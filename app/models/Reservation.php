<?php

class Reservation{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getMaxId(){
        $this->db->query("SELECT MAX(reservation_id) as id FROM `flight_reservation;");
        $result = $this->db->single();
        return $result->id;
    }

    public function add($data){
        $this->db->query("INSERT INTO `flight_reservation`(`creation_date`, `total_fare`, `cabin_class`, `creator_account_id`, `reservation_status`) VALUES (:date, :fare, :class, :creator, 'active');");
        $this->db->bind(":date", $data['reservation']['creationDate']);
        $this->db->bind(":fare", $data['reservation']['totalFare']);
        $this->db->bind(":class", $data['reservation']['cabinClass']);
        $this->db->bind(":creator", $data['reservation']['creator']);
        return $this->db->execute();
    }
    public function update($data){
        $this->db->query("UPDATE `flight_reservation` SET `creation_date`=:date,`total_fare`=:fare,`cabin_class`=:class,`creator_account_id`=:creator,`reservation_status`=:stat WHERE `reservation_id`=:id");
        $this->db->bind(":date", $data['creation_date']);
        $this->db->bind(":fare", $data['total_fare']);
        $this->db->bind(":class", $data['cabin_class']);
        $this->db->bind(":creator", $data['creator_account_id']);
        $this->db->bind(":stat", $data['reservation_status']);
        $this->db->bind(":id", $data['reservation_id']);
        return $this->db->execute();
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

    public function searchFlightRebook($data){
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
            AND (airport_origin LIKE :origin)
            AND (airport_destination LIKE :destination)                 
            ");
        
        $this->db->bind(":monday", $data['monday']);
        $this->db->bind(":tuesday", $data['tuesday']);
        $this->db->bind(":wednesday", $data['wednesday']);
        $this->db->bind(":thursday", $data['thursday']);
        $this->db->bind(":friday", $data['friday']);
        $this->db->bind(":saturday", $data['saturday']);
        $this->db->bind(":sunday", $data['sunday']);
        $this->db->bind(":dept_date", $data['selectedDate']->format('Y-m-d'));
        $this->db->bind(":origin", "%".$data['targetOrigin']."%");
        // $this->db->bind(":originName", "%".$data['targetOrigin']->name."%");
        // $this->db->bind(":originAdd", "%".$data['targetOrigin']->address."%");
        $this->db->bind(":destination", "%".$data['targetDestination']."%");
        // $this->db->bind(":destinationName", "%".$data['targetDestination']->name."%");
        // $this->db->bind(":destinationAdd", "%".$data['targetDestination']->address."%");
        // print_r($this->db->stmt());
        return $this->db->resultSet();
    }

    function getFaresByFlightClass($sched, $class){
        $this->db->query("SELECT * FROM vw_flight_prices WHERE schedule_id = :sched AND class=:class");
        $this->db->bind(":sched", $sched);
        $this->db->bind(":class", $class);
        return $this->db->resultSet();
    }

    function getFaresByFareId($sched, $fareId){
        $this->db->query("SELECT * FROM vw_flight_prices WHERE schedule_id = :sched AND fare_id=:fareId");
        $this->db->bind(":sched", $sched);
        $this->db->bind(":fareId", $fareId);
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
    function searchMinimumPriceRebook($data){
        $this->db->query("SELECT schedule_id, flight_no, MIN(price) as 'minimum_price'
        FROM vw_flight_prices
        WHERE :date BETWEEN effective_start_date AND effective_end_date
            AND fare_id = :fareId
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
        $this->db->bind(":fareId", $data['reservedFlight']->fareDetail->fare_id);
        $this->db->bind(":origin", $data['targetOrigin']);
        $this->db->bind(":destination", $data['targetDestination']);
        $this->db->bind(":monday", $data['monday']);
        $this->db->bind(":tuesday", $data['tuesday']);
        $this->db->bind(":wednesday", $data['wednesday']);
        $this->db->bind(":thursday", $data['thursday']);
        $this->db->bind(":friday", $data['friday']);
        $this->db->bind(":saturday", $data['saturday']);
        $this->db->bind(":sunday", $data['sunday']);
        
        return $this->db->single();
    }

    public function getAllBookingsByUser($id){
        $this->db->query("SELECT * FROM `flight_reservation` WHERE `creator_account_id`=:id;");
        $this->db->bind(":id", $id);
        return $this->db->resultSet();
    }

    public function getReservationById($id){
        $this->db->query("SELECT * FROM `flight_reservation` WHERE `reservation_id`=:id;");
        $this->db->bind(":id", $id);
        return $this->db->single();
    }
}