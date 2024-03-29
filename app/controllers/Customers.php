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
        $limit = 10;
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

        //todo: #16 // Add a condition to filter reservations based on status
        else if ($status != ' ' && $search == '' && $startDate == '' && $endDate == '') {
            $reservations = $this->customerModel->getReservationWithStatus($_SESSION['user_id'], $limit, $offset, $status);
            $totalReservations = $this->customerModel->getTotalReservationCountWithStatus($_SESSION['user_id'], $status);
            $totalPages = ceil($totalReservations / $limit);
        }

        //todo: #17 // Add a condition to filter reservations based on date range

        else if (($startDate != '' || $endDate != '') && $status == '' && $search == '') {

            $reservations = $this->customerModel->getReservationWithDateRange($_SESSION['user_id'], $limit, $offset, $startDate, $endDate);
            $totalReservations = $this->customerModel->getTotalReservationCountWithDateRange($_SESSION['user_id'], $startDate, $endDate);
            $totalPages = ceil($totalReservations / $limit);
        } 
        
        else if ($status != '' && $search == '' && ($startDate != '' || $endDate != '')) {
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
            // Process the reservation form data
            $data = [
                'customerID' => $_SESSION['user_id'],
                'tableID' => trim($_POST['tableID']), // Assuming you have a tableID field in your form
                'packageID' => trim($_POST['packageID']),
                'date' => trim($_POST['date']),
                'reservationStartTime' => trim($_POST['reservationStartTime']),
                'reservationEndTime' => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(trim($_POST['reservationStartTime'])))),
                'numOfPeople' => trim($_POST['numOfPeople']),
                'amount' => trim($_POST['amount']),
                // Add other necessary fields here
            ];

            // Validate the data (similar to what you've done in AddReservation method)

            // If validation passes, call the model method to add the reservation
            if ($this->customerModel->addReservation($data)) {
                // Reservation added successfully
                flash('reservation_message', 'Reservation Added');
                redirect('customers/reservation');
            } else {
                // Something went wrong
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
}
