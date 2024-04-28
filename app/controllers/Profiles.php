<?php


class Profiles extends Controller
{
    public $profileModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('login');
        }

        $this->profileModel = $this->model('Profile');
    }

    public function uploadUserImage()
    {
        // Ensure the user is logged in
        if (!isset($_SESSION['user_id'])) {
            die("You must be logged in to upload a photo.");
        }

        $userId = $_SESSION['user_id'];
        $userInfo = $_SESSION['role'];

        $uploadDir = 'img/profilePhotos/'; // Ensure the path is correct
        $allowedTypes = ['jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png'];

        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
            $fileTmpPath = $_FILES['photo']['tmp_name'];
            $fileType = $_FILES['photo']['type'];
            $fileName = $_FILES['photo']['name'];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (!array_key_exists($fileExt, $allowedTypes) || $fileType !== $allowedTypes[$fileExt]) {
                echo "Error: Only JPG, JPEG, and PNG files are allowed.";
            } elseif ($_FILES['photo']['size'] > 5000000) { // 5MB limit
                echo "Error: File size is too large.";
            } else {
                $newFileName = $userId . '_' . time() . '.' . $fileExt;
                $destination = $uploadDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $destination)) {
                    if ($this->profileModel->updateProfilePhoto($userId, $newFileName)) {
                        $_SESSION['profile_picture'] = $newFileName;
                        $_SESSION['ppsuccess_message'] = 'Profile picture updated successfully.';
                        $this->redirectToUserPage($_SESSION['role']);
                    }
                } else {
                    echo "Error uploading the file.";
                }
            }
        } else {
            echo "Error: " . $this->fileUploadError($_FILES['photo']['error']);
        }
    }


    private function redirectToUserPage($role)
    {
        switch ($role) {
            case 'manager':
                redirect('managers/profile');
                break;
            case 'inventoryManager':
                redirect('inventoryManagers/profile');
                break;
            case 'receptionist':
                redirect('receptionists/profile');
                break;
            case 'chef':
                redirect('chefs/profile');
                break;
            case 'customer':
                redirect('customers/profile');
                break;
            default:
                redirect('login');
                break;
        }
    }

    private function fileUploadError($code)
    {
        switch ($code) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                return "File too large (limit of " . ini_get('upload_max_filesize') . " bytes).";
            case UPLOAD_ERR_PARTIAL:
                return "File upload was not completed.";
            case UPLOAD_ERR_NO_FILE:
                return "No file was uploaded.";
            case UPLOAD_ERR_NO_TMP_DIR:
                return "Missing a temporary folder.";
            case UPLOAD_ERR_CANT_WRITE:
                return "Failed to write file to disk.";
            case UPLOAD_ERR_EXTENSION:
                return "File upload stopped by extension.";
            default:
                return "Unknown upload error.";
        }
    }




    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'old-psw' => trim($_POST['old-psw'] ?? ''),
                'new-psw' => trim($_POST['new-psw'] ?? ''),
                'confirm-psw' => trim($_POST['confirm-psw'] ?? ''),
                'old-psw_err' => '',
                'new-psw_err' => '',
                'confirm-psw_err' => '',
                'user_id' => $_SESSION['user_id'],
                'role' => $_SESSION['role']
            ];

            // Validate old password
            if (empty($data['old-psw'])) {
                $data['old-psw_err'] = 'Please enter your old password.';
            } elseif (!$this->profileModel->verifyPassword($data['user_id'], $data['old-psw'])) {
                $data['old-psw_err'] = 'The old password is incorrect.';
            }

            // Validate new password
            if (empty($data['new-psw'])) {
                $data['new-psw_err'] = 'Please enter a new password.';
            } elseif (strlen($data['new-psw']) < 6) {
                $data['new-psw_err'] = 'The new password must be at least 6 characters.';
            }

            // Validate password confirmation
            if (empty($data['confirm-psw'])) {
                $data['confirm-psw_err'] = 'Please confirm your new password.';
            } elseif ($data['new-psw'] !== $data['confirm-psw']) {
                $data['confirm-psw_err'] = 'The new passwords do not match.';
            }

            // Proceed if no errors
            if (empty($data['old-psw_err']) && empty($data['new-psw_err']) && empty($data['confirm-psw_err'])) {
                $data['new-psw'] = password_hash(trim($data['new-psw']), PASSWORD_DEFAULT);
                if ($this->profileModel->updatePassword($data['user_id'], $data['new-psw'])) {
                    $_SESSION['pwsuccess_message'] = 'Password updated successfully.';
                    $this->redirectToUserPage($_SESSION['role']);
                } else {
                    $_SESSION['error_message'] = 'Something went wrong while updating your password.';
                    $this->redirectToUserPage($_SESSION['role']);
                }
            } else {
                // Store errors in the session and redirect back to the form
                $_SESSION['errors'] = [$data['old-psw_err'], $data['new-psw_err'], $data['confirm-psw_err']];
                $this->redirectToUserPage($_SESSION['role']);
            }
        } else {
            // Redirect to the form if not a POST request
            $this->redirectToUserPage($_SESSION['role']);
        }
    }

    public function updateUserDetails()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Validation (example)
            if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                // Handle error
                $_SESSION['error'] = 'Invalid email format';
                $this->redirectToUserPage($_SESSION['role']);
            }

            // Assume data is valid
            $data = [
                'user_name' => $_POST['user_name'],
                'email' => $_POST['email'],
                'mobile_no' => $_POST['mobile_no']
            ];
            $userId = $_SESSION['user_id'];

            // Update logic
            if ($this->profileModel->updateUser($userId ,$data)) {
                // Success message
                $_SESSION['user_name'] = $data['user_name'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['mobile_no'] = $data['mobile_no'];
                
                
                $_SESSION['success_message'] = 'Details updated successfully';
                $this->redirectToUserPage($_SESSION['role']);

            } else {
                // Error message
                $_SESSION['error'] = 'Failed to update details';
                $this->redirectToUserPage($_SESSION['role']);
            }
        }
    }
}
