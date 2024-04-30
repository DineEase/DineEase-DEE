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
    public function Index()
    {
        $updateshelllife = $this->inventoryManagerModel->automaticallyupdateshellife();
        $data = [];

        $this->view('InventoryManager/index');
    }

    //adding categories to the db
    public function addCategory()
    {
        // Get the JSON payload from the request body
        $data = json_decode(file_get_contents('php://input'), true);

        // Validate the input
        if (empty($data['categoryName']) || empty($data['categoryCode'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid input.']);
            return;
        }
        $creationDate = date('Y-m-d');

        // Call the model to add the category
        $success = $this->inventoryManagerModel->addCategory(null, $data['categoryName'], $data['categoryCode'], $creationDate);

        // Return a JSON response
        if ($success) {
            http_response_code(201);
            echo json_encode(['success' => true, 'message' => 'Category added successfully.']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to add category.']);
        }
    }

    public function addInventory()
    {
        // Get the JSON payload from the request body
        $data = json_decode(file_get_contents('php://input'), true);
        error_log("Data addinventory controller: " . json_encode($data));

        // Validate the input
        if (empty($data['categoryID']) || empty($data['inventoryName']) || empty($data['inventoryCode']) || empty($data['roqLevel']) || empty($data['units'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid input.']);
            return;
        }
        $creationDate = date('Y-m-d');
        // Call the model to add the inventory
        $success = $this->inventoryManagerModel->addInventory(
            $data['categoryID'],
            $data['inventoryName'],
            $data['inventoryCode'],
            $data['roqLevel'],
            $data['units'],
            $creationDate
        );

        // Return a JSON response
        if ($success) {
            http_response_code(201);
            echo json_encode(['success' => true, 'message' => 'Inventory added successfully.']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to add inventory.']);
        }
    }

    public function fetchCategories()
    {
        // Call the model to get categories
        $categories = $this->inventoryManagerModel->fetchCategories();

        // Return the categories as a JSON response
        header('Content-Type: application/json');
        echo json_encode($categories);
    }

    public function fetchInventoryByCategory($categoryID = null)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($categoryID)) {
            // Sanitize and validate input
            if (empty($categoryID)) {
                $categoryID = filter_input(INPUT_POST, 'categoryID', FILTER_VALIDATE_INT);
            }

            if ($categoryID !== false && $categoryID !== null) {
                $inventories = $this->inventoryManagerModel->fetchInventoryByCategory($categoryID);
                // Check if any inventories were found
                if ($inventories !== false) {
                    // Return JSON response with inventory data
                    header('Content-Type: application/json');
                    echo json_encode($inventories);
                    return;
                } else {
                    // If no inventories were found, return an empty array
                    echo json_encode([]);
                    return;
                }
            }
        }
        // If request is invalid, return a 400 status code with an error message
        http_response_code(400);
        echo json_encode(['error' => 'Invalid request']);
    }



    public function fetchInventoryDetails($inventorynameID)
    {
        // Assume $inventoryModel is your model class for managing inventory data
        $inventoryDetails = $this->inventoryManagerModel->fetchInventoryDetailsByID($inventorynameID);

        // Check if inventory details were found
        if ($inventoryDetails) {
            header('Content-Type: application/json');
            echo json_encode($inventoryDetails);
        } else {
            // Return error message or empty response
            echo json_encode(array("error" => "Inventory details not found"));
        }
    }



    public function Home()
    {
        $data = [];

        $this->view('InventoryManager/home');
    }

    public function inventory()
    {
        $item = $this->inventoryManagerModel->getInventoryitem();
        $data = [
            'inventorylist' => $item
        ];
        error_log("Data from inventory controller: " . json_encode($data));
        $this->view('inventoryManager/inventory', $data);

    }


    public function Alert()
    {
        $data = [];

        $this->view('InventoryManager/alert');
    }

    public function fetchBatchCode()
{
    // Retrieve the selected category and inventory names from the request
    $selectedCategory = $_GET['category'] ?? null;
    $selectedInventoryItem = $_GET['inventoryNameID'] ?? null;
    error_log("Selected Category: " . $selectedCategory);
    error_log("Selected Inventory Item: " . $selectedInventoryItem);

    // Call the model function to generate the batch code based on the selected category and inventory
    $batchCode = $this->inventoryManagerModel->generateBatchCode($selectedCategory, $selectedInventoryItem);
    error_log("Batch Code: " . $batchCode);
    // Return the batch code as JSON response
    header('Content-Type: application/json');
    echo json_encode(['batchCode' => $batchCode]);
    exit; // Terminate script execution after sending response
}

    public function addgrn()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Validate input
            $data = [
                'inventoryName' => isset($_POST['inventoryName']) ? trim($_POST['inventoryName']) : '',
                'category' => isset($_POST['category']) ? trim($_POST['category']) : '',
                'batchCode' => isset($_POST['batchCode']) ? trim($_POST['batchCode']) : '',
                'quantity' => isset($_POST['quantity']) ? trim($_POST['quantity']) : '',
                'creationDate' => isset($_POST['creationDate']) ? date('Y-m-d', strtotime(trim($_POST['creationDate']))) : '', // Ensure date is formatted correctly
                'expireDate' => isset($_POST['expireDate']) ? date('Y-m-d', strtotime(trim($_POST['expireDate']))) : '', // Ensure date is formatted correctly
                'shelfLife' => '',
                'unitCost' => isset($_POST['unitCost']) ? trim($_POST['unitCost']) : '',
                'totalCost' => isset($_POST['totalCost']) ? trim($_POST['totalCost']) : '',
                'roqLevel' => isset($_POST['roqLevel']) ? trim($_POST['roqLevel']) : '',
                'units' => isset($_POST['units']) ? trim($_POST['units']) : '',
            ];
            //var_dump('data from addgrn controller: ' . $data);
            // Calculate shelf life
            $creationDate = new DateTime($data['creationDate']);
            $expireDate = new DateTime($data['expireDate']);
            $interval = $creationDate->diff($expireDate);
            $data['shelfLife'] = $interval->days;
            var_dump($data);
        
            // Check for empty fields
            $requiredFields = ['inventoryName', 'category', 'batchCode', 'quantity', 'creationDate', 'expireDate', 'unitCost', 'totalCost', 'roqLevel', 'units'];
            foreach ($requiredFields as $field) {
                if (empty($data[$field])) {
                    die("Please fill in all required fields. Missing field: $field");
                }
            }

            // Attempt to add GRN
            try {
                if ($this->inventoryManagerModel->addgrn($data)) {
                    redirect('inventoryManagers/inventory');
                } else {
                    die('Failed to add GRN into the database.');
                }
            } catch (Exception $e) {
                die('Error while adding GRN: ' . $e->getMessage());
            }
        } else {
            // Initial load of the page, show the form without errors
            $data = [
                'inventoryName' => '',
                'category' => '',
                'batchCode' => '',
                'quantity' => '',
                'creationDate' => '',
                'expireDate' => '',
                'shelfLife' => '',
                'unitCost' => '',
                'totalCost' => '',
                'roqLevel' => '',
                'units' => ''
            ];
            $this->view('InventoryManager/inventory', $data);
        }
    }



    public function Markout()
    {
        $kitchenrequest= $this->inventoryManagerModel->getkitchenRequests();
        $kitchenrequestnames = $this->inventoryManagerModel->getkitchenRequestsNames();
        
        //$kitchenrequestunits = $this->inventoryManagerModel->getInventoryunitsByID2();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            error_log(print_r($_POST, true));

            $categoryid = $_POST['categoryName'];
            $quantity = $_POST['quantity'];
            //$inventoryName = $_POST['inventoryName'];
            // foreach ($_POST['quantity'] as $inventoryName => $quantity) {
            //     // $inventoryName is the unique identifier (inventoryName) for each inventory item
            //     // $quantity is the quantity associated with the inventory item
            //     echo "Inventory Name: " . $inventoryName . ", Quantity: " . $quantity . "<br>";
            // }
            $data = [
                'categoryid' => $categoryid,
                //'inventoryName' => $inventoryName,
                'quantity' => $quantity,
            ];
            error_log("Data from markout controller: " . json_encode($data));
            foreach ($quantity as $inventoryID => $quantityValue) {
                if (!empty($quantityValue)) {
                    if($this->inventoryManagerModel->markoutInventory($inventoryID, $quantityValue)){
                        redirect('inventoryManagers/markOut');
                    }
                }

            }
            // foreach ($inventoryName as $key => $inventoryName) {
            //     $quantity = $quantity[$key];
                
            //     // Mark out the inventory and get the remaining quantity if any
            //     $remainingQuantity = $this->inventoryManagerModel->markoutInventory($inventoryName, $categoryName, $quantity);
                
            //     // Check if the entire quantity was transferred
            //     if ($remainingQuantity === 0) {
            //         // Update the status of this inventory to "transferred" in the kitchen table
            //         $this->inventoryManagerModel->updateKitchenRequest($inventoryName, 'transferred');
            //     } else {
            //         // Update the status of this inventory to "partially transferred" in the kitchen table
            //         $this->inventoryManagerModel->updateKitchenRequest($inventoryName, 'partially_transferred');
            //     }
            // }
            
            // Redirect to a success page or display a success message
            // Redirect or display success message
        } else {
            $data =[
                'kitchenrequest' => $kitchenrequest,
                'kitchenrequestnames' => $kitchenrequestnames];
            // Handle non-POST requests appropriately
            $this->view('InventoryManager/markOut', $data);
        }
    }
    public function changerequest($ID){
        $this->inventoryManagerModel->updateKitchenrequest($ID);
        redirect('inventoryManagers/markOut');


    }

    //getcategoriesand inv from the kitchen req
    public function getInventoriesRequested() {
        $categoryName = $_GET['categoryName'];
        error_log("Category Name: " . $categoryName);
        $inventories = $this->inventoryManagerModel->getrequestedinventoriesnames($categoryName);
        $test = $this->inventoryManagerModel->getrequestedinventoriesquantities($categoryName);
        $test1 = $this->inventoryManagerModel->getrequestedinventoriesquantities($categoryName);
        error_log("test: " . json_encode($test));
        header('Content-Type: application/json');
        $response = array(
            'inventories' => $inventories,
            'quantities' => $test,
            'totquantity' => $test1
        );
        echo json_encode($response);
        exit;
    }

    public function displayKitchenRequest()
    {
       $kitchenrequest= $this->inventoryManagerModel->getkitchenRequests();
       $categories = $this->inventoryManagerModel->getrequestedCategories();
        include 'markOut.php'; 
    }
    public function updatekitchenrequestStatus() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Retrieve data from POST request
            $inventoryName = $_POST['inventoryName'];
            $status = $_POST['status'];
    
            // Call the model method to update kitchen table status
            $this->inventoryManagerModel->updateKitchenrequest($inventoryName, $status);
    
            // Return success response
            echo json_encode(["success" => true]);
        } else {
            // Return error response for invalid request method
            echo json_encode(["success" => false, "message" => "Invalid request method"]);
        }
    }
    

    public function Profile()
    {
        $data = [];

        $this->view('InventoryManager/profile');
    }

}