<?php

class Fare{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAllActiveFares(){
        $this->db->query("SELECT * FROM fare WHERE fare_status = 'active';");
        return $this->db->resultSet();
    }
}