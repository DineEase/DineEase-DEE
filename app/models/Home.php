<?php
class Home
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

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

    public function getSlots($date)
    {
        $this->db->query('SELECT slot , SUM(noofpeople) as slotCapacity FROM slots WHERE date = :date GROUP BY slot ORDER BY slot;');
        $this->db->bind(':date', $date);
        $results = $this->db->resultSet();
        return $results;
    }


}