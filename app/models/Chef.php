<?php
class Chef {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }
    public function getOrders() {
        
        // $this->db->query('SELECT * FROM orders where status =  "Paid"   ORDER BY orderItemID DESC');
        // $row1 = $this->db->resultSet();
        // foreach ($row1 as $row) {
        //     $this->db->query('SELECT * FROM orderitem WHERE orderNo = :order_id');
        //     $this->db->bind(':order_id', $row->orderItemID);
        //     $row->items = $this->db->resultSet();
        //     $this->db->query('SELECT * FROM reservation WHERE reservationID = :reservation_id');
        //     $this->db->bind(':reservation_id', $row->reservationID  );
        //     $row->reservation = $this->db->single();
        //     $this->db->query('SELECT * FROM users WHERE user_id = :customer_id');
        //     $this->db->bind(':customer_id', $row->reservation->customerID);
        //     $row->customer = $this->db->single();
        //     foreach ($row->items as $item) {
        //         $this->db->query('SELECT * FROM menuitem WHERE itemID = :menu_id');
        //         $this->db->bind(':menu_id', $item->itemID);
        //         $item->menu = $this->db->single();
        //     }
        // }

        $today = date("Y-m-d");

        $this->db->query('SELECT reservationID ,customerID, tableID , reservationStartTime , orderID FROM reservation where status =  "Paid" and date = :today ORDER BY reservationStartTime ASC');
        $this->db->bind(':today', $today);
        $row1 = $this->db->resultSet();

        foreach($row1 as $row){
            $this->db->query(('SELECT preparationStatus FROM orders WHERE orderItemID = :orderID'));
            $this->db->bind(':orderID', $row->orderID);
           $row2 = $this->db->single();
            $row->preparationStatus = $row2->preparationStatus;
        }

        foreach ($row1 as $row) {
            $this->db->query('SELECT itemID , size , quantity FROM orderitem WHERE orderNo = :orderID');
            $this->db->bind(':orderID', $row->orderID);
            $row->items = $this->db->resultSet();
            $this->db->query('SELECT name FROM users WHERE user_id = :customer_id');
            $this->db->bind(':customer_id', $row->customerID);
            $row->customer = $this->db->single();
            foreach ($row->items as $item) {
                $this->db->query('SELECT itemName , averageTime FROM menuitem WHERE itemID = :menu_id');
                $this->db->bind(':menu_id', $item->itemID);
                $row3 = $this->db->single();
                $item->itemName = $row3->itemName;
                $item->averageTime = $row3->averageTime;
            }
        }

        return $row1;
    }        
    
}


