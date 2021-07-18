<?php

class Test{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function getAirport($term){
        $this->db->query("SELECT * FROM `airport` WHERE (airport_code LIKE :code OR name LIKE :name OR address LIKE :addr) AND (airport_status = 'active');");
        $this->db->bind(":code", "%".$term."%");
        $this->db->bind(":name", "%".$term."%");
        $this->db->bind(":addr", "%".$term."%");
        return $this->db->resultSet();
    }
}