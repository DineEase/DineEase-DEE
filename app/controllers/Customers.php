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

        $reservations = $this->customerModel->getReservation($_SESSION['user_id']);
        $data = [
            'reservations' => $reservations
        ];

        $this->view('customer/reservation', $data);
        

    }
    public function Menu()
    {
        $data = [];

        $this->view('customer/menu' , $data);
    }

    public function Profile()
    {
        $data = [];

        $this->view('customer/profile' , $data);
    }

    public function Review()
    {
        $data = [];

        $this->view('customer/review' , $data);
    }
    public function CancelReservation($reservationID)
    {
        $this->customerModel->cancelReservation($reservationID);
        redirect('customers/index');
    }
    
    public function AddReservation()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //process form
            //sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'customerID' => $_SESSION['user_id'],
                'tableID' => trim($_POST['tableID']),
                'packageID' => trim($_POST['packageID']),
                'date' => trim($_POST['date']),
                'reservationStartTime' => trim($_POST['reservationStartTime']),
                'reservationEndTime' => trim($_POST['reservationEndTime']),
                'numOfPeople' => trim($_POST['numOfPeople']),
                'customerID_err' => '',
                'tableID_err' => '',
                'packageID_err' => '',
                'date_err' => '',
                'reservationStartTime_err' => '',
                'reservationEndTime_err' => '',
                'numOfPeople_err' => '',
            ];
            //validate email
            if (empty($data['customerID'])) {
                $data['customerID_err'] = 'Please enter customerID';
            }
            //validate name
            if (empty($data['tableID'])) {
                $data['tableID_err'] = 'Please enter tableID';
            }
            //validate name
            if (empty($data['packageID'])) {
                $data['packageID_err'] = 'Please enter packageID';
            }
            //validate name
            if (empty($data['date'])) {
                $data['date_err'] = 'Please enter date';
            }
            //validate name
            if (empty($data['reservationStartTime'])) {
                $data['reservationStartTime_err'] = 'Please enter reservationStartTime';
            }
            //validate name
            if (empty($data['reservationEndTime'])) {
                $data['reservationEndTime_err'] = 'Please enter reservationEndTime';
            }
            //validate name
            if (empty($data['numOfPeople'])) {
                $data['numOfPeople_err'] = 'Please enter numOfPeople';
            }
            //make sure errors are empty
            if (empty($data['customerID_err']) && empty($data['tableID_err']) && empty($data['packageID_err']) && empty($data['date_err']) && empty($data['reservationStartTime_err']) && empty($data['reservationEndTime_err']) && empty($data['numOfPeople_err'])) {
                //validated
                if ($this->customerModel->addReservation($data)) {
                    flash('reservation_message', 'Reservation Added');
                    redirect('customers/index');
                } else {
                    die('Something went wrong');
                }
            } else {
                //load view with errors
                $this->view('customer/index', $data);
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
