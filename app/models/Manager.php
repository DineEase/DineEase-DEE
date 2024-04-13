<?php
class Manager {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getUsers() {
        $this->db->query('SELECT users.user_id, users.name, users.email, users.mobile_no, users.profile_picture, employee.address, role.role_name
                         FROM employee
                         JOIN users ON employee.user_id = users.user_id
                         JOIN role ON employee.role_id = role.role_id
                         WHERE role.role_name != "manager" AND employee.delete_status = 0 ANd employee.active = 1');
        
        $result = $this->db->resultset(PDO::FETCH_ASSOC);
        
        return $result;
    }
    public function getNonactivatedUsers() {
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
                     WHERE users.user_id = :ID');
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
        $this->db->query('INSERT INTO users (name, email, password, mobile_no, dob, profile_picture, active) VALUES (:name, :email, :password, :mobile_number, :dob, :imagePath, 1)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':mobile_number', $data['mobile_number']);
        $this->db->bind(':dob', $data['dob']);
        $this->db->bind(':imagePath', $data['imagePath']);

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
    public function submitMenuitem($data) {
        $filename = basename($data['imagePath']);
        $imagePath = 'http://localhost/DineEase-DEE/public/uploads/' . $filename;
        $this->db->query('INSERT INTO menuitem (itemName, price, averageTime, hidden, imagePath, category_ID, description) VALUES (:itemName, :price, :averageTime, :hidden, :imagePath, :categoryID, :description)');
        $this->db->bind(':itemName', $data['itemName']);
        $this->db->bind(':price', $data['pricesmall']);
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
        
        }
        else {
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
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':password', $data['password']);
    $this->db->bind(':mobile_number', $data['mobile_number']);
    $this->db->bind(':dob', $data['dob']);
    $this->db->bind(':imagePath', $data['imagePath']);

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

    

    public function hideMenuitem($itemID){
    
        $this->db->query('UPDATE menuitem SET hidden = 0 WHERE itemID = :itemID');
        $this->db->bind(':itemID', $itemID);
        

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
    public function showMenuitem($itemID){
    
        $this->db->query('UPDATE menuitem SET hidden = 1 WHERE itemID = :itemID');
        $this->db->bind(':itemID', $itemID);
        

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
    public function editMenuitem($data){
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
    public function deleteMenuitem($itemID){
        $this->db->query('UPDATE menuitem SET delete_status = 1 WHERE itemID = :itemID');
        $this->db->bind(':itemID', $itemID);
    
        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getMenuitembyId($id) {
        $this->db->query('SELECT m.*, 
                                mp.itemSize,
                                mp.itemPrice
                          FROM menuitem m
                          LEFT JOIN menuprices mp ON m.itemID = mp.itemID
                          WHERE m.itemID = :id');
        $this->db->bind(':id', $id);
        $rows = $this->db->resultSet();
        
        // Debugging statements
       
    
        return $rows;
    }
   public function getmenuitemtablebyid($id){
    $this->db->query(('SELECT * FROM menuitem WHERE itemID = :id'));
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
    

    public function deleteprofile($user_id){
        $this->db->query('UPDATE employee SET delete_status = 1 WHERE user_id = :user_id AND role_id != 1');
        $this->db->bind(':user_id', $user_id);
    
        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function filterbyrole($role){
        $this->db->query('SELECT users.user_id, users.name, users.email, users.mobile_no, users.profile_picture, employee.address, role.role_name
                         FROM employee
                         JOIN users ON employee.user_id = users.user_id
                         JOIN role ON employee.role_id = role.role_id
                         WHERE role.role_name = :role AND role.role_name != \'Manager\' AND employee.delete_status = 0');
        $this->db->bind(':role', $role);
        $result = $this->db->resultset(PDO::FETCH_ASSOC);
        
        return $result;
    }
    public function searchemployeebyname($name){
        $this->db->query('SELECT users.user_id, users.name, users.email, users.mobile_no, users.profile_picture, employee.address, role.role_name
                         FROM employee
                         JOIN users ON employee.user_id = users.user_id
                         JOIN role ON employee.role_id = role.role_id
                         WHERE users.name LIKE :name AND employee.delete_status = 0 AND employee.role_id != 1');
         $this->db->bind(':name', '%' . $name . '%');
        $result = $this->db->resultset(PDO::FETCH_ASSOC);
        
        return $result;
    }
    public function searchmenubyname($name) {
        $this->db->query('SELECT menuitem.*, menucategory.category_name 
                          FROM menuitem
                          LEFT JOIN menucategory ON menuitem.category_ID = menucategory.category_ID
                          WHERE menuitem.itemName LIKE :name AND menuitem.delete_status = 0');
        
        $this->db->bind(':name', '%' . $name . '%');
        $results = $this->db->resultSet();
        
        return $results;
    }
    
public function updateuserrole($role){
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
    public function addmenucategory($data){
        $this->db->query('INSERT INTO menucategory (category_name) VALUES (:category_name)');
        $this->db->bind(':category_name', $data['category_name']); 
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getmenucategory(){
        $this->db->query('SELECT * FROM menucategory ORDER BY category_name ASC');
        
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
    public function filtermenubycategory($categoryFilter = null) {
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
    
    
     public function generatePasswordResetToken($email) {
        $token = bin2hex(random_bytes(32));
        $expiration = time() + 3600; // Set expiration time to 1 hour from now

        $this->db->query('INSERT INTO password_reset_tokens (email, token, expiration) VALUES (:email, :token, :expiration)');
        $this->db->bind(':email', $email);
        $this->db->bind(':token', $token);
        $this->db->bind(':expiration', $expiration);

        return $this->db->execute() ? $token : false;
    }
   public function manuallyactivateemployee($user_ID){
        $this->db->query('UPDATE employee SET active = 1 WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_ID);
    
        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getEmployeeEmail($user_ID) {
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
    public function editmenucategory($ID, $category_name){
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
        public function getcategorybyID($ID){
        $this->db->query('SELECT * FROM menucategory WHERE category_ID = :ID');
        $this->db->bind(':ID',$ID);
        $row = $this->db->single();
        return $row;
        
    }
    public function updatecategorytime($data){
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
    public function hidecategory($data){
        $this->db->query('UPDATE menucategory SET hidden_status = 1 WHERE category_ID = :category_ID');
        $this->db->bind(':category_ID', $data['category_ID']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    
    
}
public function showcategory($data){
        $this->db->query('UPDATE menucategory SET hidden_status = 0 WHERE category_ID = :category_ID');
        $this->db->bind(':category_ID', $data['category_ID']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
}
public function emailcheck($email){
    $this->db->query('SELECT * FROM users WHERE email = :email');
    $this->db->bind(':email', $email);
    $row = $this->db->single();
    if ($this->db->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}
public function getpackages(){
    $this->db->query('SELECT * FROM package');
    $results = $this->db->resultSet();
    return $results;
}
public function getpackagebyid($packageID){
    $this->db->query('SELECT * FROM package WHERE packageID = :packageID');
    $this->db->bind(':packageID', $packageID);
    $row = $this->db->single();
    return $row;
}
public function gettables(){
    $this->db->query('SELECT * FROM tables');
    $results = $this->db->resultSet();
    return $results;
}
public function addtable($data){
    $this->db->query('INSERT INTO tables (capacity, packageID) VALUES (:capacity, :packageID)');
    $this->db->bind(':capacity', $data['capacity']);
    $this->db->bind(':packageID', $data['packageID']);
    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}
public function editpackage($data){
    var_dump($data);
    $this->db->query('UPDATE package SET packageName = :packageName, tax = :tax, capacity = :capacity, description = :description WHERE packageID = :packageID');
    $this->db->bind(':packageName', $data['packageName']);
    $this->db->bind(':tax', $data['tax']);
    $this->db->bind(':capacity', $data['capacity']);
    $this->db->bind(':description', $data['description']);
    $this->db->bind(':packageID', $data['packageID']);
    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}
}
?>