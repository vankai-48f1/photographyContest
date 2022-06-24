<?php
require_once('mvc/core/DB.php');

class User
{

    private $db;

    public function __construct()
    {
        $this->db = new DB;
    }

    //Find user by email or username
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        // $this->db->bind(':username', $username); // gắn giá trị cho :username = $username (:username đại diện cho biến)
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        //Check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //Login user
    public function login($email, $password)
    {

        $row = $this->findUserByEmail($email);

        if ($row == false) return false;

        $hashedPassword = $row->password;

        // if (password_verify($password, $hashedPassword)) {
        if (md5($password) === $hashedPassword) {
            return $row;
        } else {
            return false;
        }
    }


    // Add Information
    public function addInformation($data)
    {

        $row = $this->checkUserExist($data['email']);

        if (!$row) {

            $this->db->query('INSERT INTO users (username, email, password)
            VALUES (:username, :email, :password)');

            //Bind values
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':email',  $data['email']);
            $this->db->bind(':password',  md5($data['password']));

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function checkUserExist($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email'); // Named Placeholder :email
        $this->db->bind(':email', $email); // gắn giá trị :email = $email

        $row = $this->db->single();


        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function submission($data)
    {
        if ($this->checkVote($data['user_id'])) {
            return false;
        }

        $this->db->query('INSERT INTO submission (user_id, photography_id, date)
        VALUES (:user_id, :photography_id, :date)');

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':photography_id',  $data['photography_id']);
        $this->db->bind(':date',  date('Y-m-d H:i:s', time()));

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkVote($userId)
    {
        $this->db->query('SELECT * FROM submission WHERE user_id = :user_id');
        $this->db->bind(':user_id', $userId);

        $vote = $this->db->single();

        return $vote;
    }
}
