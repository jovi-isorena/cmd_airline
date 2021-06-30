<?php

class ScheduledAircrafts extends Controller{
    public function __construct(){
        $this->scheduledAircraftModel = $this->model('ScheduledAircraft');
        $this->scheduleModel = $this->model('Schedule');
        $this->flightModel = $this->model('Flight');
        $this->aircraftModel = $this->model('Aircraft');
    }

    public function aircraft($scheduleId){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $schedule = $this->scheduleModel->getScheduleById($scheduleId);
        $aircrafts = $this->aircraftModel->getAllActiveAircrafts();
        $flight = $this->flightModel->getFlightByNumber($schedule->flight_no);
        $insertData = [
            'schedule' => '',
            'day' => '',
            'aircraft' => '',
            'layout' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Aircraft Schedule',
                'flight' => $flight,
                'schedule' => $schedule,
                'aircrafts' => $aircrafts,
                'aircrafts-monday' => '',
                'aircrafts-tuesday' => '',
                'aircrafts-wednesday' => '',
                'aircrafts-thursday' => '',
                'aircrafts-friday' => '',
                'aircrafts-saturday' => '',
                'aircrafts-sunday' => '',
                'layouts-monday' => '',
                'layouts-tuesday' => '',
                'layouts-wednesday' => '',
                'layouts-thursday' => '',
                'layouts-friday' => '',
                'layouts-saturday' => '',
                'layouts-sunday' => '',
                'ac-mon-err' => '',
                'ac-tue-err' => '',
                'ac-wed-err' => '',
                'ac-thu-err' => '',
                'ac-fri-err' => '',
                'ac-sat-err' => '',
                'ac-sun-err' => '',
                'lay-mon-err' => '',
                'lay-tue-err' => '',
                'lay-wed-err' => '',
                'lay-thu-err' => '',
                'lay-fri-err' => '',
                'lay-sat-err' => '',
                'lay-sun-err' => '',
                'successMessage' => ''
            ];
            //validate inputs
            if(isset($_POST['aircrafts-monday'])){
                if(empty($_POST['aircrafts-monday']) || $_POST['aircrafts-monday'] == 0){
                    $data['ac-mon-err'] = "Please select an aircraft for Monday schedule.";
                }else{
                    $data['aircrafts-monday'] = $_POST['aircrafts-monday'];
                }
            }
            if(isset($_POST['aircrafts-tuesday'])){
                if(empty($_POST['aircrafts-tuesday']) || $_POST['aircrafts-tuesday'] == 0){
                    $data['ac-tue-err'] = "Please select an aircraft for Tuesday schedule.";
                }else{
                    $data['aircrafts-tuesday'] = $_POST['aircrafts-tuesday'];
                }
            }
            if(isset($_POST['aircrafts-wednesday'])){
                if(empty($_POST['aircrafts-wednesday']) || $_POST['aircrafts-wednesday'] == 0){
                    $data['ac-wed-err'] = "Please select an aircraft for Wednesday schedule.";
                }else{
                    $data['aircrafts-wednesday'] = $_POST['aircrafts-wednesday'];
                }
            }
            if(isset($_POST['aircrafts-thursday'])){
                if(empty($_POST['aircrafts-thursday']) || $_POST['aircrafts-thursday'] == 0){
                    $data['ac-thu-err'] = "Please select an aircraft for Thursday schedule.";
                }else{
                    $data['aircrafts-thursday'] = $_POST['aircrafts-thursday'];
                }
            }
            if(isset($_POST['aircrafts-friday'])){
                if(empty($_POST['aircrafts-friday']) || $_POST['aircrafts-friday'] == 0){
                    $data['ac-fri-err'] = "Please select an aircraft for Friday schedule.";
                }else{
                    $data['aircrafts-friday'] = $_POST['aircrafts-friday'];
                }
            }
            if(isset($_POST['aircrafts-saturday'])){
                if(empty($_POST['aircrafts-saturday']) || $_POST['aircrafts-saturday'] == 0){
                    $data['ac-sat-err'] = "Please select an aircraft for Saturday schedule.";
                }else{
                    $data['aircrafts-saturday'] = $_POST['aircrafts-saturday'];
                }
            }
            if(isset($_POST['aircrafts-sunday'])){
                if(empty($_POST['aircrafts-sunday']) || $_POST['aircrafts-sunday'] == 0){
                    $data['ac-sun-err'] = "Please select an aircraft for Sunday schedule.";
                }else{
                    $data['aircrafts-sunday'] = $_POST['aircrafts-sunday'];
                }
            }
            if(isset($_POST['layouts-monday'])){
                if(empty($_POST['layouts-monday']) || $_POST['layouts-monday'] == 0){
                    $data['lay-mon-err'] = "Please select a layout for Monday schedule.";
                }else{
                    $data['layouts-monday'] = $_POST['layouts-monday'];
                }
            }
            if(isset($_POST['layouts-tuesday'])){
                if(empty($_POST['layouts-tuesday']) || $_POST['layouts-tuesday'] == 0){
                    $data['lay-tue-err'] = "Please select a layout for Tuesday schedule.";
                }else{
                    $data['layouts-tuesday'] = $_POST['layouts-tuesday'];
                }
            }
            if(isset($_POST['layouts-wednesday'])){
                if(empty($_POST['layouts-wednesday']) || $_POST['layouts-wednesday'] == 0){
                    $data['lay-wed-err'] = "Please select a layout for Wednesday schedule.";
                }else{
                    $data['layouts-wednesday'] = $_POST['layouts-wednesday'];
                }
            }
            if(isset($_POST['layouts-thursday'])){
                if(empty($_POST['layouts-thursday']) || $_POST['layouts-thursday'] == 0){
                    $data['lay-thu-err'] = "Please select a layout for Thursday schedule.";
                }else{
                    $data['layouts-thursday'] = $_POST['layouts-thursday'];
                }
            }
            if(isset($_POST['layouts-friday'])){
                if(empty($_POST['layouts-friday']) || $_POST['layouts-friday'] == 0){
                    $data['lay-fri-err'] = "Please select a layout for Friday schedule.";
                }else{
                    $data['layouts-friday'] = $_POST['layouts-friday'];
                }
            }
            if(isset($_POST['layouts-saturday'])){
                if(empty($_POST['layouts-saturday']) || $_POST['layouts-saturday'] == 0){
                    $data['lay-sat-err'] = "Please select a layout for Saturday schedule.";
                }else{
                    $data['layouts-saturday'] = $_POST['layouts-saturday'];
                }
            }
            if(isset($_POST['layouts-sunday'])){
                if(empty($_POST['layouts-sunday']) || $_POST['layouts-sunday'] == 0){
                    $data['lay-sun-err'] = "Please select a layout for Sunday schedule.";
                }else{
                    $data['layouts-sunday'] = $_POST['layouts-sunday'];
                }
            }

            //check all errors
            if(empty($data['ac-mon-err']) && empty($data['ac-tue-err']) && empty($data['ac-wed-err']) && empty($data['ac-thu-err']) && empty($data['ac-fri-err']) && empty($data['ac-sat-err']) && empty($data['ac-sun-err']) && empty($data['lay-mon-err']) && empty($data['lay-tue-err']) && empty($data['lay-wed-err']) && empty($data['lay-thu-err']) && empty($data['lay-fri-err']) && empty($data['lay-sat-err']) && empty($data['lay-sun-err'])){
                if($data['schedule']->monday){
                    $insertData['schedule'] = $data['schedule']->schedule_id;
                    $insertData['day'] = "Monday";
                    $insertData['aircraft'] = $data['aircrafts-monday'];
                    $insertData['layout'] = $data['layouts-monday'];
                    if($this->scheduledAircraftModel->add($insertData)){
                        $data['successMessage'] = "Schedule successfully saved.";
                        
                    }else{
                        die('Something went wrong.');
                    }
                }
                if($data['schedule']->tuesday){
                    $insertData['schedule'] = $data['schedule']->schedule_id;
                    $insertData['day'] = "Tuesday";
                    $insertData['aircraft'] = $data['aircrafts-tuesday'];
                    $insertData['layout'] = $data['layouts-tuesday'];
                    if($this->scheduledAircraftModel->add($insertData)){
                        $data['successMessage'] = "Schedule successfully saved.";
                        
                    }else{
                        die('Something went wrong.');
                    }
                }
                if($data['schedule']->wednesday){
                    $insertData['schedule'] = $data['schedule']->schedule_id;
                    $insertData['day'] = "Wednesday";
                    $insertData['aircraft'] = $data['aircrafts-wednesday'];
                    $insertData['layout'] = $data['layouts-wednesday'];
                    if($this->scheduledAircraftModel->add($insertData)){
                        $data['successMessage'] = "Schedule successfully saved.";
                        
                    }else{
                        die('Something went wrong.');
                    }
                }
                if($data['schedule']->thursday){
                    $insertData['schedule'] = $data['schedule']->schedule_id;
                    $insertData['day'] = "Thursday";
                    $insertData['aircraft'] = $data['aircrafts-thursday'];
                    $insertData['layout'] = $data['layouts-thursday'];
                    if($this->scheduledAircraftModel->add($insertData)){
                        $data['successMessage'] = "Schedule successfully saved.";
                        
                    }else{
                        die('Something went wrong.');
                    }
                }
                if($data['schedule']->friday){
                    $insertData['schedule'] = $data['schedule']->schedule_id;
                    $insertData['day'] = "Friday";
                    $insertData['aircraft'] = $data['aircrafts-friday'];
                    $insertData['layout'] = $data['layouts-friday'];
                    if($this->scheduledAircraftModel->add($insertData)){
                        $data['successMessage'] = "Schedule successfully saved.";
                        
                    }else{
                        die('Something went wrong.');
                    }
                }
                if($data['schedule']->saturday){
                    $insertData['schedule'] = $data['schedule']->schedule_id;
                    $insertData['day'] = "Saturday";
                    $insertData['aircraft'] = $data['aircrafts-saturday'];
                    $insertData['layout'] = $data['layouts-saturday'];
                    if($this->scheduledAircraftModel->add($insertData)){
                        $data['successMessage'] = "Schedule successfully saved.";
                        
                    }else{
                        die('Something went wrong.');
                    }
                }
                if($data['schedule']->sunday){
                    $insertData['schedule'] = $data['schedule']->schedule_id;
                    $insertData['day'] = "Sunday";
                    $insertData['aircraft'] = $data['aircrafts-sunday'];
                    $insertData['layout'] = $data['layouts-sunday'];
                    if($this->scheduledAircraftModel->add($insertData)){
                        $data['successMessage'] = "Schedule successfully saved.";
                        
                    }else{
                        die('Something went wrong.');
                    }
                }
                
            }
        }else{
            $data = [
                'title' => 'Aircraft Schedule',
                'flight' => $flight,
                'schedule' => $schedule,
                'aircrafts' => $aircrafts,
                'aircrafts-monday' => '',
                'aircrafts-tuesday' => '',
                'aircrafts-wednesday' => '',
                'aircrafts-thursday' => '',
                'aircrafts-friday' => '',
                'aircrafts-saturday' => '',
                'aircrafts-sunday' => '',
                'layouts-monday' => '',
                'layouts-tuesday' => '',
                'layouts-wednesday' => '',
                'layouts-thursday' => '',
                'layouts-friday' => '',
                'layouts-saturday' => '',
                'layouts-sunday' => '',
                'ac-mon-err' => '',
                'ac-tue-err' => '',
                'ac-wed-err' => '',
                'ac-thu-err' => '',
                'ac-fri-err' => '',
                'ac-sat-err' => '',
                'ac-sun-err' => '',
                'lay-mon-err' => '',
                'lay-tue-err' => '',
                'lay-wed-err' => '',
                'lay-thu-err' => '',
                'lay-fri-err' => '',
                'lay-sat-err' => '',
                'lay-sun-err' => '',
                'successMessage' => ''
            ];
        }



        $this->view("scheduledAircrafts/aircraft", $data);
    }
}