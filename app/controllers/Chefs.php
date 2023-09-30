<?php
class Chefs extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        } else {
            if (isset($_SESSION['user_id'])) {
                if ($_SESSION['role'] != 'chef') {
                    logout();
                }
            }
        }
    }
    public  function Index()
    {
        $data = [];

        $this->view('chef/index');
    }
}
