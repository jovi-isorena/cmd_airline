<?php

class Passenger{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function add($data){
        $this->db->query("INSERT INTO `passenger`(`firstname`, `lastname`, `gender`, `birthdate`, `valid_id`, `valid_id_no`, `issuing_country`, `expiration_date`, `reservation_id`, `reserved_flight_id`, `passenger_status`) VALUES (:firstname,:lastname,:gender,:birthdate,:id,:idNo,:country,:expDate,:reservationId,:flightId,'active');");
        $this->db->bind(":firstname", $data['firstname']);
        $this->db->bind(":lastname", $data['lastname']);
        $this->db->bind(":gender", $data['gender']);
        $this->db->bind(":birthdate", $data['dob']);
        $this->db->bind(":id", $data['doctype']);
        $this->db->bind(":idNo", $data['docnumber']);
        $this->db->bind(":country", $data['issuingcountry']);
        $this->db->bind(":expDate", $data['expiration']);
        $this->db->bind(":reservationId", $data['reservationId']);
        $this->db->bind(":flightId", $data['flightId']);
        return $this->db->execute();
    }
    
    public function getMaxId(){
        $this->db->query("SELECT MAX(id) as id FROM passenger;");
        return $this->db->single()->id;
    }

    public function getAllPassengersByReservationId($id,$flight){
        $this->db->query("SELECT * FROM `passenger` WHERE `reservation_id`=:id AND `reserved_flight_id` = :flight;");
        $this->db->bind(":id", $id);
        $this->db->bind(":flight", $flight);
        return $this->db->resultSet();
    }

    public function update($data){
        $this->db->query("UPDATE `passenger` SET `firstname`=:firstname,`lastname`=:lastname,`gender`=:gender,`birthdate`=:birthdate,`valid_id`=:idtype,`valid_id_no`=:idNo,`issuing_country`=:country,`expiration_date`=:expDate,`reservation_id`=:reservationId,`reserved_flight_id`=:flightId,`passenger_status`=:stat WHERE `id`=:id;");
        $this->db->bind(":firstname", $data['firstname']);
        $this->db->bind(":lastname", $data['lastname']);
        $this->db->bind(":gender", $data['gender']);
        $this->db->bind(":birthdate", $data['birthdate']);
        $this->db->bind(":idtype", $data['valid_id']);
        $this->db->bind(":idNo", $data['valid_id_no']);
        $this->db->bind(":country", $data['issuing_country']);
        $this->db->bind(":expDate", $data['expiration_date']);
        $this->db->bind(":reservationId", $data['reservation_id']);
        $this->db->bind(":flightId", $data['reserved_flight_id']);
        $this->db->bind(":stat", $data['passenger_status']);
        $this->db->bind(":id", $data['id']);
        return $this->db->execute();
    }
}