<?php
class Users extends Controller
{
    public function __construct()
    {
    }


    // Define the view method
    public function view($view, $data = [])
    {
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die('View does not exist');
        }
    }

    // Define the login method
    public function login()
    {
        //check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //process form
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
}
