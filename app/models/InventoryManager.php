<?php
class InventoryManager{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getInventoryitem()
    {
        $this->db->query('SELECT * FROM inventoryitem');
        $results = $this->db->resultSet();
        return $results;
    }
}
?>