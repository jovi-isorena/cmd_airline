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
        
        $this->db->bind(":monday", $data['monday']);
        $this->db->bind(":tuesday", $data['tuesday']);
        $this->db->bind(":wednesday", $data['wednesday']);
        $this->db->bind(":thursday", $data['thursday']);
        $this->db->bind(":friday", $data['friday']);
        $this->db->bind(":saturday", $data['saturday']);
        $this->db->bind(":sunday", $data['sunday']);
        $this->db->bind(":dept_date", $data['dept']->format('Y-m-d'));
        $this->db->bind(":origin", "%".$data['targetOrigin']->airport_code."%");
        $this->db->bind(":originName", "%".$data['targetOrigin']->name."%");
        $this->db->bind(":originAdd", "%".$data['targetOrigin']->address."%");
        $this->db->bind(":destination", "%".$data['targetDestination']->airport_code."%");
        $this->db->bind(":destinationName", "%".$data['targetDestination']->name."%");
        $this->db->bind(":destinationAdd", "%".$data['targetDestination']->address."%");
        // print_r($this->db->stmt());
        return $this->db->resultSet();
    }

    function getFaresByFlightClass($sched, $class){
        $this->db->query("SELECT * FROM vw_flight_prices WHERE schedule_id = :sched AND class=:class");
        $this->db->bind(":sched", $sched);
        $this->db->bind(":class", $class);
        return $this->db->resultSet();
    }

    

    function searchMinimumPrice($data){
        $this->db->query("SELECT schedule_id, flight_no, MIN(price) as 'minimum_price'
        FROM vw_flight_prices
        WHERE :date BETWEEN effective_start_date AND effective_end_date
            AND class = :class
            AND airport_origin = :origin
            AND airport_destination = :destination
            AND ((monday AND :monday)
                OR (tuesday AND :tuesday)
                OR (wednesday AND :wednesday)
                OR (thursday AND :thursday)
                OR (friday AND :friday)
                OR (saturday AND :saturday)
                OR (sunday AND :sunday))         
            ");
        // echo '<pre>';    
        // var_dump($data);
        // echo '</pre>';    
        $this->db->bind(":date", $data['targetDate']);
        $this->db->bind(":class", $data['cabinClass']);
        $this->db->bind(":origin", $data['targetOrigin']->airport_code);
        $this->db->bind(":destination", $data['targetDestination']->airport_code);
        $this->db->bind(":monday", $data['monday']);
        $this->db->bind(":tuesday", $data['tuesday']);
        $this->db->bind(":wednesday", $data['wednesday']);
        $this->db->bind(":thursday", $data['thursday']);
        $this->db->bind(":friday", $data['friday']);
        $this->db->bind(":saturday", $data['saturday']);
        $this->db->bind(":sunday", $data['sunday']);
        
        return $this->db->single();
    }
}