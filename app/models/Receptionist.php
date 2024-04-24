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

    //!Reservation Functions
    public function getMinDate()
    {
        $this->db->query('SELECT MIN(date) as minDate FROM reservation');
        $results = $this->db->single();
        return $results;
    }

    public function getMaxDate()
    {
        $this->db->query('SELECT MAX(date) as maxDate FROM reservation');
        $results = $this->db->single();
        return $results;
    }

    public function getReservationWithSearch( $limit = 10, $offset = 0, $search)
    {
        $this->db->query('SELECT * FROM reservation WHERE  (status LIKE :search OR numOfPeople LIKE :search) ORDER BY date ASC LIMIT :offset, :limit');
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        $this->db->bind(':search', "%$search%");
        $results = $this->db->resultSet();
        return $results;
    }
    public function getTotalReservationCountWithSearch( $search)
    {
        $this->db->query('SELECT COUNT(*) as count FROM reservation WHERE (status LIKE :search OR numOfPeople LIKE :search) order by date ASC');
        $this->db->bind(':search', "%$search%");
        $row = $this->db->single();
        return $row->count;
    }

    public function getReservationWithStatus( $limit = 10, $offset = 0, $status)
    {
        $this->db->query('SELECT * FROM reservation WHERE status = :status ORDER BY date ASC LIMIT :offset, :limit');
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        $this->db->bind(':status', $status);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getTotalReservationCountWithStatus( $status)
    {
        $this->db->query('SELECT COUNT(*) as count FROM reservation WHERE status = :status ORDER BY date ASC');
        $this->db->bind(':status', $status);
        $row = $this->db->single();
        return $row->count;
    }
    
    public function getReservationWithDateRange( $limit = 10, $offset = 0, $startDate, $endDate)
    {
        $this->db->query('SELECT * FROM reservation WHERE date BETWEEN :startDate AND :endDate ORDER BY date ASC LIMIT :offset, :limit');
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);
        $results = $this->db->resultSet();
        return $results;
    }
    public function getTotalReservationCountWithDateRange( $startDate, $endDate)
    {
        $this->db->query('SELECT COUNT(*) as count FROM reservation WHERE date BETWEEN :startDate AND :endDate ORDER BY date ASC');
        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);
        $row = $this->db->single();
        return $row->count;
    }

    
    public function getReservationWithStatusAndDateRange( $limit = 10, $offset = 0, $status, $startDate, $endDate)
    {
        $this->db->query('SELECT * FROM reservation WHERE  status = :status AND date BETWEEN :startDate AND :endDate ORDER BY date ASC LIMIT :offset, :limit');
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        $this->db->bind(':status', $status);
        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);
        $results = $this->db->resultSet();
        return $results;
    }
    public function getTotalReservationCountWithStatusAndDateRange( $status, $startDate, $endDate)
    {
        $this->db->query('SELECT COUNT(*) as count FROM reservation WHERE status = :status AND date BETWEEN :startDate AND :endDate ORDER BY date ASC');
        $this->db->bind(':status', $status);
        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);
        $row = $this->db->single();
        return $row->count;
    }

    public function getReservation($limit = 10, $offset = 0)
    {
        $this->db->query('SELECT * FROM reservation  ORDER BY date ASC LIMIT :offset, :limit');
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        $results = $this->db->resultSet();
        return $results;
    }
    public function getTotalReservationCount()
    {
        $this->db->query('SELECT COUNT(*) as count FROM reservation ORDER BY date ASC');
        $row = $this->db->single();
        return $row->count;
    }

    public function getReservationStatus()
    {
        $this->db->query('SELECT * FROM reservationStatus');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getSuiteReviews()
    {
        $this->db->query('SELECT suite , COUNT(suitRating) as "totalReviews" , ROUND(SUM(suitRating) / COUNT(suitRating)) as "avgReviews"  FROM reservationreview GROUP BY suite');
        $results = $this->db->resultSet();
        return $results;
    }
    public function getRefundrequests(){
        $this->db->query('SELECT * FROM refundrequest ORDER BY date DESC');
        $results = $this->db->resultSet();
        return $results;
    }
}
