<?php

class FlightFare{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAllFlightFaresByFlight($flight_no){
        
        $this->db->query("SELECT `flight_fare`.`id`, `flight_no`, `fare_id`, `price`, `available_slots`, `status`, `fare`.name, `fare`.`class` FROM `flight_fare`, `fare` WHERE flight_no = :num  && `flight_fare`.`fare_id` = `fare`.`id` AND `status` = 'active' ORDER BY price ASC;");
        $this->db->bind(":num", $flight_no);
        return $this->db->resultSet();
    }

    public function getFlightFareById($id){
        
        $this->db->query("SELECT `flight_fare`.`id`, `flight_no`, `fare_id`, `price`, `available_slots`, `status`, `fare`.name, `fare`.`class` FROM `flight_fare`, `fare` WHERE `flight_fare`.`id` = :id && `flight_fare`.`fare_id` = `fare`.`id` ;");
        $this->db->bind(":id", $id);
        return $this->db->single();
    }

    public function isExist($data){
        $this->db->query("SELECT * FROM `flight_fare` WHERE `flight_no` = :flightNo AND `fare_id` = :fareId AND `status` = 'active'");
        $this->db->bind(":flightNo", $data['flight']->flight_no);
        $this->db->bind(":fareId", $data['fare']);
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function add($data){
        $this->db->query("INSERT INTO `flight_fare`(`flight_no`, `fare_id`, `price`, `available_slots`, `status`) VALUES (:num,:fare,:price,:slot,'active');");
        $this->db->bind(":num", $data['flight']->flight_no);
        $this->db->bind(":fare", $data['fare']);
        $this->db->bind(":price", $data['price']);
        $this->db->bind(":slot", $data['slots']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function edit($data){
        $this->db->query("UPDATE `flight_fare` SET `price`=:price,`available_slots`=:slots WHERE `id`=:id;");
        $this->db->bind(":id", $data['flightFare']->id);
        $this->db->bind(":price", $data['price']);
        $this->db->bind(":slots", $data['slots']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function delete($id){
        $this->db->query("UPDATE `flight_fare` SET `status` = 'inactive' WHERE `id`=:id;");
        $this->db->bind(":id", $id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}