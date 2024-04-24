<?php
class Chefs extends Controller
{
    public $chefModel;
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        } else {
            if (isset($_SESSION['user_id'])) {
                if ($_SESSION['role'] != 'chef') {
                    destroyOldSession();
                }
            }
        }
        $this->chefModel = $this->model('Chef');
    }
    public  function Index()
    {
        $data = [];

        $this->view('chef/index');
    }

    public function Order()
    {
        $reservations =$this->chefModel->getOrders();
        $data = [
            'reservations' => $reservations
        ];

        $this->view('chef/order', $data);
    }   

    public function Profile()
    {
        $data = [];

        $this->view('chef/profile');
    }
    


   
}