<?php
class Extra{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAllActiveExtras(){
        $this->db->query("SELECT * FROM `extra` WHERE `extra_status` = 'active';");
        return $this->db->resultSet();

    }
    public function getAllActiveExtrasByType($type){
        $this->db->query("SELECT * FROM `extra` WHERE `extra_status` = 'active' && type LIKE :type;");
        $this->db->bind(":type", $type);
        return $this->db->resultSet();
    }
    public function getAllTypes(){
        $this->db->query("SELECT DISTINCT type FROM `extra` WHERE `extra_status` = 'active';");
        return $this->db->resultSet();
    }

    public function add($data){
        $this->db->query("INSERT INTO `extra`(`type`, `name`, `description`, `price`, `extra_status`) VALUES (:type,:name,:desc,:price,'active')");
        $this->db->bind(":type", $data['type']);
        $this->db->bind(":name", $data['name']);
        $this->db->bind(":desc", $data['description']);
        $this->db->bind(":price", $data['price']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}