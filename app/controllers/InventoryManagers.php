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

        public function Grn()
        {
            $data = [];

            $this->view('InventoryManager/grn');
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
