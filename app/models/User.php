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
        $this->db->query('SELECT * FROM Users WHERE email = :email AND active = 1');
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
        $this->db->query('SELECT * FROM Users WHERE mobile_no = :mobile_no AND active = 1 ');
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
    
        $this->db->query('INSERT INTO users (name, email, dob, mobile_no, password, active) VALUES (:name, :email, :dob, :mobile_no, :password, 1)');
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
        $this->db->query('SELECT * FROM users WHERE mobile_no = :mobile_no AND active = 1');
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
        $this->db->query('SELECT * FROM employee WHERE user_id = :id AND delete_status = 0 AND active = 1');
        //bind value
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;

    }
    
    public function generatePasswordResetToken($email) {
        $token = bin2hex(random_bytes(32));
        $expiration = time() + 3600; // Set expiration time to 1 hour from now

        $this->db->query('INSERT INTO password_reset_tokens (email, token, expiration) VALUES (:email, :token, :expiration)');
        $this->db->bind(':email', $email);
        $this->db->bind(':token', $token);
        $this->db->bind(':expiration', $expiration);

        return $this->db->execute() ? $token : false;
    }
    public function generateactivationToken($email) {
        $token = bin2hex(random_bytes(32));
        $expiration = time() + 3600; // Set expiration time to 1 hour from now

        $this->db->query('INSERT INTO activation_tokens (email, token, expiration) VALUES (:email, :token, :expiration)');
        $this->db->bind(':email', $email);
        $this->db->bind(':token', $token);
        $this->db->bind(':expiration', $expiration);

        return $this->db->execute() ? $token : false;
    }

    // Verify the validity of the password reset token
    public function verifyPasswordResetToken($email, $token) {
        $this->db->query('SELECT * FROM password_reset_tokens WHERE email = :email AND token = :token AND expiration > :now AND used = 0');
        $this->db->bind(':email', $email);
        $this->db->bind(':token', $token);
        $this->db->bind(':now', gmdate('U'));
        //var_dump($email);
        //var_dump($token);
        $this->db->single();
        return $this->db->rowCount() > 0;
    }

    // Update the user's password after a successful password reset
    public function resetPassword($email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->db->query('UPDATE users SET password = :password WHERE email = :email AND active = 1');
        $this->db->bind(':password', $hashedPassword);
        $this->db->bind(':email', $email);

        return $this->db->execute();
    }
    public function getEmailByPasswordResetToken($token) {
        $this->db->query('SELECT email FROM password_reset_tokens WHERE token = :token AND used = 0 AND expiration > :now');
        $this->db->bind(':token', $token);
        $this->db->bind(':now', time());
    
        $row = $this->db->single();
    
        // Debugging: Check the content of $row
        //var_dump($row);
    
        // Check if $row is an object before accessing its properties
        if ($row && is_object($row)) {
            return $row->email;
        } else {
            // Debugging: Check why the email is not returned
             // Assuming the Database class has an error() method
            // Handle the case where no matching record is found
            return null;
        }
    }
    
    
    public function markPasswordResetTokenAsUsed($token) {
        $this->db->query('UPDATE password_reset_tokens SET used = 1 WHERE token = :token');
        $this->db->bind(':token', $token);

        return $this->db->execute();
    }
    public function activateEmployeeByEmail($email) {
        // Assuming $this->db represents your database connection object
    
        // Prepare and execute the SQL query
        $this->db->query('UPDATE employee 
                          SET active = 1 
                          WHERE user_id = (SELECT user_id FROM users WHERE email = :email)');
    
        // Bind the parameter
        $this->db->bind(':email', $email);
        var_dump($email);
        // Execute the query
        return $this->db->execute();
    }
    
    public function markactivationTokenAsUsed($token) {
        $this->db->query('UPDATE activation_tokens SET used = 1 WHERE token = :token');
        $this->db->bind(':token', $token);

        return $this->db->execute();
    }

    public function verifyactivationToken($email, $token) {
        $this->db->query('SELECT * FROM activation_tokens WHERE email = :email AND token = :token AND expiration > :now AND used = 0');
        $this->db->bind(':email', $email);
        $this->db->bind(':token', $token);
        $this->db->bind(':now', gmdate('U'));
        var_dump($email);
        var_dump($token);
        $this->db->single();
        return $this->db->rowCount() > 0;
    }
    public function getEmailByactivationToken($token) {
        $this->db->query('SELECT email FROM activation_tokens WHERE token = :token AND used = 0 AND expiration > :now');
        $this->db->bind(':token', $token);
        $this->db->bind(':now', time());
    
        $row = $this->db->single();
    
        // Debugging: Check the content of $row
        var_dump($row);
    
        // Check if $row is an object before accessing its properties
        if ($row && is_object($row)) {
            return $row->email;
        } else {
            // Debugging: Check why the email is not returned
             // Assuming the Database class has an error() method
            // Handle the case where no matching record is found
            return null;
        }
    }
    public function activateaccount($email) {
        $this->db->query('UPDATE users SET active = 1 WHERE email = :email');
        $this->db->bind(':email', $email);
    
        // Execute the update query
        if ($this->db->execute()) {
            return true; // Activation successful
        } else {
            return false; // Activation failed
        }
    }

    public function checkPassword($userId, $oldPassword) {
        $this->db->query('SELECT password FROM users WHERE user_id = :userId');
        $this->db->bind(':userId', $userId);
        $row = $this->db->single();
        if($row && password_verify($oldPassword, $row->password)) {
            return true;
        }
        return false;
    }

    // Method to update the user's password
    public function updatePassword($userId, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $this->db->query('UPDATE users SET password = :password WHERE user_id = :userId');
        $this->db->bind(':password', $hashedPassword);
        $this->db->bind(':userId', $userId);
        if($this->db->execute()) {
            return true;
        }
        return false;
    }

    
}