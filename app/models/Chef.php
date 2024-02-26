<?php
class Chef {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }
    public function getOrders() {
        $this->db->query('SELECT orders.*, users.name AS customer_name, menuitem.itemName
                          FROM orders 
                          JOIN users ON orders.customerID = users.user_id 
                          JOIN menuitem ON orders.menuid = menuitem.itemID
                          WHERE orders.status != "Completed"');
        $results = $this->db->resultSet();
        return $results;
    }
    public function updateOrderStatus($orderID, $newStatus) {
        $this->db->query('UPDATE orders SET status = :newStatus WHERE orderID = :orderID');
        $this->db->bind(':orderID', $orderID);
        $this->db->bind(':newStatus', $newStatus);
        $this->db->execute();
        return true;
    }
    public function viewmenu($menuID){
        $this->db->query('SELECT * FROM menuitem WHERE itemID = :menuID');
        $this->db->bind(':menuID', $menuID); // Use ':menuID' for consistency
        $results = $this->db->resultSet();
    return $results;
    }
    public function getcompletedorders(){
        $this->db->query('SELECT orders.*, users.name AS customer_name, menuitem.itemName
                          FROM orders 
                          JOIN users ON orders.customerID = users.user_id 
                          JOIN menuitem ON orders.menuid = menuitem.itemID
                          WHERE orders.status = "Completed"');
        $results = $this->db->resultSet();
        return $results;
    }
    
}


