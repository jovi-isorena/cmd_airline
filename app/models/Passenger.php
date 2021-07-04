<?php

class Passenger{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function add($data){
        $this->db->query("INSERT INTO `passenger`(`firstname`, `lastname`, `gender`, `birthdate`, `valid_id`, `valid_id_no`, `issuing_country`, `expiration_date`, `reservation_id`, `passenger_status`) VALUES (:firstname,:lastname,:gender,:birthdate,:id,:idNo,:country,:expDate,:reservationId,'active');");
        $this->db->bind(":firstname", $data['firstname']);
        $this->db->bind(":lastname", $data['lastname']);
        $this->db->bind(":gender", $data['gender']);
        $this->db->bind(":birthdate", $data['dob']);
        $this->db->bind(":id", $data['doctype']);
        $this->db->bind(":idNo", $data['docnumber']);
        $this->db->bind(":country", $data['issuingcountry']);
        $this->db->bind(":expDate", $data['expiration']);
        $this->db->bind(":reservationId", $data['reservationId']);
        return $this->db->execute();
    }
    
    public function getMaxId(){
        $this->db->query("SELECT MAX(id) as id FROM passenger;");
        return $this->db->single()->id;
    }
}