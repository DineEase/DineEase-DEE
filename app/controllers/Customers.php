<?php
class Customers extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
    }

    public  function Index()
    {
        $data = [];

        $this->view('customer/index');
    }
    public  function Home()
    {
        $data = [];

        $this->view('customer/home');
    }
}
