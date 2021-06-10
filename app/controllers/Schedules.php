<?php

class Schedules extends Controller{
    public function __construct(){
        $this->scheduleModel = $this->model('Schedule');
        $this->flightModel = $this->model('Flight');
        $this->aircraftModel = $this->model('Aircraft');
    }

    public function index($status = '%'){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $schedules = $this->scheduleModel->getAllSchedulesByStatus($status);
        $data = [
            'schedules' => $schedules,
            'status' => $status,
            'title' => 'Flight Scheduler'
        ];
        $this->view("schedules/index", $data);
    }

    public function create(){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        var_dump($_POST);
        $flights = $this->flightModel->getAllActiveFlights();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'title' => 'Create Schedule',
                'flightNumber' => trim($_POST['flightNumber']),
                'flights' => $flights,
                'time' => trim($_POST['time']),
                'gate' => trim($_POST['gate']),
                'monday' => !empty($_POST['monday']),
                'tuesday' => !empty($_POST['tuesday']),
                'wednesday' => !empty($_POST['wednesday']),
                'thursday' => !empty($_POST['thursday']),
                'friday' => !empty($_POST['friday']),
                'saturday' => !empty($_POST['saturday']),
                'sunday' => !empty($_POST['sunday']),
                'startDate' => $_POST['startDate'],
                'endDate' => $_POST['endDate'],
                'flightNumberError' => '',
                'frequencyError' => '',
                'timeError' => '',
                'gateError' => '',
                'startDateError' => '',
                'endDateError' => '',
                'successMessage' => ''
            ];

            //validate input
            if(empty($data['flightNumber'])){
                $data['flightNumberError'] = 'Please select a flight number.';
            }
            if(empty($data['monday']) && empty($data['tuesday']) && empty($data['wednesday']) && empty($data['thursday']) && empty($data['friday']) && empty($data['saturday']) && empty($data['sunday'])){
                $data['frequencyError'] = 'Required to select at least a day.';
            }
            if(empty($data['time'])){
                $data['timeError'] = 'Please select a time.';
            }
            if(empty($data['gate'])){
                $data['gateError'] = 'Please enter a gate.';
            }
            if(empty($data['startDate'])){
                $data['startDateError'] = 'Please select a date.';
            }elseif($data['startDate'] <= date('Y-m-d')){
                $data['startDateError'] = 'Please select a date after today.';
            }
            if(!empty($data['endDate']) && $data['endDate'] < $data['startDate']){
                $data['endDateError'] = 'End date cannot be earlier than the start date.';
            }
            

            //check if all errors are clear
            if(empty($data['flightNumberError']) && empty($data['timeError']) && empty($data['frequencyError']) && empty($data['gateError']) && empty($data['startDateError']) && empty($data['endDateError'])){
                // $this->airportModel->add($data);
                if($this->scheduleModel->add($data)){
                    $data['successMessage'] = "Schedule successfully added.";
                    $data['flightNumber'] = '';
                    $data['time'] = '';
                    $data['monday'] = '';
                    $data['tuesday'] = '';
                    $data['wednesday'] = '';
                    $data['thursday'] = '';
                    $data['friday'] = '';
                    $data['saturday'] = '';
                    $data['sunday'] = '';
                    $data['gate'] = '';
                    $data['startDate'] = '';
                    $data['endDate'] = '';
                }else{
                    die("Something went wrong.");
                }
            }
        }else{
            $data = [
                'title' => 'Create Schedule',
                'flightNumber' => '',
                'flights' => $flights,
                'time' => '',
                'gate' => '',
                'monday' => '',
                'tuesday' => '',
                'wednesday' => '',
                'thursday' => '',
                'friday' => '',
                'saturday' => '',
                'sunday' => '',
                'startDate' => '',
                'endDate' => '',
                'flightNumberError' => '',
                'frequencyError' => '',
                'timeError' => '',
                'gateError' => '',
                'startDateError' => '',
                'endDateError' => '',
                'successMessage' => ''
            ];
        }
        $this->view("schedules/create", $data);
    }

    public function edit($id){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $schedule = $this->scheduleModel->getScheduleById($id);
        $flights = $this->flightModel->getAllActiveFlights();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'title' => 'Edit Schedule',
                'schedule' => $schedule,
                'flightNumber' => trim($_POST['flightNumber']),
                'flights' => $flights,
                'monday' => !empty($_POST['monday']),
                'tuesday' => !empty($_POST['tuesday']),
                'wednesday' => !empty($_POST['wednesday']),
                'thursday' => !empty($_POST['thursday']),
                'friday' => !empty($_POST['friday']),
                'saturday' => !empty($_POST['saturday']),
                'sunday' => !empty($_POST['sunday']),
                'startDate' => $_POST['startDate'],
                'endDate' => $_POST['endDate'],
                'time' => trim($_POST['time']),
                'gate' => trim($_POST['gate']),
                'status' => trim($_POST['status']),
                'flightNumberError' => '',
                'frequencyError' => '',
                'timeError' => '',
                'gateError' => '',
                'startDateError' => '',
                'endDateError' => '',
                'statusError' => '',
                'successMessage' => ''
            ];

            //validate input
            if(empty($data['flightNumber'])){
                $data['flightNumberError'] = 'Please select a flight number.';
            }
            if(empty($data['monday']) && empty($data['tuesday']) && empty($data['wednesday']) && empty($data['thursday']) && empty($data['friday']) && empty($data['saturday']) && empty($data['sunday'])){
                $data['frequencyError'] = 'Required to select at least a day.';
            }
            if(empty($data['time'])){
                $data['timeError'] = 'Please select a time.';
            }
            if(empty($data['gate'])){
                $data['gateError'] = 'Please enter a gate.';
            }
            if(empty($data['startDate'])){
                $data['startDateError'] = 'Please select a date.';
            }elseif($data['startDate'] <= date('Y-m-d')){
                $data['startDateError'] = 'Please select a date after today.';
            }
            if(!empty($data['endDate']) && $data['endDate'] < $data['startDate']){
                $data['endDateError'] = 'End date cannot be earlier than the start date.';
            }
            //check if all errors are clear
            if(empty($data['flightNumberError']) && empty($data['timeError']) && empty($data['frequencyError']) && empty($data['gateError']) && empty($data['startDateError']) && empty($data['endDateError'])){
                // $this->airportModel->add($data);
                if($this->scheduleModel->edit($data)){
                    header("location: " . URLROOT . "/schedules");
                }else{
                    die("Something went wrong.");
                }
            }
        }else{
            $data = [
                'title' => 'Edit Schedule',
                'schedule' => $schedule,
                'flightNumber' => $schedule->flight_no,
                'flights' => $flights,
                'monday' => $schedule->monday,
                'tuesday' => $schedule->tuesday,
                'wednesday' => $schedule->wednesday,
                'thursday' => $schedule->thursday,
                'friday' => $schedule->friday,
                'saturday' => $schedule->saturday,
                'sunday' => $schedule->sunday,
                'startDate' => $schedule->effective_start_date,
                'endDate' => $schedule->effective_end_date,
                'time' => $schedule->departure_time,
                'gate' => $schedule->gate,
                'status' => $schedule->schedule_status,
                'flightNumberError' => '',
                'frequencyError' => '',
                'timeError' => '',
                'gateError' => '',
                'startDateError' => '',
                'endDateError' => '',
                'statusError' => '',
                'successMessage' => ''
            ];
        }
        $this->view("schedules/edit", $data);
    }

    
}