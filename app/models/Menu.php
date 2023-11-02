<?php
class Menu {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function findMenuByID($id)
    {
        $this->db->query('SELECT * FROM menu WHERE id = :id');
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
    public function findMenuByName($name)
    {
        $this->db->query('SELECT * FROM menu WHERE name = :name');
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
    public function submitMenu($data){
    
        $this->db->query('INSERT INTO menu (ID, name, price, description) VALUES (:ID, :name, :price, :description)');
        $this->db->bind(':ID', $data['ID']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':description', $data['description']);
        

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
    public function editMenuimage($data){
    
        $this->db->query('UPDATE menu SET image = :image WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':image', $data['image']);
        

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
        
    }

    public function hideMenu($id){
    
        $this->db->query('UPDATE menu SET status = 0 WHERE id = :id');
        $this->db->bind(':id', $id);
        

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
    public function showMenu($id){
    
        $this->db->query('UPDATE menu SET status = 1 WHERE id = :id');
        $this->db->bind(':id', $id);
        

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
    public function editMenu($data){
    
        $this->db->query('UPDATE menu SET name = :name, price = :price, description = :description WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':description', $data['description']);
        

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
    public function deleteMenu($id){
    
        $this->db->query('DELETE FROM menu WHERE id = :id');
        $this->db->bind(':id', $id);
        

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
}
?>