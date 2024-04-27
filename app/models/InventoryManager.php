<?php
class InventoryManager{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
//grn dropdown
    public function fetchCategories() {
        $sql = "SELECT * FROM categories";
        $this->db->query($sql);
        return $this->db->resultSet();
        }

     public function fetchInventoryByCategory($categoryID) {
        $query = "SELECT * FROM inventories WHERE categoryID = :categoryID";
    $this->db->query($query);
    $this->db->bind(':categoryID', $categoryID);

    return $this->db->resultSet();
    }

    public function fetchInventoryDetailsByID($inventorynameID) {
        $this->db->query('SELECT * FROM inventories WHERE inventorynameID = :inventorynameID');
        $this->db->bind(':inventorynameID', $inventorynameID);
        return $this->db->single();
        
    }


    // Adding categories and inevntories 
    public function addCategory($categoryID, $categoryName, $categoryCode, $creationDate) {
        $sql = 'INSERT INTO categories (categoryID,categoryName, categoryCode, creationDate) VALUES (:categoryID, :categoryName, :categoryCode, :creationDate)';
        $this->db->query($sql);
        $this->db->bind(':categoryID', $categoryID);
        $this->db->bind(':categoryName', $categoryName);
        $this->db->bind(':categoryCode', $categoryCode);
        $this->db->bind(':creationDate', $creationDate);
        return $this->db->execute();
    }
    public function addInventory($categoryID, $inventoryName, $inventoryCode,$roqLevel,$units, $creationDate) {
        $sql = "INSERT INTO inventories (categoryID, inventoryName, inventoryCode,roqLevel,units, creationDate) VALUES (:categoryID, :inventoryName, :inventoryCode, :roqLevel, :units, :creationDate)";
        $this->db->query($sql);
        $this->db->bind(':categoryID', $categoryID);
        $this->db->bind(':inventoryName', $inventoryName);
        $this->db->bind(':inventoryCode', $inventoryCode);
        $this->db->bind(':roqLevel', $roqLevel);
        $this->db->bind(':units', $units);
        $this->db->bind(':creationDate', $creationDate);
        return $this->db->execute();
    }

