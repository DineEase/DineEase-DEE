<?php
class Chef {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getMenuitem()
    {
        $this->db->query('SELECT * FROM menuitem');
        $results = $this->db->resultSet();
        return $results;
    }
        public function findMenuitemByID($id)
    {
        $this->db->query('SELECT * FROM menuitem WHERE itemID = :id');
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
        $this->db->query('SELECT * FROM menuitem WHERE itemName = :name');
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
    public function submitMenuitem($data){
        $this->db->query('INSERT INTO menuitem (itemName, price, averageTime, hidden, imagePath) VALUES (:itemName, :price, :averageTime, :hidden, :imagePath)');
        $this->db->bind(':itemName', $data['itemName']); 
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':averageTime', $data['averageTime']);
        $this->db->bind(':hidden', 0);
        $this->db->bind(':imagePath', $data['imagePath']);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
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
    
        $this->db->query('UPDATE menuitem SET itemName = :itemName, price = :price, averageTime = :averageTime, imagePath = :imagePath WHERE itemID = :itemID');
        $this->db->bind(':itemID', $data['itemID']);
        $this->db->bind(':itemName', $data['itemName']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':averageTime', $data['averageTime']);
        $this->db->bind(':imagePath', $data['imagePath']);
        

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
    public function deleteMenuitem($itemID){
    
        $this->db->query('DELETE FROM menuitem WHERE itemID = :itemID');
        $this->db->bind(':itemID', $itemID);
        

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
    public function getMenuitembyId($id){
        $this->db->query('SELECT * FROM menuitem WHERE itemID = :id');
        $this->db->bind(':id',$id);
        $row = $this->db->single();
        return $row;

    }
}
?>