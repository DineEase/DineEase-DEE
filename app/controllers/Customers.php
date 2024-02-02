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
        // Get the current page, search term from the URL query string
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $search = $_GET['search'] ?? '';
        $limit = 10;
        $offset = ($page - 1) * $limit;

        // Fetch reservations with pagination and search
        $reservations = $this->customerModel->getReservation($_SESSION['user_id'], $limit, $offset, $search);

        // Pass the data to the view
        $data = [
            'reservations' => $reservations,
            'search' => $search,
            'page' => $page
            // Include additional data as needed for the view
        ];

        $totalReservations = $this->customerModel->getTotalReservationCount($_SESSION['user_id']);

        $totalPages = ceil($totalReservations / $limit);

        $data = [
            'reservations' => $reservations,
            'search' => $search,
            'page' => $page,
            'totalPages' => $totalPages,
            'totalReservations' => $totalReservations,
            'limit' => $limit

        ];



        $this->view('customer/reservation', $data);
    }

    public function Menu()
    {
        $data = [];

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

    // public function getRemainingSlots($date)
    // {
    //     $this->customerModel->getRemainingSlots($date);
    //     $slots = $this->customerModel->getRemainingSlots($date);

    //     $this->view('customer/index', $data);
    // }

}
