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
    public function addgrn($data)
{
    $this->db->query('INSERT INTO inventoryitem (inventoryname, category, quantityLevel, asondate, expiredate, batchcode, description, cost, quantityadded, roqlevel) VALUES (:inventoryname, :category, :quantitylevel, :asondate, :expiredate, :batchcode, :description, :cost, :quantityadded, :roqlevel)');
    $this->db->bind(':inventoryname', $data['inventoryname']);
    $this->db->bind(':category', $data['category']);
    $this->db->bind(':quantitylevel', $data['quantitylevel']);
    $this->db->bind(':asondate', $data['asondate']);
    $this->db->bind(':expiredate', $data['expiredate']);
    $this->db->bind(':batchcode', $data['batchcode']);
    $this->db->bind(':description', $data['description']);
    $this->db->bind(':cost', $data['cost']);
    $this->db->bind(':quantityadded', $data['quantityadded']);
    $this->db->bind(':roqlevel', $data['roqlevel']);

    // Execute
    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}

}
?>
