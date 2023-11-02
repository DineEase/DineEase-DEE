<?php
class Receptionist
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getReservation($user_id)
    {
        $this->db->query('SELECT * FROM reservation WHERE customerID = :user_id order by date desc limit 10');
        $this->db->bind(':user_id', $user_id);
        $results = $this->db->resultSet();
        return $results;
    }
    // public function cancelReservation($reservationID)
    // {
    //     $this->db->query('DELETE FROM reservation WHERE reservationID = :reservationID');
    //     $this->db->bind(':reservationID', $reservationID);
    //     $results = $this->db->execute();
    //     return $results;
    // }

    public function cancelReservation($reservationID)
    {   
        $this->db->query("UPDATE reservation SET status = 'Cancelled' WHERE reservationID = :reservationID");
        $this->db->bind(':reservationID', $reservationID);
        $results = $this->db->execute();
        return $results;
    }

    public function addReservation($data)
    {
        $this->db->query('INSERT INTO reservation (customerID, tableID, packageID,date, reservationStartTime, reservationEndTime, numOfPeople) VALUES (:customerID, :tableID, :packageID, :date, :reservationStartTime, :reservationEndTime, :numOfPeople)');
        $this->db->bind(':customerID', $data['customerID']);
        $this->db->bind(':tableID', $data['tableID']);
        $this->db->bind(':packageID', $data['packageID']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':reservationStartTime', $data['reservationStartTime']);
        $this->db->bind(':reservationEndTime', $data['reservationEndTime']);
        $this->db->bind(':numOfPeople', $data['numOfPeople']);
        $this->db->bind('', $data['']);
        $this->db->bind('', $data['']);
        $this->db->bind('', $data['']);
        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function getRemainingSlots($date){
        $this->db->query('SELECT * FROM reservation WHERE date = :date');
        $this->db->bind(':date', $date);
        $results = $this->db->resultSet();
        return $results;
    }

    // //indusaras functions
    // public function getRequests(){
    //     $this->db->query('SELECT * from refund_requests');
    //                     // -- refund_requests.invoiceID as postId,
    //                     // -- customer.user_id as userId,
    //                     // -- FROM refund_requests
    //                     // -- INNER JOIN customer
    //                     // -- ON posts.userID = customer.user_id  
    //                     // -- FROM refund_requests
    //                     // -- ORDER BY refund_requests.date DESC

    //     $results = $this->db->resultset();

    //     return $results;
    // }

    // public function addRequest($data){
    
    //     $this->db->query('INSERT INTO refund_requests (invoiceID, body, price) VALUES (:invoiceID, :body, :price)');
    //     $this->db->bind(':invoiceID', $data['invoiceID']);
    //     $this->db->bind(':body', $data['body']);
    //     $this->db->bind(':price', $data['price']);
        

    //     //execute
    //     if ($this->db->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
        
    // }

    // public function updateRequest($data){
    
    //     $this->db->query('UPDATE refund_requests SET invoiceID = :invoiceID, body = :body, price = :price WHERE invoiceID = :invoiceID');
    //     $this->db->bind(':invoiceID', $data['invoiceID']);
    //     $this->db->bind(':body', $data['body']);
    //     $this->db->bind(':price', $data['price']);
        

    //     //execute
    //     if ($this->db->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
        
    // }

    // public function getRequestsById($id){
    //     $this->db->query('SELECT * from refund_requests where invoiceID = :id');
    //     $this->db->bind(':id', $id);
    //     $results = $this->db->resultset();

    //     return $results;
    // } 

    // public function deleteRequest($id){
    //     $this->db->query('DELETE FROM refund_requests WHERE invoiceID = :id');
    //     $this->db->bind(':id', $id);
    //     //execute
    //     if ($this->db->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}
