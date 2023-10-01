<?php
class Customers extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        } else {
            if (isset($_SESSION['user_id'])) {
                if ($_SESSION['role'] != 'customer') {
                    destroyOldSession();
                }
            }
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
    public  function Reservation()
    {
        $data = [];

        $this->view('customer/reservation');
    }
    public  function Menus()
    {
        $data = [];

        $this->view('customer/menus');
    }
}
