<?php
class Receptionist
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    // public function getReservation($user_id)
    // {
    //     $this->db->query('SELECT * FROM reservation ORDER BY date DESC');
    //     $results = $this->db->resultSet();
    //     return $results;
    // }

    // public function cancelReservation($reservationID)
    // {
    //     $this->db->query("UPDATE reservation SET status = 'Cancelled' WHERE reservationID = :reservationID");
    //     $this->db->bind(':reservationID', $reservationID);
    //     $results = $this->db->execute();
    //     return $results;
    // }

    // public function addReservation($data)
    // {
    //     $this->db->query('INSERT INTO reservation (customerID, tableID, packageID,date, reservationStartTime, reservationEndTime, numOfPeople) VALUES (:customerID, :tableID, :packageID, :date, :reservationStartTime, :reservationEndTime, :numOfPeople)');
    //     $this->db->bind(':customerID', $data['customerID']);
    //     $this->db->bind(':tableID', $data['tableID']);
    //     $this->db->bind(':packageID', $data['packageID']);
    //     $this->db->bind(':date', $data['date']);
    //     $this->db->bind(':reservationStartTime', $data['reservationStartTime']);
    //     $this->db->bind(':reservationEndTime', $data['reservationEndTime']);
    //     $this->db->bind(':numOfPeople', $data['numOfPeople']);
    //     //execute
    //     if ($this->db->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // public function getReviews()
    // {
    //     $this->db->query('SELECT * FROM review ORDER BY date DESC');
    //     $results = $this->db->resultSet();
    //     return $results;
    // }

    // public function getRemainingSlots($date)
    // {
    //     $this->db->query('SELECT * FROM reservation WHERE date = :date');
    //     $this->db->bind(':date', $date);
    //     $results = $this->db->resultSet();
    //     return $results;
    // }

    public function getPackages()
    {
        $this->db->query('SELECT * FROM package');
        $results = $this->db->resultSet();
        return $results;
    }
    public function getAllReservationsOnDate($date, $suite)
    {
        $this->db->query('SELECT * FROM reservation WHERE `packageID` = :suite AND `date` = :date ORDER BY reservationStartTime ASC');
        $this->db->bind(':date', $date);
        $this->db->bind(':suite', $suite);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getAllReservationsOnDateForAllSuites($date)
    {
        $this->db->query('SELECT * FROM reservation WHERE `date` = :date ORDER BY reservationStartTime ASC');
        $this->db->bind(':date', $date);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getSlots()
    {
        $this->db->query('SELECT * FROM package');
        $results = $this->db->resultSet();
        return $results;
    }


//!menu Functions
public function getMenus()
{
    $this->db->query("SELECT mi.itemID, mi.itemName, mi.imagePath , mi.category_ID, GROUP_CONCAT(mp.itemSize ORDER BY mp.itemSize SEPARATOR ', ') AS Sizes, GROUP_CONCAT(mp.ItemPrice ORDER BY mp.itemSize SEPARATOR ', ') AS Prices FROM menuitem mi JOIN menuprices mp ON mi.itemID = mp.ItemID WHERE mi.delete_status = 0 AND mi.hidden = 0 GROUP BY mi.itemID ORDER BY mi.itemID;");
    $results = $this->db->resultSet();
    return $results;
}

public function getFoodReviews()
{
    $this->db->query('SELECT  itemID , COUNT(stars) as "count" , ROUND(SUM(stars) / COUNT(stars)) as "stars" FROM reviewfood GROUP BY itemID');
    $results = $this->db->resultSet();
    return $results;
}

}
