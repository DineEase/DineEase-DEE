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
    public function addInventory($categoryID, $inventoryName, $inventoryCode, $roqLevel, $units) {
        $sql = "INSERT INTO inventories (categoryID, inventoryName, inventoryCode, roqLevel, units, createDate) VALUES (:categoryID, :inventoryName, :inventoryCode, :roqLevel, :units, NOW())";
        $this->db->query($sql);
        $this->db->bind(':categoryID', $categoryID);
        $this->db->bind(':inventoryName', $inventoryName);
        $this->db->bind(':inventoryCode', $inventoryCode);
        $this->db->bind(':roqLevel', $roqLevel);
        $this->db->bind(':units', $units);
        //$this->db->bind(':creationDate', $creationDate);
        return $this->db->execute();
    }
    public function getinventoriesnamenyid($inventorynameID) {
        $this->db->query('SELECT inventoryName FROM inventories WHERE inventorynameID = :inventorynameID');
        $this->db->bind(':inventorynameID', $inventorynameID);
        return $this->db->single();
    }

public function getcategorynamebyid2($categoryID) {
    $this->db->query('SELECT categoryName FROM categories WHERE categoryID = :categoryID');
    $this->db->bind(':categoryID', $categoryID);
    return $this->db->single();
}
    //ADD GRN
    public function addgrn($data)
    
