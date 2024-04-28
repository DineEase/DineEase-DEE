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

    public function verifyPassword($user_id, $old_pswd)
    {
        $this->db->query('SELECT password FROM users WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $row = $this->db->single();
        $hashed_password = $row->password;
        if (password_verify($old_pswd, $hashed_password)) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePassword($user_id, $hashed_password)
    {
        $this->db->query('UPDATE users SET password = :password WHERE user_id = :user_id');
        $this->db->bind(':password', $hashed_password);
        $this->db->bind(':user_id', $user_id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUser($user_id, $data, $role)
    {
        $this->db->query('UPDATE users SET name = :name, email = :email, mobile_no = :mobile_no WHERE user_id = :user_id');
        $this->db->bind(':name', $data['user_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':mobile_no', $data['mobile_no']);
        $this->db->bind(':user_id', $user_id);
        if ($this->db->execute()) {

            if ($role != 'Customer') {
            
                $this->db->query('UPDATE employee SET address = :address WHERE user_id = :user_id');
                $this->db->bind(':address', $data['address']);
                $this->db->bind(':user_id', $user_id);
                if ($this->db->execute()) {
                    return true;
                } else {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }
}
