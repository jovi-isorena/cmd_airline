<?php

    class Employee{
        private $db;

        public function __construct(){
            $this->db = new Database();

        }

        public function findUserByEmail($email){
            $this->db->query("SELECT * FROM employee WHERE email = :email AND account_status = 'active'");
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
            $this->db->query("INSERT INTO `employee`(`firstname`, `middlename`, `lastname`, `suffix`, `email`, `password`, `position`, `account_status`) VALUES (:fname,:mname,:lname,:suffix,:email,:password,:position,'active');");
            $this->db->bind(':fname', $data['firstName']);
            $this->db->bind(':mname', $data['middleName']);
            $this->db->bind(':lname', $data['lastName']);
            $this->db->bind(':suffix', $data['suffix']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':position', $data['position']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        public function getActiveEmployees(){
            $this->db->query("SELECT * FROM users WHERE account_status = 'active';");
            $result = $this->db->resultSet();
            return $result;
        }

        public function login($username, $password){
            $this->db->query("SELECT * FROM employee WHERE email = :email");
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