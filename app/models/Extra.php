<?php
class Extra{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAllActiveExtras(){
        $this->db->query("SELECT * FROM `extra` WHERE `extra_status` = 'active' ORDER BY type, price ASC;");
        return $this->db->resultSet();

    }
    public function getAllActiveExtrasByType($type){
        $this->db->query("SELECT * FROM `extra` WHERE `extra_status` = 'active' && type LIKE :type ORDER BY price ASC;");
        $this->db->bind(":type", $type);
        return $this->db->resultSet();
    }
    public function getAllTypes(){
        $this->db->query("SELECT DISTINCT type FROM `extra` WHERE `extra_status` = 'active';");
        return $this->db->resultSet();
    }

    public function getExtraById($id){
        $this->db->query("SELECT * FROM `extra` WHERE `id` = :id;");
        $this->db->bind(":id",$id);
        $row = $this->db->single();
        if(is_object($row)){
            return $row;
        }else{
            return false;
        }
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
    public function edit($data){
        $this->db->query("UPDATE `extra` SET `type`=:type,`name`=:name,`description`=:desc,`price`=:price WHERE `id`=:id");
        $this->db->bind(":type", $data['type']);
        $this->db->bind(":name", $data['name']);
        $this->db->bind(":desc", $data['description']);
        $this->db->bind(":price", $data['price']);
        $this->db->bind(":id", $data['extra']->id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function delete($id){
        $this->db->query("UPDATE `extra` SET `extra_status` = 'inactive' WHERE `id`=:id");
        $this->db->bind(":id", $id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}