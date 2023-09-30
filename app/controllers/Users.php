<?php
class Users extends Controller
{
    public $userModel;
    public function __construct()
    {
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
            //validate dob
            if (empty($data['dob'])) {
                $data['dob_err'] = 'Please enter dob';
            }
            //validate mobile_no
            if (empty($data['mobile_no'])) {
                $data['mobile_no_err'] = 'Please enter email';
            } else {
                // check email
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
                //validated

                //hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //register user
                if ($this->userModel->register($data)) {

                    flash('register_success', 'You are registered and can log in');
                    redirect('users/login');
                } else {
                    die('Something went wrong');
                }

                // echo '<pre>';
                // print_r($data);
                // echo '</pre>';
            } else {
                //load view with errors
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
    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_mobile_no'] = $user->mobile_no;
        redirect('customer/index');
    }
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_mobile_no']);
        session_destroy();
        redirect('users/login');
    }

    public function isLoggedIn(){
        if(isset($_SESSION['user_id'])){
            return true;
        }else{
            return false;
        }
    }

}
