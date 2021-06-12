<?php

class ScheduledAircraft{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function add($data){
        // $data = [
        //     'title' => 'Aircraft Schedule',
        //     'flight' => $flight,
        //     'schedule' => $schedule,
        //     'aircrafts' => $aircrafts,
        //     'aircrafts-monday' => '',
        //     'aircrafts-tuesday' => '',
        //     'aircrafts-wednesday' => '',
        //     'aircrafts-thursday' => '',
        //     'aircrafts-friday' => '',
        //     'aircrafts-saturday' => '',
        //     'aircrafts-sunday' => '',
        //     'layouts-monday' => '',
        //     'layouts-tuesday' => '',
        //     'layouts-wednesday' => '',
        //     'layouts-thursday' => '',
        //     'layouts-friday' => '',
        //     'layouts-saturday' => '',
        //     'layouts-sunday' => '',
        //     'ac-mon-err' => '',
        //     'ac-tue-err' => '',
        //     'ac-wed-err' => '',
        //     'ac-thu-err' => '',
        //     'ac-fri-err' => '',
        //     'ac-sat-err' => '',
        //     'ac-sun-err' => '',
        //     'lay-mon-err' => '',
        //     'lay-tue-err' => '',
        //     'lay-wed-err' => '',
        //     'lay-thu-err' => '',
        //     'lay-fri-err' => '',
        //     'lay-sat-err' => '',
        //     'lay-sun-err' => '',
        //     'successMessage' => ''
        // ];
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

    public function getScheduledAircraft($data){
        
    }
}