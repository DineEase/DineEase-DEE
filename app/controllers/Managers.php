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
            // Handle the case where the category does not exist
            // For example, you can redirect to an error page or show an error message
            ob_clean();
            $data['message'] = 'No Such Menu Item Found';

            $this->redirectpage($data, true, URLROOT . '/managers/menu', 5, 'Error', 'Menu Error');
            //
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['imagePath']) && $_FILES['imagePath']['error'] === UPLOAD_ERR_OK) {
                // Handle image upload and get the image path
                $imagePath = $this->handleImageUpload($_FILES['imagePath']);
                if ($imagePath === false) {
                    // Handle image upload error
                    // Redirect or show an error message
                    ob_clean();
                    $data['message'] = 'Error: Image upload failed.';

                    $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Error', 'Image Upload Error');
                    //
                    exit();
                }
            } else {
                // If no new image is uploaded, use the existing image path from the database
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

            // Validate the name only if it has changed
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
                    'imagePath' => $imagePath, // Assign the image path to the menuData array
                    'category_ID' => $_POST['category'], // Assign the image path to the menuData array
                    'menucategory' => $menuCategories,
                    'description' => $data['description'],
                ];
                if ($this->managerModel->editMenuitem($menuData)) {
                    // Handle success, e.g., redirect to another page
                    // header('Location: ' . URLROOT . '/menus/submitMenu');
                    ob_clean();
                    $data['message'] = 'Menu Edited Successfully!';

                    $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Successful', 'Menu Edited Successfully');
                    //
                    exit();
                } else {
                    $this->view('manager/editmenu', $data);
                    ob_clean();
                    $data['message'] = 'Menu Editing Failed!';

                    $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Error', 'Menu Editing Error');
                    //
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




            // $menuCategories = $this->managerModel->getmenucategory();
            // $data['menucategory'] = $menuCategories;
            $this->view('manager/editmenu', $data);
        }
    }

    public function deleteMenuitem($itemID)
    {
        if ($this->managerModel->deleteMenuItem($itemID)) {
            ob_clean();
            $data['message'] = 'Menu Deleted Successfully!';

            $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Successful', 'Menu Deleted Successfully');
            //
            exit();
        }
        else {
            ob_clean();
            ob_end_flush();
            echo "<script>alert('There are reservations for this menuitem in the upcoming future. Please try hiding it.');</script>";
           
            echo "<script>window.location.href = '".URLROOT."/managers/menu';</script>";
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
        // Get the search query from the query parameter
        $searchQuery = isset($_GET['searchQuery']) ? $_GET['searchQuery'] : null;

        // Call the model method with the retrieved search query
        if ($menu = $this->managerModel->searchmenubyname($searchQuery)) {

            $data = [
                'menu' => $menu,
                'categories' => $categories,
            ];

            // Load the view with the filtered data
            $this->view('manager/menu', $data);
        } else {
            ob_clean();
            $data['message'] = 'No Such Menu Item Found';

            $this->redirectpage($data, true, URLROOT . '/managers/menu', 5, 'Error', 'Menu Error');
            //
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

            // Check if the category already exists
            if (empty($data['category_name_err'])) {
                $existingCategory = $this->managerModel->findcategorybyname($data['category_name']);
                if ($existingCategory) {
                    $data['category_name_err'] = 'Category already exists';
                }
            }

            if (empty($data['category_name_err'])) {
                // Call the model function to insert user data
                if ($this->managerModel->addmenucategory($data)) {
                    // Handle success
                    $data['new_category_added'] = true; // Set the flag
                } else {
                    $data['category_name_err'] = 'Something went wrong';
                }
            }
        }

        // Fetch menu and categories
        #$menuitem = $this->managerModel->getMenuitem();
        $categories = $this->managerModel->getmenucategory();

        // Merge with existing data
        #$data['menu'] = $menuitem;
        $data['categories'] = $categories;

        // Show the form with errors or redirect after showing the alert
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

        // Get the category ID from the query parameter
        $category_ID = isset($_GET['categoryFilter']) ? $_GET['categoryFilter'] : null;


        // Call the model method to get filtered menu items
        $menu = $this->managerModel->filtermenubycategory($category_ID);

        $data = [
            'menu' => $menu,
            'categories' => $categories,
        ];

        // Load the view with the filtered data
        $this->view('manager/menu', $data);
    }
    public function editmenucategory($category_ID)
    {
        $menu = $this->managerModel->getMenuitem();
        $categories = $this->managerModel->getmenucategory();
        $category = $this->managerModel->getcategorybyID($category_ID);
        if (!$category) {
            // Handle the case where the category does not exist
            // For example, you can redirect to an error page or show an error message
            ob_clean();
            $data['message'] = 'No Such Menu Category Found';

            $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Error', 'Category Error');
            //
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

            // Validate category name
            if (empty($data['category_name'])) {
                $data['category_edit_name_err'] = 'Please enter a category name';
            } elseif ($this->managerModel->findcategorybyname($data['category_name'])) {
                $data['category_edit_name_err'] = 'Category already exists';
            }

            if (empty($data['category_edit_name_err'])) {
                // Call the model function to update the category
                if ($this->managerModel->editmenucategory($category_ID, $data['category_name'])) {
                    // Handle success, e.g., redirect to another page
                    ob_clean();
                    $data['message'] = 'Catergory Edited Successfully!';

                    $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Successful', 'Category Edited');
                    //
                    exit();
                    //var_dump($data['category_name']);
                    //var_dump($category_ID);
                } else {
                    ob_clean();
                    $data['message'] = 'Category Edit Unsuccessful!';

                    $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Error', 'Category Error');
                    //
                    exit();
                }
            } else {
                // Validation failed, show the form with errors and the original category name
                $this->view('manager/categories', $data);
            }
        } else {
            // Initial load of the page, show the form without errors

            $data = [
                'category_ID' => $category_ID,
                'category_name' => $category->category_name,
                'category_edit_name_err' => '',
                //'menu' => $menu,
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
                // Call the model function to insert user data
                if ($this->managerModel->updatecategorytime($data)) {
                    // Handle success, e.g., redirect to another page
                    // header('Location: ' . URLROOT . '/menus/submitMenu');
                    //redirect('managers/menu');
                    ob_clean();
                    $data['message'] = 'Category Update Successful!';

                    $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Successful', 'Category Update Successful');
                    //
                    exit();
                } else {
                    ob_clean();
                    $data['message'] = 'Category Update Failed';

                    $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Error', 'Category Update Error');
                    //
                    exit();
                }
            } else {
                // Validation failed, show the form with errors
                $this->view('manager/categories', $data);
            }
        } else {
            // Initial load of the page, show the form without errors
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
                // Call the model function to insert user data
                if ($this->managerModel->hidecategory($data)) {
                    // Handle success, e.g., redirect to another page
                    // header('Location: ' . URLROOT . '/menus/submitMenu');
                    redirect('managers/updatetimecategories');
                    //var_dump( $data);
                    exit();
                } else {
                    ob_clean();
                    $data['message'] = 'Category Hide Failed!';

                    $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Error', 'Category Hide Error');
                    //
                    exit();
                }
            } else {
                // Validation failed, show the form with errors
                $this->view('manager/categories', $data);
            }
        } else {
            // Initial load of the page, show the form without errors
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
                // Call the model function to insert user data
                if ($this->managerModel->showcategory($data)) {
                    // Handle success, e.g., redirect to another page
                    // header('Location: ' . URLROOT . '/menus/submitMenu');
                    redirect('managers/updatetimecategories');
                    //var_dump( $data);
                    exit();
                } else {
                    ob_clean();
                    $data['message'] = 'Category Show Failed!';

                    $this->redirectpage($data, true, URLROOT . '/managers/menu', 10, 'Error', 'Category Show Error');
                    //
                    exit();
                }
            } else {
                // Validation failed, show the form with errors
                $this->view('manager/categories', $data);
            }
        } else {
            // Initial load of the page, show the form without errors
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
    
        // Replace spaces with underscores in the file name
        $imageName = str_replace(' ', '_', $imageFile['name']);
    
        // Check if the file is an image
        $check = getimagesize($imageFile['tmp_name']);
        if ($check === false) {
            die('Error: Uploaded file is not an image.');
        }
    
        // Generate a random number
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






    // User Handling functions

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
            // ... (existing code)
            if (isset($_FILES['imagePath']) && $_FILES['imagePath']['error'] === UPLOAD_ERR_OK) {
                // Handle image upload and get the image path
                $imagePath = $this->handleImageUploadprofilepicture($_FILES['imagePath']);
                if ($imagePath === false) {
                    // Handle image upload error
                    // Redirect or show an error message
                    die('Error: Image upload failed.');
                }
            } else {
                // Handle no image uploaded or upload error
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
                // Check if email is already taken as a staff member
                if ($this->managerModel->findEmployeeByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already taken as a staff member';
                } else {
                    // Verify email using Hunter API
                    $hunterApiKey = 'f0b22562feaf8e34e1332f9e148c6f246dc78045';
                    if (!$this->verifyEmailUsingHunter($data['email'], $hunterApiKey)) {
                        $data['email_err'] = 'Email address is not deliverable';
                    }
                }
            }


            if (empty($data['mobile_number'])) {
                $data['mobile_number_err'] = 'Please enter mobile number';
            } else {
                // check email
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
                // Convert DOB to DateTime object
                $dobDateTime = new DateTime($data['dob']);

                // Calculate age by finding the difference between current date and DOB
                $currentDateTime = new DateTime();
                $age = $currentDateTime->diff($dobDateTime)->y;

                // Check if the person is at least 18+4 years old
                if ($age < 18) {
                    $data['dob_err'] = 'User must be at least 18 years old.';
                }
            }
            if (empty($data['password_err']) && empty($data['role_err']) && empty($data['email_err']) && empty($data['mobile_number_err']) && empty($data['nic_err']) && empty($data['dob_err'])) {
                // Call the model function to insert user data
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $userData = [
                    'name' => $data['name'],
                    'password' => $data['password'],
                    'role' => $data['role'], // This is the role ID, not the role name
                    'address' => $data['address'],
                    'email' => $data['email'],
                    'joined_date' => $data['joined_date'],
                    'nic' => $data['nic'],
                    'mobile_number' => $data['mobile_number'],
                    'dob' => $data['dob'],
                    'imagePath' => $imagePath,
                ];

                // Insert the user and retrieve the user_id
                $userId = $this->managerModel->addUsers($userData);

                if ($userId) {
                    // Generate password reset token
                    $token = $this->managerModel->generatePasswordResetToken($data['email']);

                    // Send password reset email
                    $this->sendPasswordResetEmail($data['email'], $token);

                    // Handle success, e.g., redirect to another page
                    //redirect('managers/Index');
                    exit();
                } else {
                    // Validation failed, show the form with errors
                    $data['error_message'] = 'Something went wrong. Please try again.';
                    $this->view('manager/adduser', $data);

                    // Log the error (you might want to implement a logging mechanism)
                    //error_log('Error adding user: Something went wrong.');
                }
            } else {
                // Validation failed, show the form with errors
                $this->view('manager/adduser', $data);
            }
        } else {
            // Initial load of the page, show the form without errors
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
            // ... (existing code)
            if (isset($_FILES['imagePath']) && $_FILES['imagePath']['error'] === UPLOAD_ERR_OK) {
                // Handle image upload and get the image path
                $imagePath = $this->handleImageUploadprofilepicture($_FILES['imagePath']);
                if ($imagePath === false) {
                    // Handle image upload error
                    // Redirect or show an error message
                    die('Error: Image upload failed.');
                }
            } else {
                // Handle no image uploaded or upload error
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
                // Check if email is already taken as a staff member
                if ($this->managerModel->findEmployeeByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already taken as a staff member';
                } else {
                    // Verify email using Hunter API
                    if (!$this->managerModel->emailcheck($data['email'])) {
                        //$data['email_err'] = 'Email address is not deliverable';

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
                // check email
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
                // Convert DOB to DateTime object
                $dobDateTime = new DateTime($data['dob']);

                // Calculate age by finding the difference between current date and DOB
                $currentDateTime = new DateTime();
                $age = $currentDateTime->diff($dobDateTime)->y;

                // Check if the person is at least 18+4 years old
                if ($age < 18) {
                    $data['dob_err'] = 'User must be at least 18 years old.';
                }
            }
            if (empty($data['password_err']) && empty($data['role_err']) && empty($data['email_err']) && empty($data['mobile_number_err']) && empty($data['nic_err']) && empty($data['dob_err'])) {
                // Call the model function to insert user data
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $userData = [
                    'user_id' => $ID,
                    'name' => $data['name'],
                    'password' => $data['password'],
                    'role' => $data['role'], // This is the role ID, not the role name
                    'address' => $data['address'],
                    'email' => $data['email'],
                    'joined_date' => $data['joined_date'],
                    'nic' => $data['nic'],
                    'mobile_number' => $data['mobile_number'],
                    'dob' => $data['dob'],
                    'imagePath' => $imagePath,
                ];
                //var_dump($userData);
                // Insert the user and retrieve the user_id
                // $userId =$ID;

                if ($this->managerModel->promotecustomer($userData)) {
                    // Generate password reset token
                    $token = $this->managerModel->generatePasswordResetToken($data['email']);

                    // Send password reset email
                    $this->sendPasswordResetEmail($data['email'], $token);
                    //var_dump($userData);
                    //var_dump($token);
                    // Handle success, e.g., redirect to another page
                    //redirect('managers/Index');
                    //exit();
                } else {
                    // Validation failed, show the form with errors
                    $data['error_message'] = 'Something went wrong. Please try again.';
                    $this->view('manager/adduser', $data);

                    // Log the error (you might want to implement a logging mechanism)
                    //error_log('Error adding user: Something went wrong.');
                }
            } else {
                // Validation failed, show the form with errors
                $this->view('manager/adduser', $data);
            }
        } else {
            // Initial load of the page, show the form without errors
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
            // Get the search term from the request
            $searchTerm = $_POST['search_term'];
            $searchResult = $this->managerModel->searchUsersByEmailOrPhone($searchTerm);
            $data = ['searchResult' => $searchResult];
            $this->view('manager/customerpromote', $data);
            //var_dump($searchResult);
            // Additional logic if needed
        }
        // Additional logic if needed
        $this->view('manager/customerpromote', $data);
        // var_dump($data);
    }

    //var_dump($searchResult);
    // Pass the search result to your view





    public function viewprofile($ID)
    {
        $user = $this->managerModel->viewprofile($ID);
        if (!$user) {
            // Handle the case where the category does not exist
            // For example, you can redirect to an error page or show an error message
            ob_clean();
            $data['message'] = 'No Such User Found';

            $this->redirectpage($data, true, URLROOT . '/managers/getUsers', 10, 'Error', 'User Error');
            //
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
        // Get the role from the query parameter
        $role = isset($_GET['role']) ? $_GET['role'] : null;

        // Call the model method with the retrieved role
        $users = $this->managerModel->filterbyrole($role);
        $nonactiveusers = $this->managerModel->getNonactivatedUsers();
        $data = [
            'users' => $users,
            'nonactiveusers' => $nonactiveusers,
        ];

        // Load the view with the filtered data
        $this->view('manager/users', $data);
    }
    public function searchemployeebyname()
    {
        // Get the search query from the query parameter
        $searchQuery = isset($_GET['searchQuery']) ? $_GET['searchQuery'] : null;

        // Call the model method with the retrieved search query
        $users = $this->managerModel->searchemployeebyname($searchQuery);
        $nonactiveusers = $this->managerModel->getNonactivatedUsers();
        $data = [
            'users' => $users,
            'nonactiveusers' => $nonactiveusers,
        ];
        // Load the view with the filtered data
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
                // Call the model function to insert user data
                if ($this->managerModel->updateuserrole($data)) {
                    // Handle success, e.g., redirect to another page
                    // header('Location: ' . URLROOT . '/menus/submitMenu');
                    redirect('managers/viewprofile/' . $ID . '');
                    exit();
                } else {
                    $this->view('manager/updateuserrole', $data);
                    die('Something went wrong');
                }
            } else {
                // Validation failed, show the form with errors
                $this->view('manager/updateuserrole', $data);
            }
        } else {
            // Initial load of the page, show the form without errors
            $data = [
                'role' => '',
                'role_err' => '',
            ];
            $this->view('manager/updateuserrole', $data);
        }
    }





    private function sendPasswordResetEmail($email, $token)
    {
        // Load PHPMailer library
        // Adjust the paths based on your PHPMailer location

        require_once APPROOT . '/vendor/autoload.php'; // Include Composer autoloader



        // Create a new PHPMailer instance
        $mail = new PHPMailer\PHPMailer\PHPMailer();

        // Set up SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // Your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'pachax001@gmail.com';
        $mail->Password   = 'soqrsqcrcwsmxpyd ';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Set up sender and recipient
        $mail->setFrom('pachax001@gmail.com', 'pachax001');
        $mail->addAddress($email);

        // Set email content
        $mail->isHTML(true);
        $mail->Subject = 'Employee Password Reset';
        $mail->Body    = 'Link is only valid for 1 hour. Click the following link to reset your password: ' . URLROOT . '/users/resetPasswordEmployee/' . $token;

        // Send the email
        if ($mail->send()) {
            // Email sent successfully
            ob_clean();
            $data['message'] = 'Email Sent Successfully';

            $this->redirectpage($data, true, URLROOT . '/managers/getUsers', 10, 'Success', 'Mail Delivered');
            //
            exit();
            //
            //echo 'Email sent successfully.';
            return true;
        } else {
            // Error in sending email
            ob_clean();
            $data['message'] = 'Email could not be sent. Error: ' . $mail->ErrorInfo;

            $this->redirectpage($data, true, URLROOT . '/managers/getUsers', 10, 'Error', 'Mail Error');
            //
            exit();
            //echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
            return false;
        }
    }
    public function manuallyactivateemployee($user_id)
    {
        $email = $this->managerModel->getEmployeeEmail($user_id);
        //var_dump($email);
        if ($this->managerModel->manuallyactivateemployee($user_id)) {
            $this->sendManuallyActivatedEmployee($email);
            //redirect('managers/getUsers');
        }
    }
    private function sendManuallyActivatedEmployee($email)
    {
        // Load PHPMailer library
        // Adjust the paths based on your PHPMailer location

        require_once APPROOT . '/vendor/autoload.php'; // Include Composer autoloader



        // Create a new PHPMailer instance
        $mail = new PHPMailer\PHPMailer\PHPMailer();

        // Set up SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // Your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'pachax001@gmail.com';
        $mail->Password   = 'soqrsqcrcwsmxpyd ';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Set up sender and recipient
        $mail->setFrom('pachax001@gmail.com', 'pachax001');
        $mail->addAddress($email);

        // Set email content
        $mail->isHTML(true);
        $mail->Subject = 'Employee Activation';
        $mail->Body    = 'Manager Has Manually Activated Your Account.Use forgot password to reset your password';

        // Send the email
        if ($mail->send()) {
            // Email sent successfully
            ob_clean();
            $data['message'] = 'Email Sent Successfully';

            $this->redirectpage($data, true, URLROOT . '/managers/getUsers', 10, 'Success', 'Mail Delivered');
            //
            exit();

            return true;
        } else {
            // Error in sending email

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
    
        // Replace spaces with underscores in the file name
        $imageName = str_replace(' ', '_', $imageFile['name']);
    
        // Check if the file is an image
        $check = getimagesize($imageFile['tmp_name']);
        if ($check === false) {
            die('Error: Uploaded file is not an image.');
        }
    
        // Generate a random number
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
    private function handlimageUploadpackagepicture($imageFile)
{
    $targetDirectory = 'C:\\wamp64\\www\\DineEase-DEE\\public\\uploads\\package\\';

    // Create the target directory if it doesn't exist
    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }

    // Replace spaces with underscores in the file name
    $imageName = str_replace(' ', '_', $imageFile['name']);

    // Check if the file is an image
    $check = getimagesize($imageFile['tmp_name']);
    if ($check === false) {
        die('Error: Uploaded file is not an image.');
    }

    // Generate a random number
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
            }
            else {
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
    public function dashboard(){
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
// public function reports($data = []){
//     $minmaxpaymentdate = $this->managerModel->minmaxpaymentdate();
    
//     $data = [
//         'minmaxpaymentdate' => $minmaxpaymentdate,
//     ];
//     $this->view('manager/reports', $data);
// }
public function reports(){
    ob_start();
    $minmaxpaymentdate = $this->managerModel->minmaxpaymentdate();
    $data = [
        'minmaxpaymentdate' => $minmaxpaymentdate,
    ];
    $this->view('manager/reports', $data);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
            'start_date' => isset($_POST['start_date']) ? trim($_POST['start_date']) : '',
            'end_date' => isset($_POST['end_date']) ? trim($_POST['end_date']) : '',
            'start_date_err' => '',
            'end_date_err' => '',
            'minmaxpaymentdate' => $minmaxpaymentdate,
        ];
        var_dump($data);
        error_log('Data passed to model: ' . print_r($data, true));
        //var_dump($data['end_date']);
        if (empty($data['start_date'])) {
            $data['start_date_err'] = 'Please enter start date';
        }
        if (empty($data['end_date'])) {
            $data['end_date_err'] = 'Please enter end date';
        }
        if ($data['start_date'] > $data['end_date']) {
            $data['start_date_err'] = 'Start date must be before end date';
            
        }

        if (empty($data['start_date_err']) && empty($data['end_date_err'])) {
            // Call the model function to insert user data
            $salesreport = $this->managerModel->salesreport($data);
            error_log('Data retrieved from model: ' . print_r($salesreport, true));
           //var_dump($salesreport);
            $data = [
                'salesreport' => $salesreport,
                'minmaxpaymentdate' => $minmaxpaymentdate,
            ];
            //$this->reports($data);
            error_log('$Data retrieved from model: ' . print_r($data, true));
            //ob_clean();
            //ob_end_flush();
            $this->view('manager/reports', $data);
            //ob_clean();
            //ob_end_flush();
            exit();
        } else {
            // Validation failed, show the form with errors
            
            $this->view('manager/reports', $data);
            //$this->reports($data);
        }
    }
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
public function deletetable(){
    //try to delete table. If cannot show an alert saying there are orders on the table
    ob_start();
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $ID = isset($_POST['table_id']) ? trim($_POST['table_id']) : '';
    if ($this->managerModel->deletetable($ID)) {
        ob_clean();
        ob_end_flush();
        redirect('managers/viewtables'); 
        exit();
    }
    else{
        ob_clean();
        ob_end_flush();
        echo "<script>alert('There are reservations for this table in the upcoming future. Please try hiding it.');</script>";
       
        echo "<script>window.location.href = '".URLROOT."/managers/viewtables';</script>";
        exit();
    }
    


}
public function tablevisibility(){
    ob_start();
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $ID = isset($_POST['tableID']) ? trim($_POST['tableID']) : '';
    $status = isset($_POST['visibility']) ? trim($_POST['visibility']) : '';
    if ($this->managerModel->tablevisibility($ID,$status)) {
        //ob_clean();
        //ob_end_flush();
        //redirect('managers/viewtables'); 
        exit();
    }

}
}