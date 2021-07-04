<?php

class ReservedFlight{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function add($data){
        $this->db->query("INSERT INTO `reserved_flight`(`reservation_id`, `schedule_id`, `flight_date`, `status`) VALUES (:reservation,:schedule,:date,'active');");
        $this->db->bind(":reservation", $data['reservationId']);
        $this->db->bind(":schedule", $data['scheduleId']);
        $this->db->bind(":date", $data['flightDate']);
        return $this->db->execute();
    }

    public function getMaxId(){
        $this->db->query("SELECT MAX(id) as id FROM `reserved_flight;");
        $result = $this->db->single();
        return $result->id;
    }

    public function getFlightByReservationId($id){
        $this->db->query("SELECT * FROM `reserved_flight` WHERE `reservation_id` = :id;");
        $this->db->bind(":id", $id);
        return $this->db->resultSet();
    }
}