    //ADD GRN
    public function addgrn($data)
{  
     try {
         $query = 'INSERT INTO inventorylist (inventoryName, categoryName, batchCode, quantity, creationDate, expireDate, shelfLife, unitCost, totalCost, roqLevel,units) VALUES (:inventoryName, :category, :batchCode, :quantity, :creationDate, :expireDate, :shelfLife, :unitCost, :totalCost, :roqLevel, :units)';
        $this->db->query($query);
        $this->db->bind(':inventoryName', $data['inventoryName']);
        $this->db->bind(':categoryName', $data['category']); 
        $this->db->bind(':batchCode', $data['batchCode']);
        $this->db->bind(':quantity', $data['quantity']);
        $this->db->bind(':creationDate', $data['creationDate']);
        $this->db->bind(':expireDate', $data['expireDate']);
        $this->db->bind(':shelfLife', $data['shelfLife']);
        $this->db->bind(':unitCost', $data['unitCost']);
        $this->db->bind(':totalCost', $data['totalCost']);
        $this->db->bind(':roqLevel', $data['roqLevel']);
        $this->db->bind(':units', $data['units']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        throw new Exception('Error adding GRN: ' . $e->getMessage());
    }
    
}

//batchcode
public function generatebatchCode($categoryName, $inventoryName){
   
    $categoryCode = $this->getCategoryCodeByID($categoryName);
    
    $inventoryCode = $this->getInventoryCodeByID($inventoryName);

    $nextInventoryID = $this->getNextInventoryID();

    $batchCode = $categoryCode . '-' . $inventoryCode . '-' . $nextInventoryID;

    return $batchCode;
   
}
public function getCategoryCodeByID($categoryName) {
    $this->db->query('SELECT categoryCode FROM categories WHERE categoryName = :categoryName');
    $this->db->bind(':categoryID', $categoryName);
    $result = $this->db->single();
    return $result['categoryCode'];
}
public function getInventoryCodeByID($inventoryName) {
    $this->db->query('SELECT inventoryCode FROM inventories WHERE inventoryName = :inventoryName');
    $this->db->bind(':inventoryName', $inventoryName);
    $result = $this->db->single();
    return $result['inventoryCode'];
}

public function getNextInventoryID() {
    // Fetch the next available inventory ID from the database
    $this->db->query('SELECT MAX(inventoryID) AS maxID FROM inventorylist');
    $result = $this->db->single();
    $nextID = $result['maxID'] + 1;
    return $nextID;
}
//kitchenreqst
public function getkitchenRequests(){
    $query = "SELECT * FROM kitchenrequest";
    $this->db->query($query);
    $results = $this->db->resultSet();
    return $results;

}
public function getrequestedCategories() {
    $query = "SELECT DISTINCT categoryName FROM kitchenrequest";
    $this->db->query($query);
    $results = $this->db->resultSet();
    return $results;
}

public function getrequestedInventories($categoryName) {
    $query = "SELECT DISTINCT inventoryName FROM kitchenrequest WHERE categoryName = :categoryName";
    $this->db->query($query);
    $this->db->bind(':categoryName', $categoryName);
    $results = $this->db->resultSet();
    return $results;
}


public function getInventoryNameByID($inventoryID) {
    $query = "SELECT inventoryName FROM inventorylist WHERE inventoryID = :inventoryID";
    $this->db->query($query);
    $this->db->bind(':inventoryID', $inventoryID);
    return $this->db->single()['inventoryName']; // Assuming single() method fetches a single row
}

public function getCategoryNameByID($categoryID) {
    $query = "SELECT categoryName FROM categories WHERE categoryID = :categoryID";
    $this->db->query($query);
    $this->db->bind(':categoryID', $categoryID);
    return $this->db->single()['categoryName']; // Assuming single() method fetches a single row
}


public function getInventoryitem()
{
    $this->db->query('SELECT * FROM inventorylist ORDER BY shelfLife ASC');
    $results = $this->db->resultSet();
    return $results;
}


    // Add issued inventory to the database
    public function addIssuedInventory($inventoryName, $quantity) {
        // Implement database insert query to add issued inventory
    }
//deduct inevno=tory qty
public function deductquantity($inventoryName, $quantity)
{
    // Deduct the quantity from the inventory list
    $query = "UPDATE inventorylist SET quantity = quantity - :quantity WHERE inventoryName = :inventoryName ORDER BY shelfLife ASC LIMIT :quantity" ;
    $this->db->query($query);
    $this->db->bind(':quantity', $quantity);
    $this->db->bind(':inventoryName', $inventoryName);

    // Execute the update query
    return $this->db->execute();
}

// quantity update in inventorylist after markout
public function markoutInventory($inventoryName, $categoryName, $Quantity) {
    // Fetch inventory items ordered by shelf life for the specified category and batch code
    $query = "SELECT * FROM inventorylist WHERE inventoryName = :inventoryName AND categoryName = :categoryName ORDER BY shelfLife ASC";
    $this->db->query($query);
    $this->db->bind(':inventoryName', $inventoryName);
    $this->db->bind(':categoryName', $categoryName);
    $inventoryName = $this->db->resultSet();

    foreach ($inventoryName as $item) {
        if ($Quantity <= 0) {
            break; 
        }
        $availableQuantity = $item['quantity'];
        if ($Quantity >= $availableQuantity) 
        {
            $Quantity -= $availableQuantity;
            $this->updateInventoryQuantity($item['inventoryID'], 0); // Set quantity to 0
        } else {
            $this->updateInventoryQuantity($item['inventoryID'], $availableQuantity - $Quantity);
            $Quantity = 0; // All requested quantity has been fulfilled
        }
    }
}

//kitchenrequesttable uodtae
public function updateKitchenrequest($inventoryName, $status) {
    $query = "UPDATE kitchenrequest SET status = :status WHERE inventoryName = :inventoryName";
    $this->db->query($query);
    $this->db->bind(':status', $status);
    $this->db->bind(':inventoryName', $inventoryName);
    $this->db->execute();
}

private function updateInventoryQuantity($inventoryID, $newQuantity) {
    $query = "UPDATE inventorylist SET quantity = :newQuantity WHERE inventoryID = :inventoryID";
    $this->db->query($query);
    $this->db->bind(':newQuantity', $newQuantity);
    $this->db->bind(':inventoryID', $inventoryID);
    $this->db->execute();
}


}
