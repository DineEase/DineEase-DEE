<?php
class User {
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    // find user by email
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM Users WHERE email = :email');
        //bind value
        $this->db->bind(':email', $email);
        $row = $this->db->single();
        //check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }

    //register user
    public function register($data){
    
        $this->db->query('INSERT INTO users (name, email, dob, mobile_no, password) VALUES (:name, :email, :dob, :mobile_no, :password)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':dob', $data['dob']);
        $this->db->bind(':mobile_no', $data['mobile_no']);
        $this->db->bind(':password', $data['password']);
        

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
}