<?php
class Users extends Controller
{
    public $userModel;
    public function __construct()
    {   
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_mobile_no']);
        unset($_SESSION['employee_id']);
        unset($_SESSION['employee_role']);
        unset($_SESSION['profile_picture']);
        $this->userModel = $this->model('User');
    }

    // Define the login method
    public function login()
    {
        //check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //process form
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //init data
            $data = [
                'mobile_no' => isset($_POST['mobile_no']) ? trim($_POST['mobile_no']) : '',
                'password' =>  isset($_POST['password']) ? trim($_POST['password']) : '',
                'mobile_no_err' => '',
                'password_err' => '',
            ];

            //validate mobile_no
            if (empty($data['mobile_no'])) {
                $data['mobile_no_err'] = 'Please enter Mobile number';
            } else {
                // check mobile_no
                if ($this->userModel->findUserByMobile($data['mobile_no'])) {
                } else {
                    $data['mobile_no_err'] = 'No user found';
                }
            }

            //validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['password']) < 8) {
                $data['password_err'] = 'Password must be at least 8 characters';
            }

            //make sure errors are empty
            if (empty($data['mobile_no_err']) && empty($data['password_err'])) {
                //validated
                //check and set logged in user
                $loggedInUser = $this->userModel->login($data['mobile_no'], $data['password']);

                if ($loggedInUser) {
                    //create session
                    $this->createUserSession($loggedInUser);
                    //have to handle roles

                } else {
                    $data['password_err'] = 'Password incorrect';
                    $this->view('users/login', $data);
                }
            } else {
                //load view with errors
                $this->view('users/login', $data);
            }
        } else {
            //init data
            $data = [
                'mobile_no' => '',
                'password' => '',
                'mobile_no_err' => '',
                'password_err' => '',
            ];
            //load view
            $this->view('users/login', $data);
        }
    }

    public function register()
    {
        //check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //process form
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //init data
            $data = [
                'name' => isset($_POST['name']) ? trim($_POST['name']) : '',
                'email' => isset($_POST['email']) ? trim($_POST['email']) : '',
                'dob' => isset($_POST['dob']) ? trim($_POST['dob']) : '',
                'mobile_no' => isset($_POST['mobile_no']) ? trim($_POST['mobile_no']) : '',
                'password' => isset($_POST['password']) ? trim($_POST['password']) : '',
                'confirm_password' => isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '',
                'name_err' => '',
                'email_err' => '',
                'dob_err' => '',
                'mobile_no_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            //validate name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }
            //validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                // check email
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already taken';
                }
            }
            $hunterApiKey = 'f0b22562feaf8e34e1332f9e148c6f246dc78045';
            if (!$this->verifyEmailUsingHunter($data['email'], $hunterApiKey)) {
                $data['email_err'] = 'Email address is not deliverable';
            }  
            //validate dob
            if (empty($data['dob'])) {
                $data['dob_err'] = 'Please enter dob';   
            }
            else 
            {
                if (strtotime($data['dob']) > strtotime('now')) {
                    $data['dob_err'] = 'Please enter a valid date of birth.';
                }
            }            
            //validate mobile_no
            if (empty($data['mobile_no'])) {
                $data['mobile_no_err'] = 'Please enter mobile number';
            } else {
                // check mobile number
                if ($this->userModel->findUserByMobile($data['mobile_no'])) {
                    $data['mobile_no_err'] = 'Mobile Number is already registered';
                }
            }
            //validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['password']) < 8) {
                $data['password_err'] = 'Password must be at least 8 characters';
            }
            //validate confirm_password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please enter confirm password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            //make sure errors are empty
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['dob_err']) && empty($data['mobile_no_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // validated
                $data['password'] = password_hash(trim($data['password']), PASSWORD_DEFAULT);

                //register user
                if ($this->userModel->register($data)) {
                    $token = $this->userModel->generateactivationToken($data['email']);
                    if($this->sendaccountactivateEmail($data['email'], $token)){
                    flash('register_success', 'Check email for activation link');
                    
                    redirect('users/login');
                    }
                    else{
                        flash('register_success', 'Cannot Send Activation Link. Contact Us');
                    }
                } else {
                    die('Something went wrong');
                }
            } else {
                // load view with errors
                $this->view('users/register', $data);
            }
        } else {
            //init data
            $data = [
                'name' => '',
                'email' => '',
                'dob' => '',
                'mobile_no' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'dob_err' => '',
                'mobile_no_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            //load view
            $this->view('users/register', $data);
        }
    }

    public function staff()
    {

        //check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //process form
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //init data
            $data = [
                'mobile_no' => isset($_POST['mobile_no']) ? trim($_POST['mobile_no']) : '',
                'password' =>  isset($_POST['password']) ? trim($_POST['password']) : '',
                'mobile_no_err' => '',
                'password_err' => '',
            ];

            //validate mobile_no
            if (empty($data['mobile_no'])) {
                $data['mobile_no_err'] = 'Please enter Mobile number';
            } else {
                // check mobile_no
                if ($this->userModel->findUserByMobile($data['mobile_no'])) {
                } else {
                    $data['mobile_no_err'] = 'No user found';
                }
            }

            //validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['password']) < 8) {
                $data['password_err'] = 'Password must be at least 8 characters';
            }

            //make sure errors are empty
            if (empty($data['mobile_no_err']) && empty($data['password_err'])) {
                //validated
                //check and set logged in user
                $loggedInUser = $this->userModel->login($data['mobile_no'], $data['password']);

                if ($loggedInUser) {
                    //create session
                    $employee = $this->userModel->getEmployeeById($loggedInUser->user_id);
                    if ($employee) {
                        $this->createStaffSession($loggedInUser, $employee);
                    } else {
                        $data['password_err'] = 'You do not have permission to login as staff';
                        $this->view('users/staff', $data);
                    }
                } else {
                    $data['password_err'] = 'Password incorrect';
                    $this->view('users/staff', $data);
                }
            } else {
                //load view with errors
                $this->view('users/staff', $data);
            }
        } else {
            //init data
            $data = [
                'mobile_no' => '',
                'password' => '',
                'mobile_no_err' => '',
                'password_err' => '',
            ];
            //load view
            $this->view('users/staff', $data);
        }
    }
    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_mobile_no'] = $user->mobile_no;
        $_SESSION['role'] = 'customer';
        $_SESSION['profile_picture'] = $user->profile_picture;
        redirect('customers/reservation');
    }

    public function createStaffSession($user, $employee)
    {
        // user roles    
        // 1=Managers
        // 2=InventoryManagers
        // 3=Receptionists
        // 4=Chefs

        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_mobile_no'] = $user->mobile_no;
        $_SESSION['employee_id'] = $employee->user_id;
        $_SESSION['role'] = $employee->role_id;
        $_SESSION['profile_picture'] = $user->profile_picture;
        

        // echo '<pre>';
        // print_r($_SESSION);
        // echo '</pre>';

        switch ((string)$_SESSION['role']) {
            case '1':
                $_SESSION['role'] = 'manager';
                redirect('managers/index');
                break;
            case '2':
                $_SESSION['role'] = 'inventoryManager';
                redirect('inventoryManagers/inventory');
                break;
            case '3':
                $_SESSION['role'] = 'receptionist';
                redirect('receptionists/reservation');
                break;
            case '4':
                $_SESSION['role'] = 'chef';
                redirect('chefs/menu');
                break;
        }
    }

    function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_mobile_no']);
        unset($_SESSION['employee_id']);
        unset($_SESSION['employee_role']);
        unset($_SESSION['profile_picture']);
        session_destroy();
        redirect('users/login');
    }

    public function forgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset-password'])) {
            // Process the form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $email = isset($_POST['email']) ? trim($_POST['email']) : '';

            // Validate email
            if (empty($email)) {
                $data['email_err'] = 'Please enter your email address.';
            } else {
                if ($this->userModel->findUserByEmail($email)) {
                    $token = $this->userModel->generatePasswordResetToken($email);

                    // Send email with the reset link
                    $this->sendPasswordResetEmail($email, $token);
                    
                    //var_dump('error');
                    flash('password_reset', 'Password reset link sent to your email.');
                    redirect('users/login');
                } else {
                    $data['email_err'] = 'No account found with that email address.';
                }
            }

            $this->view('users/enter_email', $data);
        } else {
            // Load the view for entering the email address
            $data = ['email' => '', 'email_err' => ''];
            $this->view('users/enter_email', $data);
        }
    }

    public function resetPassword($token) {
        $email = $this->userModel->getEmailByPasswordResetToken($token);

        
        $data = []; // Initialize $data array
        //var_dump($token);
        //var_dump($email);
        //var_dump($this->userModel->verifyPasswordResetToken($email, $token));
        if ($this->userModel->verifyPasswordResetToken($email, $token)) {
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process the password reset form
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
                $newPassword = isset($_POST['new_password']) ? trim($_POST['new_password']) : '';
                $confirmPassword = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';
    
                // Validate passwords
                if (empty($newPassword)) {
                    $data['new_password_err'] = 'Please enter a new password.';
                } elseif (strlen($newPassword) < 8) {
                    $data['new_password_err'] = 'Password must be at least 8 characters.';
                }
    
                if (empty($confirmPassword)) {
                    $data['confirm_password_err'] = 'Please confirm your password.';
                } elseif ($newPassword != $confirmPassword) {
                    $data['confirm_password_err'] = 'Passwords do not match.';
                }
    
                // If no errors, update the password
                if (empty($data['new_password_err']) && empty($data['confirm_password_err'])) {
                    $this->userModel->resetPassword($email, $newPassword);
    
                    // Mark the token as used
                    $this->userModel->markPasswordResetTokenAsUsed($token);
                    //$this->userModel->activateEmployeeByEmail($email);
                    // Set success message for display
                    $data['success'] = 'Password reset successfully.';
                }
            }
    
            $data['token'] = $token;
            $this->view('users/reset_password', $data);
        } else {
            // Invalid or expired token
            //var_dump('error');
            flash('password_reset_error', 'Invalid or expired password reset link.');
            var_dump($email); // Debugging: Display email even in the case of an error
            //redirect('users/login');
        }
    }
    
    public function resetPasswordEmployee($token) {
        $email = $this->userModel->getEmailByPasswordResetToken($token);

        //var_dump($email);
        //$data = []; // Initialize $data array
        //var_dump($token);
        //var_dump($email);
        //var_dump($this->userModel->verifyPasswordResetToken($email, $token));
        if ($this->userModel->verifyPasswordResetToken($email, $token)) {
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process the password reset form
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
                $newPassword = isset($_POST['new_password']) ? trim($_POST['new_password']) : '';
                $confirmPassword = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';
    
                // Validate passwords
                if (empty($newPassword)) {
                    $data['new_password_err'] = 'Please enter a new password.';
                } elseif (strlen($newPassword) < 8) {
                    $data['new_password_err'] = 'Password must be at least 8 characters.';
                }
    
                if (empty($confirmPassword)) {
                    $data['confirm_password_err'] = 'Please confirm your password.';
                } elseif ($newPassword != $confirmPassword) {
                    $data['confirm_password_err'] = 'Passwords do not match.';
                }
    
                // If no errors, update the password
                if (empty($data['new_password_err']) && empty($data['confirm_password_err'])) {
                    try {
                        // Reset the password
                        $this->userModel->resetPassword($email, $newPassword);
            
                        // Activate the employee
                        if($this->userModel->activateEmployeeByEmail($email)){
                           
                        // Mark the token as used
                        $this->userModel->markPasswordResetTokenAsUsed($token);
            
                        // Set success message for display
                        $data['success'] = 'Password reset successfully.';
                        }
                    } catch (Exception $e) {
                        // Log the exception for debugging purposes
                        error_log('Exception in resetPasswordEmployee: ' . $e->getMessage());
            
                        // Provide a user-friendly message
                        // You might want to redirect the user or show an appropriate message on the page
                        $data['error_message'] = 'Something went wrong. Please try again.';
                    }
                }
            }
    
            $data['token'] = $token;
            $this->view('manager/reset_password_employee', $data);
        } else {
            // Invalid or expired token
            //var_dump('error');
            flash('password_reset_error', 'Invalid or expired password reset link.');
            //var_dump($email); // Debugging: Display email even in the case of an error
            //redirect('users/login');
        }
    }
    
    
    
    

    // Helper method to send the password reset email
