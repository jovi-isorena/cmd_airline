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
    
    public function getReservedSeatByPassengerId($id){
        $this->db->query("SELECT * FROM `reserved_seat` WHERE `passenger_id` = :id;");
        $this->db->bind(":id", $id);
        return $this->db->resultSet();
    }
}