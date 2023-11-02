<?php
    class InventoryManagers extends Controller
    {
        public $inventoryManagerModel;
        public function __construct()
        {
            if (!isLoggedIn()) {
                redirect('users/login');
            } else {
                if (isset($_SESSION['user_id'])) {
                    if ($_SESSION['role'] != 'inventoryManager') {
                        destroyOldSession();
                    }
                }
            }
            $this->inventoryManagerModel = $this->model('InventoryManager');
        }
        public  function Index()
        {
            $data = [];

            $this->view('InventoryManager/index');
        }

        public  function inventory()
        {
            $inventoryitem = $this->inventoryManagerModel->getInventoryitem();
            $data = [
                'inventory' => $inventoryitem
            ];
            $this->view('inventoryManager/inventory', $data);
            
        }
        

        public  function Alert()
        {
            $data = [];

            $this->view('InventoryManager/alert');
        }

        public function grn()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
            'inventoryname' => isset($_POST['inventoryname']) ? trim($_POST['inventoryname']) : '',
            'category' => isset($_POST['category']) ? trim($_POST['category']) : '',
            'quantitylevel' => isset($_POST['quantitylevel']) ? trim($_POST['quantitylevel']) : '',
            'asondate' => isset($_POST['asondate']) ? trim($_POST['asondate']) : '',
            'expiredate' => isset($_POST['expiredate']) ? trim($_POST['expiredate']) : '',
            'batchcode' => isset($_POST['batchcode']) ? trim($_POST['batchcode']) : '',
            'description' => isset($_POST['description']) ? trim($_POST['description']) : '',
            'cost' => isset($_POST['cost']) ? trim($_POST['cost']) : '',
            'quantityadded' => isset($_POST['quantityadded']) ? trim($_POST['quantityadded']) : '',
            'roqlevel' => isset($_POST['roqlevel']) ? trim($_POST['roqlevel']) : ''
        ];

        // Validate form fields (similar to the example given for menu item)
        // You can add validation logic here if needed

        // Assuming $this->inventoryManagerModel->addInventoryItem($data) is the function to insert data into the database
        if ($this->inventoryManagerModel->addgrn($data)) {
            // Insertion successful, redirect to the inventory manager page
            redirect('inventoryManagers/inventory');
        } else {
            // Handle database insertion error
            // Redirect or show an error message
            die('Inventory item insertion failed');
        }
    } else {
        // Initial load of the page, show the form without errors
        $data = [
            'inventoryname' => '',
            'category' => '',
            'quantitylevel' => '',
            'asondate' => '',
            'expiredate' => '',
            'batchcode' => '',
            'description' => '',
            'cost' => '',
            'quantityadded' => '',
            'roqlevel' => ''
        ];
        $this->view('InventoryManager/grn', $data);
    }
}


        public function Markout()
        {
            $data = [];

            $this->view('InventoryManager/markout');
        }

        public function Profile()
        {
            $data = [];

            $this->view('InventoryManager/profile');
        }
    }
