<?php
class Customer
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getReservation($user_id, $limit = 10, $offset = 0)
    {
        $this->db->query('SELECT * FROM reservation WHERE customerID = :user_id ORDER BY date ASC LIMIT :offset, :limit');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        $results = $this->db->resultSet();
        return $results;
    }

    // Add a function to count the total number of reservations based on search criteria
    public function getTotalReservationCount($user_id)
    {
        $this->db->query('SELECT COUNT(*) as count FROM reservation WHERE customerID = :user_id ORDER BY date ASC');
        $this->db->bind(':user_id', $user_id);
        $row = $this->db->single();
        return $row->count;
    }

    public function getReservationWithSearch($user_id, $limit = 10, $offset = 0 , $search)
    {
        $this->db->query('SELECT * FROM reservation WHERE customerID = :user_id AND (status LIKE :search OR numOfPeople LIKE :search) ORDER BY date ASC LIMIT :offset, :limit');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        $this->db->bind(':search', "%$search%");
        $results = $this->db->resultSet();
        return $results;
    }

    public function getTotalReservationCountWithSearch($user_id, $search)
    {
        $this->db->query('SELECT COUNT(*) as count FROM reservation WHERE customerID = :user_id AND (status LIKE :search OR numOfPeople LIKE :search) order by date ASC');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':search', "%$search%");
        $row = $this->db->single();
        return $row->count;
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
        $this->db->query('INSERT INTO reservation (customerID, tableID, packageID, date, reservationStartTime,amount, reservationEndTime, numOfPeople,invoiceID) VALUES (:customerID, :tableID, :packageID, :date, :reservationStartTime,:amount, :reservationEndTime, :numOfPeople, InvoiceID)');
        $this->db->bind(':customerID', $data['customerID']);
        $this->db->bind(':tableID', $data['tableID']);
        $this->db->bind(':packageID', $data['packageID']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':reservationStartTime', $data['reservationStartTime']);
        $this->db->bind(':amount', $data['amount']);
        $this->db->bind(':reservationEndTime', $data['reservationEndTime']);
        $this->db->bind(':numOfPeople', $data['numOfPeople']);

        // Add other bindings for additional fields

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }




    public function removeReview($reviewID)
    {
        $this->db->query('DELETE FROM review WHERE reviewID = :reviewID');
        $this->db->bind(':reviewID', $reviewID);
        $this->db->execute();
    }

    public function getReviews($user_ID)
    {
        $this->db->query('SELECT * FROM review WHERE customerID = :user_ID ORDER BY date DESC');
        $this->db->bind(':user_ID', $user_ID);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getMenus()
    {
        $this->db->query('SELECT * FROM menuitem');
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

    public function getReservationStatus()
    {
        $this->db->query('SELECT * FROM reservationStatus');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getReservationWithStatus($user_id, $limit = 10, $offset = 0, $status)
    {
        $this->db->query('SELECT * FROM reservation WHERE customerID = :user_id AND status = :status ORDER BY date ASC LIMIT :offset, :limit');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        $this->db->bind(':status', $status);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getTotalReservationCountWithStatus($user_id, $status)
    {
        $this->db->query('SELECT COUNT(*) as count FROM reservation WHERE customerID = :user_id AND status = :status ORDER BY date ASC');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':status', $status);
        $row = $this->db->single();
        return $row->count;
    }

    public function getReservationWithDateRange($user_id, $limit = 10, $offset = 0, $startDate, $endDate)
    {
        $this->db->query('SELECT * FROM reservation WHERE customerID = :user_id AND date BETWEEN :startDate AND :endDate ORDER BY date ASC LIMIT :offset, :limit');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);
        $results = $this->db->resultSet();
        return $results;
    }
    public function getTotalReservationCountWithDateRange($user_id, $startDate, $endDate)
    {
        $this->db->query('SELECT COUNT(*) as count FROM reservation WHERE customerID = :user_id AND date BETWEEN :startDate AND :endDate ORDER BY date ASC');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);
        $row = $this->db->single();
        return $row->count;
    }

    public function getMaxDate()
    {
        $this->db->query('SELECT MAX(date) as maxDate FROM reservation');
        $row = $this->db->single();
        return $row->maxDate;
    }

    public function getMinDate()
    {
        $this->db->query('SELECT MIN(date) as minDate FROM reservation');
        $row = $this->db->single();
        return $row->minDate;
    }

    public function getReservationWithStatusAndDateRange($user_id, $limit = 10, $offset = 0, $status, $startDate, $endDate)
    {
        $this->db->query('SELECT * FROM reservation WHERE customerID = :user_id AND status = :status AND date BETWEEN :startDate AND :endDate ORDER BY date ASC LIMIT :offset, :limit');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        $this->db->bind(':status', $status);
        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getTotalReservationCountWithStatusAndDateRange($user_id, $status, $startDate, $endDate)
    {
        $this->db->query('SELECT COUNT(*) as count FROM reservation WHERE customerID = :user_id AND status = :status AND date BETWEEN :startDate AND :endDate ORDER BY date ASC');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':status', $status);
        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);
        $row = $this->db->single();
        return $row->count;
    }

    public function getReservationWithSearchStatusAndDateRange($user_id, $limit = 10, $offset = 0, $search, $status, $startDate, $endDate)
    {
        $this->db->query('SELECT * FROM reservation WHERE customerID = :user_id AND (status LIKE :search OR numOfPeople LIKE :search) AND date BETWEEN :startDate AND :endDate ORDER BY date ASC LIMIT :offset, :limit');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        $this->db->bind(':search', "%$search%");
        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getTotalReservationCountWithSearchStatusAndDateRange($user_id, $search, $status, $startDate, $endDate)
    {
        $this->db->query('SELECT COUNT(*) as count FROM reservation WHERE customerID = :user_id AND (status LIKE :search OR numOfPeople LIKE :search) AND date BETWEEN :startDate AND :endDate ORDER BY date ASC');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':search', "%$search%");
        $this->db->bind(':startDate', $startDate);
        $this->db->bind(':endDate', $endDate);
        $row = $this->db->single();
        return $row->count;
    }

}
