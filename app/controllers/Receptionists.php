<?php

use GuzzleHttp\Psr7\ServerRequest;

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
        $date = date('Y-m-d');
        $suite = 0;
        $reservationsStartTime = 8;
        $reservationsEndTime = 23;
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (isset($_POST)) {

            if (isset($_POST['date'])) {
                $dateInput = $_POST['date'];
                $dateObject = new DateTime($dateInput);
                $date = $dateObject->format('Y-m-d');
            }
            if (isset($_POST['suite'])) {
                $suite = $_POST['suite'];
            }
        }

        $packages = $this->receptionistModel->getPackages();
        //TODO #62 Receptionist View shows all reservations for the without filtering those which are cancelled\
        if($suite==0){
            $reservations = $this->receptionistModel->getAllReservationsOnDateForAllSuites($date);
        }
        else{
            $reservations = $this->receptionistModel->getAllReservationsOnDate($date, $suite);
        }

        $data = [
            'input' => $_POST,
            'suite' => $suite,
            'date' => $date,
            'packages' => $packages,
            'reservations' => $reservations,
            'reservationsStartTime' => $reservationsStartTime,
            'reservationsEndTime' => $reservationsEndTime
        ];

        $this->view('Receptionist/index', $data);
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
