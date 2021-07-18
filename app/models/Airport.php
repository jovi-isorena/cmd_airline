<?php

class Airport{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function getAllActiveAirports(){
        $this->db->query("SELECT * FROM airport WHERE airport_status = 'active';");
        return $this->db->resultSet();
    }

    public function getAirportByCode($code){
        $this->db->query("SELECT * from airport WHERE airport_code = :code;");
        $this->db->bind(":code", $code);
        $row = $this->db->single();
        
        if(is_object($row)){
            return $row;
        }else{
            return false;
        }
        
    }

    public function add($data){
        $this->db->query("INSERT INTO `airport`(`airport_code`, `name`, `address`, `type`, `airport_status`) VALUES (:code,:name,:address,:type,'active');");
        $this->db->bind(":code",$data['airportCode']);
        $this->db->bind(":name",$data['name']);
        $this->db->bind(":address",$data['address']);
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
        $this->db->query("UPDATE `airport` SET`name`=:name,`address`=:address, `type`=:type WHERE `airport_code` = :code");
        $this->db->bind(":code",$data['code']);
        $this->db->bind(":name",$data['name']);
        $this->db->bind(":address",$data['address']);
        $this->db->bind(":type",$data['type']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function delete($code){
        $this->db->query("UPDATE `airport` SET`airport_status`= 'inactive' WHERE `airport_code` = :code");
        $this->db->bind(":code",$code);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function fetchAirport($term){
        $this->db->query("SELECT * FROM `airport` WHERE (airport_code LIKE :code OR name LIKE :name OR address LIKE :addr) AND (airport_status = 'active');");
        $this->db->bind(":code", "%".$term."%");
        $this->db->bind(":name", "%".$term."%");
        $this->db->bind(":addr", "%".$term."%");
        return $this->db->resultSet();
    }
}