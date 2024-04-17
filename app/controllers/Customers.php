<?php
class Customers extends Controller
{
    public $customerModel;

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
        $this->customerModel = $this->model('Customer');
    }

    public function Index()
    {
        $reservations = $this->customerModel->getReservation($_SESSION['user_id']);
        $data = [
            'reservations' => $reservations
        ];
        $this->view('customer/index', $data);
    }
    public function Home()
    {
        $data = [];

        $this->view('customer/home');
    }

    public function Reservation()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        $search = isset($_POST['search']) && !empty($_POST['search']) ? $_POST['search'] : '';
        $limit = 7;
        $offset = ($page - 1) * $limit;
        $status = isset($_POST['status']) && $_POST['status'] != "Select Status" ? $_POST['status'] : '';

        $startDate = isset($_POST['startDate']) && !empty($_POST['startDate']) ? $_POST['startDate'] : $this->customerModel->getMinDate();
        $endDate = isset($_POST['endDate']) && !empty($_POST['endDate']) ? $_POST['endDate'] : $this->customerModel->getMaxDate();

        if ($startDate > $endDate) {
            flash('reservation_message', 'Start date cannot be greater than end date', 'alert alert-danger');
            redirect('customers/reservation');
        }

        if ($startDate == $endDate) {
            $endDate = date('Y-m-d', strtotime($endDate . ' +1 day'));
        }

        if ($search != '') {
            $reservations = $this->customerModel->getReservationWithSearch($_SESSION['user_id'], $limit, $offset, $search);
            $totalReservations = $this->customerModel->getTotalReservationCountWithSearch($_SESSION['user_id'], $search);
            $totalPages = ceil($totalReservations / $limit);
        }

        //DONE: #16 // Add a condition to filter reservations based on status
        else if ($status != ' ' && $search == '' && $startDate == '' && $endDate == '') {
            $reservations = $this->customerModel->getReservationWithStatus($_SESSION['user_id'], $limit, $offset, $status);
            $totalReservations = $this->customerModel->getTotalReservationCountWithStatus($_SESSION['user_id'], $status);
            $totalPages = ceil($totalReservations / $limit);
        }

        //DONE: #17 // Add a condition to filter reservations based on date range - done

        else if (($startDate != '' || $endDate != '') && $status == '' && $search == '') {

            $reservations = $this->customerModel->getReservationWithDateRange($_SESSION['user_id'], $limit, $offset, $startDate, $endDate);
            $totalReservations = $this->customerModel->getTotalReservationCountWithDateRange($_SESSION['user_id'], $startDate, $endDate);
            $totalPages = ceil($totalReservations / $limit);
        } else if ($status != '' && $search == '' && ($startDate != '' || $endDate != '')) {
            $reservations = $this->customerModel->getReservationWithStatusAndDateRange($_SESSION['user_id'], $limit, $offset, $status, $startDate, $endDate);
            $totalReservations = $this->customerModel->getTotalReservationCountWithStatusAndDateRange($_SESSION['user_id'], $status, $startDate, $endDate);
            $totalPages = ceil($totalReservations / $limit);
        }

        //TODO #18 Add a condition to filter reservations based on search, status and date range
        //have to submit two forms to get this condition to work figure out a way to submit two forms at once
        //or use ajax to submit the second form

        // else if ($status != '' && $search != '' && ($startDate != '' || $endDate != '')) {
        //     $reservations = $this->customerModel->getReservationWithSearchStatusAndDateRange($_SESSION['user_id'], $limit, $offset, $search, $status, $startDate, $endDate);
        //     $totalReservations = $this->customerModel->getTotalReservationCountWithSearchStatusAndDateRange($_SESSION['user_id'], $search, $status, $startDate, $endDate);
        //     $totalPages = ceil($totalReservations / $limit);
        // }

        else {
            $reservations = $this->customerModel->getReservation($_SESSION['user_id'], $limit, $offset);
            $totalReservationsCount = $this->customerModel->getTotalReservationCount($_SESSION['user_id']);
            $totalPages = ceil($totalReservationsCount / $limit);
        }

        $reservationStatus = $this->customerModel->getReservationStatus();

        $data = [

            'reservations' => $reservations,
            'status' => $status,
            'search' => $search,
            'page' => $page,
            'totalPages' => $totalPages,
            'limit' => $limit,
            'reservationStatus' => $reservationStatus,
            'startDate' => $startDate,
            'endDate' => $endDate

        ];
        $this->view('customer/reservation', $data);
    }

    public function Menu()
    {
        $menus = $this->customerModel->getMenus();


        $data = [
            'menus' => $menus
        ];


        $this->view('customer/menu', $data);
    }

    public function Profile()
    {
        $data = [];

        $this->view('customer/profile', $data);
    }

    public function Review()
    {
        $reviews = $this->customerModel->getReviews($_SESSION['user_id']);
        $data = [
            'reviews' => $reviews,

        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'customerID' => $_SESSION['user_id'],
                'rating' => isset($_POST['rating']) ? trim($_POST['rating']) : '',
                'comment' => isset($_POST['comment']) ? trim($_POST['comment']) : '',
                'customerID_err' => '',
                'rating_err' => '',
                'comment_err' => '',
                'remove_review_ID' => isset($_POST['remove_review_ID']) ? trim($_POST['remove_review_ID']) : ''
            ];
            if (!empty($data['customerID'])) {
                if (!empty($data['rating'])) {
                    if (!empty($data['comment'])) {
                        if ($this->customerModel->addReview($data)) {
                            flash('review_message', 'Review Added');
                            redirect('customers/review');
                        } else {
                            die('Something went wrong');
                        }
                    } else {
                    }
                } else {
                }
            } else {
            }
        }

        $this->view('customer/review', $data);
    }



    public function deleteReview($reviewID)
    {
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Get the review ID from the hidden input field
            $reviewID = $_POST['remove_review_id'];

            // Call the removeReview method from the model to delete the review
            $this->customerModel->removeReview($reviewID);



            // Redirect back to the Reviews page
            redirect('customers/review');
        } else {
            // If the form is not submitted directly, redirect to the Reviews page
            redirect('customers/review');
        }
    }

    public function CancelReservation($reservationID)
    {
        $this->customerModel->cancelReservation($reservationID);
        flash('reservation_message', 'Reservation cancelled successfully');
        redirect('customers/reservation');
    }

    public function addReservation()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Process the reservation form data
            $data = [
                'customerID' => $_SESSION['user_id'],
                'tableID' => trim($_POST['tableID']),
                'packageID' => trim($_POST['packageID']),
                'date' => trim($_POST['date']),
                'reservationStartTime' => trim($_POST['reservationStartTime']),
                'reservationEndTime' => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(trim($_POST['reservationStartTime'])))),
                'numOfPeople' => trim($_POST['numOfPeople']),
                'amount' => trim($_POST['amount']),

            ];

            // Validate the data (similar to what you've done in AddReservation method)

            // If validation passes, call the model method to add the reservation
            if ($this->customerModel->addReservation($data)) {

                $reservationID = $this->customerModel->getAddedReservationID($data);

                $slot = date("H", strtotime($data['reservationStartTime']));

                if ($this->customerModel->addToSlot($reservationID, $data, $slot)) {
                    $reservationID = $this->customerModel->getAddedReservationID($data);
                    echo json_encode($reservationID);
                }
            } else {
                die('Something went wrong');
            }
        }
    }

    public function getReservationDetails($reservationID)
    {
        $reservationDetails = $this->customerModel->getReservationDetailsByID($reservationID);
        echo json_encode($reservationDetails);
    }

    public function markPaid()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $reservationID = $_POST['reservationID'];
        }
        $this->customerModel->markPaid($reservationID);
    }

    public function makePayment()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'invoiceID' => trim($_POST['invoiceID']),
                'reservationID' => trim($_POST['reservationID']),
                'amount' => trim($_POST['amount']),
                'paymentMethod' => trim($_POST['paymentMethod']),
                'reservationID_err' => '',
                'amount_err' => '',
                'paymentMethod_err' => ''
            ];
        }
        if ($this->customerModel->makePayment($data)) {
            echo json_encode($data);

        } else {
        }
    }

    public function createOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if(isset($_POST['orderItems'])){
                $orderItems = $_POST['orderItems'];
            }
            else{
                $orderItems = [];
            }
            $data = [
                'customerID' => $_SESSION['user_id'],
                'reservationID' => trim($_POST['reservationID']),
                'orderItems' => $orderItems,
                'tableID' => 1,
                'orderTime'=>date('Y-m-d H:i:s'),
                'orderStatus'=>'Queued'
            ];
            
            if ($this->customerModel->createOrder($data)) {
                echo ("Order created successfully") ;
            } else {
                die('Something went wrong');
            }

        }
       
    }

    public function getMenuItemsAPI()
    {
        $menuItems = $this->customerModel->getMenus();

        // Set header as JSON for the response
        header('Content-Type: application/json');

        // Return the menu items as JSON
        echo json_encode($menuItems);
    }

    public function getReservationSlots()
    {
        $date = $_GET['date'] ?? null;

        if (!$date) {
            http_response_code(400);
            echo json_encode(['error' => 'No date provided']);
            return;
        }

        $slots = $this->customerModel->getSlots($date);
        header('Content-Type: application/json');
        echo json_encode($slots);
    }

    public function payhereprocesss()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'amount' => trim($_POST['amount'])
            ];
        }
        $amount = $data['amount'];
        $merchant_id = "1226500";
        $order_id = 2;
        $currency = 'LKR';
        $merchant_secret = "Mzg2MDAyNTU4NzMyMTI4OTY5MTAyOTM1MDc1NDk1MjIzMDM4MjQzNQ==";
        $hash = strtoupper(
            md5(
                $merchant_id .
                    $order_id .
                    number_format($amount, 2, '.', '') .
                    $currency .
                    strtoupper(md5($merchant_secret))
            )
        );
        $array = [];
        $array['amount'] = $amount;
        $array['merchant_id'] = $merchant_id;
        $array['order_id'] = $order_id;
        $array['currency'] = $currency;
        $array['hash'] = $hash;
        $array['first_name'] = 'dew';
        $array['last_name'] = 'Liyanage';
        $array['email'] = 'dew@gmail.com';
        $array['phone'] = '0771234567';
        $array['address'] = 'No.1, Galle Road';
        $array['city'] = 'Colombo';
        $array['country'] = 'Sri Lanka';
        $array['items'] = 'Dinner';

        $jsonObj = json_encode($array);
        echo $jsonObj;
    }
}
