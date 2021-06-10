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
        $this->db->query("INSERT INTO `aircraft`(`name`, `model`, `passenger_capacity`, `status`) VALUES (:name, :model, :capacity,'active');");
        $this->db->bind(":name",$data['name']);
        $this->db->bind(":model",$data['model']);
        $this->db->bind(":capacity",$data['capacity']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function edit($data){
        $this->db->query("UPDATE `aircraft` SET `name`= :name, `model`=:model, `passenger_capacity`=:capacity WHERE `id`= :id;");
        $this->db->bind(":name",$data['name']);
        $this->db->bind(":model",$data['model']);
        $this->db->bind(":capacity",$data['capacity']);
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