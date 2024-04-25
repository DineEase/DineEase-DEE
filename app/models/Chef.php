<?php
class Chef
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getOrders()
    {

        $today = date("Y-m-d");

        $this->db->query('SELECT reservationID ,customerID, tableID , reservationStartTime , orderID FROM reservation where status =  "Paid" and date = :today ORDER BY reservationStartTime ASC');
        $this->db->bind(':today', $today);
        $row1 = $this->db->resultSet();

        foreach ($row1 as $row) {
            $this->db->query(('SELECT preparationStatus FROM orders WHERE orderItemID = :orderID'));
            $this->db->bind(':orderID', $row->orderID);
            $row2 = $this->db->single();
            $row->preparationStatus = $row2->preparationStatus;
        }

        foreach ($row1 as $row) {
            $this->db->query('SELECT orderItemID ,itemID , size , quantity , itemProcessingStatus FROM orderitem WHERE orderNo = :orderID');
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

    public function changeOrderStatus($orderID)
    {
        $this->db->query('UPDATE orders SET preparationStatus = "Active" WHERE orderItemID = :orderID');
        $this->db->bind(':orderID', $orderID);
        $this->db->execute();

        $this->db->query('SELECT * FROM orderitem WHERE orderNo = :orderID');
        $this->db->bind(':orderID', $orderID);
        $row2 = $this->db->resultSet();

        foreach ($row2 as $row) {
            $this->db->query('UPDATE orderitem SET status = "Active" , itemProcessingStatus = "Queued"  WHERE orderItemID = :itemID');
            $this->db->bind(':itemID', $row->orderItemID);
            $this->db->execute();
        }
        
    }

    public function changeItemStatus($itemID, $status)
    {
        $this->db->query('UPDATE orderitem SET itemProcessingStatus = :status WHERE orderItemID = :itemID');
        $this->db->bind(':itemID', $itemID);
        $this->db->bind(':status', $status);
        $this->db->execute();

        $this->db->query('SELECT * FROM orderitem WHERE orderItemID = :itemID');
        $this->db->bind(':itemID', $itemID);
        $row = $this->db->single();

        $this->db->query('SELECT * FROM orderitem WHERE orderNo = :orderNo');
        $this->db->bind(':orderNo', $row->orderNo);
        $row2 = $this->db->resultSet();

        $flag = 0;
        foreach ($row2 as $row) {
            if ($row->itemProcessingStatus != 'Ready') {
                $flag = 1;
            }
        }

        if ($flag == 0) {
            $this->db->query('UPDATE orders SET preparationStatus = "Completed" WHERE orderItemID = :orderID');
            $this->db->bind(':orderID', $row->orderNo);
            $this->db->execute();
        }

        $this->db->query('SELECT * FROM orderitem WHERE orderNo = :orderID');
        $this->db->bind(':orderID', $row->orderNo);
        $row2 = $this->db->resultSet();
  
        foreach ($row2 as $row) {
            $this->db->query('UPDATE orderitem SET status = "Active" WHERE orderItemID = :itemID');
            $this->db->bind(':itemID', $row->orderItemID);
            $this->db->execute();
        }
    }
}
