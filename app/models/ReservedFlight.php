<?php

class ReservedFlight{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function add($data){
        $this->db->query("INSERT INTO `reserved_flight`(`reservation_id`, `schedule_id`, `fare_id`, `flight_date`, `status`) VALUES (:reservation,:schedule,:fareId,:date,'active');");
        $this->db->bind(":reservation", $data['reservationId']);
        $this->db->bind(":schedule", $data['scheduleId']);
        $this->db->bind(":date", $data['flightDate']);
        $this->db->bind(":fareId", $data['fareId']);
        return $this->db->execute();
    }

    public function getMaxId(){
        $this->db->query("SELECT MAX(id) as id FROM `reserved_flight;");
        $result = $this->db->single();
        return $result->id;
    }

    public function getFlightByReservationId($id){
        $this->db->query("SELECT * FROM `reserved_flight` WHERE `reservation_id` = :id AND `status` = 'active';");
        $this->db->bind(":id", $id);
        return $this->db->resultSet();
    }
    public function getFlightById($id){
        $this->db->query("SELECT * FROM `reserved_flight` WHERE `id` = :id AND `status` = 'active';");
        $this->db->bind(":id", $id);
        return $this->db->single();
    }
}