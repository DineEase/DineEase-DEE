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
    public function findUserByMobile($mobile_no)
    {
        $this->db->query('SELECT * FROM Users WHERE mobile_no = :mobile_no');
        //bind value
        $this->db->bind(':mobile_no', $mobile_no);
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

    //login user
    public function login($mobile_no, $password)
    {
        $this->db->query('SELECT * FROM users WHERE mobile_no = :mobile_no');
        $this->db->bind(':mobile_no', $mobile_no);
        $row = $this->db->single();
        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }
    public function getStaff($mobile_no, $password)
    {
        $this->db->query('SELECT * FROM staff WHERE mobile_no = :mobile_no');
        $this->db->bind(':mobile_no', $mobile_no);
        $row = $this->db->single();
        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }

    //find user by id
    public function getEmployeeById($id)
    { 
        $this->db->query('SELECT * FROM employee WHERE user_id = :id');
        //bind value
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;

    }
    

}