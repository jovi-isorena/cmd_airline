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

    public function getFareById($id){
        $this->db->query("SELECT * FROM fare WHERE id = :id;");
        $this->db->bind(":id", $id);
        $row = $this->db->single();
        if(is_object($row)){
            return $row;
        }else{
            return false;
        }
    }
    public function add($data){
        $this->db->query("INSERT INTO `fare`(`name`, `class`, `checked_baggage`, `flight_date_change`, `cancellation_before_depart`, `no_show_fee`, `mileage_accrual`, `fare_status`) VALUES (:name,:class,:baggage,:dateChange,:cancel,:noShow,:accrual,'active')");
        $this->db->bind(":name",$data['name']);
        $this->db->bind(":class",$data['class']);
        $this->db->bind(":baggage",$data['baggage']);
        $this->db->bind(":dateChange",$data['dateChange']);
        $this->db->bind(":cancel",$data['cancelFee']);
        $this->db->bind(":noShow",$data['noShowFee']);
        $this->db->bind(":accrual",$data['accrual']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function edit($data){
        $this->db->query("UPDATE `fare` SET `name`=:name,`class`=:class,`checked_baggage`=:baggage,`flight_date_change`=:dateChange,`cancellation_before_depart`=:cancel,`no_show_fee`=:noShow,`mileage_accrual`=:accrual WHERE `id`=:id");
        $this->db->bind(":name",$data['name']);
        $this->db->bind(":class",$data['class']);
        $this->db->bind(":baggage",$data['baggage']);
        $this->db->bind(":dateChange",$data['dateChange']);
        $this->db->bind(":cancel",$data['cancelFee']);
        $this->db->bind(":noShow",$data['noShowFee']);
        $this->db->bind(":accrual",$data['accrual']);
        $this->db->bind(":id",$data['fare']->id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function delete($id){
        $this->db->query("UPDATE `fare` SET `fare_status`='inactive' WHERE `id`=:id");
        $this->db->bind(":id",$id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}