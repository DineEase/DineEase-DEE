<?php


class Profiles extends Controller
{
    public $profileModel;

    public function __construct()
    {

        $this->profileModel = $this->model('Profile');
    }

    public function uploadUserImage()
    {
        // Ensure the user is logged in
        if (!isset($_SESSION['user_id'])) {
            die("You must be logged in to upload a photo.");
        }
    
        $userId = $_SESSION['user_id'];
        $userInfo = $this->profileModel->getUserInfo($userId); // Assuming this method exists and returns user role/type
    
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
                        $_SESSION['success_message'] = 'Profile picture updated successfully.';
                        $this->redirectToUserPage($userInfo['role']);
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
            case 'admin':
                redirect('admin/dashboard');
                break;
            case 'customer':
                redirect('customers/profile');
                break;
            case 'staff':
                redirect('staff/dashboard');
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
}
