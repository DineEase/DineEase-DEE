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
                    destroyOldSession();
                }
            }
        }
    }
    public  function Index()
    {
        $data = [];

        $this->view('Receptionist/index');
    }
    public  function Refund()
    {
        $data = [];

        $this->view('Receptionist/refund');
    }

    public  function Reservation()
    {
        $data = [];

        $this->view('Receptionist/reservation');
    }

    public function Profile()
    {
        $data = [];

        $this->view('Receptionist/profile');
    }

    public function Review()
    {
        $data = [];

        $this->view('Receptionist/review');
    }

    public function Menu()
    {
        $data = [];

        $this->view('Receptionist/menu');
    }

    public function Orders()
    {
        $data = [];

        $this->view('Receptionist/orders');
    }
    
}
