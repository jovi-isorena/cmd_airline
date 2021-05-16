<?php 

class Schedule{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function getAllSchedules(){
        $this->db->query("SELECT * FROM flight_schedule ORDER BY flight_no ASC;");
        return $this->db->resultSet();
    }

    public function getAllSchedulesByStatus($status){
        $this->db->query("SELECT * FROM flight_schedule WHERE schedule_status LIKE :status  ORDER BY flight_no ASC;");
        $this->db->bind(":status", $status);
        return $this->db->resultSet();
    }

    public function add($data){
        $this->db->query("INSERT INTO `flight_schedule` (`flight_no`, `departure_time`, `departure_date`, `gate`, `schedule_status`) VALUES (:num, :time, :date, :gate, 'Scheduled');");
        // INSERT INTO `flight_schedule` (`schedule_id`, `flight_no`, `departure_time`, `departure_date`, `gate`, `schedule_status`) VALUES (NULL, '11111', '05:30:00', '2021-05-18', 'A2', 'Scheduled');
        $this->db->bind(":num", $data['flightNumber']);
        $this->db->bind(":time", $data['time']);
        $this->db->bind(":date", $data['date']);
        $this->db->bind(":gate", $data['gate']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}