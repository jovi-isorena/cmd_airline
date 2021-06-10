<?php

class Reservation{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function searchFlight($data){
        $this->db->query("SELECT * FROM vw_flight_info
            WHERE ((`monday` AND :monday) 
            OR (`tuesday` AND :tuesday) 
            OR (`wednesday` AND :wednesday) 
            OR (`thursday` AND :thursday) 
            OR (`friday` AND :friday) 
            OR (`saturday` AND :saturday) 
            OR (`sunday` AND :sunday))	
                AND NOT schedule_status = 'inactive' 
                AND NOT flight_status = 'inactive' 
                AND (:dept_date BETWEEN effective_start_date AND effective_end_date)
                AND (airport_origin LIKE :origin  
                    OR origin_name LIKE :originName
                    OR origin_address LIKE :originAdd)
                AND (airport_destination LIKE :destination
                    OR destination_name LIKE :destinationName
                    OR destination_address LIKE :destinationAdd)                 
            ");
        ;
        $this->db->bind(":monday", $data['monday']);
        $this->db->bind(":tuesday", $data['tuesday']);
        $this->db->bind(":wednesday", $data['wednesday']);
        $this->db->bind(":thursday", $data['thursday']);
        $this->db->bind(":friday", $data['friday']);
        $this->db->bind(":saturday", $data['saturday']);
        $this->db->bind(":sunday", $data['sunday']);
        $this->db->bind(":dept_date", $data['date']);
        $this->db->bind(":origin", "%".$data['origin']."%");
        $this->db->bind(":originName", "%".$data['origin']."%");
        $this->db->bind(":originAdd", "%".$data['origin']."%");
        $this->db->bind(":destination", "%".$data['destination']."%");
        $this->db->bind(":destinationName", "%".$data['destination']."%");
        $this->db->bind(":destinationAdd", "%".$data['destination']."%");
        print_r($this->db->stmt());
        return $this->db->resultSet();
    }
}