private function sendPasswordResetEmail($email, $token) {
        // Load PHPMailer library
        // Adjust the paths based on your PHPMailer location

require_once APPROOT . '/vendor/autoload.php'; // Include Composer autoloader


    
        // Create a new PHPMailer instance
        $mail = new PHPMailer\PHPMailer\PHPMailer();
    
        // Set up SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // Your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'pachax001@gmail.com';
        $mail->Password   = 'soqrsqcrcwsmxpyd ';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
    
        // Set up sender and recipient
        $mail->setFrom('pachax001@gmail.com', 'pachax001');
        $mail->addAddress($email);
    
        // Set email content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset';
        $mail->Body    = 'Link is only valid for 1 hour. Click the following link to reset your password: ' . URLROOT . '/users/resetPassword/' . $token;
    
        // Send the email
        if ($mail->send()) {
            // Email sent successfully
            echo 'Email sent successfully.';
            return true;
        } else {
            // Error in sending email
            
            echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
            return false;
        }
    }
    public function activateaccount($token) {
        $email = $this->userModel->getEmailByactivationToken($token);

        var_dump($email);
        $data = []; // Initialize $data array
        //var_dump($token);
        //var_dump($email);
        //var_dump($this->userModel->verifyactivationToken($email, $token));
        if ($this->userModel->verifyactivationToken($email, $token)) {
            $this->userModel->activateaccount($email);
            $this->userModel->markactivationTokenAsUsed($token);
            flash('password_reset', 'Activated');
                    redirect('users/login');
            
    }
}
private function verifyEmailUsingHunter($email, $apiKey)
{
    require_once APPROOT . '/vendor/autoload.php';
    $url = "https://api.hunter.io/v2/email-verifier?email=" . urlencode($email) . "&api_key=" . $apiKey;

    $client = new \GuzzleHttp\Client(['verify' => false]);

    $response = $client->get($url);

    $data = json_decode($response->getBody(), true);

    // Check if the API request was successful
    if ($response->getStatusCode() === 200) {
        return $data['data']['result'] === 'deliverable';
    } else {
        // Handle API error
        return false;
    }
}

    
    private function sendaccountactivateEmail($email, $token) {
        // Load PHPMailer library
        // Adjust the paths based on your PHPMailer location

require_once APPROOT . '/vendor/autoload.php'; // Include Composer autoloader


    
        // Create a new PHPMailer instance
        $mail = new PHPMailer\PHPMailer\PHPMailer();
    
        // Set up SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // Your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'pachax001@gmail.com';
        $mail->Password   = 'soqrsqcrcwsmxpyd ';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
    
        // Set up sender and recipient
        $mail->setFrom('pachax001@gmail.com', 'pachax001');
        $mail->addAddress($email);
    
        // Set email content
        $mail->isHTML(true);
        $mail->Subject = 'Activate Account';
        $mail->Body    = 'Link is only valid for 1 hour. Click the following link to activate your account: ' . URLROOT . '/users/activateaccount/' . $token;
    
        // Send the email
        if ($mail->send()) {
            // Email sent successfully
            echo 'Email sent successfully.';
            return true;
        } else {
            // Error in sending email
            
            echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
            return false;
        }
    }
    
    
}