{  
    error_log('Data: ' . print_r($data, true));
    $inventorynamename = $this->getinventoriesnamenyid($data['inventoryName'])->inventoryName;
    $categoryName = $this->getcategorynamebyid2($data['category'])->categoryName;
    error_log('Inventory Name: ' . print_r($inventorynamename, true));
    
     try {
         $query = 'INSERT INTO inventorylist (inventoryName, categoryName, batchCode, quantity, creationDate, expireDate, shelfLife, unitCost, totalCost, roqLevel,units) VALUES (:inventoryName, :category, :batchCode, :quantity, :creationDate, :expireDate, :shelfLife, :unitCost, :totalCost, :roqLevel, :units)';
        $this->db->query($query);
        $this->db->bind(':inventoryName', $inventorynamename);
        $this->db->bind(':category', $categoryName); 
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

    $batchCode = $categoryCode->categoryCode . '-' . $inventoryCode->inventoryCode . '-' . $nextInventoryID;

    return $batchCode;
   
}
public function getCategoryCodeByID($categoryID) {
    //error_log('Category Name: ' . $categoryName);
    $this->db->query('SELECT categoryCode FROM categories WHERE categoryID = :categoryID');
    $this->db->bind(':categoryID', $categoryID);
    $result = $this->db->single();
    return $result;
}
public function getInventoryCodeByID($inventorynameID) {
    $this->db->query('SELECT inventoryCode FROM inventories WHERE inventorynameID = :inventorynameID');
    $this->db->bind(':inventorynameID', $inventorynameID);
    $result = $this->db->single();
    return $result;
}

public function getNextInventoryID() {
    // Fetch the next auto-increment value from the database
    $this->db->query('SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = :databaseName AND TABLE_NAME = :tableName');
    $this->db->bind(':databaseName', 'de_db_v9');
    $this->db->bind(':tableName', 'inventorylist');
    $result = $this->db->single();

    // Check if the query was successful
    if ($result) {
        $nextID = $result->AUTO_INCREMENT+1;
    } else {
        // Handle the case where the query fails or returns no result
        // You might want to throw an exception, log an error, or return a default value
        $nextID = null;
    }

    return $nextID;
}

public function automaticallyupdateshellife() {
    $query = "UPDATE inventorylist SET shelfLife = DATEDIFF(expireDate, NOW())";
    $this->db->query($query);
    return $this->db->execute();
    return true;
}
// public function getCategoryNameByID2($categoryID) {
//     $query = "SELECT categoryName FROM categories WHERE categoryID = :categoryID";
//     $this->db->query($query);
//     $result=$this->db->bind(':categoryID', $categoryID);
//     return $result; // Assuming single() method fetches a single row
// }
//kitchenreqst
public function getkitchenRequests(){
    $query = "SELECT  * FROM kitchenrequest WHERE status = 'Requested' ORDER BY requestDate ASC";
    $this->db->query($query);
    $results = $this->db->resultSet();
    foreach ($results as &$result) {
        $categoryid = $result->categoryID;
        $inventeoryid=$result->inventoryName;
        $InventoryName = $this->getInventoryNameByID2($inventeoryid);
        $categoryname = $this->getCategoryNameByID2($categoryid);
        $result->categoryName = $categoryname;
        $result->Inventoryname = $InventoryName;  // Add categoryName property to result object
    }

    // Return the results with category names
    error_log('Results: ' . print_r($results, true));
    return $results;

}
public function getKitchenRequestsNames(){
    $query = "SELECT DISTINCT categoryID, inventoryName FROM kitchenrequest WHERE status = 'Requested' ORDER BY requestDate ASC";
    $this->db->query($query);
    $results = $this->db->resultSet();
    $uniqueInventoryNames = [];
    foreach ($results as $key => &$result) {
        $categoryid = $result->categoryID;
        $inventeoryid = $result->inventoryName;
        $inventoryName = $this->getInventoryNameByID2($inventeoryid);
        $categoryname = $this->getCategoryNameByID2($categoryid);
        $result->categoryName = $categoryname;
        $result->inventoryName = $inventoryName;
        if (!in_array($categoryname, $uniqueInventoryNames)) {
            // If not, add it to the array
            $uniqueInventoryNames[] = $categoryname;
        } else {
            // If it's already in the array, remove this result from the original results array
            unset($results[$key]);
        }
    }

    // Return the results with category names
    error_log('Results: ' . print_r($results, true));
    return $results;
}

public function getInventoryNameByID2($inventorynameID) {
    $query = "SELECT inventoryName FROM inventories WHERE inventorynameID = :inventorynameID";
    $this->db->query($query);
    $this->db->bind(':inventorynameID', $inventorynameID);
    $result = $this->db->single() ;// Assuming single() method fetches a single row
    return $result;
}
public function getcategoryidbyinventroynameid($inventorynameID) {
    $query = "SELECT categoryID FROM inventories WHERE inventorynameID = :inventorynameID";
    $this->db->query($query);
    $this->db->bind(':inventorynameID', $inventorynameID);
    $result = $this->db->single() ;// Assuming single() method fetches a single row
    return $result;
}
// public updatekitchenrequest($data){

// }
public function getrequestedCategories() {
    $query = "SELECT DISTINCT categoryName FROM kitchenrequest";
    $this->db->query($query);
    $results = $this->db->resultSet();
    return $results;
}

public function getrequestedInventories($categoryID) {
    $query = "SELECT DISTINCT inventoryName FROM kitchenrequest WHERE categoryID = :categoryID AND status = 'Requested' ";
    $this->db->query($query);
    $this->db->bind(':categoryID', $categoryID);
    $results = $this->db->resultSet();
    foreach ($results as &$result) {
        $categoryid = $result->categoryID;
        $inventeoryid=$result->inventoryName;
        $InventoryName = $this->getInventoryNameByID2($inventeoryid);
        $categoryname = $this->getCategoryNameByID2($categoryid);
        $result->categoryName = $categoryname;
        $result->Inventoryname = $InventoryName;  // Add categoryName property to result object
    }

    // Return the results with category names
   // error_log('Results: ' . print_r($results, true));
    return $results;
}
public function getrequestedinventoriesnames($categoryID) {
    $query = "SELECT DISTINCT inventoryName FROM kitchenrequest WHERE categoryID = :categoryID AND status = 'Requested' ";
    $this->db->query($query);
    $this->db->bind(':categoryID', $categoryID);
    $results = $this->db->resultSet();
    foreach ($results as &$result) {
        //$categoryid = $result->categoryID;
        $inventeoryid=$result->inventoryName;
        $InventoryName = $this->getInventoryNameByID2($inventeoryid);
        //$categoryname = $this->getCategoryNameByID2($categoryid);
        //$result->categoryName = $categoryname;
        $result->Inventoryname = $InventoryName;  // Add categoryName property to result object
    }
    //error_log('Results: ' . print_r($results, true));
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
public function markoutInventory($inventoryid, $requestedQuantity) {
    // Fetch inventory items ordered by shelf life for the specified category and batch code
    $inventoryName=$this->getInventoryNameByID2($inventoryid)->inventoryName;
//     error_log('Final inventory quantities:');
// $query = "SELECT * FROM inventorylist WHERE inventoryName = :inventoryName";
// $this->db->query($query);
// $this->db->bind(':inventoryName', $inventoryName);
// $finalInventory = $this->db->resultSet();
// foreach ($finalInventory as $item) {
//     error_log('Inventory ID: ' . $item->inventoryID . ', Quantity: ' . $item->quantity);
//}

    $query = "SELECT * FROM inventorylist WHERE inventoryName = :inventoryName AND quantity > 0 ORDER BY shelfLife ASC";
    $this->db->query($query);
    $this->db->bind(':inventoryName', $inventoryName);
    //$this->db->bind(':categoryName', $categoryName);
    $inventoryNames = $this->db->resultSet();
    $availableQuantity = 0;
    $markoutQuantity = 0;
    foreach ($inventoryNames as $item) {
        $availableQuantity += $item->quantity;
    }
    error_log('Available Quantity: ' . $availableQuantity);
    $actualQuantity = min($availableQuantity, $requestedQuantity);
    foreach ($inventoryNames as $item) {
        error_log('Actual Quantity: ' . $actualQuantity);
        error_log('Requested Quantity: ' . $requestedQuantity);
        error_log('Item Quantity: ' . $item->quantity);
        $shelfLifeQuantity = min($item->quantity, $actualQuantity);
        error_log('Shelf Life Quantity: ' . $shelfLifeQuantity);
        //$actualQuantity = $actualQuantity - $shelfLifeQuantity;
        $actualQuantity -= $shelfLifeQuantity;
        //$quantity -= $shelfLifeQuantity;
        $query = "UPDATE inventorylist SET quantity = quantity - :shelfLifeQuantity WHERE inventoryID = :inventoryID";
        $this->db->query($query);
        $this->db->bind(':shelfLifeQuantity', $shelfLifeQuantity);
        $this->db->bind(':inventoryID', $item->inventoryID);
        $this->db->execute();
        error_log('Updated quantity for inventory ID ' . $item->inventoryID . ' - Quantity deducted: ' . $shelfLifeQuantity);
        error_log('Actual Quantity after deduction: ' . $actualQuantity);
        $markoutQuantity += $shelfLifeQuantity;

        if ($actualQuantity >= $requestedQuantity || $actualQuantity <= 0) {
            break;
        }
    }
    error_log('Actual Quantity: ' . print_r($actualQuantity, true));
    if ($markoutQuantity < $requestedQuantity) {
        // Show an error
        echo '<script>alert("Error: Not enough inventory available for ' . $inventoryName . '. Used all quantities from every batch to fulfill the request.Markout quantity '.$markoutQuantity .'");</script>';
    
    
    }
    
    error_log('Markout Quantity: ' . $markoutQuantity);
// insert into markout table. Fields are categoryName, inventoryName, quantity
$categoryid = $this->getcategoryidbyinventroynameid($inventoryid)->categoryID;
$categoryName = $this->getcategorynamebyid2($categoryid)->categoryName;
    $query = "INSERT INTO markout (categoryName, inventoryName, quantity) VALUES (:categoryName, :inventoryName, :quantity)";
    $this->db->query($query);
   $this->db->bind(':categoryName', $categoryName);
    $this->db->bind(':inventoryName', $inventoryName);
    $this->db->bind(':quantity', $markoutQuantity);
    $this->db->execute();
    //return $markoutQuantity;
return true;
    
}

// public function subtractInventory($inventoryName, $quantity) {
//     $query = "SELECT * FROM inventory WHERE inventoryName = :inventoryName AND quantity > 0 ORDER BY shelfLife ASC";
//     $stmt = $this->db->prepare($query);
//     $stmt->bindParam(':inventoryName', $inventoryName);
//     $stmt->execute();
//     $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     foreach ($rows as $row) {
//         $shelfLifeQuantity = min($row['quantity'], $quantity);
//         $quantity -= $shelfLifeQuantity;

//         // Update the quantity of the current row
//         $query = "UPDATE inventory SET quantity = quantity - :shelfLifeQuantity WHERE inventoryID = :inventoryID";
//         $stmt = $this->db->prepare($query);
//         $stmt->bindParam(':shelfLifeQuantity', $shelfLifeQuantity);
//         $stmt->bindParam(':inventoryID', $row['inventoryID']);
//         $stmt->execute();

//         // If quantity is fully depleted, break the loop
//         if ($quantity <= 0) {
//             break;
//         }
//     }

//     // If there are still remaining quantity but no more rows with the same inventory name
//     if ($quantity > 0) {
//         // Show an error
//         echo "Error: Not enough inventory available for $inventoryName.";
//     }
// }


//kitchenrequesttable uodtae
public function updateKitchenrequest($ID) {
    $query = "UPDATE kitchenrequest SET status = 'Completed' WHERE requestID = :ID";
    $this->db->query($query);
    $this->db->bind(':ID', $ID);
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