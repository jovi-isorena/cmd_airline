<?php

class ScheduledAircraft{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function add($data){
        $this->db->query("INSERT INTO `scheduled_aircraft`(`schedule_id`, `day`, `aircraft_id`, `layout_id`) VALUES (:schedule,:day,:aircraft,:layout)");
        $this->db->bind(":schedule",$data['schedule']);
        $this->db->bind(":day",$data['day']);
        $this->db->bind(":aircraft",$data['aircraft']);
        $this->db->bind(":layout",$data['layout']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function edit($data){

    }

    public function delete($data){

    }

    public function isExisting($data){

    }

    public function getScheduledAircraft($sched_id, $day){
        $this->db->query("SELECT * FROM `scheduled_aircraft` WHERE `schedule_id` = :sched AND `day` = :day;");
        $this->db->bind(":sched", $sched_id);
        $this->db->bind(":day", $day);
        return $this->db->single();
    }
    
}