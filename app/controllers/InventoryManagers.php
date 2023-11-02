 <?php
    class InventoryManagers extends Controller
    {
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
        }
        public  function Index()
        {
            $data = [];

            $this->view('InventoryManager/index');
        }

        public  function Inventory()
        {
            $data = [];

            $this->view('InventoryManager/inventory');
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
