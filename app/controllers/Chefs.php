<?php
class Chefs extends Controller {
    public $chefModel;
    public function __construct() {
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

    public function index() {
        $orders = $this->chefModel->getOrders();
        $comorders = $this->chefModel->getcompletedorders();
        $data = [
            'orders' => $orders,
            'comorders' => $comorders
        ];
        $this->view('chef/index', $data);
    }
    public function updateorder() {
        $orders = $this->chefModel->getOrders();
        $comorders = $this->chefModel->getcompletedorders();
        $data = [
            'orders' => $orders,
            'comorders' => $comorders
        ];
        $this->view('chef/index-old', $data);
    }
   
    public function updateOrderStatus($orderID, $newStatus) {
        // Add logic to determine the new status based on your requirements
        $this->chefModel->updateOrderStatus($orderID, $newStatus);
        redirect('chefs/index');
     }
     public function viewmenu($menuID){
        $menu = $this->chefModel->viewMenu($menuID);
        $data = [
            'menu' => $menu
        ];
        $this->view('chef/viewmenu', $data);
     }
     public function getcompletedorders(){
        $orders = $this->chefModel->getCompletedOrders();
        $data = [
            'orders' => $orders
        ];
        $this->view('chef/viewcompletedorders', $data);
     }   
    }
    

?>