<?php
class Receptionists extends Controller
{
    public $receptionistModel;
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
        $this->receptionistModel = $this->model('Receptionist');
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
        $reservations = $this->receptionistModel->getReservation($_SESSION['user_id']);
        // $request= $this->receptionistModel->getRequests();

        $data = [
            'reservations' => $reservations,
            // 'request' => $request
        ];

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
