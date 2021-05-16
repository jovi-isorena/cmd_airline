<?php

class Schedules extends Controller{
    public function __construct(){
        $this->scheduleModel = $this->model('Schedule');
        $this->flightModel = $this->model('Flight');
    }

    public function index($status = '%'){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $schedules = $this->scheduleModel->getAllSchedulesByStatus($status);
        $data = [
            'schedules' => $schedules,
            'status' => $status
        ];
        $this->view("schedules/index", $data);
    }

    public function create(){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        
        $flights = $this->flightModel->getAllActiveFlights();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'flightNumber' => trim($_POST['flightNumber']),
                'flights' => $flights,
                'time' => trim($_POST['time']),
                'date' => trim($_POST['date']),
                'gate' => trim($_POST['gate']),
                'flightNumberError' => '',
                'timeError' => '',
                'dateError' => '',
                'gateError' => '',
                'successMessage' => ''
            ];

            //validate input
            if(empty($data['flightNumber'])){
                $data['flightNumberError'] = 'Please select a flight number.';
            }
            if(empty($data['time'])){
                $data['timeError'] = 'Please select a time.';
            }
            if(empty($data['date'])){
                $data['dateError'] = 'Please select a date.';
            }
            if(empty($data['gate'])){
                $data['gateError'] = 'Please enter a gate.';
            }

            //check if all errors are clear
            if(empty($data['flightNumberError']) && empty($data['timeError']) && empty($data['dateError']) && empty($data['gateError'])){
                // $this->airportModel->add($data);
                if($this->scheduleModel->add($data)){
                    $data['successMessage'] = "Schedule successfully added.";
                    $data['flightNumber'] = '';
                    $data['time'] = '';
                    $data['date'] = '';
                    $data['gate'] = '';
                }else{
                    die("Something went wrong.");
                }
            }
        }else{
            $data = [
                'flightNumber' => '',
                'flights' => $flights,
                'time' => '',
                'date' => '',
                'gate' => '',
                'flightNumberError' => '',
                'timeError' => '',
                'dateError' => '',
                'gateError' => '',
                'successMessage' => ''
            ];
        }
        $this->view("schedules/create", $data);
    }
}