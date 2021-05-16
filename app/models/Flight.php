<?php

class Flight{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function getAllActiveFlights(){
        $this->db->query("SELECT * FROM flight WHERE flight_status = 'active';");
        return $this->db->resultSet();
    }

    public function getFlightByNumber($num){
        $this->db->query("SELECT * from flight WHERE flight_no = :num;");
        $this->db->bind(":num", $num);
        $row = $this->db->single();
        
        if(is_object($row)){
            return $row;
        }else{
            return false;
        }
    }

    public function add($data){
        $this->db->query("INSERT INTO `flight`(`flight_no`, `duration_minutes`, `airport_origin`, `airport_destination`, `type`, `flight_status`) VALUES (:num,:duration,:origin,:destination,:type,'active')");
        $this->db->bind(":num",$data['flightNumber']);
        $this->db->bind(":duration",$data['duration']);
        $this->db->bind(":origin",$data['origin']);
        $this->db->bind(":destination",$data['destination']);
        $this->db->bind(":type",$data['type']);
        if($this->db->execute()){
            // echo 'rowcount';
            return true;
        }else{
            // echo 'row 0';
            return false;
        }
    }

    public function edit($data){
        $this->db->query("UPDATE `flight` SET `duration_minutes`= :duration,`airport_origin`= :origin,`airport_destination`= :destination,`type`= :type WHERE `flight_no`= :num");
        $this->db->bind(":num",$data['flight']->flight_no);
        $this->db->bind(":duration",$data['duration']);
        $this->db->bind(":origin",$data['origin']);
        $this->db->bind(":destination",$data['destination']);
        $this->db->bind(":type",$data['type']);
        if($this->db->execute()){
            // echo 'rowcount';
            return true;
        }else{
            // echo 'row 0';
            return false;
        }
    }

    public function delete($num){
        $this->db->query("UPDATE `flight` SET `flight_status` = 'inactive' WHERE `flight_no`= :num");
        $this->db->bind(":num",$num);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}