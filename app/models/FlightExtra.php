<?php

class FlightExtra{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function getBaggageByFlightNo($flight_no){

    }
    public function getMealByFlightNo($flight_no){
        
    }
    public function getRoamingByFlightNo($flight_no){
        
    }
    public function getFlightExtraById($id){
        $this->db->query("SELECT * FROM `flight_extra` WHERE id = :id;");
        $this->db->bind(":id", $id);
        return $this->db->single();
    }
    public function getFlightExtrasByFlightNo($flight_no){
        $this->db->query("SELECT a.`id`, `flight_no`, `extra_id`, b.`type`, b.`name`, b.`description`, b.`price`, a.`status` FROM `flight_extra` a, `extra` b WHERE a.`extra_id` = b.`id` AND `flight_no` = :flight AND `status` = 'active';");
        $this->db->bind(":flight", $flight_no);
        return $this->db->resultSet();
    }
    public function isExist($flightNo, $extraId){
        $this->db->query("SELECT * FROM `flight_extra` WHERE `flight_no` = :flight AND `extra_id` = :extra AND `status` = 'active';");
        $this->db->bind(":flight",$flightNo);
        $this->db->bind(":extra",$extraId);
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function add($data){
        $this->db->query("INSERT INTO `flight_extra`(`flight_no`, `extra_id`, `status`) VALUES (:num,:id,'active');");
        $this->db->bind(":num",$data['flightNo']);
        $this->db->bind(":id",$data['extraId']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function delete($id){
        $this->db->query("DELETE FROM `flight_extra` WHERE `id`=:id;");
        $this->db->bind(":id",$id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}