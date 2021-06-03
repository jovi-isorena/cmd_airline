<?php

class SeatLayout{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getLayoutsByAircraft($aircraftId){
        $this->db->query("SELECT * FROM `seat_layout` WHERE `aircraft_id` = :id AND `status` = 'active';");
        $this->db->bind(":id", $aircraftId);
        return $this->db->resultSet();
    }

    public function add($data){
        $this->db->query("INSERT INTO `seat_layout`(`name`, `layout`, `aircraft_id`, `status`) VALUES (:name,:layout,:aircraft,'active');");
        $this->db->bind(":layout", $data['layout']);
        $this->db->bind(":aircraft", $data['aircraft']);
        $this->db->bind(":name", $data['name']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
        
    }

    public function getLayoutById($id){
        $this->db->query("SELECT * FROM `seat_layout` WHERE `id` = :id;");
        $this->db->bind(":id", $id);
        return $this->db->single();
    }
}