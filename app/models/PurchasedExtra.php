<?php

class PurchasedExtra{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function add($data){
        $this->db->query("INSERT INTO `purchased_extra`(`passenger_id`, `extra_id`, `reservation_id`, `purchased_status`) VALUES (:passenger,:extra,:reservation,'active');");
        $this->db->bind(":passenger", $data['passenger']);
        $this->db->bind(":extra", $data['extra']);
        $this->db->bind(":reservation", $data['reservation']);
        return $this->db->execute();
    }

    public function getPurchasedExtraByPassengerId($id){
        $this->db->query("SELECT * FROM `purchased_extra` WHERE `passenger_id` = :id;");
        $this->db->bind(":id", $id);
        return $this->db->resultSet();
    }
}