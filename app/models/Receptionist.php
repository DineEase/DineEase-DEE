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
    $this->db->query('SELECT * FROM reservation ORDER BY date DESC LIMIT 10');
    $results = $this->db->resultSet();
    return $results;
}

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
        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getReviews()
    {
        $this->db->query('SELECT * FROM review ORDER BY date DESC');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getRemainingSlots($date){
        $this->db->query('SELECT * FROM reservation WHERE date = :date');
        $this->db->bind(':date', $date);
        $results = $this->db->resultSet();
        return $results;
    }

}
