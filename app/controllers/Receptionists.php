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

    public function Reservation()
{
    $user_id = $_SESSION['user_id'];

    $reservations =  $this->receptionistModel->getReservation($user_id);
    $data = [ 
        'reservations' => $reservations
    ];

    $this->view('Receptionist/reservation', $data);
}


    


    public function Profile()
    {
        $data = [];

        $this->view('Receptionist/profile');
    }

    public function Review()
    {
        $reviews = $this->receptionistModel->getReviews();
        $data = [
            'reviews' => $reviews,

        ];
        $this->view('Receptionist/review', $data);
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
