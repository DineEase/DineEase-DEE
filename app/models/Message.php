<?php
class Message {
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function setOTP($OTP){
        $this->db->query('INSERT INTO otp (otp) VALUES (:otp)');
        $this->db->bind(':otp', $OTP);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
}