<?php

    class User{
        private $db;

        public function __construct(){
            $this->db = new Database();

        }

        //find user by email. email is apassed in by controller
        public function findUserByEmail($email){
            $this->db->query("SELECT * FROM users WHERE email = :email AND account_status = 'active'");
            //bind 
            $this->db->bind(':email', $email);
            //checks if email is existing in db
            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function register($data){
            $this->db->query("INSERT INTO users (`firstname`, `middlename`, `lastname`, `suffix`, `email`, `password`, `mobile_no`, `birthdate`, `account_status`) VALUES (:fname, :mname, :lname, :suffix, :email, :password, :mobileno, :birthdate, 'active');");
            $this->db->bind(':fname', $data['firstName']);
            $this->db->bind(':mname', $data['middleName']);
            $this->db->bind(':lname', $data['lastName']);
            $this->db->bind(':suffix', $data['suffix']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':mobileno', $data['mobileNo']);
            $this->db->bind(':birthdate', $data['birthday']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        public function getUsers(){
            $this->db->query("SELECT * FROM users;");
            $result = $this->db->resultSet();
            return $result;
        }

        public function login($username, $password){
            $this->db->query("SELECT * FROM users WHERE email = :email");
            //bind value
            $this->db->bind(':email',$username);
            $row = $this->db->single();
            if(is_object($row)){
                $hashedPassword = $row->password;
                if(password_verify($password,$hashedPassword)){
                    return $row;
                }else{
                    return false;
                }
            }else{
                return false;
            }

            
        }
    }