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
        $reservationsEndTime = 24;
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
        if ($suite == 0) {
            $reservations = $this->receptionistModel->getAllReservationsOnDateForAllSuites($date);
        } else {
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
        $refund = $this->receptionistModel->getRefundrequests();

        $data = [
            'refund' => $refund
        ];

        $this->view('Receptionist/refund', $data);
    }

    public  function Reservation()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 7;
        $offset = ($page - 1) * $limit;
        $status = isset($_POST['status']) && $_POST['status'] != "Select Status" ? $_POST['status'] : '';

        $startDate = isset($_POST['startDate']) && !empty($_POST['startDate']) ? $_POST['startDate'] : $this->receptionistModel->getMinDate();
        $endDate = isset($_POST['endDate']) && !empty($_POST['endDate']) ? $_POST['endDate'] : $this->receptionistModel->getMaxDate();



        if ($status != '') {
            $reservations = $this->receptionistModel->getReservationWithStatus($limit, $offset, $status);
            $totalReservations = $this->receptionistModel->getTotalReservationCountWithStatus($status);
            $totalPages = ceil($totalReservations / $limit);
        } else {
            $reservations = $this->receptionistModel->getReservation($limit, $offset);
            $totalReservations = $this->receptionistModel->getTotalReservationCount();
            $totalPages = ceil($totalReservations / $limit);
        }


        if ($reservationStatus = $this->receptionistModel->getReservationStatus()) {
        } else {
            die('Something went wrong');
        }

        if ($suites = $this->receptionistModel->getSuites()) {
        } else {
            die('Something went wrong');
        }

        $capacity = $this->receptionistModel->getPackageCapacity();

        $data = [
            'reservations' => $reservations,
            'totalReservations' => $totalReservations,
            'totalPages' => $totalPages,
            'status' => $status,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'page' => $page,
            'limit' => $limit,
            'reservationStatus' => $reservationStatus,
            'suites' => $suites,
            'capacity' => $capacity

        ];

        $this->view('Receptionist/reservation', $data);
    }

    public function getOrders()
    {
        $reservations = $this->receptionistModel->getOrders();
        header('Content-Type: application/json');
        echo json_encode($reservations);
    }

    public function createOrder()
    {

        //TODO UPDATE GETTING ONGOING RESERVATION AND COMPLETED RESERVATION LOGIC 

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $order = [
                'numberOfGuests' => $_POST['numberOfGuests'],
                'suitePackage' => $_POST['suitePackage'],
                'items' => $_POST['items'],
                'slot' =>   sprintf("%02d:00:00", $_POST['slot']),
                'total' => $_POST['total'],
                'sloNo' => $_POST['slot'],
            ];

            $result = $this->receptionistModel->createOrderForWalkIn($order);

            echo json_encode($result);
        }
    }


    public function getAvailableSlotsNow()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $suite = $_GET['suiteID'];
            $result = $this->receptionistModel->getAvailableSlotsNow($suite);
            echo json_encode($result);
        }
    }



    public function markCompleted()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $orderID = $_POST['orderID'];
        }
        $result = $this->receptionistModel->markCompleted($orderID);

        if ($result == NULL) {
            echo json_encode(0);
        } else {
            echo json_encode($result);
        }
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
        $menus = $this->receptionistModel->getMenus();

        if ($food = $this->receptionistModel->getFoodReviews()) {
        } else {
            die('Something went wrong');
        }


        $data = [
            'menus' => $menus,
            'foodReview' => $food
        ];


        $this->view('Receptionist/menu', $data);
    }

    public function Orders()
    {
        $data = [];

        $this->view('Receptionist/orders');
    }

    public function getMenus()
    {
        $menus = $this->receptionistModel->getMenus();
        header('Content-Type: application/json');
        echo json_encode($menus);
    }


    public function addItemsToOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $orderID = $_POST['orderID'];
            $items = $_POST['items'];
            $totalForFood = $_POST['totalForFood'];
            $totalBill = $_POST['totalBill'];

            $data = [
                'orderID' => $orderID,
                'items' => $items,
                'totalForFood' => $totalForFood,
                'totalBill' => $totalBill
            ];
        }
        $result = $this->receptionistModel->addItemsToOrder($data);
        if ($result == NULL) {
            echo json_encode(0);
        } else {
            echo json_encode($result);
        }
    }

    public function getReservationDetails($reservationID)
    {
        $reservationDetails = $this->receptionistModel->getReservationDetailsByID($reservationID);
        echo json_encode($reservationDetails);
    }

    public function markArrived()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $reservationID = $_POST['reservationID'];
        }
        $result = $this->receptionistModel->markArrived($reservationID);

        if ($result == true) {
            echo json_encode(1);
        } else {
            echo json_encode($result);
        }
    }

    public function cancelLateReservation()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $reservationID = $_POST['reservationID'];
        }
        $result = $this->receptionistModel->cancelLateReservation($reservationID);

        if ($result == true) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function getPackageCapacity()
    {

        $capacity = $this->receptionistModel->getPackageCapacity();

        header('Content-Type: application/json');

        if ($capacity !== null) {
            echo json_encode(array($capacity));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Failed to fetch slot capacity'));
        }
    }

    public function getReservationMarkedArrivedStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $reservationID = $_POST['reservationID'];
        }
        $result = $this->receptionistModel->getReservationMarkedArrivedStatus($reservationID);
        if ($result->hasArrived == 1) {
            echo json_encode(1);
        } else {
            echo json_encode($result);
        }
    }
}
