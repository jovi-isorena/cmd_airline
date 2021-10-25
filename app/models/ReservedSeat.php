<?php

class ReservedSeat{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function add($data){
        $this->db->query("INSERT INTO `reserved_seat`(`reserved_flight_id`, `passenger_id`, `seat_number`, `status`) VALUES (:resFlight,:passenger,:seatNumber,'active');");
        $this->db->bind(":resFlight", $data['resFlight']);
        $this->db->bind(":passenger", $data['passenger']);
        $this->db->bind(":seatNumber", $data['seatNumber']);
        return $this->db->execute();
    }
    
    public function update($data){
        $this->db->query("UPDATE `reserved_seat` SET `reserved_flight_id`=:resFlight,`passenger_id`=:passenger,`seat_number`=:seatNumber,`status`=:stat WHERE `reserved_seat_id`=:id;");
        $this->db->bind(":resFlight", $data['reserved_flight_id']);
        $this->db->bind(":passenger", $data['passenger_id']);
        $this->db->bind(":seatNumber", $data['seat_number']);
        $this->db->bind(":stat", $data['status']);
        $this->db->bind(":id", $data['reserved_seat_id']);
        return $this->db->execute();
    }

    public function getReservedSeatByPassengerId($id){
        $this->db->query("SELECT * FROM `reserved_seat` WHERE `passenger_id` = :id;");
        $this->db->bind(":id", $id);
        return $this->db->resultSet();
    }

    //input: schedule id, flight date and 
    public function takenSeatInFlight($schedule, $date){

    }
}