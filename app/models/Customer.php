<?php
class Customer
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

    public function getReviews($user_ID)
    {
        $this->db->query('SELECT * FROM review WHERE customerID = :user_ID');
        $this->db->bind(':user_ID', $user_ID);
        $results = $this->db->resultSet();
        return $results;
    }

    public function addReview($data)
    {
        $this->db->query('INSERT INTO review (customerID, rating, comment) VALUES (:customerID, :rating, :comment)');
        $this->db->bind(':customerID', $data['customerID']);
        $this->db->bind(':rating', $data['rating']);
        $this->db->bind(':comment', $data['comment']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getRemainingSlots($date)
    {
        $this->db->query('SELECT * FROM reservation WHERE date = :date');
        $this->db->bind(':date', $date);
        $results = $this->db->resultSet();
        return $results;
    }
}
