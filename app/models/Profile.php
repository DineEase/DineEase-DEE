<?php
class Profile
{
    private $db;
    public function __construct()
    {

        $this->db = new Database;
    }

    public function updateProfilePhoto($user, $photo)
    {
        $this->db->query('UPDATE users SET imagePath = :photo WHERE user_id = :user');
        $this->db->bind(':photo', $photo);
        $this->db->bind(':user', $user);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
