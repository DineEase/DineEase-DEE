<?php
class Chefs extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('users/login');
        }
    }
    public  function Index()
    {
        $data = [];

        $this->view('chef/index');
    }
}
