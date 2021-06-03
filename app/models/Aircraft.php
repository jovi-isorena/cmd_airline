<?php 

class Aircraft{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAllActiveAircrafts(){
        $this->db->query("SELECT * FROM aircraft WHERE `status` = 'active';");
        return $this->db->resultSet();
    }

    public function getAircraftById($id){
        $this->db->query("SELECT * FROM aircraft WHERE `id` = :id;");
        $this->db->bind(":id",$id);
        return $this->db->single();
    }

    public function isExisting($name){
        $this->db->query("SELECT * FROM aircraft WHERE `name` = :name AND `status` = 'active';");
        $this->db->bind(":name",$name);
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function add($data){
        $this->db->query("INSERT INTO `aircraft`(`name`, `status`) VALUES (:name, 'active');");
        $this->db->bind(":name",$data['name']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function edit($data){
        $this->db->query("UPDATE `aircraft` SET `name`= :name WHERE `id`= :id;");
        $this->db->bind(":name",$data['name']);
        $this->db->bind(":id",$data['aircraft']->id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function delete($id){
        $this->db->query("UPDATE `aircraft` SET `status`= 'inactive' WHERE `id`= :id;");
        $this->db->bind(":id",$id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}