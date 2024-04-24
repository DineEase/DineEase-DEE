<?php
class Managers extends Controller
{
    public $managerModel;
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        } else {
            if (isset($_SESSION['user_id'])) {
                if ($_SESSION['role'] != 'manager') {
                    destroyOldSession();
                }
            }
        }
        $this->managerModel = $this->model('Manager');
    }
    public  function Index()
    {
        $data = [];

        $this->view('manager/index');
    }
    // hunter email verification
    private function verifyEmailUsingHunter($email, $apiKey)
    {
        require_once APPROOT . '/vendor/autoload.php';
        $url = "https://api.hunter.io/v2/email-verifier?email=" . urlencode($email) . "&api_key=" . $apiKey;

        $client = new \GuzzleHttp\Client(['verify' => false]);

        $response = $client->get($url);

        $data = json_decode($response->getBody(), true);

        // Check if the API request was successful
        if ($response->getStatusCode() === 200) {
            return $data['data']['result'] === 'deliverable';
        } else {
            // Handle API error
            return false;
        }
    }
    // Redirections
    public function redirectpage($data = [], $redirectAfter = false, $redirectUrl = '', $redirectDelay = '', $title = '', $header = '')
    {
        // Set a default message if $data is empty
        if (empty($data)) {
            $data['message'] = 'An error occurred.';
        }

        // Include the redirect delay and URL in the data array
        $data['redirectDelay'] = $redirectDelay;
        $data['redirectUrl'] = $redirectUrl;
        $data['title'] = $title;
        $data['header'] = $header;

        $this->view('manager/redirect', $data);

        if ($redirectAfter && !empty($redirectUrl)) {
            // Redirect after $redirectDelay seconds
            header("refresh:{$redirectDelay};url={$redirectUrl}");
            exit();  // Stop further execution after redirect header
        }
    }
    //Menu Handling functions
    public function menu()
    {
        $menuitem = $this->managerModel->getMenuitem();
        $categories = $this->managerModel->getmenucategory();
        $categoryFilter = isset($_GET['categoryFilter']) ? $_GET['categoryFilter'] : '';
        $data = [
            'menu' => $menuitem,
            'categories' => $categories,
            'categoryFilter' => $categoryFilter,
        ];
        $this->view('manager/menu', $data);
    }

    public function viewmenuitem($itemID)
    {
        $menuItem = $this->managerModel->getmenudetails($itemID);
        if (!$menuItem) {
            // Handle the case where the menu item does not exist
            // For example, you can redirect to an error page or show an error message
            ob_clean();
            $data['message'] = 'No Such Menu Item Found';
            $this->redirectpage($data, true, URLROOT . '/managers/menu', 5, 'Error', 'Menu Error');
            exit();
        }

        // Create the $data array with retrieved menu item details
        $data = [
            'itemID' => $menuItem->itemID,
            'itemName' => $menuItem->itemName,
            'prices' => explode(',', $menuItem->prices), // Convert prices string to array
            'sizes' => explode(',', $menuItem->sizes), // Convert sizes string to array
            'averageTime' => $menuItem->averageTime,
            'imagePath' => $menuItem->imagePath,
            'category' => $menuItem->category_name,
            'description' => $menuItem->description,
        ];

        // Pass the $data array to the view
        $this->view('manager/viewmenu', $data);
    }


    public function submitMenuitem()
    {
        $menuCategories = $this->managerModel->getmenucategory();
        $data = [
            'itemName' => '',
            'pricesmall' => '',
            'priceregular' => '',
            'pricelarge' => '',
            'averageTime' => '',
            'description' => '',
            'itemName_err' => '',
            'price_err' => '',
            'averageTime_err' => '',
            'description_err' => '',
            'menucategory' => $menuCategories,
            'menu_added_success' => false,
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->processMenuForm($_POST, $_FILES);
            if (empty($data['itemName_err']) && empty($data['price_err']) && empty($data['averageTime_err']) && empty($data['description_err'])) {
                $menuData = [
                    'itemName' => $data['itemName'],
                    'pricesmall' => $data['pricesmall'],
                    'priceregular' => $data['priceregular'],
                    'pricelarge' => $data['pricelarge'],
                    'averageTime' => $data['averageTime'],
                    'imagePath' => $data['imagePath'],
                    'category_ID' => $_POST['category'],
                    'menucategory' => $data['menucategory'],
                    'description' => $data['description'],
                ];

                if ($this->managerModel->submitMenuitem($menuData)) {
                    ob_clean();
                    $data['message'] = 'Menu Added Successfully!';

                    $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Successful', 'Menu Added');
                    //
                    exit();
                    //echo '<script>console.log("Menu added successfully flag is set!");</script>';
                    // Now you can safely redirect using JavaScript
                    //echo '<script>alert("Menu added successfully!"); window.location.href = "' . URLROOT . '/managers/menu";</script>';
                } else {

                    ob_clean();
                    $data['message'] = 'Menu Insertion Failed!';

                    $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Error', 'Menu Adding Error');
                    //
                    exit();
                }
            } else {
                $this->view('manager/createmenu', $data);
            }
        } else {
            $this->view('manager/createmenu', $data);
        }
    }

    private function processMenuForm($postData, $files)
    {
        $menuCategories = $this->managerModel->getmenucategory();
        $data = [
            'itemName' => isset($postData['itemName']) ? trim($postData['itemName']) : '',
            'pricesmall' => isset($postData['pricesmall']) ? trim($postData['pricesmall']) : '',
            'priceregular' => isset($postData['priceregular']) ? trim($postData['priceregular']) : '',
            'pricelarge' => isset($postData['pricelarge']) ? trim($postData['pricelarge']) : '',
            'averageTime' => isset($postData['averageTime']) ? trim($postData['averageTime']) : '',
            'description' => isset($postData['description']) ? trim($postData['description']) : '',
            'menucategory' => $menuCategories,
            'itemName_err' => '',
            'price_err' => '',
            'averageTime_err' => '',
            'description_err' => '',
            'imagePath' => '',
        ];
        if (isset($files['imagePath']) && $files['imagePath']['error'] === UPLOAD_ERR_OK) {
            $data['imagePath'] = $this->handleImageUpload($files['imagePath']);
            if ($data['imagePath'] === false) {
                ob_clean();
                $data['message'] = 'Error: Image upload failed.';

                $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Error', 'Image Upload Error');
                //
                exit();
            }
        } else {
            ob_clean();
            $data['message'] = 'Error: No image uploaded or upload error.';

            $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Error', 'Image Upload Error');
            //
            exit();
        }
        if (empty($data['itemName'])) {
            $data['itemName_err'] = 'Please enter item name';
        } elseif ($this->managerModel->findMenuitemByName($data['itemName'])) {
            $data['itemName_err'] = 'Item Name is already taken';
        }

        if (empty($data['priceregular'])) {
            $data['price_err'] = 'Please enter price';
        } elseif (!is_numeric($data['priceregular'])) {
            $data['price_err'] = 'Price must be a valid number';
        } elseif (
            (!empty($data['pricesmall']) && !is_numeric($data['pricesmall'])) ||
            (!empty($data['pricelarge']) && !is_numeric($data['pricelarge'])) ||
            (
                (!empty($data['pricesmall']) && $data['pricesmall'] >= $data['priceregular']) ||
                (!empty($data['pricelarge']) && $data['pricelarge'] <= $data['priceregular'])
            )
        ) {
            $data['price_err'] = 'Prices must be in ascending order: Small < Regular < Large';
        }
        if (empty($data['averageTime'])) {
            $data['averageTime_err'] = 'Please enter average time';
        } elseif (!is_numeric($data['averageTime'])) {
            $data['averageTime_err'] = 'Average time must be a valid number';
        }
        if (empty($data['description'])) {
            $data['description_err'] = 'Please enter description';
        }
        //var_dump($data);
        return $data;
    }
    public function editMenuitem($itemID)
    {
        $menuItem = $this->managerModel->getMenuItemById($itemID);
        $menuitemtable = $this->managerModel->getmenuitemtablebyid($itemID);

        $menuCategories = $this->managerModel->getmenucategory();
        if (!$menuItem) {
            ob_clean();
            $data['message'] = 'No Such Menu Item Found';
            $this->redirectpage($data, true, URLROOT . '/managers/menu', 5, 'Error', 'Menu Error');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['imagePath']) && $_FILES['imagePath']['error'] === UPLOAD_ERR_OK) {
                $imagePath = $this->handleImageUpload($_FILES['imagePath']);
                if ($imagePath === false) {
                    ob_clean();
                    $data['message'] = 'Error: Image upload failed.';
                    $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Error', 'Image Upload Error');
                    exit();
                }
            } else {
                $imagePath = $menuitemtable->imagePath;
            }
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'itemID' => $itemID,
                'itemName' => trim($_POST['itemName']),
                'pricesmall' =>  trim($_POST['pricesmall']),
                'priceregular' =>  trim($_POST['priceregular']),
                'pricelarge' =>  trim($_POST['pricelarge']),
                'averageTime' => trim($_POST['averageTime']),
                'imagePath' => $imagePath,
                'menucategory' => $menuCategories,
                'description' => trim($_POST['description']),
                'itemName_err' => '',
                'price_err' => '',
                'averageTime_err' => '',
                'description_err' => '',
            ];
            if ($data['itemName'] !== $menuitemtable->itemName) {
                if (empty($data['itemName'])) {
                    $data['itemName_err'] = 'Please enter name';
                } else {
                    if ($this->managerModel->findMenuitemByName($data['itemName'])) {
                        $data['itemName_err'] = 'Name is already taken';
                    }
                }
            }
            if (empty($data['priceregular'])) {
                $data['price_err'] = 'Please enter price';
            } elseif (!is_numeric($data['priceregular'])) {
                $data['price_err'] = 'Price must be a valid number';
            } elseif (
                (!empty($data['pricesmall']) && !is_numeric($data['pricesmall'])) ||
                (!empty($data['pricelarge']) && !is_numeric($data['pricelarge'])) ||
                (
                    (!empty($data['pricesmall']) && $data['pricesmall'] >= $data['priceregular']) ||
                    (!empty($data['pricelarge']) && $data['pricelarge'] <= $data['priceregular'])
                )
            ) {
                $data['price_err'] = 'Prices must be in ascending order: Small < Regular < Large';
            }
            if (empty($data['averageTime'])) {
                $data['averageTime_err'] = 'Please enter average time';
            } elseif (!is_numeric($data['averageTime'])) {
                $data['averageTime_err'] = 'Average time must be a valid number';
            }
            if (empty($data['description'])) {
                $data['description_err'] = 'Please enter description';
            }
            if (empty($data['itemName_err']) && empty($data['price_err']) && empty($data['averageTime_err'])) {
                $menuCategories = $this->managerModel->getmenucategory();
                $menuData = [
                    'itemID' => $itemID,
                    'itemName' => $data['itemName'],
                    'pricesmall' => $data['pricesmall'],
                    'priceregular' => $data['priceregular'],
                    'pricelarge' => $data['pricelarge'],
                    'averageTime' => $data['averageTime'],
                    'imagePath' => $imagePath, 
                    'category_ID' => $_POST['category'],
                    'menucategory' => $menuCategories,
                    'description' => $data['description'],
                ];
                if ($this->managerModel->editMenuitem($menuData)) {
                    ob_clean();
                    $data['message'] = 'Menu Edited Successfully!';
                    $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Successful', 'Menu Edited Successfully');
                    exit();
                } else {
                    $this->view('manager/editmenu', $data);
                    ob_clean();
                    $data['message'] = 'Menu Editing Failed!';
                    $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Error', 'Menu Editing Error');
                    exit();
                }
            } else {
                $this->view('manager/editmenu', $data);
            }
        } else {
            $data = [
                'itemID' => $itemID,
                'itemName' => $menuItem[0]->itemName,
                'pricesmall' => $menuItem[0]->itemPrice,
                'priceregular' => $menuItem[1]->itemPrice ?? null,
                'pricelarge' => $menuItem[2]->itemPrice ?? null,
                'averageTime' => $menuItem[0]->averageTime,
                'imagePath' => $menuItem[0]->imagePath,
                'category_ID' => $menuItem[0]->category_ID,
                'description' => $menuItem[0]->description,
                'itemName_err' => '',
                'price_err' => '',
                'averageTime_err' => '',
                'description_err' => '',
                'menucategory' => $menuCategories
            ];
            $this->view('manager/editmenu', $data);
        }
    }

    public function deleteMenuitem($itemID)
    {
        if ($this->managerModel->deleteMenuItem($itemID)) {
            ob_clean();
            $data['message'] = 'Menu Deleted Successfully!';

            $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Successful', 'Menu Deleted Successfully');
            exit();
        }
        else {
            ob_clean();
            ob_end_flush();
            echo "<script>alert('There are reservations for this menuitem in the upcoming future. Please try hiding it.');</script>";
            echo "<script>window.location.href = '" . URLROOT . "/managers/menu';</script>";
            exit();
        }
    }
    public function hideMenuitem($itemID)
    {
        if ($this->managerModel->hideMenuitem($itemID)) {
            redirect('managers/menu');
        }
    }
    public function showMenuitem($itemID)
    {
        if ($this->managerModel->showMenuitem($itemID)) {
            redirect('managers/menu');
        }
    }
    public function searchmenubyname()
    {
        $categories = $this->managerModel->getmenucategory();
        $searchQuery = isset($_GET['searchQuery']) ? $_GET['searchQuery'] : null;
        if ($menu = $this->managerModel->searchmenubyname($searchQuery)) {
            $data = [
                'menu' => $menu,
                'categories' => $categories,
            ];
            $this->view('manager/menu', $data);
        } else {
            ob_clean();
            $data['message'] = 'No Such Menu Item Found';
            $this->redirectpage($data, true, URLROOT . '/managers/menu', 5, 'Error', 'Menu Error');
            exit();
        }
    }
    public function addmenucategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'category_name' => isset($_POST['category_name']) ? trim($_POST['category_name']) : '',
                'category_name_err' => '',
            ];
            if (empty($data['category_name'])) {
                $data['category_name_err'] = 'Please enter a category name';
            }
            if (empty($data['category_name_err'])) {
                $existingCategory = $this->managerModel->findcategorybyname($data['category_name']);
                if ($existingCategory) {
                    $data['category_name_err'] = 'Category already exists';
                }
            }
            if (empty($data['category_name_err'])) {
                if ($this->managerModel->addmenucategory($data)) {
                    // Handle success
                    $data['new_category_added'] = true;
                } else {
                    $data['category_name_err'] = 'Something went wrong';
                }
            }
        }
        $categories = $this->managerModel->getmenucategory();
        $data['categories'] = $categories;
        $this->view('manager/categories', $data);
    }
    public function getmenucategory()
    {
        $menucategory = $this->managerModel->getmenucategory();
        $data = [
            'menucategory' => $menucategory
        ];
        $this->view('manager/createMenu', $data);
    }
    public function filtermenubycategory()
    {
        $categories = $this->managerModel->getmenucategory();
        $category_ID = isset($_GET['categoryFilter']) ? $_GET['categoryFilter'] : null;
        $menu = $this->managerModel->filtermenubycategory($category_ID);
        $data = [
            'menu' => $menu,
            'categories' => $categories,
        ];
        $this->view('manager/menu', $data);
    }
    public function editmenucategory($category_ID)
    {
        $menu = $this->managerModel->getMenuitem();
        $categories = $this->managerModel->getmenucategory();
        $category = $this->managerModel->getcategorybyID($category_ID);
        if (!$category) {
            ob_clean();
            $data['message'] = 'No Such Menu Category Found';
            $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Error', 'Category Error');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'category_ID' => $category_ID,
                'category_name' => isset($_POST['category_name']) ? trim($_POST['category_name']) : '',
                'category_edit_name_err' => '',
                'menu' => $menu,
                'categories' => $categories,
            ];
            if (empty($data['category_name'])) {
                $data['category_edit_name_err'] = 'Please enter a category name';
            } elseif ($this->managerModel->findcategorybyname($data['category_name'])) {
                $data['category_edit_name_err'] = 'Category already exists';
            }

            if (empty($data['category_edit_name_err'])) {
                if ($this->managerModel->editmenucategory($category_ID, $data['category_name'])) {
                    ob_clean();
                    $data['message'] = 'Catergory Edited Successfully!';
                    $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Successful', 'Category Edited');
                    exit();
                } else {
                    ob_clean();
                    $data['message'] = 'Category Edit Unsuccessful!';
                    $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Error', 'Category Error');
                    exit();
                }
            } else {
                $this->view('manager/categories', $data);
            }
        } else {
            $data = [
                'category_ID' => $category_ID,
                'category_name' => $category->category_name,
                'category_edit_name_err' => '',
                'categories' => $categories,
            ];
            $this->view('manager/categories', $data);
        }
    }
    public function updatetimecategories()
    {
        $categories = $this->managerModel->getmenucategory();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'category_ID' => isset($_POST['category_ID']) ? trim($_POST['category_ID']) : '',
                'start_time' => isset($_POST['start_time']) ? trim($_POST['start_time']) : '',
                'end_time' => isset($_POST['end_time']) ? trim($_POST['end_time']) : '',
                'start_time_err' => '',
                'end_time_err' => '',
                'time_diff_err' => '',
            ];
            if (empty($data['start_time'])) {
                $data['start_time_err'] = 'Please enter start time';
            }
            if (empty($data['end_time'])) {
                $data['end_time_err'] = 'Please enter end time';
            }
            if (strtotime($data['start_time']) > strtotime($data['end_time'])) {
                $data['time_diff_err'] = 'Start time cannot be greater than end time';
            }
            if (empty($data['start_time_err']) && empty($data['end_time_err']) && empty($data['time_diff_err'])) {
                if ($this->managerModel->updatecategorytime($data)) {
                    ob_clean();
                    $data['message'] = 'Category Update Successful!';
                    $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Successful', 'Category Update Successful');
                    exit();
                } else {
                    ob_clean();
                    $data['message'] = 'Category Update Failed';
                    $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Error', 'Category Update Error');
                    exit();
                }
            } else {
                $this->view('manager/categories', $data);
            }
        } else {
            $data = [
                'category_ID' => '',
                'start_time' => '',
                'end_time' => '',
                'start_time_err' => '',
                'end_time_err' => '',
                'time_diff_err' => '',
                'categories' => $categories,
            ];
            $this->view('manager/categories', $data);
        }
    }
    public function hidecategory()
    {
        $categories = $this->managerModel->getmenucategory();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'category_ID' => isset($_POST['category_ID']) ? trim($_POST['category_ID']) : '',
            ];
            if (empty($data['category_ID'])) {
                $data['category_ID_err'] = 'Please select a category';
            }
            if (empty($data['category_ID_err'])) {
                if ($this->managerModel->hidecategory($data)) {
                    redirect('managers/updatetimecategories');
                    exit();
                } else {
                    ob_clean();
                    $data['message'] = 'Category Hide Failed!';
                    $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Error', 'Category Hide Error');
                    exit();
                }
            } else {
                $this->view('manager/categories', $data);
            }
        } else {
            $data = [
                'category_ID' => '',
                'categories' => $categories,
            ];
            $this->view('manager/categories', $data);
        }
    }
    public function showcategory()
    {
        $categories = $this->managerModel->getmenucategory();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'category_ID' => isset($_POST['category_ID']) ? trim($_POST['category_ID']) : '',
            ];
            if (empty($data['category_ID'])) {
                $data['category_ID_err'] = 'Please select a category';
            }
            if (empty($data['category_ID_err'])) {
                if ($this->managerModel->showcategory($data)) {
                    redirect('managers/updatetimecategories');
                    exit();
                } else {
                    ob_clean();
                    $data['message'] = 'Category Show Failed!';
                    $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Error', 'Category Show Error');
                    exit();
                }
            } else {
                $this->view('manager/categories', $data);
            }
        } else {
            $data = [
                'category_ID' => '',
                'categories' => $categories,
            ];
            $this->view('manager/categories', $data);
        }
    }

    private function handleImageUpload($imageFile)
    {
        $targetDirectory = 'C:\\wamp64\\www\\DineEase-DEE\\public\\uploads\\';

        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }
        $imageName = str_replace(' ', '_', $imageFile['name']);
        $check = getimagesize($imageFile['tmp_name']);
        if ($check === false) {
            die('Error: Uploaded file is not an image.');
        }
        $randomNumber = mt_rand(100000, 999999);
        $imageNameWithoutExt = pathinfo($imageName, PATHINFO_FILENAME);
        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
        $imageName = $imageNameWithoutExt . '_' . $randomNumber . '.' . $imageExtension;
        $targetFile = $targetDirectory . basename($imageName);
        echo "Target File: " . $targetFile . "<br>";
        while (file_exists($targetFile)) {
            $randomNumber = mt_rand(100000, 999999);
            $imageName = $imageNameWithoutExt . '_' . $randomNumber . '.' . $imageExtension;
            $targetFile = $targetDirectory . basename($imageName);
        }
        if (move_uploaded_file($imageFile['tmp_name'], $targetFile)) {
            return $targetFile;
        } else {
            die('Error: Failed to move uploaded file.');
        }
    }
    public function getUsers()
    {
        $users = $this->managerModel->getUsers();
        $nonactiveusers = $this->managerModel->getNonactivatedUsers();
        $data = [
            'users' => $users,
            'nonactiveusers' => $nonactiveusers,
        ];
        $this->view('manager/users', $data);
    }


    public function addUsers()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['imagePath']) && $_FILES['imagePath']['error'] === UPLOAD_ERR_OK) {
                $imagePath = $this->handleImageUploadprofilepicture($_FILES['imagePath']);
                if ($imagePath === false) {
                    die('Error: Image upload failed.');
                }
            } else {
                die('Error: No image uploaded or upload error.');
            }
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'name' => isset($_POST['name']) ? trim($_POST['name']) : '',
                'password' => isset($_POST['password']) ? trim($_POST['password']) : '',
                'role' => isset($_POST['role']) ? trim($_POST['role']) : '',
                'address' => isset($_POST['address']) ? trim($_POST['address']) : '',
                'email' => isset($_POST['email']) ? trim($_POST['email']) : '',
                'joined_date' => isset($_POST['joined_date']) ? trim($_POST['joined_date']) : '',
                'nic' => isset($_POST['nic']) ? trim($_POST['nic']) : '',
                'mobile_number' => isset($_POST['mobile_number']) ? trim($_POST['mobile_number']) : '',
                'dob' => isset($_POST['dob']) ? trim($_POST['dob']) : '',
                'password_err' => '',
                'role_err' => '',
            ];
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                if ($this->managerModel->findEmployeeByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already taken as a staff member';
                } else {
                    $hunterApiKey = 'f0b22562feaf8e34e1332f9e148c6f246dc78045';
                    if (!$this->verifyEmailUsingHunter($data['email'], $hunterApiKey)) {
                        $data['email_err'] = 'Email address is not deliverable';
                    }
                }
            }
            if (empty($data['mobile_number'])) {
                $data['mobile_number_err'] = 'Please enter mobile number';
            } else {
                if ($this->managerModel->findEmployeeByMobile($data['mobile_number'])) {
                    $data['mobile_number_err'] = 'Mobile Number is already registered as a staff member';
                }
            }
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter a password';
            }
            if (empty($data['role'])) {
                $data['role_err'] = 'Please select a role';
            }
            if (empty($data['nic'])) {
                $data['nic_err'] = 'Please enter NIC';
            } elseif (!preg_match('/^(\d{9}[vV]|\d{12})$/', $data['nic'])) {
                $data['nic_err'] = 'Invalid NIC format. NIC must be either 9 digits with "V" or "v" at the end or 12 digits.';
            }
            if (empty($data['dob'])) {
                $data['dob_err'] = 'Please enter Date of Birth';
            } else {
                $dobDateTime = new DateTime($data['dob']);
                $currentDateTime = new DateTime();
                $age = $currentDateTime->diff($dobDateTime)->y;
                if ($age < 18) {
                    $data['dob_err'] = 'User must be at least 18 years old.';
                }
            }
            if (empty($data['password_err']) && empty($data['role_err']) && empty($data['email_err']) && empty($data['mobile_number_err']) && empty($data['nic_err']) && empty($data['dob_err'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $userData = [
                    'name' => $data['name'],
                    'password' => $data['password'],
                    'role' => $data['role'],
                    'address' => $data['address'],
                    'email' => $data['email'],
                    'joined_date' => $data['joined_date'],
                    'nic' => $data['nic'],
                    'mobile_number' => $data['mobile_number'],
                    'dob' => $data['dob'],
                    'imagePath' => $imagePath,
                ];
                $userId = $this->managerModel->addUsers($userData);
                if ($userId) {
                    $token = $this->managerModel->generatePasswordResetToken($data['email']);
                    $this->sendPasswordResetEmail($data['email'], $token);
                    redirect('managers/getUsers');
                } else {
                    $data['error_message'] = 'Something went wrong. Please try again.';
                    $this->view('manager/adduser', $data);
                }
            } else {
                $this->view('manager/adduser', $data);
            }
        } else {
            $data = [
                'name' => '',
                'password' => '',
                'role' => '',
                'address' => '',
                'email' => '',
                'joined_date' => '',
                'nic' => '',
                'mobile_number' => '',
                'dob' => '',
                'password_err' => '',
                'role_err' => '',
            ];
            $this->view('manager/adduser', $data);
        }
    }
    public function promotecustomers($ID)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['imagePath']) && $_FILES['imagePath']['error'] === UPLOAD_ERR_OK) {
                $imagePath = $this->handleImageUploadprofilepicture($_FILES['imagePath']);
                if ($imagePath === false) {
                    die('Error: Image upload failed.');
                }
            } else {
                die('Error: No image uploaded or upload error.');
            }
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'user_id' => $ID,
                'name' => isset($_POST['name']) ? trim($_POST['name']) : '',
                'password' => isset($_POST['password']) ? trim($_POST['password']) : '',
                'role' => isset($_POST['role']) ? trim($_POST['role']) : '',
                'address' => isset($_POST['address']) ? trim($_POST['address']) : '',
                'email' => isset($_POST['email']) ? trim($_POST['email']) : '',
                'joined_date' => isset($_POST['joined_date']) ? trim($_POST['joined_date']) : '',
                'nic' => isset($_POST['nic']) ? trim($_POST['nic']) : '',
                'mobile_number' => isset($_POST['mobile_number']) ? trim($_POST['mobile_number']) : '',
                'dob' => isset($_POST['dob']) ? trim($_POST['dob']) : '',
                'password_err' => '',
                'role_err' => '',
            ];
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                if ($this->managerModel->findEmployeeByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already taken as a staff member';
                } else {
                    if (!$this->managerModel->emailcheck($data['email'])) {
                        $hunterApiKey = 'f0b22562feaf8e34e1332f9e148c6f246dc78045';
                        if (!$this->verifyEmailUsingHunter($data['email'], $hunterApiKey)) {
                            $data['email_err'] = 'Email address is not deliverable';
                        }
                    }
                }
            }
            if (empty($data['mobile_number'])) {
                $data['mobile_number_err'] = 'Please enter mobile number';
            } else {
                if ($this->managerModel->findEmployeeByMobile($data['mobile_number'])) {
                    $data['mobile_number_err'] = 'Mobile Number is already registered as a staff member';
                }
            }
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter a password';
            }
            if (empty($data['role'])) {
                $data['role_err'] = 'Please select a role';
            }
            if (empty($data['nic'])) {
                $data['nic_err'] = 'Please enter NIC';
            } elseif (!preg_match('/^(\d{9}[vV]|\d{12})$/', $data['nic'])) {
                $data['nic_err'] = 'Invalid NIC format. NIC must be either 9 digits with "V" or "v" at the end or 12 digits.';
            }
            if (empty($data['dob'])) {
                $data['dob_err'] = 'Please enter Date of Birth';
            } else {
                $dobDateTime = new DateTime($data['dob']);
                $currentDateTime = new DateTime();
                $age = $currentDateTime->diff($dobDateTime)->y;
                if ($age < 18) {
                    $data['dob_err'] = 'User must be at least 18 years old.';
                }
            }
            if (empty($data['password_err']) && empty($data['role_err']) && empty($data['email_err']) && empty($data['mobile_number_err']) && empty($data['nic_err']) && empty($data['dob_err'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $userData = [
                    'user_id' => $ID,
                    'name' => $data['name'],
                    'password' => $data['password'],
                    'role' => $data['role'],
                    'address' => $data['address'],
                    'email' => $data['email'],
                    'joined_date' => $data['joined_date'],
                    'nic' => $data['nic'],
                    'mobile_number' => $data['mobile_number'],
                    'dob' => $data['dob'],
                    'imagePath' => $imagePath,
                ];
                if ($this->managerModel->promotecustomer($userData)) {
                    $token = $this->managerModel->generatePasswordResetToken($data['email']);
                    $this->sendPasswordResetEmail($data['email'], $token);
                    redirect('managers/getUsers');
                } else {
                    $data['error_message'] = 'Something went wrong. Please try again.';
                    $this->view('manager/adduser', $data);
                }
            } else {
                $this->view('manager/adduser', $data);
            }
        } else {
            $data = [
                'name' => '',
                'password' => '',
                'role' => '',
                'address' => '',
                'email' => '',
                'joined_date' => '',
                'nic' => '',
                'mobile_number' => '',
                'dob' => '',
                'password_err' => '',
                'role_err' => '',
            ];
            $this->view('manager/customerpromote', $data);
        }
    }

    public function searchUsers()
    {
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $searchTerm = $_POST['search_term'];
            $searchResult = $this->managerModel->searchUsersByEmailOrPhone($searchTerm);
            $data = ['searchResult' => $searchResult];
            $this->view('manager/customerpromote', $data);
        }
        $this->view('manager/customerpromote', $data);
    }

    public function viewprofile($ID)
    {
        $user = $this->managerModel->viewprofile($ID);
        if (!$user) {
            ob_clean();
            $data['message'] = 'No Such User Found';
            $this->redirectpage($data, true, URLROOT . '/managers/getUsers', 10, 'Error', 'User Error');
            exit();
        }
        $data = [
            'users' => $user
        ];
        $this->view('manager/viewprofiles', $data);
    }
    public function viewmanagerprofile()
    {
        $manager = $this->managerModel->viewManagerProfile();
        $data = [
            'manager' => $manager
        ];
        $this->view('manager/managerviewprofile', $data);
    }
    public function deleteprofile($ID)
    {
        if ($this->managerModel->deleteprofile($ID)) {
            redirect('managers/Index');
        }
    }
    public function filterbyrole()
    {
        $role = isset($_GET['role']) ? $_GET['role'] : null;
        $users = $this->managerModel->filterbyrole($role);
        $nonactiveusers = $this->managerModel->getNonactivatedUsers();
        $data = [
            'users' => $users,
            'nonactiveusers' => $nonactiveusers,
        ];
        $this->view('manager/users', $data);
    }
    public function searchemployeebyname()
    {
        $searchQuery = isset($_GET['searchQuery']) ? $_GET['searchQuery'] : null;
        $users = $this->managerModel->searchemployeebyname($searchQuery);
        $nonactiveusers = $this->managerModel->getNonactivatedUsers();
        $data = [
            'users' => $users,
            'nonactiveusers' => $nonactiveusers,
        ];
        $this->view('manager/users', $data);
    }

    public function updateuserrole($ID)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'user_id' => $ID,
                'role' => isset($_POST['role']) ? trim($_POST['role']) : '',
                'role_err' => '',
            ];
            if (empty($data['role'])) {
                $data['role_err'] = 'Please select a role';
            }
            if (empty($data['role_err'])) {
                if ($this->managerModel->updateuserrole($data)) {
                    redirect('managers/viewprofile/' . $ID . '');
                    exit();
                } else {
                    $this->view('manager/updateuserrole', $data);
                    die('Something went wrong');
                }
            } else {
                $this->view('manager/updateuserrole', $data);
            }
        } else {
            $data = [
                'role' => '',
                'role_err' => '',
            ];
            $this->view('manager/updateuserrole', $data);
        }
    }

    private function sendPasswordResetEmail($email, $token)
    {
        require_once APPROOT . '/vendor/autoload.php';
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'pachax001@gmail.com';
        $mail->Password   = 'soqrsqcrcwsmxpyd ';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        $mail->setFrom('pachax001@gmail.com', 'pachax001');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Employee Password Reset';
        $mail->Body    = 'Link is only valid for 1 hour. Click the following link to reset your password: ' . URLROOT . '/users/resetPasswordEmployee/' . $token;
        if ($mail->send()) {
            ob_clean();
            $data['message'] = 'Email Sent Successfully';
            $this->redirectpage($data, true, URLROOT . '/managers/getUsers', 10, 'Success', 'Mail Delivered');
            exit();
            return true;
        } else {
            ob_clean();
            $data['message'] = 'Email could not be sent. Error: ' . $mail->ErrorInfo;
            $this->redirectpage($data, true, URLROOT . '/managers/getUsers', 10, 'Error', 'Mail Error');
            exit();
            return false;
        }
    }
    public function manuallyactivateemployee($user_id)
    {
        $email = $this->managerModel->getEmployeeEmail($user_id);
        if ($this->managerModel->manuallyactivateemployee($user_id)) {
            $this->sendManuallyActivatedEmployee($email);
        }
    }
    private function sendManuallyActivatedEmployee($email)
    {

        require_once APPROOT . '/vendor/autoload.php';
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'pachax001@gmail.com';
        $mail->Password   = 'soqrsqcrcwsmxpyd ';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        $mail->setFrom('pachax001@gmail.com', 'pachax001');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Employee Activation';
        $mail->Body    = 'Manager Has Manually Activated Your Account.Use forgot password to reset your password';
        if ($mail->send()) {
            ob_clean();
            $data['message'] = 'Email Sent Successfully';
            $this->redirectpage($data, true, URLROOT . '/managers/getUsers', 10, 'Success', 'Mail Delivered');
            exit();
            return true;
        } else {
            echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
            return false;
        }
    }

    private function handleImageUploadprofilepicture($imageFile)
    {
        $targetDirectory = 'C:\\wamp64\\www\\DineEase-DEE\\public\\uploads\\profile\\';
        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }
        $imageName = str_replace(' ', '_', $imageFile['name']);
        $check = getimagesize($imageFile['tmp_name']);
        if ($check === false) {
            die('Error: Uploaded file is not an image.');
        }
        $randomNumber = mt_rand(100000, 999999);
        $imageNameWithoutExt = pathinfo($imageName, PATHINFO_FILENAME);
        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
        $imageName = $imageNameWithoutExt . '_' . $randomNumber . '.' . $imageExtension;

        $targetFile = $targetDirectory . basename($imageName);
        echo "Target File: " . $targetFile . "<br>";
        while (file_exists($targetFile)) {
            $randomNumber = mt_rand(100000, 999999);
            $imageName = $imageNameWithoutExt . '_' . $randomNumber . '.' . $imageExtension;
            $targetFile = $targetDirectory . basename($imageName);
        }
        if (move_uploaded_file($imageFile['tmp_name'], $targetFile)) {
            return $targetFile;
        } else {
            die('Error: Failed to move uploaded file.');
        }
    }
    private function handlimageUploadpackagepicture($imageFile)
    {
        $targetDirectory = 'C:\\wamp64\\www\\DineEase-DEE\\public\\uploads\\package\\';

        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }
        $imageName = str_replace(' ', '_', $imageFile['name']);
        $check = getimagesize($imageFile['tmp_name']);
        if ($check === false) {
            die('Error: Uploaded file is not an image.');
        }
        $randomNumber = mt_rand(100000, 999999);

        // Append the random number to the file name
        $imageNameWithoutExt = pathinfo($imageName, PATHINFO_FILENAME);
        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
        $imageName = $imageNameWithoutExt . '_' . $randomNumber . '.' . $imageExtension;

        $targetFile = $targetDirectory . basename($imageName);
        echo "Target File: " . $targetFile . "<br>";

        // Check if a file with the same name already exists
        while (file_exists($targetFile)) {
            // Generate a new random number
            $randomNumber = mt_rand(100000, 999999);
            // Append the new random number to the file name
            $imageName = $imageNameWithoutExt . '_' . $randomNumber . '.' . $imageExtension;
            $targetFile = $targetDirectory . basename($imageName);
        }

        // Upload the image file
        if (move_uploaded_file($imageFile['tmp_name'], $targetFile)) {
            return $targetFile; // Return the uploaded image path
        } else {
            die('Error: Failed to move uploaded file.');
        }
    }



    public function packages()
    {
        $packages = $this->managerModel->getpackages();
        $data = [
            'packages' => $packages
        ];
        $this->view('manager/packages', $data);
    }

    //     public function editpackage($ID)
    //     {
    //         $package = $this->managerModel->getpackagebyid($ID);
    //         if (!$package) {
    //             // Handle the case where the category does not exist
    //             // For example, you can redirect to an error page or show an error message
    //             ob_clean();
    //             $data['message'] = 'No Such Package Found';

    //             $this->redirectpage($data, true, URLROOT . '/managers/packages', 10, 'Error', 'Package Error');
    //             //
    //             exit();
    //         }
    //         $data = [
    //             'package' => $package
    //         ];
    //         $this->view('manager/editpackage', $data);
    //         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //             // ... (existing code)
    //             if (isset($_FILES['imagePath']) && $_FILES['imagePath']['error'] === UPLOAD_ERR_OK) {
    //                 // Handle image upload and get the image path
    //                 $imagePath = $this->handlimageUploadpackagepicture($_FILES['imagePath']);
    //                 if ($imagePath === false) {
    //                     // Handle image upload error
    //                     // Redirect or show an error message
    //                     die('Error: Image upload failed.');
    //                 }
    //             } else {
    //                 // Handle no image uploaded or upload error
    //                 die('Error: No image uploaded or upload error.');
    //             }
    //         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //             $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    //             $data = [
    //                 'packageID' => $ID,
    //                 'packageName' => isset($_POST['packageName']) ? trim($_POST['packageName']) : '',
    //                 'tax' => isset($_POST['tax']) ? trim($_POST['tax']) : '',
    //                 'capacity' => isset($_POST['capacity']) ? trim($_POST['capacity']) : '',
    //                 'description' => isset($_POST['description']) ? trim($_POST['description']) : '',
    //                 'imagePath' => $imagePath,
    //                 'packagename_err' => '',
    //                 'vat_err' => '',
    //                 'capacity_err' => '',
    //                 'description_err' => '',
    //             ];
    //             if (empty($data['packageName'])) {
    //                 $data['packagename_err'] = 'Please enter package name';
    //             }
    //             if (empty($data['tax'])) {
    //                 $data['vat_err'] = 'Please enter tax';
    //             }
    //             if (empty($data['capacity'])) {
    //                 $data['capacity_err'] = 'Please enter capacity';
    //             }
    //             if (empty($data['description'])) {
    //                 $data['description_err'] = 'Please enter description';
    //             }
    //             if (empty($data['packagename_err']) && empty($data['vat_err']) && empty($data['capacity_err']) && empty($data['description_err'])) {
    //                 // Call the model function to insert user data
    //                 if ($this->managerModel->editpackage($data)) {
    //                     // Handle success, e.g., redirect to another page
    //                     // header('Location: ' . URLROOT . '/menus/submitMenu');
    //                     //redirect('managers/packages');
    //                     //exit();
    //                 } else {
    //                     $this->view('manager/editpackage', $data);
    //                     //die('Something went wrong');
    //                 }
    //             } else {
    //                 // Validation failed, show the form with errors
    //                 $this->view('manager/editpackage', $data);
    //             }
    //         }
    //     }
    // }
    public function getpackagedetails($ID)
    {
        $package = $this->managerModel->getpackagebyid($ID);
        if (!$package) {
            // Handle the case where the category does not exist
            // For example, you can redirect to an error page or show an error message
            ob_clean();
            $data['message'] = 'No Such Package Found';

            $this->redirectpage($data, true, URLROOT . '/managers/packages', 10, 'Error', 'Package Error');
            //
            exit();
        }
        $data = [
            'package' => $package,
            'packagename_err' => '',
            'vat_err' => '',
            'capacity_err' => '',
            'description_err' => '',
        ];
        $this->view('manager/editpackage', $data);
    }
    public function editpackage()
    {

        $data = []; // Initialize $data array

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $ID = $_POST['packageID'];
            $package = $this->managerModel->getpackagebyid($ID);
            // Check if image was uploaded successfully

            $imagePath = '';
            if (isset($_FILES['imagePath']) && $_FILES['imagePath']['error'] === UPLOAD_ERR_OK) {
                // Handle image upload and get the image path
                $imagePath = $this->handlimageUploadpackagepicture($_FILES['imagePath']);
                //var_dump($imagePath);
                if ($imagePath === false) {
                    // Handle image upload error
                    // Redirect or show an error message
                    die('Error: Image upload failed.');
                }
            } else {
                // Handle no image uploaded or upload error
                //die('Error: No image uploaded or upload error.');
                $imagePath = $package->image;
            }

            $data = [
                'packageID' => isset($_POST['packageID']) ? trim($_POST['packageID']) : '',
                'packageName' => isset($_POST['packageName']) ? trim($_POST['packageName']) : '',
                'tax' => isset($_POST['tax']) ? trim($_POST['tax']) : '',
                //'capacity' => isset($_POST['capacity']) ? trim($_POST['capacity']) : '',
                'description' => isset($_POST['description']) ? trim($_POST['description']) : '',
                'imagePath' => $imagePath,
                'packagename_err' => '',
                'vat_err' => '',
                //'capacity_err' => '',
                'description_err' => '',
            ];

            // Perform validation
            if (empty($data['packageName'])) {
                $data['packagename_err'] = 'Please enter package name';
            }
            if (empty($data['tax'])) {
                $data['vat_err'] = 'Please enter tax';
            }
            // if (empty($data['capacity'])) {
            //     $data['capacity_err'] = 'Please enter capacity';
            // }
            if (empty($data['description'])) {
                $data['description_err'] = 'Please enter description';
            }

            // Check if there are any validation errors
            if (
                empty($data['packagename_err']) ||
                empty($data['vat_err']) ||
                empty($data['description_err'])
            ) {
                // Call the model function to update package data
                if ($this->managerModel->editpackage($data)) {
                    // Handle success, e.g., redirect to another page
                    // header('Location: ' . URLROOT . '/menus/submitMenu');
                    redirect('managers/packages');
                    exit();
                } else {
                    // Handle failure to update package
                    $data['message'] = 'Failed to update package.';
                }
            } else {
                // Validation failed, display the form with validation errors
                $this->view('manager/editpackage', $data);
            }
        }

        $this->view('manager/editpackage', $data);
    }


    public function addtable()
    {
        ob_start();
        $tables = $this->managerModel->gettables();
        $packages = $this->managerModel->getpackages();
        $data = [
            'tables' => $tables,
            'packages' => $packages,
        ];
        $this->view('manager/tables', $data);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'packageID' => isset($_POST['packageID']) ? trim($_POST['packageID']) : '',
                'capacity' => isset($_POST['capacity']) ? trim($_POST['capacity']) : '',
                'packageName' => isset($_POST['packageName']) ? trim($_POST['packageName']) : '',
            ];
            if (empty($data['packageID'])) {
                $data['packageID_err'] = 'Please select a package';
            }
            if (empty($data['capacity'])) {
                $data['capacity_err'] = 'Please enter capacity';
            }
            if (empty($data['packageID_err']) && empty($data['capacity_err'])) {
                // Call the model function to insert user data
                if ($this->managerModel->addtable($data)) {
                    // Handle success, e.g., redirect to another page
                    // header('Location: ' . URLROOT . '/menus/submitMenu');
                    ob_clean();

                    ob_end_flush();
                    redirect('managers/addtable');
                    //exit();
                } else {
                    $this->view('manager/tables', $data);
                    die('Something went wrong');
                }
            } else {
                // Validation failed, show the form with errors
                $this->view('manager/tables', $data);
            }


            // Fetch menu and categories
            $tables = $this->managerModel->gettables();
            $packages = $this->managerModel->getpackages();
            // Merge with existing data
            $data = [
                'tables' => $tables,
                'packages' => $packages,
            ];

            // Show the form with errors or redirect after showing the alert
            $this->view('manager/tables', $data);
        }
    }
    public function addmenudiscounts()
    {
        ob_start();
        $categories = $this->managerModel->getmenucategory();
        $menus = $this->managerModel->getMenuitem();
        $discountedmenus = $this->managerModel->getdiscountedmenus();
        $data = [
            'categories' => $categories,
            'menus' => $menus,
            'discountedmenus' => $discountedmenus,
        ];
        $this->view('manager/discounts', $data);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'menu_ID' => isset($_POST['menu_id']) ? trim($_POST['menu_id']) : '',
                'discount' => isset($_POST['menu_dis']) ? trim($_POST['menu_dis']) : '',
                'menu_start_date' => isset($_POST['menu_start_date']) ? trim($_POST['menu_start_date']) : '',
                'menu_end_date' => isset($_POST['menu_end_date']) ? trim($_POST['menu_end_date']) : '',
                'menu_ID_err' => '',
                'discount_err' => '',
                'menu_start_date_err' => '',
                'menu_end_date_err' => '',
            ];
            if (empty($data['menu_ID'])) {
                $data['menu_ID_err'] = 'Please select a menu';
            }
            if (empty($data['discount'])) {
                $data['discount_err'] = 'Please enter discount';
            } elseif ($data['discount'] < 0 || $data['discount'] > 100) {
                $data['discount_err'] = 'Discount must be between 0 and 100';
            }
            if (empty($data['menu_start_date'])) {
                $data['menu_start_date_err'] = 'Please enter start date';
            }
            if (empty($data['menu_end_date'])) {
                $data['menu_end_date_err'] = 'Please enter end date';
            }
            if ($data['menu_start_date'] > $data['menu_end_date']) {
                $data['menu_start_date_err'] = 'Start date must be before end date';
            }

            if (empty($data['menu_ID_err']) && empty($data['discount_err']) && empty($data['menu_start_date_err']) && empty($data['menu_end_date_err'])) {
                // Call the model function to insert user data
                if ($this->managerModel->addmenudiscounts($data)) {
                    // Handle success, e.g., redirect to another page
                    // header('Location: ' . URLROOT . '/menus/submitMenu');
                    ob_clean();

                    ob_end_flush();
                    redirect('managers/handlediscounts');
                    exit();
                } else {
                    $this->view('manager/discounts', $data);
                    die('Something went wrong');
                }
            } else {
                // Validation failed, show the form with errors
                $this->view('manager/discounts', $data);
            }
        }
    }
    public function handlediscounts()
    {
        $categories = $this->managerModel->getmenucategory();
        $menus = $this->managerModel->getMenuitem();
        $discountedcategories = $this->managerModel->getdiscountedcategories();
        $discountedmenus = $this->managerModel->getdiscountedmenus();
        $checktotaldiscount = $this->managerModel->checktotaldiscount();
        $data = [
            'categories' => $categories,
            'menus' => $menus,
            'discountedmenus' => $discountedmenus,
            'discountedcategories' => $discountedcategories,
            'checktotaldiscount' => $checktotaldiscount,
        ];
        $this->view('manager/discounts', $data);
    }

    public function addcategorydiscounts()
    {
        ob_start();
        $categories = $this->managerModel->getmenucategory();
        $menus = $this->managerModel->getMenuitem();
        $discountedcategories = $this->managerModel->getdiscountedcategories();
        $data = [
            'categories' => $categories,
            'menus' => $menus,
            'discountedcategories' => $discountedcategories,
        ];
        $this->view('manager/discounts', $data);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'category_ID' => isset($_POST['category_id']) ? trim($_POST['category_id']) : '',
                'discount' => isset($_POST['category_discount']) ? trim($_POST['category_discount']) : '',
                'menu_start_date' => isset($_POST['menu_start_date']) ? trim($_POST['menu_start_date']) : '',
                'menu_end_date' => isset($_POST['menu_end_date']) ? trim($_POST['menu_end_date']) : '',
                'menu_ID_err' => '',
                'discount_err' => '',
                'menu_start_date_err' => '',
                'menu_end_date_err' => '',
            ];
            if (empty($data['category_ID'])) {
                $data['menu_ID_err'] = 'Please select a menu';
            }
            if (empty($data['discount'])) {
                $data['discount_err'] = 'Please enter discount';
            } elseif ($data['discount'] < 0 || $data['discount'] > 100) {
                $data['discount_err'] = 'Discount must be between 0 and 100';
            }
            if (empty($data['menu_start_date'])) {
                $data['menu_start_date_err'] = 'Please enter start date';
            }
            if (empty($data['menu_end_date'])) {
                $data['menu_end_date_err'] = 'Please enter end date';
            }
            if ($data['menu_start_date'] > $data['menu_end_date']) {
                $data['menu_start_date_err'] = 'Start date must be before end date';
            }

            if (empty($data['menu_ID_err']) && empty($data['discount_err']) && empty($data['menu_start_date_err']) && empty($data['menu_end_date_err'])) {
                // Call the model function to insert user data
                if ($this->managerModel->addcategorydiscounts($data)) {
                    // Handle success, e.g., redirect to another page
                    //header('Location: ' . URLROOT . '/managers/handlediscounts');
                    ob_clean();

                    ob_end_flush();
                    redirect('managers/handlediscounts');
                    exit();
                } else {
                    $this->view('manager/discounts', $data);
                    die('Something went wrong');
                }
            } else {
                // Validation failed, show the form with errors
                $this->view('manager/discounts', $data);
            }
        }
    }
    public function addtotaldiscount()
    {
        ob_start();
        $categories = $this->managerModel->getmenucategory();
        $menus = $this->managerModel->getMenuitem();
        $discountedcategories = $this->managerModel->getdiscountedcategories();
        $data = [
            'categories' => $categories,
            'menus' => $menus,
            'discountedcategories' => $discountedcategories,
        ];
        $this->view('manager/discounts', $data);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'discount' => isset($_POST['total_discount']) ? trim($_POST['total_discount']) : '',
                'menu_start_date' => isset($_POST['menu_start_date']) ? trim($_POST['menu_start_date']) : '',
                'menu_end_date' => isset($_POST['menu_end_date']) ? trim($_POST['menu_end_date']) : '',
                'discount_err' => '',
                'menu_start_date_err' => '',
                'menu_end_date_err' => '',
            ];
            if (empty($data['discount'])) {
                $data['discount_err'] = 'Please enter discount';
            } elseif ($data['discount'] < 0 || $data['discount'] > 100) {
                $data['discount_err'] = 'Discount must be between 0 and 100';
            }
            if (empty($data['menu_start_date'])) {
                $data['menu_start_date_err'] = 'Please enter start date';
            }
            if (empty($data['menu_end_date'])) {
                $data['menu_end_date_err'] = 'Please enter end date';
            }
            if ($data['menu_start_date'] > $data['menu_end_date']) {
                $data['menu_start_date_err'] = 'Start date must be before end date';
            }

            if (empty($data['discount_err']) && empty($data['menu_start_date_err']) && empty($data['menu_end_date_err'])) {
                // Call the model function to insert user data
                if ($this->managerModel->addtotaldiscount($data)) {
                    // Handle success, e.g., redirect to another page
                    //header('Location: ' . URLROOT . '/managers/handlediscounts');
                    ob_clean();

                    ob_end_flush();
                    redirect('managers/handlediscounts');
                    exit();
                } else {
                    $this->view('manager/discounts', $data);
                    die('Something went wrong');
                }
            } else {
                // Validation failed, show the form with errors
                $this->view('manager/discounts', $data);
            }
        }
    }
    public function getmenudiscountdetails($ID)

    {
        ob_start();
        $discountdetails = $this->managerModel->getdiscountedmenubyid($ID);

        $data = [
            'discountdetails' => $discountdetails
        ];

        $this->view('manager/updatemenudiscounts', $data);
        if (!$discountdetails) {
            ob_clean();
            ob_end_flush();
            redirect('managers/handlediscounts');
            exit();
        }

        //$this->view('manager/testvardump', $data);

    }
    public function getcategorydiscountdetails($ID)
    {
        ob_start();
        $discountdetails = $this->managerModel->getdiscountedcategorybyid($ID);

        $data = [
            'discountdetails' => $discountdetails
        ];

        $this->view('manager/updatecategorydiscount', $data);
        if (!$discountdetails) {
            ob_clean();
            ob_end_flush();
            redirect('managers/handlediscounts');
            exit();
        }

        // $this->view('manager/testvardump', $data);
    }
    public function updatemenudiscounts()
    {
        ob_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                //'menu_ID' => isset($_POST['menu_id']) ? trim($_POST['menu_id']) : '',
                //'menu_ID' => $ID,
                'discount_id' => isset($_POST['discount_id']) ? trim($_POST['discount_id']) : '',
                'category_menu_id' => isset($_POST['category_menu_id']) ? trim($_POST['category_menu_id']) : '',
                'discount' => isset($_POST['menu_dis']) ? trim($_POST['menu_dis']) : '',
                'menu_start_date' => isset($_POST['menu_start_date']) ? trim($_POST['menu_start_date']) : '',
                'menu_end_date' => isset($_POST['menu_end_date']) ? trim($_POST['menu_end_date']) : '',
                //'menu_ID_err' => '',
                'discount_err' => '',
                'menu_start_date_err' => '',
                'menu_end_date_err' => '',
            ];

            if (empty($data['discount'])) {
                $data['discount_err'] = 'Please enter discount';
            } elseif ($data['discount'] < 0 || $data['discount'] > 100) {
                $data['discount_err'] = 'Discount must be between 0 and 100';
            }
            if (empty($data['menu_start_date'])) {
                $data['menu_start_date_err'] = 'Please enter start date';
            }
            if (empty($data['menu_end_date'])) {
                $data['menu_end_date_err'] = 'Please enter end date';
            }
            if ($data['menu_start_date'] > $data['menu_end_date']) {
                $data['menu_start_date_err'] = 'Start date must be before end date';
            }

            if (empty($data['discount_err']) && empty($data['menu_start_date_err']) && empty($data['menu_end_date_err'])) {
                // Call the model function to insert user data
                if ($this->managerModel->updatemenudiscounts($data)) {
                    // Handle success, e.g., redirect to another page
                    // header('Location: ' . URLROOT . '/menus/submitMenu');
                    ob_clean();

                    ob_end_flush();
                    redirect('managers/viewdiscounteditems');
                    exit();
                } else {
                    $this->view('manager/updatemenudiscounts', $data);
                    die('Something went wrong');
                }
            } else {
                // Validation failed, show the form with errors
                $this->view('manager/updatemenudiscounts', $data);
            }
        }
    }
    public function viewdiscounteditems()
    {
        //$categories = $this->managerModel->getmenucategory();
        //$menus = $this->managerModel->getMenuitem();
        $discountedcategories = $this->managerModel->getdiscountedcategories();
        $discountedmenus = $this->managerModel->getdiscountedmenus();
        $totaldiscount = $this->managerModel->gettotaldiscount();
        $data = [
            //'categories' => $categories,
            //'menus' => $menus,
            'discountedcategories' => $discountedcategories,
            'discountedmenus' => $discountedmenus,
            'totaldiscount' => $totaldiscount,
        ];
        //$this->view('manager/testvardump', $data);
        $this->view('manager/viewdiscounts', $data);
    }

    public function deletediscount()
    {
        ob_start();
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $ID = isset($_POST['discount_id']) ? trim($_POST['discount_id']) : '';

        if ($this->managerModel->deletediscount($ID)) {

            ob_clean();
            ob_end_flush();
        }
    }

    public function updatecategorydiscounts()
    {
        ob_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                //'menu_ID' => isset($_POST['menu_id']) ? trim($_POST['menu_id']) : '',
                //'menu_ID' => $ID,
                'discount_id' => isset($_POST['discount_id']) ? trim($_POST['discount_id']) : '',
                'category_menu_id' => isset($_POST['category_menu_id']) ? trim($_POST['category_menu_id']) : '',
                'discount' => isset($_POST['menu_dis']) ? trim($_POST['menu_dis']) : '',
                'menu_start_date' => isset($_POST['menu_start_date']) ? trim($_POST['menu_start_date']) : '',
                'menu_end_date' => isset($_POST['menu_end_date']) ? trim($_POST['menu_end_date']) : '',
                //'menu_ID_err' => '',
                'discount_err' => '',
                'menu_start_date_err' => '',
                'menu_end_date_err' => '',
            ];

            if (empty($data['discount'])) {
                $data['discount_err'] = 'Please enter discount';
            } elseif ($data['discount'] < 0 || $data['discount'] > 100) {
                $data['discount_err'] = 'Discount must be between 0 and 100';
            }
            if (empty($data['menu_start_date'])) {
                $data['menu_start_date_err'] = 'Please enter start date';
            }
            if (empty($data['menu_end_date'])) {
                $data['menu_end_date_err'] = 'Please enter end date';
            }
            if ($data['menu_start_date'] > $data['menu_end_date']) {
                $data['menu_start_date_err'] = 'Start date must be before end date';
            }

            if (empty($data['discount_err']) && empty($data['menu_start_date_err']) && empty($data['menu_end_date_err'])) {
                // Call the model function to insert user data
                if ($this->managerModel->updatecategorydiscounts($data)) {
                    // Handle success, e.g., redirect to another page
                    // header('Location: ' . URLROOT . '/menus/submitMenu');
                    ob_clean();

                    ob_end_flush();
                    redirect('managers/viewdiscounteditems');
                    exit();
                } else {
                    $this->view('manager/updatcategorydiscounts', $data);
                    die('Something went wrong');
                }
            } else {
                // Validation failed, show the form with errors
                $this->view('manager/updatcategorydiscounts', $data);
            }
        }
    }
    public function updatetotaldiscount()
    {
        ob_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                //'menu_ID' => isset($_POST['menu_id']) ? trim($_POST['menu_id']) : '',
                //'menu_ID' => $ID,
                'discount_id' => isset($_POST['discount_id']) ? trim($_POST['discount_id']) : '',
                //'category_menu_id' => isset($_POST['category_menu_id']) ? trim($_POST['category_menu_id']) : '',
                'discount' => isset($_POST['menu_dis']) ? trim($_POST['menu_dis']) : '',
                'menu_start_date' => isset($_POST['menu_start_date']) ? trim($_POST['menu_start_date']) : '',
                'menu_end_date' => isset($_POST['menu_end_date']) ? trim($_POST['menu_end_date']) : '',
                //'menu_ID_err' => '',
                'discount_err' => '',
                'menu_start_date_err' => '',
                'menu_end_date_err' => '',
            ];

            if (empty($data['discount'])) {
                $data['discount_err'] = 'Please enter discount';
            } elseif ($data['discount'] < 0 || $data['discount'] > 100) {
                $data['discount_err'] = 'Discount must be between 0 and 100';
            }
            if (empty($data['menu_start_date'])) {
                $data['menu_start_date_err'] = 'Please enter start date';
            }
            if (empty($data['menu_end_date'])) {
                $data['menu_end_date_err'] = 'Please enter end date';
            }
            if ($data['menu_start_date'] > $data['menu_end_date']) {
                $data['menu_start_date_err'] = 'Start date must be before end date';
            }

            if (empty($data['discount_err']) && empty($data['menu_start_date_err']) && empty($data['menu_end_date_err'])) {
                // Call the model function to insert user data
                if ($this->managerModel->updatetotaldiscount($data)) {
                    // Handle success, e.g., redirect to another page
                    // header('Location: ' . URLROOT . '/menus/submitMenu');
                    ob_clean();

                    ob_end_flush();
                    redirect('managers/viewdiscounteditems');
                    exit();
                } else {
                    $this->view('manager/updatcategorydiscounts', $data);
                    die('Something went wrong');
                }
            } else {
                // Validation failed, show the form with errors
                $this->view('manager/updatcategorydiscounts', $data);
            }
        }
    }
    public function viewtotaldiscount()
    {
        ob_start();
        $discountdetails = $this->managerModel->gettotaldiscountdetails();
        $data = [
            'discountdetails' => $discountdetails
        ];
        $this->view('manager/updatetotaldiscount', $data);
        if (!$discountdetails) {
            ob_clean();
            ob_end_flush();
            redirect('managers/handlediscounts');
            exit();
        }
    }
    public function dashboard()
    {
        $totalsales = $this->managerModel->totalsales();
        $totalorders = $this->managerModel->totalorders();
        $totalcustomers = $this->managerModel->totalcustomers();
        $totalmenus = $this->managerModel->totalmenuitems();
        $bestsellingmenuitem = $this->managerModel->bestsellingmenuitem();
        $bestsellingtop5menuitems = $this->managerModel->top5bestsellinmenuitems();
        $mostusedpackage = $this->managerModel->mostusedpackage();
        $gettotalpackageusage = $this->managerModel->gettotalpackageusage();
        $top5customers = $this->managerModel->top5customers();
        $bestreviewedfood = $this->managerModel->bestreviewedfood();
        $leastreviewedfood = $this->managerModel->leastreviewedfood();
        $totalpendingrefundrequests = $this->managerModel->totalpendingrefundrequests();
        $data = [
            'totalsales' => $totalsales,
            'totalorders' => $totalorders,
            'totalcustomers' => $totalcustomers,
            'totalmenus' => $totalmenus,
            'bestsellingmenuitem' => $bestsellingmenuitem,
            'bestsellingtop5menuitems' => $bestsellingtop5menuitems,
            'mostusedpackage' => $mostusedpackage,
            'gettotalpackageusage' => $gettotalpackageusage,
            'top5customers' => $top5customers,
            'bestreviewedfood' => $bestreviewedfood,
            'leastreviewedfood' => $leastreviewedfood,
            'totalpendingrefundrequests' => $totalpendingrefundrequests,
        ];
        $this->view('manager/dashboard', $data);
        //$this->view('manager/testvardump', $data);

    }
    public function reports()
    {
        $minmaxpaymentdate = $this->managerModel->minmaxpaymentdate();
        $minmaxreservationdate = $this->managerModel->minmaxreservationdate();

        $data = [
            'minmaxpaymentdate' => $minmaxpaymentdate,
            'minmaxreservationdate' => $minmaxreservationdate,
        ];
        $this->view('manager/reports', $data);
    }
    public function fetchSalesReport()
    {

        $minmaxpaymentdate = $this->managerModel->minmaxpaymentdate();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'start_date' => isset($_POST['start_date']) ? trim($_POST['start_date']) : '',
                'end_date' => isset($_POST['end_date']) ? trim($_POST['end_date']) : '',
                'start_date_err' => '',
                'end_date_err' => '',
                'minmaxpaymentdate' => $minmaxpaymentdate,
            ];
            // var_dump($data);
            error_log('Data passed to model: ' . print_r($data, true));
            //var_dump($data['end_date']);
            if (empty($data['start_date'])) {
                $data['start_date_err'] = 'Please enter start date';
            }
            if (empty($data['end_date'])) {
                $data['end_date_err'] = 'Please enter end date';
            }
            if ($data['start_date'] > $data['end_date']  && !empty($data['start_date']) && !empty($data['end_date'])) {
                $data['diff_date_err'] = 'Start date must be before end date';
            }

            if (empty($data['start_date_err']) && empty($data['end_date_err']) && empty($data['diff_date_err'])) {
                // Call the model function to insert user data
                $salesreport = $this->managerModel->salesreport($data);
                // $menureport = $this->managerModel->menureport($data);
                //error_log('Data retrieved from salesreport model: ' . print_r(json_encode($salesreport), true));
                //var_dump($salesreport);
                header('Content-Type: application/json');
                echo json_encode($salesreport);
                //echo json_encode($menureport);
                //exit();
                //ob_clean();
                //ob_end_flush();

            } else {
                // Validation failed, show the form with errors
                //ob_clean();
                //ob_end_flush();
                header('Content-Type: application/json');
                echo json_encode(['errors' => $data]);
                //exit();
                //$this->reports($data);
            }
        }
    }
    public function fetchMenuReport()
    {

        $minmaxreservationdate = $this->managerModel->minmaxreservationdate();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'start_date' => isset($_POST['start_date']) ? trim($_POST['start_date']) : '',
                'end_date' => isset($_POST['end_date']) ? trim($_POST['end_date']) : '',
                'start_date_err' => '',
                'end_date_err' => '',
                'minmaxreservationdate' => $minmaxreservationdate,
            ];
            // var_dump($data);
            //error_log('Data passed to model: ' . print_r($data, true));
            //var_dump($data['end_date']);
            if (empty($data['start_date'])) {
                $data['start_date_err'] = 'Please enter start date';
            }
            if (empty($data['end_date'])) {
                $data['end_date_err'] = 'Please enter end date';
            }
            if ($data['start_date'] > $data['end_date']  && !empty($data['start_date']) && !empty($data['end_date'])) {
                $data['diff_date_err'] = 'Start date must be before end date';
            }

            if (empty($data['start_date_err']) && empty($data['end_date_err']) && empty($data['diff_date_err'])) {
                // Call the model function to insert user data
                $menureport = $this->managerModel->menureport($data);
                // $menureport = $this->managerModel->menureport($data);
                //error_log('Data retrieved from menureport model: ' . print_r($menureport, true));
                //var_dump($salesreport);
                header('Content-Type: application/json');
                echo json_encode($menureport);
                //var_dump(json_encode($menureport));
                //echo json_encode($menureport);
                //exit();
                //ob_clean();
                //ob_end_flush();

            } else {
                // Validation failed, show the form with errors
                //ob_clean();
                //ob_end_flush();
                header('Content-Type: application/json');
                echo json_encode(['errors' => $data]);
                //exit();
                //$this->reports($data);
            }
        }
    }
    public function generatereportpdf()
    {
        require_once APPROOT . '/vendor/autoload.php';
        $startDate = $_GET['startDate'];
        $endDate = $_GET['endDate'];
        // Get the JSON data from the request body
        $request_body = file_get_contents('php://input');


        // Decode the JSON data
        $menuReport = json_decode($request_body, true);

        // Create a new TCPDF instance
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Set document information
        $creator = $_SESSION['user_name'];
        $pdf->SetCreator($creator);
        $pdf->SetAuthor('Manager');
        $pdf->SetTitle('Menu Report');
        $pdf->SetSubject('Menu Report');
        $pdf->SetKeywords('Menu, Report');

        // Add a page
        $pdf->AddPage();

        // Add the logo image
        $imageFile = URLROOT . '/public/img/login/dineease-logo.png'; // Specify the path to your logo image file
        $pdf->Image($imageFile, $x = 10, $y = 10, $w = 50, $h = '', $type = '', $link = '', $align = '', $resize = false, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox = false, $hidden = false, $fitonpage = false);
        // Add the report period to the content of the PDF
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(0, 10, 'Report Period: ' . $startDate . ' to ' . $endDate, 0, 1);

        // Set font
        $pdf->SetFont('times', 'BI', 16);

        // Add heading
        $pdf->Cell(0, 10, 'Menu Report', 0, 1, 'C');

        // Add top selling menus section
        $pdf->Ln(10);
        $pdf->SetFont('times', 'B', 14);
        $pdf->Cell(0, 10, 'Top Selling Menus', 0, 1);
        $pdf->SetFont('times', '', 12);
        foreach ($menuReport['topSellingMenus'] as $menu) {
            $pdf->Cell(0, 10, $menu['itemName'] . ' - Total Quantity Sold: ' . $menu['total_quantity_sold'], 0, 1);
        }

        // Add top selling categories section
        $pdf->Ln(10);
        $pdf->SetFont('times', 'B', 14);
        $pdf->Cell(0, 10, 'Top Selling Categories', 0, 1);
        $pdf->SetFont('times', '', 12);
        foreach ($menuReport['topSellingCategories'] as $category) {
            $pdf->Cell(0, 10, $category['category_name'] . ' - Total Quantity Sold: ' . $category['total_quantity_sold'], 0, 1);
        }

        // Add most reservations date section
        $pdf->Ln(10);
        $pdf->SetFont('times', 'B', 14);
        $pdf->Cell(0, 10, 'Most Reservations Date', 0, 1);
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(0, 10, 'Date: ' . $menuReport['mostReservationsDate']['date'] . ' - Reservation Count: ' . $menuReport['mostReservationsDate']['reservation_count'], 0, 1);

        // Add most ordered sizes section
        $pdf->Ln(10);
        $pdf->SetFont('times', 'B', 14);
        $pdf->Cell(0, 10, 'Most Ordered Sizes', 0, 1);
        $pdf->SetFont('times', '', 12);
        foreach ($menuReport['mostOrderedSizes'] as $size) {
            $pdf->Cell(0, 10, $size['itemName'] . ' - Size: ' . $size['size'] . ' - Total Quantity Sold: ' . $size['total_quantity_sold'], 0, 1);
        }

        // Add results section
        $pdf->Ln(10);
        $pdf->SetFont('times', 'B', 14);
        $pdf->Cell(0, 10, 'Total quantity sold and total amount for each menu item', 0, 1);
        $pdf->SetFont('times', '', 12);

        // Define table columns
        $header = array('Category', 'Item', 'Date', 'Total Quantity Sold', 'Total Amount');

        // Set maximum column widths
        $maxColumnWidths = array(40, 40, 30, 40, 40); // Adjust these values as needed

        // Calculate the maximum width needed for the 'Item' column
        $maxItemWidth = 0;
        foreach ($menuReport['results'] as $result) {
            $itemWidth = $pdf->GetStringWidth($result['itemName']); // Get the width of the item name
            if ($itemWidth > $maxItemWidth) {
                $maxItemWidth = $itemWidth;
            }
        }

        // Adjust the width of the 'Item' column based on the maximum item name width
        $maxColumnWidths[1] = $maxItemWidth + 10; // Add some extra padding

        // Calculate the total width of the table
        $totalWidth = array_sum($maxColumnWidths);

        // Adjust column widths if the total width exceeds the page width
        $pageWidth = $pdf->getPageWidth() - 20; // Subtract some padding for margins
        if ($totalWidth > $pageWidth) {
            // Calculate the ratio to scale down the column widths
            $ratio = $pageWidth / $totalWidth;

            // Apply the ratio to adjust the column widths
            foreach ($maxColumnWidths as &$width) {
                $width *= $ratio;
            }
        }

        // Draw header row
        $pdf->SetFillColor(200, 220, 255); // Set table header fill color
        $pdf->SetTextColor(0); // Set text color
        $pdf->SetFont('times', 'B');
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($maxColumnWidths[$i], 10, $header[$i], 1, 0, 'C', true);
        }
        $pdf->Ln();
        $pdf->SetFont('times', '');
        foreach ($menuReport['results'] as $result) {
            $pdf->Cell($maxColumnWidths[0], 10, $result['category_name'], 1);
            $pdf->Cell($maxColumnWidths[1], 10, $result['itemName'], 1);
            $pdf->Cell($maxColumnWidths[2], 10, $result['date'], 1, 0, 'C');
            $pdf->Cell($maxColumnWidths[3], 10, $result['total_quantity_sold'], 1, 0, 'C');
            $pdf->Cell($maxColumnWidths[4], 10, $result['total_amount'], 1, 0, 'C');
            $pdf->Ln();
        }

        // Output PDF to browser
        $date = date('Y-m-d_H-i-s'); // Get current date and time in the format YYYY-MM-DD_HH-MM-SS
        $pdf->Output('menu_report_' . $date . '.pdf', 'I');
    }

    public function viewtables()
    {
        // Fetch tables and packages
        $tables = $this->managerModel->tabledetailswithpackage();
        $packages = $this->managerModel->getpackages();

        // Check if package ID is provided in the POST data
        $packageID = isset($_POST['packageID']) ? $_POST['packageID'] : '';

        // If package ID is provided, filter the tables by package
        if (!empty($packageID)) {
            $tables = $this->managerModel->filtertablesbypackage($packageID);
        }

        // Pass data to the view
        $data = [
            'tables' => $tables,
            'packages' => $packages,
        ];

        // Load the view

        $this->view('manager/viewtables', $data);
    }
    public function deletetable()
    {
        //try to delete table. If cannot show an alert saying there are orders on the table
        ob_start();
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $ID = isset($_POST['table_id']) ? trim($_POST['table_id']) : '';
        if ($this->managerModel->deletetable($ID)) {
            ob_clean();
            ob_end_flush();
            redirect('managers/viewtables');
            exit();
        } else {
            ob_clean();
            ob_end_flush();
            echo "<script>alert('There are reservations for this table in the upcoming future. Please try hiding it.');</script>";

            echo "<script>window.location.href = '" . URLROOT . "/managers/viewtables';</script>";
            exit();
        }
    }
    public function tablevisibility()
    {
        ob_start();
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $ID = isset($_POST['tableID']) ? trim($_POST['tableID']) : '';
        $status = isset($_POST['visibility']) ? trim($_POST['visibility']) : '';
        if ($this->managerModel->tablevisibility($ID, $status)) {
            //ob_clean();
            //ob_end_flush();
            //redirect('managers/viewtables'); 
            exit();
        }
    }
}
