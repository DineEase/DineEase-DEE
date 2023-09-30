<?php
class Receptionists extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        } else {
            if (isset($_SESSION['user_id'])) {
                if ($_SESSION['role'] != 'receptionist') {
                    logout();
                }
            }
        }
    }
    public  function Index()
    {
        $data = [];

        $this->view('Receptionist/index');
    }
}
