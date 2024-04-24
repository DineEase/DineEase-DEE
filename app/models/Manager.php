<?php
class Manager
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getUsers()
    {
        $this->db->query('SELECT users.user_id, users.name, users.email, users.mobile_no, users.profile_picture, employee.address, role.role_name
                         FROM employee
                         JOIN users ON employee.user_id = users.user_id
                         JOIN role ON employee.role_id = role.role_id
                         WHERE role.role_name != "manager" AND employee.delete_status = 0 ANd employee.active = 1');

        $result = $this->db->resultset(PDO::FETCH_ASSOC);

        return $result;
    }
    public function getNonactivatedUsers()
    {
        $this->db->query('SELECT users.user_id, users.name, users.email, users.mobile_no, users.profile_picture, employee.address, role.role_name
                         FROM employee
                         JOIN users ON employee.user_id = users.user_id
                         JOIN role ON employee.role_id = role.role_id
                         WHERE role.role_name != "manager" AND employee.delete_status = 0 ANd employee.active = 0');

        $result = $this->db->resultset(PDO::FETCH_ASSOC);

        return $result;
    }



    public function viewprofile($ID)
    {
        $this->db->query('SELECT users.user_id, users.name, users.email, users.mobile_no, users.profile_picture, employee.address, employee.nic, role.role_name, role.role_id
                     FROM employee
                     JOIN users ON employee.user_id = users.user_id
                     JOIN role ON employee.role_id = role.role_id
                     WHERE users.user_id = :ID AND employee.delete_status = 0 AND employee.active = 1');
        $this->db->bind(':ID', $ID);
        $results = $this->db->resultSet();

        // Assuming you expect only one user for a given ID, return the first result
        return (!empty($results)) ? $results[0] : null;
    }
    public function viewManagerProfile()
    {
        $this->db->query('SELECT users.user_id, users.name, users.email, users.dob, users.mobile_no, users.profile_picture, employee.address, employee.nic, role.role_name, role.role_id
                     FROM employee
                     JOIN users ON employee.user_id = users.user_id
                     JOIN role ON employee.role_id = role.role_id
                     WHERE employee.role_id = 1');

        $results = $this->db->resultSet();

        // Assuming you expect only one manager with role ID 1, return the first result
        return (!empty($results)) ? $results[0] : null;
    }






    public function addUsers($data)
    {
        $filename = basename($data['imagePath']);
        $imagePath = 'http://localhost/DineEase-DEE/public/uploads/profile' . $filename;
        $this->db->query('INSERT INTO users (name, email, password, mobile_no, dob, profile_picture, active) VALUES (:name, :email, :password, :mobile_number, :dob, :imagePath, 1)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':mobile_number', $data['mobile_number']);
        $this->db->bind(':dob', $data['dob']);
        $this->db->bind(':imagePath', $imagePath);

        if ($this->db->execute()) {
            // Get the last inserted user ID
            $userId = $this->db->lastInsertId();

            // Insert the role using the obtained user ID
            $this->db->query('INSERT INTO employee (user_id, role_id, address, nic, active, delete_status) VALUES (:user_id, :role, :address, :nic, 0, 0)');
            $this->db->bind(':user_id', $userId);
            $this->db->bind(':role', $data['role']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':nic', $data['nic']);

            return $this->db->execute();
        }

        return false;
    }
    public function getMenuitem()
    {
        $this->db->query('SELECT menuitem.*, menucategory.category_name 
                      FROM menuitem
                      LEFT JOIN menucategory ON menuitem.category_ID = menucategory.category_ID
                      WHERE menuitem.delete_status = 0');
        $results = $this->db->resultSet();
        return $results;
    }

    public function findMenuitemByID($id)
    {
        $this->db->query('SELECT * FROM menuitem WHERE itemID = :id AND delete_status = 0');
        //bind value
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        //check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function findMenuitemByName($name)
    {
        $this->db->query('SELECT * FROM menuitem WHERE itemName = :name AND delete_status = 0');
        //bind value
        $this->db->bind(':name', $name);
        $row = $this->db->single();
        //check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function submitMenuitem($data)
    {
        $filename = basename($data['imagePath']);
        $imagePath = 'http://localhost/DineEase-DEE/public/uploads/' . $filename;
        $this->db->query('INSERT INTO menuitem (itemName, price, averageTime, hidden, imagePath, category_ID, description) VALUES (:itemName, :price, :averageTime, :hidden, :imagePath, :categoryID, :description)');
        $this->db->bind(':itemName', $data['itemName']);
        $this->db->bind(':price', $data['priceregular']);
        $this->db->bind(':averageTime', $data['averageTime']);
        $this->db->bind(':hidden', 0);
        $this->db->bind(':imagePath', $imagePath);
        // Use isset to ensure the key is present in $data
        $this->db->bind(':categoryID', isset($data['category_ID']) ? $data['category_ID'] : null);
        $this->db->bind(':description', $data['description']);

        // Execute

        if ($this->db->execute()) {
            $menuitemID = $this->db->lastInsertId();
            $this->db->query('INSERT INTO menuprices (itemID, itemSize, itemPrice) VALUES (:itemID, :itemSize, :itemPrice)');
            $this->db->bind(':itemID', $menuitemID);
            $this->db->bind(':itemSize', 'Small');
            $this->db->bind(':itemPrice', $data['pricesmall']);
            $this->db->execute();
            $this->db->bind(':itemID', $menuitemID);
            $this->db->bind(':itemSize', 'Regular');
            $this->db->bind(':itemPrice', $data['priceregular']);
            $this->db->execute();
            $this->db->bind(':itemID', $menuitemID);
            $this->db->bind(':itemSize', 'Large');
            $this->db->bind(':itemPrice', $data['pricelarge']);
            $this->db->execute();

            return true;
        } else {
            return false;
        }
    }
    public function promotecustomer($data)
    {
        // Check if the user ID is provided for the update
        if (isset($data['user_id'])) {
            // Perform an update
            $this->db->query('UPDATE users SET name = :name, email = :email, password = :password, mobile_no = :mobile_number, dob = :dob, profile_picture = :imagePath WHERE user_id = :user_id');
            $this->db->bind(':user_id', $data['user_id']);
        } else {
            // If it's an insert, bind a placeholder for user_id
            $this->db->bind(':user_id', null, PDO::PARAM_INT);
        }

        // Common bindings for both update and insert
        $filename = basename($data['imagePath']);
        $imagePath = 'http://localhost/DineEase-DEE/public/uploads/profile' . $filename;
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':mobile_number', $data['mobile_number']);
        $this->db->bind(':dob', $data['dob']);
        $this->db->bind(':imagePath', $imagePath);

        // Execute the query
        // Execute the query
        if ($this->db->execute()) {
            // Get the last inserted or updated user ID
            $userId = isset($data['user_id']) ? $data['user_id'] : $this->db->lastInsertId();

            // Insert into the employee table using the obtained user ID
            $this->db->query('INSERT INTO employee (user_id, role_id, address, nic, delete_status, active) VALUES (:user_id, :role, :address, :nic, 0, 0)');
            $this->db->bind(':user_id', $userId);  // Use the obtained user ID here
            $this->db->bind(':role', $data['role']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':nic', $data['nic']);

            return $this->db->execute();
        }

        return false;
    }



    public function hideMenuitem($itemID)
    {

        $this->db->query('UPDATE menuitem SET hidden = 0 WHERE itemID = :itemID');
        $this->db->bind(':itemID', $itemID);


        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function showMenuitem($itemID)
    {

        $this->db->query('UPDATE menuitem SET hidden = 1 WHERE itemID = :itemID');
        $this->db->bind(':itemID', $itemID);


        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function editMenuitem($data)
    {
        $filename = basename($data['imagePath']);
        $imagePath = 'http://localhost/DineEase-DEE/public/uploads/' . $filename;

        $this->db->query('UPDATE menuitem SET itemName = :itemName, price = :price, averageTime = :averageTime, imagePath = :imagePath, category_ID = :categoryID, description = :description WHERE itemID = :itemID');
        $this->db->bind(':itemID', $data['itemID']);
        $this->db->bind(':itemName', $data['itemName']);
        $this->db->bind(':price', $data['pricesmall']);
        $this->db->bind(':averageTime', $data['averageTime']);
        $this->db->bind(':imagePath', $imagePath);
        $this->db->bind(':categoryID', isset($data['category_ID']) ? $data['category_ID'] : null);
        $this->db->bind(':description', $data['description']);

        //execute
        if ($this->db->execute()) {
            $this->db->query('UPDATE menuprices SET itemPrice = :itemPrice WHERE itemID = :itemID AND itemSize = :itemSize');
            $this->db->bind(':itemID', $data['itemID']);
            $this->db->bind(':itemSize', 'Small');
            $this->db->bind(':itemPrice', $data['pricesmall']);
            $this->db->execute();
            $this->db->bind(':itemID', $data['itemID']);
            $this->db->bind(':itemSize', 'Regular');
            $this->db->bind(':itemPrice', $data['priceregular']);
            $this->db->execute();
            $this->db->bind(':itemID', $data['itemID']);
            $this->db->bind(':itemSize', 'Large');
            $this->db->bind(':itemPrice', $data['pricelarge']);
            $this->db->execute();
            return true;
        } else {
            return false;
        }
    }
    // public function deleteMenuitem($itemID)
    // {
    //     $this->db->query('UPDATE menuitem SET delete_status = 1 WHERE itemID = :itemID');
    //     $this->db->bind(':itemID', $itemID);

    //     // Execute the query
    //     if ($this->db->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    public function deletemenuitem($itemID)
    {
        //reservation table has orderID and same orderID is in orderitem table as orderNo
        // try to delete menuitem if there is no order from current date to upcoming dates from menuitem table
        $this->db->query('SELECT * FROM orderitem WHERE itemID = :itemID AND orderNo IN (SELECT orderID FROM reservation WHERE date >= CURDATE())');
        $this->db->bind(':itemID', $itemID);
        $this->db->execute();
        $results = $this->db->resultSet();
        if (empty($results)) {
            $this->db->query('UPDATE menuitem SET delete_status = 1 WHERE itemID = :itemID');
            $this->db->bind(':itemID', $itemID);
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function getMenuitembyId($id)
    {
        $this->db->query('SELECT m.*, 
                                mp.itemSize,
                                mp.itemPrice
                          FROM menuitem m
                          LEFT JOIN menuprices mp ON m.itemID = mp.itemID
                          WHERE m.itemID = :id ');
        $this->db->bind(':id', $id);
        $rows = $this->db->resultSet();

        // Debugging statements


        return $rows;
    }
    public function getmenuitemtablebyid($id)
    {
        $this->db->query(('SELECT * FROM menuitem WHERE itemID = :id'));
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }

    public function getmenudetails($id)
    {
        $this->db->query('SELECT menuitem.*, 
                            menucategory.category_name, 
                            GROUP_CONCAT(DISTINCT menuprices.itemSize) AS sizes, 
                            GROUP_CONCAT(DISTINCT menuprices.itemPrice) AS prices
                      FROM menuitem
                      LEFT JOIN menucategory ON menuitem.category_ID = menucategory.category_ID
                      LEFT JOIN menuprices ON menuitem.itemID = menuprices.itemID
                      WHERE menuitem.itemID = :id AND menuitem.delete_status = 0');
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;
    }





    public function findEmployeeByEmail($email)
    {
        // Check if the user_id exists in both tables
        $this->db->query('SELECT u.user_id FROM users u
                      INNER JOIN employee e ON u.user_id = e.user_id
                      WHERE u.email = :email 
                        AND e.delete_status = 0
                        AND e.active = 1');

        // Bind value
        $this->db->bind(':email', $email);
        $userRow = $this->db->single();

        // Check if the user_id exists in both tables
        if ($userRow) {
            return true;
        } else {
            return false;
        }
    }


    public function findEmployeeByMobile($mobile_no)
    {
        // Check if the user_id exists in both tables
        $this->db->query('SELECT u.user_id FROM users u
                          INNER JOIN employee e ON u.user_id = e.user_id
                          WHERE u.mobile_no = :mobile_no 
                            AND e.delete_status = 0
                            AND e.active = 1');

        // Bind value
        $this->db->bind(':mobile_no', $mobile_no);
        $userRow = $this->db->single();

        // Check if the user_id exists in both tables
        if ($userRow) {
            return true;
        } else {
            return false;
        }
    }
    // Assuming you have a class method to execute queries, you might have something like this in your model

    public function searchUsersByEmailOrPhone($searchTerm)
    {
        // Use a prepared statement to prevent SQL injection
        $this->db->query('SELECT * FROM users WHERE email = :searchTerm OR mobile_no = :searchTerm');
        // Bind values
        $this->db->bind(':searchTerm', $searchTerm);

        // Execute the query
        $results = $this->db->single();

        return $results;
    }


    public function deleteprofile($user_id)
    {
        $this->db->query('UPDATE employee SET delete_status = 1 WHERE user_id = :user_id AND role_id != 1');
        $this->db->bind(':user_id', $user_id);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function filterbyrole($role)
    {
        $this->db->query('SELECT users.user_id, users.name, users.email, users.mobile_no, users.profile_picture, employee.address, role.role_name
                         FROM employee
                         JOIN users ON employee.user_id = users.user_id
                         JOIN role ON employee.role_id = role.role_id
                         WHERE role.role_name = :role AND role.role_name != \'Manager\' AND employee.delete_status = 0');
        $this->db->bind(':role', $role);
        $result = $this->db->resultset(PDO::FETCH_ASSOC);

        return $result;
    }
    public function searchemployeebyname($name)
    {
        $this->db->query('SELECT users.user_id, users.name, users.email, users.mobile_no, users.profile_picture, employee.address, role.role_name
                         FROM employee
                         JOIN users ON employee.user_id = users.user_id
                         JOIN role ON employee.role_id = role.role_id
                         WHERE users.name LIKE :name AND employee.delete_status = 0 AND employee.role_id != 1 AND employee.active = 1');
        $this->db->bind(':name', '%' . $name . '%');
        $result = $this->db->resultset(PDO::FETCH_ASSOC);

        return $result;
    }
    public function searchmenubyname($name)
    {
        $this->db->query('SELECT menuitem.*, menucategory.category_name 
                          FROM menuitem
                          LEFT JOIN menucategory ON menuitem.category_ID = menucategory.category_ID
                          WHERE menuitem.itemName LIKE :name AND menuitem.delete_status = 0');

        $this->db->bind(':name', '%' . $name . '%');
        $results = $this->db->resultSet();

        return $results;
    }

    public function updateuserrole($role)
    {
        $this->db->query('UPDATE employee SET role_id = :role WHERE user_id = :user_id');
        $this->db->bind(':role', $role['role']);
        $this->db->bind(':user_id', $role['user_id']);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function addmenucategory($data)
    {
        $this->db->query('INSERT INTO menucategory (category_name) VALUES (:category_name)');
        $this->db->bind(':category_name', $data['category_name']);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getmenucategory()
    {
        $this->db->query('SELECT * FROM menucategory ORDER BY category_name ASC ');

        $results = $this->db->resultset();
        return $results;
    }

    public function findcategorybyname($category_name)
    {
        $this->db->query('SELECT * FROM menucategory WHERE category_name = :category_name');
        //bind value
        $this->db->bind(':category_name', $category_name);
        $row = $this->db->single();
        //check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function filtermenubycategory($categoryFilter = null)
    {
        $this->db->query('SELECT menuitem.*, menucategory.category_name 
                          FROM menuitem
                          LEFT JOIN menucategory ON menuitem.category_ID = menucategory.category_ID
                          WHERE menuitem.delete_status = 0' . ($categoryFilter !== null ? ' AND menucategory.category_ID = :categoryFilter' : ''));

        if ($categoryFilter !== null) {
            $this->db->bind(':categoryFilter', $categoryFilter);
        }

        $this->db->execute();
        $results = $this->db->resultSet();

        return $results;
    }


    public function generatePasswordResetToken($email)
    {
        $token = bin2hex(random_bytes(32));
        $expiration = time() + 3600; // Set expiration time to 1 hour from now

        $this->db->query('INSERT INTO password_reset_tokens (email, token, expiration) VALUES (:email, :token, :expiration)');
        $this->db->bind(':email', $email);
        $this->db->bind(':token', $token);
        $this->db->bind(':expiration', $expiration);

        return $this->db->execute() ? $token : false;
    }
    public function manuallyactivateemployee($user_ID)
    {
        $this->db->query('UPDATE employee SET active = 1 WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_ID);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getEmployeeEmail($user_ID)
    {
        $this->db->query('SELECT email FROM users WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_ID);
        $row = $this->db->single();

        // Check if the row exists and has the 'email' property
        if ($row && isset($row->email)) {
            return $row->email;
        } else {
            return null; // Or handle the case where email is not found
        }
    }
    public function editmenucategory($ID, $category_name)
    {
        $this->db->query('UPDATE menucategory SET category_name = :category_name WHERE category_ID = :category_ID');
        $this->db->bind(':category_ID', $ID);
        $this->db->bind(':category_name', $category_name);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getcategorybyID($ID)
    {
        $this->db->query('SELECT * FROM menucategory WHERE category_ID = :ID');
        $this->db->bind(':ID', $ID);
        $row = $this->db->single();
        return $row;
    }
    public function updatecategorytime($data)
    {
        $this->db->query('UPDATE menucategory SET start_time = :start_time, end_time = :end_time WHERE category_ID = :category_ID');
        $this->db->bind(':category_ID', $data['category_ID']);
        $this->db->bind(':start_time', $data['start_time']);
        $this->db->bind(':end_time', $data['end_time']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function hidecategory($data)
    {
        $this->db->query('UPDATE menucategory SET hidden_status = 1 WHERE category_ID = :category_ID');
        $this->db->bind(':category_ID', $data['category_ID']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function showcategory($data)
    {
        $this->db->query('UPDATE menucategory SET hidden_status = 0 WHERE category_ID = :category_ID');
        $this->db->bind(':category_ID', $data['category_ID']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function emailcheck($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function getpackages()
    {
        $this->db->query('SELECT * FROM package');
        $results = $this->db->resultSet();
        return $results;
    }
    public function getpackagebyid($packageID)
    {
        $this->db->query('SELECT * FROM package WHERE packageID = :packageID');
        $this->db->bind(':packageID', $packageID);
        $row = $this->db->single();
        return $row;
    }
    public function gettables()
    {
        $this->db->query('SELECT * FROM tables');
        $results = $this->db->resultSet();
        return $results;
    }
    public function addtable($data)
    {
        // Extracting the first three letters of the package name
        $tablename_prefix = substr($_POST['packageName'], 0, 3);

        // Inserting into the database
        $this->db->query('INSERT INTO tables (capacity, packageID) VALUES (:capacity, :packageID)');

        // Binding parameters for insertion
        $this->db->bind(':capacity', $data['capacity']);
        $this->db->bind(':packageID', $data['packageID']);

        // Executing the insertion query
        if ($this->db->execute()) {
            // Get the last inserted table ID
            $lastTableID = $this->db->lastInsertId();

            // Calculate the total capacity for the given package ID
            $this->db->query('SELECT SUM(capacity) AS total_capacity FROM tables WHERE packageID = :packageID');
            $this->db->bind(':packageID', $data['packageID']);
            $row = $this->db->single();
            $total_capacity = $row->total_capacity;

            // Update the 'capacity' column in the 'package' table with the total capacity obtained
            $this->db->query('UPDATE package SET capacity = :total_capacity WHERE packageID = :packageID');
            $this->db->bind(':total_capacity', $total_capacity);
            $this->db->bind(':packageID', $data['packageID']);
            $this->db->execute();

            // Generating a unique table name by appending the auto-generated table ID
            $tablename = $tablename_prefix . '_' . $lastTableID;

            // Updating the table name with the generated name
            $this->db->query('UPDATE tables SET table_name = :tablename WHERE tableID = :tableID');
            $this->db->bind(':tablename', $tablename);
            $this->db->bind(':tableID', $lastTableID);
            $this->db->execute();

            // Return true if insertion, capacity update, and table name update are successful
            return true;
        } else {
            // Return false if insertion fails
            return false;
        }
    }
    public function tabledetailswithpackage()
    {
        $this->db->query('SELECT tables.table_name,tables.tableID, tables.capacity,tables.hidden, package.packageName
                      FROM tables
                      JOIN package ON tables.packageID = package.packageID');
        $results = $this->db->resultSet();
        return $results;
    }
    public function deletetable($tableID)
    {
        // delete table only if there is no reservation from current date to upcomig dates
        $this->db->query('SELECT * FROM reservation WHERE tableID = :tableID AND date >= CURDATE()');
        $this->db->bind(':tableID', $tableID);
        $this->db->execute();
        $results = $this->db->resultSet();
        if (empty($results)) {
            $this->db->query('DELETE FROM tables WHERE tableID = :tableID');
            $this->db->bind(':tableID', $tableID);
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function tablevisibility($tableID, $hidden)
    {
        $this->db->query('UPDATE tables SET hidden = :hidden WHERE tableID = :tableID');
        $this->db->bind(':tableID', $tableID);
        $this->db->bind(':hidden', $hidden);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }



    public function editpackage($data)
    {
        $filename = basename($data['imagePath']);
        $imagePath = 'http://localhost/DineEase-DEE/public/uploads/package' . $filename;

        $this->db->query('UPDATE package SET packageName = :packageName, tax = :tax, description = :description, image =:image WHERE packageID = :packageID');
        $this->db->bind(':packageName', $data['packageName']);
        $this->db->bind(':tax', $data['tax']);
        //$this->db->bind(':capacity', $data['capacity']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':packageID', $data['packageID']);
        $this->db->bind(':image', $imagePath);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function filtertablesbypackage($packageID)
    {
        //need to get packagename from package table
        $this->db->query('SELECT tables.*, package.packageName
                          FROM tables
                          JOIN package ON tables.packageID = package.packageID
                          WHERE tables.packageID = :packageID');
        $this->db->bind(':packageID', $packageID);
        $this->db->execute();
        $results = $this->db->resultSet();
        return $results;
    }

    public function addmenudiscounts($data)
    {

        $this->db->query('INSERT INTO discounts (type, category_menu_id, discount_percentage,start_date, end_date) VALUES (:type, :category_menu_id, :discount_percentage, :start_date, :end_date)');
        $this->db->bind(':type', 'menu');
        $this->db->bind(':category_menu_id', $data['menu_ID']);
        $this->db->bind(':discount_percentage', $data['discount']);
        $this->db->bind(':start_date', $data['menu_start_date']);
        $this->db->bind(':end_date', $data['menu_end_date']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getdiscountedmenus()
    {
        $this->db->query('SELECT discounts.*, menuitem.itemName 
                      FROM discounts
                      JOIN menuitem ON discounts.category_menu_id = menuitem.itemID
                      WHERE discounts.type = "menu"');
        $results = $this->db->resultSet();
        return $results;
    }
    public function getdiscountedcategories()
    {
        $this->db->query('SELECT discounts.*, menucategory.category_name 
                      FROM discounts
                      JOIN menucategory ON discounts.category_menu_id = menucategory.category_ID
                      WHERE discounts.type = "category"');
        $results = $this->db->resultSet();
        return $results;
    }
    public function gettotaldiscount()
    {
        $this->db->query('SELECT * FROM discounts WHERE type = "total"');
        $results = $this->db->resultSet();
        return $results;
    }
    public function addcategorydiscounts($data)
    {

        $this->db->query('INSERT INTO discounts (type, category_menu_id, discount_percentage,start_date, end_date) VALUES (:type, :category_menu_id, :discount_percentage, :start_date, :end_date)');
        $this->db->bind(':type', 'category');
        $this->db->bind(':category_menu_id', $data['category_ID']);
        $this->db->bind(':discount_percentage', $data['discount']);
        $this->db->bind(':start_date', $data['menu_start_date']);
        $this->db->bind(':end_date', $data['menu_end_date']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function addtotaldiscount($data)
    {
        $this->db->query('INSERT INTO discounts (type, discount_percentage,start_date, end_date) VALUES (:type, :discount_percentage, :start_date, :end_date)');
        $this->db->bind(':type', 'total');
        $this->db->bind(':discount_percentage', $data['discount']);
        $this->db->bind(':start_date', $data['menu_start_date']);
        $this->db->bind(':end_date', $data['menu_end_date']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updatemenudiscounts($data)
    {
        #use type menu
        $this->db->query('UPDATE discounts SET discount_percentage = :discount_percentage, start_date = :start_date, end_date = :end_date WHERE type = "menu" AND category_menu_id = :category_menu_id');
        $this->db->bind(':category_menu_id', $data['category_menu_id']);
        $this->db->bind(':discount_percentage', $data['discount']);
        $this->db->bind(':start_date', $data['menu_start_date']);
        $this->db->bind(':end_date', $data['menu_end_date']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updatecategorydiscounts($data)
    {
        #use type category
        $this->db->query('UPDATE discounts SET discount_percentage = :discount_percentage, start_date = :start_date, end_date = :end_date WHERE type = "category" AND category_menu_id = :category_menu_id');
        $this->db->bind(':category_menu_id', $data['category_menu_id']);
        $this->db->bind(':discount_percentage', $data['discount']);
        $this->db->bind(':start_date', $data['menu_start_date']);
        $this->db->bind(':end_date', $data['menu_end_date']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getdiscountedmenubyid($id)
    {
        #use categeroy_menu_id to get the discount and menuname
        $this->db->query('SELECT discounts.*, menuitem.itemName 
                      FROM discounts
                      JOIN menuitem ON discounts.category_menu_id = menuitem.itemID
                      WHERE discounts.type = "menu" AND discounts.category_menu_id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }
    public function getdiscountedcategorybyid($id)
    {
        #use categeroy_menu_id to get the discount and menuname
        $this->db->query('SELECT discounts.*, menucategory.category_name 
                      FROM discounts
                      JOIN menucategory ON discounts.category_menu_id = menucategory.category_ID
                      WHERE discounts.type = "category" AND discounts.category_menu_id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }
    public function deletediscount($id)
    {
        $this->db->query('DELETE FROM discounts WHERE id = :id');
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function checktotaldiscount()
    {
        // function retrieve total type from discounts table
        $this->db->query('SELECT * FROM discounts WHERE type = "total"');
        $row = $this->db->single();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function gettotaldiscountdetails()
    {
        $this->db->query('SELECT * FROM discounts WHERE type = "total"');
        $row = $this->db->single();
        return $row;
    }
    public function updatetotaldiscount($data)
    {
        $this->db->query('UPDATE discounts SET discount_percentage = :discount_percentage, start_date = :start_date, end_date = :end_date WHERE type = "total"');
        $this->db->bind(':discount_percentage', $data['discount']);
        $this->db->bind(':start_date', $data['menu_start_date']);
        $this->db->bind(':end_date', $data['menu_end_date']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function totalsales()
    {
        $this->db->query('SELECT SUM(amount) FROM payment');
        $row = $this->db->single();
        return $row;
    }
    public function totalorders()
    {
        $this->db->query('SELECT COUNT(orderItemID) FROM orders');
        $row = $this->db->single();
        return $row;
    }
    public function totalcustomers()
    {

        $this->db->query('SELECT COUNT(user_id) FROM users WHERE delete_status = 0');
        $row = $this->db->single();
        return $row;
    }
    public function totalmenuitems()
    {
        $this->db->query('SELECT COUNT(itemID) FROM menuitem');
        $row = $this->db->single();
        return $row;
    }
    public function bestsellingmenuitem()
    {
        $this->db->query('SELECT menuitem.itemName,menuitem.imagePath, SUM(orderitem.quantity) AS total_quantity
                      FROM menuitem
                      JOIN orderitem ON menuitem.itemID = orderitem.itemID
                      GROUP BY menuitem.itemID
                      ORDER BY total_quantity DESC
                      LIMIT 1');
        $row = $this->db->single();
        return $row;
    }
    public function top5bestsellinmenuitems()
    {
        $this->db->query('SELECT menuitem.itemName, SUM(orderitem.quantity) AS total_quantity
                      FROM menuitem
                      JOIN orderitem ON menuitem.itemID = orderitem.itemID
                      GROUP BY menuitem.itemID
                      ORDER BY total_quantity DESC
                      LIMIT 5');
        $results = $this->db->resultSet();
        return $results;
    }
    public function mostusedpackage()
    {
        $this->db->query('SELECT package.packageName, COUNT(reservation.packageID) AS total_usage
                      FROM package
                      LEFT JOIN reservation ON package.packageID = reservation.packageID
                      GROUP BY package.packageID
                      ORDER BY total_usage DESC
                      LIMIT 1');
        $row = $this->db->single();
        return $row;
    }
    public function gettotalpackageusage()
    {
        //use reservation table and package table to get the count of each package usage in reservation
        $this->db->query('SELECT package.packageID, package.packageName, COUNT(reservation.packageID) AS total_usage
                      FROM package
                      LEFT JOIN reservation ON package.packageID = reservation.packageID
                      GROUP BY package.packageID');
        $results = $this->db->resultSet();
        return $results;
    }
    public function top5customers()
    {
        $this->db->query('SELECT users.name, COUNT(reservation.customerID) AS total_reservations
                      FROM users
                      LEFT JOIN reservation ON users.user_id = reservation.customerID
                      GROUP BY users.user_id
                      ORDER BY total_reservations DESC
                      LIMIT 5');
        $results = $this->db->resultSet();
        return $results;
    }
    public function bestreviewedfood()
    {
        $this->db->query('SELECT menuitem.itemName, AVG(reviewfood.stars) AS average_rating
                      FROM menuitem
                      LEFT JOIN reviewfood ON menuitem.itemID = reviewfood.reviewfoodID
                      GROUP BY menuitem.itemID
                      ORDER BY average_rating DESC
                      LIMIT 1');
        $row = $this->db->single();
        return $row;
    }
    public function leastreviewedfood()
    {
        $this->db->query('SELECT menuitem.itemName, AVG(reviewfood.stars) AS average_rating
                      FROM menuitem
                      LEFT JOIN reviewfood ON menuitem.itemID = reviewfood.reviewfoodID
                      GROUP BY menuitem.itemID
                      ORDER BY average_rating ASC
                      LIMIT 1');
        $row = $this->db->single();
        return $row;
    }
    public function totalpendingrefundrequests()
    {
        $this->db->query('SELECT COUNT(refundrequest.refundRequestID) FROM refundrequest WHERE status = "Pending"');
        $row = $this->db->single();
        return $row;
    }
    public function minmaxpaymentdate()
    {
        //function to get first and last payment date from payments table
        $this->db->query('SELECT MIN(paymentDate) AS first_payment, MAX(paymentDate) AS last_payment FROM payment');
        $row = $this->db->single();
        return $row;
    }
    public function salesreport($data)
    {
        //function to get sales report between two dates
        $this->db->query('SELECT SUM(amount) FROM payment WHERE DATE(paymentDate) BETWEEN :start_date AND :end_date');
        $this->db->bind(':start_date', $data['start_date']);
        $this->db->bind(':end_date', $data['end_date']);
        $row = $this->db->single();
        return $row;
    }

    // }
    // public function salesreport($data) {




    //        $this->db->query('SELECT SUM(amount) FROM payment WHERE DATE(paymentDate) BETWEEN :start_date AND :end_date');
    //         $this->db->bind(':start_date', $data['start_date']);
    //         $this->db->bind(':end_date', $data['end_date']);
    //         $results = $this->db->resultSet();
    //         return $results;



    // }
    // public function menureport($data){
    //     //function to get menu report between two dates
    //     // There is orderNo in orderitem table and orderID in reservation table
    //     // try to get the sum of quantity of each menu item between two dates

    //     //$this->db->query('SELECT SUM(orderitem.quantity) FROM orderitem WHERE DATE(orderDate) BETWEEN :start_date AND :end_date');
    //     $this->db->query('SELECT 
    //     mc.category_ID,
    //     mc.category_name,
    //     SUM(mp.ItemPrice * oi.quantity) AS total_amount
    // FROM 
    //     reservation r
    // LEFT JOIN 
    //     orders o ON r.reservationID = o.reservationID
    // LEFT JOIN 
    //     orderitem oi ON o.orderItemID = oi.orderNO
    // LEFT JOIN 
    //     menuitem mi ON oi.ItemID = mi.itemID
    // LEFT JOIN 
    //     menucategory mc ON mi.category_ID = mc.category_ID
    // LEFT JOIN 
    //     menuprices mp ON oi.ItemID = mp.ItemID AND oi.size = mp.itemSize
    // WHERE 
    //     r.date BETWEEN :start_date AND :end_date AND r.status = 'paid'

    // GROUP BY 
    //     mc.category_ID, mc.category_name;

    // ');

    //     $this->db->bind(':start_date', $data['start_date']);
    //     $this->db->bind(':end_date', $data['end_date']);
    //     $row = $this->db->resultset();
    //     return $row;
    //     var_dump($row);

    // }
    public function minmaxreservationdate()
    {
        //function to get first and last payment date from payments table
        $this->db->query('SELECT MIN(date) AS first_reservation, MAX(date) AS last_reservation FROM reservation');
        $row = $this->db->single();
        return $row;
    }
    public function menureport($data)
    {
        // get the total quantity sold and total amount for each menu item between two dates
        $this->db->query('SELECT 
        mc.category_ID,
        mc.category_name,
        mi.itemID,
        mi.itemName,
        r.date,
        SUM(oi.quantity) AS total_quantity_sold,
        SUM(mp.ItemPrice * oi.quantity) AS total_amount
    
    FROM 
        reservation r
    LEFT JOIN 
        orders o ON r.reservationID = o.reservationID
    LEFT JOIN 
        orderitem oi ON o.orderItemID = oi.orderNO
    LEFT JOIN 
        menuitem mi ON oi.ItemID = mi.itemID
    LEFT JOIN 
        menucategory mc ON mi.category_ID = mc.category_ID
    LEFT JOIN 
        menuprices mp ON oi.ItemID = mp.ItemID AND oi.size = mp.itemSize
    WHERE 
        r.date BETWEEN :start_date AND :end_date
        AND r.status = "paid"  
    GROUP BY 
        mc.category_ID, mc.category_name, mi.itemID, mi.itemName, r.date
    ORDER BY 
        SUM(oi.quantity) DESC
    ');
    
            $this->db->bind(':start_date', $data['start_date']);
            $this->db->bind(':end_date', $data['end_date']);
            $results = $this->db->resultSet(); // Use resultSet() instead of resultset()
    
    // Top 5 Selling Menus
        $this->db->query('SELECT mi.itemID, mi.itemName, SUM(oi.quantity) AS total_quantity_sold
                          FROM reservation r
                          LEFT JOIN orders o ON r.reservationID = o.reservationID
                          LEFT JOIN orderitem oi ON o.orderItemID = oi.orderNO
                          LEFT JOIN menuitem mi ON oi.ItemID = mi.itemID
                          WHERE r.date BETWEEN :start_date AND :end_date
                          AND r.status = "paid"
                          GROUP BY mi.itemID, mi.itemName
                          ORDER BY SUM(oi.quantity) DESC
                          LIMIT 5');
        $this->db->bind(':start_date', $data['start_date']);
        $this->db->bind(':end_date', $data['end_date']);
        $topSellingMenus = $this->db->resultSet();
    
        // Top 5 Selling Categories
        $this->db->query('SELECT mc.category_ID, mc.category_name, SUM(oi.quantity) AS total_quantity_sold
                          FROM reservation r
                          LEFT JOIN orders o ON r.reservationID = o.reservationID
                          LEFT JOIN orderitem oi ON o.orderItemID = oi.orderNO
                          LEFT JOIN menuitem mi ON oi.ItemID = mi.itemID
                          LEFT JOIN menucategory mc ON mi.category_ID = mc.category_ID
                          WHERE r.date BETWEEN :start_date AND :end_date
                          AND r.status = "paid"
                          GROUP BY mc.category_ID, mc.category_name
                          ORDER BY SUM(oi.quantity) DESC
                          LIMIT 5');
        $this->db->bind(':start_date', $data['start_date']);
        $this->db->bind(':end_date', $data['end_date']);
        $topSellingCategories = $this->db->resultSet();
    
        // Date with Most Reservations
        $this->db->query('SELECT r.date, COUNT(r.reservationID) AS reservation_count
                          FROM reservation r
                          WHERE r.date BETWEEN :start_date AND :end_date
                          AND r.status = "paid"
                          GROUP BY r.date
                          ORDER BY COUNT(r.reservationID) DESC
                          LIMIT 1');
        $this->db->bind(':start_date', $data['start_date']);
        $this->db->bind(':end_date', $data['end_date']);
        $mostReservationsDate = $this->db->single();
    
        // Most Ordered Size from Top 5 Best Selling Menus
        $mostOrderedSizes = [];
        foreach ($topSellingMenus as $menu) {
            $this->db->query('SELECT oi.size, SUM(oi.quantity) AS total_quantity_sold
                              FROM reservation r
                              LEFT JOIN orders o ON r.reservationID = o.reservationID
                              LEFT JOIN orderitem oi ON o.orderItemID = oi.orderNO
                              WHERE oi.itemID = :item_id
                              AND r.date BETWEEN :start_date AND :end_date
                              AND r.status = "paid"
                              GROUP BY oi.size
                              ORDER BY SUM(oi.quantity) DESC
                              LIMIT 1');
           $this->db->bind(':item_id', $menu->itemID);
            $this->db->bind(':start_date', $data['start_date']);
            $this->db->bind(':end_date', $data['end_date']);
            $size = $this->db->single();
            if ($size) {
                $mostOrderedSizes[] = ['itemName' => $menu->itemName, 'size' => $size->size, 'total_quantity_sold' => $size->total_quantity_sold];
            }
        }            
    
        // Return results
        return ['topSellingMenus' => $topSellingMenus,
                'topSellingCategories' => $topSellingCategories,
                'mostReservationsDate' => $mostReservationsDate,
                'mostOrderedSizes' => $mostOrderedSizes,
            'results' => $results];
    }
}    
