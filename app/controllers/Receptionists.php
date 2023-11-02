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

    // public  function addrefund()
    // {
    //     $receptionistModel = $this->model('receptionist');
    //     if($_SERVER['REQUEST_METHOD'] == 'POST'){          
    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
           
    //         print_r($_POST );
    //         $data = [
    //             'invoiceID' => trim($_POST['invoice_ID']),
    //             'body' => trim($_POST['body']),
    //             'price' => trim($_POST['price']),
    //             'invoiceID_err' => '',
    //             'body_err' => '',
    //             'price_err' => '',
    //             'sucess' => false
    //         ];

    //         if(empty($data['invoiceID'])){
    //             $data['invoiceID_err'] = 'Please enter invoiceID';
    //         }
    //         if(empty($data['body'])){
    //             $data['body_err'] = 'Please enter body';
    //         }
    //         if(empty($data['price'])){
    //             $data['price_err'] = 'Please enter price';
    //         }

    //         if(empty($data['invoiceID_err']) && empty($data['body_err']) && empty($data['price_err'])){
    //             if($receptionistModel->addRequest($data)){
    //                 flash('request_message', 'Request Added');
    //                 redirect('Receptionists/index');
    //             }else{               
    //                 die('Something went wrong');
    //             }    
        
    //         }else{
    //             $data['sucess'] = true;
    //             $this->view('Receptionist/index', $data);
    //         }  
    //     }else {
    //         $data = [
    //         'invoiceID' => '',
    //         'body' => '',
    //         'price' => ''];

    //     $this->view('Receptionist/index', $data);
    //     }
    // }

    // public  function editrefund($id)
    // {
    //     $receptionistModel = $this->model('receptionist');
    //     if($_SERVER['REQUEST_METHOD'] == 'POST'){  
    //         //sanitize post        
    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
           
    //         print_r($_POST );
    //         $data = [
    //             'id' => $id, //this is the id of the post that we are editing   
    //             'invoiceID' => trim($_POST['invoice_ID']),
    //             'body' => trim($_POST['body']),
    //             'price' => trim($_POST['price']),
    //             'invoiceID_err' => '',
    //             'body_err' => '',
    //             'price_err' => '',
    //             'sucess' => false
    //         ];
    //         //

    //         if(empty($data['invoiceID'])){
    //             $data['invoiceID_err'] = 'Please enter invoiceID';
    //         }
    //         if(empty($data['body'])){
    //             $data['body_err'] = 'Please enter body';
    //         }
    //         if(empty($data['price'])){
    //             $data['price_err'] = 'Please enter price';
    //         }

    //         if(empty($data['invoiceID_err']) && empty($data['body_err']) && empty($data['price_err'])){
    //             if($receptionistModel->updateRequest($data)){
    //                 flash('request_message', 'Request updated');
    //                 redirect('Receptionists/index');
    //             }else{               
    //                 die('Something went wrong');
    //             }    
        
    //         }else{
    //             $data['sucess'] = true;
    //             $this->view('Receptionist/editrefund', $data);
    //         }  
    //     }else {
    //         //get existing post from model
    //         $request = $receptionistModel->getRequestsById($id);

    //         //check for owner
    //         if($request->user_id != $_SESSION['user_id']){
    //             redirect('Receptionists/index');
    //         }
    //         $data = [
    //         'id' => $id,
    //         'invoiceID' => $request->invoiceID,
    //         'body' => $request->body,
    //         'price' => $request->price];

    //     $this->view('Receptionist/editrefund', $data);
    //     }
    // }

    // public  function showrefund($id)
    // {
    //     $receptionistModel = $this->model('receptionist');
    //     $request = $receptionistModel->getRequestsById($id);
    //     $data = [
    //         'request' => $request
    //     ];

    //     $this->view('Receptionist/showrefund');
    // }


    // public function deleterefund($id){
    //     if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //         //get existing post from model
    //         $receptionistModel = $this->model('receptionist');
    //         $request = $receptionistModel->getRequestsById($id);

    //         //check for owner
    //         if($request->user_id != $_SESSION['user_id']){
    //             redirect('Receptionists/index');
    //         }
    //         if($receptionistModel->deleteRequest($id)){
    //             flash('request_message', 'Request Removed');
    //             redirect('Receptionists/index');
    //         }else{
    //             die('Something went wrong');
    //         }
    //     }else{
    //         redirect('Receptionists/index');
    //     }
    // }


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
