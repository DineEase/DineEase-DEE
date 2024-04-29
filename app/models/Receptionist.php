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
        $this->db->query('SELECT * FROM reservation WHERE `packageID` = :suite AND `date` = :date AND  status != "Cancelled" AND  status != "Pending"  ORDER BY reservationStartTime ASC');
        $this->db->bind(':date', $date);
        $this->db->bind(':suite', $suite);
        $results = $this->db->resultSet();

        foreach ($results as $result) {
            $this->db->query('SELECT name FROM users WHERE user_id = :customerID');
            $this->db->bind(':customerID', $result->customerID);
            $result->customerName = $this->db->single()->name;
        }
        return $results;
    }

    public function getAllReservationsOnDateForAllSuites($date)
    {
        $this->db->query('SELECT * FROM reservation WHERE `date` = :date AND  status != "Cancelled" AND  status != "Pending"  ORDER BY reservationStartTime ASC');
        $this->db->bind(':date', $date);
        $results = $this->db->resultSet();
        $results = $this->db->resultSet();

        foreach ($results as $result) {
            $this->db->query('SELECT name FROM users WHERE user_id = :customerID');
            $this->db->bind(':customerID', $result->customerID);
            $result->customerName = $this->db->single()->name;
        }
        return $results;
    }

    // public function getSlots()
    // {
    //     $this->db->query('SELECT * FROM package');
    //     $results = $this->db->resultSet();
    //     return $results;
    // }


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

    public function createOrderForWalkIn($order)
    {
        // implement slot checking logic

        $time = new DateTime($order['slot']);
        $time->modify('+1 hour');
        $endTime = $time->format('H:i:s');
        $today = date("Y-m-d");

        $total = $order['total'];


        $this->db->query('INSERT INTO reservation (customerID, tableID, reservationStartTime, reservationEndTime, date, numOfPeople, packageID, status , amount ) VALUES (:customerID, :tableID, :reservationStartTime, :reservationEndTime, :date, :numOfPeople, :packageID, :status , :amount)');
        $this->db->bind(':customerID', "52");
        //TODO cerate table logic
        $this->db->bind(':tableID', 1);
        $this->db->bind(':reservationStartTime', $order['slot']);
        $this->db->bind(':reservationEndTime', $endTime);
        $this->db->bind(':date', $today);
        $this->db->bind(':numOfPeople', $order['numberOfGuests']);
        $this->db->bind(':packageID', $order['suitePackage']);
        $this->db->bind(':status', 'Unpaid');
        $this->db->bind(':amount', $total);
        if ($this->db->execute()) {
            $reservationID = $this->db->lastInsertId();

            $this->db->query('INSERT INTO slots (reservationID, slot , date , noofpeople) VALUES (:reservationID, :slot ,:date , :noofpeople)');
            $this->db->bind(':reservationID', $reservationID);
            $this->db->bind(':slot', $order['sloNo']);
            $this->db->bind(':date', $today);
            $this->db->bind(':noofpeople', $order['numberOfGuests']);
            $this->db->execute();

            $orderID = $reservationID . "_ORD";

            $this->db->query('INSERT INTO orders (orderItemID , reservationID, status, preparationStatus) VALUES ( :orderID ,:reservationID, "Unpaid", "Pending")');
            $this->db->bind(':orderID', $orderID);
            $this->db->bind(':reservationID', $reservationID);
            if (
                $this->db->execute()
            ) {

                $this->db->query('UPDATE reservation SET orderID = :orderID WHERE reservationID = :reservationID');
                $this->db->bind(':orderID', $orderID);
                $this->db->bind(':reservationID', $reservationID);
                $this->db->execute();

                $items = $order['items'];
                foreach ($items as $item) {
                    $this->db->query('INSERT INTO orderitem (orderNo, itemID, size, quantity , status) VALUES (:orderNo, :itemID, :size, :quantity, :status)');
                    $this->db->bind(':orderNo', $orderID);
                    $this->db->bind(':itemID', $item['itemID']);
                    $this->db->bind(':size', $item['itemSize']);
                    $this->db->bind(':quantity', $item['quantity']);
                    $this->db->bind(':status', 'Pending');
                    $this->db->execute();
                }
                return "order created successfully";
            } else {
                return "order creation failed";
            }
        } else {
            return "reservation creation failed";
        }
    }

    public function getAvailableSlotsNow($suite)
    {
        $today = date("Y-m-d");
        $time = date("H:00:00");

        $data = [
            'today' => $today,
            'time' => $time,
            'suite' => $suite

        ];

        $this->db->query('SELECT SUM(numOfPeople) as "reserved"  FROM reservation WHERE reservationStartTime = :time AND date = :today AND packageID = :suite ');
        $this->db->bind(':time', $time);
        $this->db->bind(':today', $today);
        $this->db->bind(':suite', $suite);
        $results = $this->db->single();
        if ($results->reserved == null) {
            $results->reserved = 0;
        } else {
            $results->reserved = (int)$results->reserved;
        }



        return $results->reserved;
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

    public function markCompleted($orderID)
    {
        $this->db->query('UPDATE reservation SET status = "Completed" WHERE orderID = :orderID');
        $this->db->bind(':orderID', $orderID);
        $result =  $this->db->execute();
        return $result;
    }

    public function getOrders()
    {

        $today = date("Y-m-d");

        $this->db->query('SELECT reservationID ,customerID, tableID , reservationStartTime , orderID  , amount FROM reservation where (status =  "Paid" OR status =  "Unpaid")  and date = :today ORDER BY reservationStartTime ASC');
        $this->db->bind(':today', $today);
        $row1 = $this->db->resultSet();


        foreach ($row1 as $row) {
            $this->db->query('SELECT amount FROM payment WHERE reservationID = :reservationID');
            $this->db->bind(':reservationID', $row->reservationID);
            $row2 = $this->db->single();
            if ($row2) {
                $row->amountPaid = $row2->amount;
            } else {
                $row->amountPaid = 0;
            }
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

    public function addItemsToOrder($data)
    {
        $this->db->query('SELECT * FROM reservation WHERE  orderID = :orderID');
        $this->db->bind(':orderID', $data['orderID']);
        $reservation = $this->db->single();

        $this->db->query('SELECT * FROM orders WHERE orderItemID = :orderID');
        $this->db->bind(':orderID', $data['orderID']);
        $order = $this->db->single();

        if ($order->preparationStatus == 'Completed') {
            $this->db->query('UPDATE orders SET preparationStatus = "Active" WHERE orderItemID = :orderID');
            $this->db->bind(':orderID', $data['orderID']);
            $this->db->execute();
        }

        foreach ($data['items'] as $item) {
            $this->db->query('INSERT INTO orderitem (orderNo , itemID , size , quantity ,status, itemProcessingStatus) VALUES (:orderNo , :itemID , :size , :quantity , :status , :itemProcessingStatus)');
            $this->db->bind(':orderNo', $data['orderID']);
            $this->db->bind(':itemID', $item['itemID']);
            $this->db->bind(':size', $item['itemSize']);
            $this->db->bind(':quantity', $item['quantity']);
            $this->db->bind(':status', $order->preparationStatus);
            if ($order->preparationStatus == 'Active') {
                $this->db->bind(':itemProcessingStatus', 'Queued');
            } else {
                $this->db->bind(':itemProcessingStatus', 'Pending');
            }
            if ($this->db->execute()) {
            } else {
                return "Failed to add items to order";;
            }
        }

        $this->db->query('UPDATE reservation SET amount =:total WHERE orderID = :orderID');
        $this->db->bind(':total', $data['totalBill']);
        $this->db->bind(':orderID', $data['orderID']);
        if ($this->db->execute()) {
            return "Items added to order successfully";
        } else {
            return "Failed to update order total amount";
        }
    }
    function getSuites()
    {
        $this->db->query('SELECT * FROM package');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getReservationDetailsByID($reservationID)
    {

        $this->db->query('SELECT * FROM reservation WHERE reservationID = :reservationID');
        $this->db->bind(':reservationID', $reservationID);
        $row1 = $this->db->single();

        $this->db->query('SELECT * FROM reservationreview WHERE reservationID = :reservationID');
        $this->db->bind(':reservationID', $reservationID);
        if ($this->db->single()) {
            $row1->review = 1;
        } else {
            $row1->review = 0;
        }

        $this->db->query('SELECT * FROM orderitem WHERE orderNO = :orderNO');
        $this->db->bind(':orderNO', $row1->orderID);
        $row2 = $this->db->resultSet();

        foreach ($row2 as $item) {
            $this->db->query('SELECT * FROM menuitem WHERE itemID = :itemID');
            $this->db->bind(':itemID', $item->itemID);
            $row3 = $this->db->single();
            $item->itemName = $row3->itemName;
            $item->imagePath = $row3->imagePath;
        }

        foreach ($row2 as $item) {
            $this->db->query('SELECT * FROM menuprices WHERE ItemID = :itemID AND itemSize = :size');
            $this->db->bind(':itemID', $item->itemID);
            $this->db->bind(':size', $item->size);
            $row4 = $this->db->single();
            if ($row4) {
                $item->price = $row4->ItemPrice;
            } else {
                $this->db->query('SELECT * FROM menuprices WHERE ItemID = :itemID AND itemSize = "Regular"');
                $this->db->bind(':itemID', $item->itemID);
                $row5 = $this->db->single();
                $item->price = $row5->ItemPrice;
            }
        }

        $data[0] = $row1;
        $data[1] = $row2;

        return $data;
    }

    public function markArrived($reservationID)
    {
        $this->db->query('UPDATE reservation SET hasArrived = 1 WHERE reservationID = :reservationID');
        $this->db->bind(':reservationID', $reservationID);
        $result =  $this->db->execute();
        return $result;
    }

    public function cancelLateReservation($reservationID)
    {
        $this->db->query('UPDATE reservation SET status = "Cancelled" WHERE reservationID = :reservationID');
        $this->db->bind(':reservationID', $reservationID);
        if ($result =  $this->db->execute()) {
            $this->db->query('SELECT orderID FROM reservation WHERE reservationID = :reservationID');
            $this->db->bind(':reservationID', $reservationID);
            $orderID = $this->db->single()->orderID;
            $this->db->query('UPDATE orders SET status = "Cancelled" WHERE orderItemID = :orderID');
            $this->db->bind(':orderID', $orderID);
            if ($this->db->execute()) {

                $this->db->query('SELECT * FROM orderitem WHERE orderNo = :orderID');
                $this->db->bind(':orderID', $orderID);
                $items = $this->db->resultSet();
                foreach ($items as $item) {
                    $this->db->query('UPDATE orderitem SET status = "Cancelled" WHERE orderNo = :orderID AND itemID = :itemID');
                    $this->db->bind(':orderID', $orderID);
                    $this->db->bind(':itemID', $item->itemID);
                    $this->db->execute();
                }
                $this->db->query('DELETE FROM slots WHERE reservationID = :reservationID');
                $this->db->bind(':reservationID', $reservationID);
                if ($this->db->execute()) {
                    return true;
                }
            }
            return "Failed to cancel order";
        }
        return "Failed to cancel reservation";
    }

    public function getPackageCapacity()
    {

        $this->db->query('SELECT packageID, SUM(capacity) AS total_capacity
        FROM `tables`
        GROUP BY packageID;');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getReservationMarkedArrivedStatus($reservationID)
    {
        $this->db->query('SELECT hasArrived FROM reservation WHERE reservationID = :reservationID');
        $this->db->bind(':reservationID', $reservationID);
        $result = $this->db->single();
        return $result;
    }

}
