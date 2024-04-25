<?php
class Receptionist
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

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

    public function getReservationWithSearch($limit = 10, $offset = 0, $search)
    {
        $this->db->query('SELECT * FROM reservation WHERE  (status LIKE :search OR numOfPeople LIKE :search) ORDER BY date ASC LIMIT :offset, :limit');
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        $this->db->bind(':search', "%$search%");
        $results = $this->db->resultSet();
        return $results;
    }
    public function getTotalReservationCountWithSearch($search)
    {
        $this->db->query('SELECT COUNT(*) as count FROM reservation WHERE (status LIKE :search OR numOfPeople LIKE :search) order by date ASC');
        $this->db->bind(':search', "%$search%");
        $row = $this->db->single();
        return $row->count;
    }

    public function getReservationWithStatus($limit = 10, $offset = 0, $status)
    {
        $this->db->query('SELECT * FROM reservation WHERE status = :status ORDER BY date ASC LIMIT :offset, :limit');
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        $this->db->bind(':status', $status);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getTotalReservationCountWithStatus($status)
    {
        $this->db->query('SELECT COUNT(*) as count FROM reservation WHERE status = :status ORDER BY date ASC');
        $this->db->bind(':status', $status);
        $row = $this->db->single();
        return $row->count;
    }

    public function getReservationWithDateRange($limit = 10, $offset = 0, $startDate, $endDate)
    {
        $this->db->query('SELECT * FROM reservation WHERE date BETWEEN :startDate AND :endDate ORDER BY date ASC LIMIT :offset, :limit');
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);
        $results = $this->db->resultSet();
        return $results;
    }
    public function getTotalReservationCountWithDateRange($startDate, $endDate)
    {
        $this->db->query('SELECT COUNT(*) as count FROM reservation WHERE date BETWEEN :startDate AND :endDate ORDER BY date ASC');
        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);
        $row = $this->db->single();
        return $row->count;
    }


    public function getReservationWithStatusAndDateRange($limit = 10, $offset = 0, $status, $startDate, $endDate)
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
    public function getTotalReservationCountWithStatusAndDateRange($status, $startDate, $endDate)
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
    public function getRefundrequests()
    {
        $this->db->query('SELECT * FROM refundrequest ORDER BY date DESC');
        $results = $this->db->resultSet();
        return $results;
    }

    public function markCompleted($orderID){
        $this->db->query('UPDATE reservation SET status = "Completed" WHERE orderID = :orderID');
        $this->db->bind(':orderID', $orderID);
        $result =  $this->db->execute();
        return $result;
    }

    public function getOrders()
    {

        $today = date("Y-m-d");

        $this->db->query('SELECT reservationID ,customerID, tableID , reservationStartTime , orderID  , amount FROM reservation where status =  "Paid" and date = :today ORDER BY reservationStartTime ASC');
        $this->db->bind(':today', $today);
        $row1 = $this->db->resultSet();

        foreach ($row1 as $row) {
            $this->db->query('SELECT amount FROM payment WHERE reservationID = :reservationID');
            $this->db->bind(':reservationID', $row->reservationID);
            $row2 = $this->db->single();
            $row->amountPaid = $row2->amount;   
        }


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
}
