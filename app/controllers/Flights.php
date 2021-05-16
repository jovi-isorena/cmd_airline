<?php

class Flights extends Controller{
    public function __construct(){
        $this->flightModel = $this->model('Flight');
        $this->airportModel = $this->model('Airport');
    }

    public function index(){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $flights = $this->flightModel->getAllActiveFlights();
        $data = [
            'flights' => $flights,
            'title' => 'Flight Maintenance'
        ];
        $this->view('flights/index', $data);
    }

    public function create(){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $airports = $this->airportModel->getAllActiveAirports();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if($this->airportModel->getAirportByCode( $_POST['origin'])->type == "International" || $this->airportModel->getAirportByCode( $_POST['destination'])->type == "International"){
                $type = "International";
            }else{
                $type = "Local";
            }
            $data = [
                'title' => 'Create Flight',
                'flightNumber' => trim($_POST['flightNumber']),
                'duration' => $_POST['duration'],
                'origin' => $_POST['origin'],
                'destination' => $_POST['destination'],
                'type' => $type,
                'airports' => $airports,
                'flightNumberError' => '',
                'durationError' => '',
                'originError' => '',
                'destinationError' => '',
                'successMessage' => ''
            ];

            //validate input
            if(empty($data['flightNumber'])){
                $data['flightNumberError'] = 'Please enter a flight number.';
            }elseif($this->flightModel->getFlightByNumber($data['flightNumber'])){
                $data['flightNumberError'] = 'Flight Number already exist.';
            }
            if(intval($data['duration']) <= 0){
                $data['durationError'] = 'Duration cannot be zero or lower.';
            }
            if(empty($data['origin'])){
                $data['originError'] = 'Please select an airport.';
            }
            if(empty($data['destination'])){
                $data['destinationError'] = 'Please select an airport.';
            }elseif($data['destination'] == $data['origin']){
                $data['destinationError'] = 'Destination cannot be the same origin';
            }
            //check if all errors are clear
            if(empty($data['flightNumberError']) && empty($data['durationError']) && empty($data['originError']) && empty($data['destinationError'])){
                // $this->airportModel->add($data);
                if($this->flightModel->add($data)){
                    $data['successMessage'] = "Flight successfully created.";
                    $data['flightNumber'] = '';
                    $data['duration'] = '';
                    $data['origin'] = '';
                    $data['destination'] = '';
                    $data['type'] = '';
                }else{
                    die("Something went wrong.");
                }
            }
        }else{
            $data = [
                'title' => 'Create Flight',
                'flightNumber' => '',
                'duration' => '',
                'origin' => '',
                'destination' =>  '',
                'type' => '',
                'airports' => $airports,
                'flightNumberError' => '',
                'durationError' => '',
                'originError' => '',
                'destinationError' => '',
                'successMessage' => ''
            ];
        }
        


        $this->view("flights/create", $data);
    }

    public function edit($num){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $airports = $this->airportModel->getAllActiveAirports();
        $flight = $this->flightModel->getFlightByNumber($num);

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if($this->airportModel->getAirportByCode( $_POST['origin'])->type == "International" || $this->airportModel->getAirportByCode( $_POST['destination'])->type == "International"){
                $type = "International";
            }else{
                $type = "Local";
            }
            $data = [
                'title' => 'Edit Flight',
                'flight' => $flight,
                'duration' => $_POST['duration'],
                'origin' => $_POST['origin'],
                'destination' => $_POST['destination'],
                'type' => $type,
                'airports' => $airports,
                'flightNumberError' => '',
                'durationError' => '',
                'originError' => '',
                'destinationError' => '',
                'successMessage' => ''
            ];

            //validate input
            
            if(intval($data['duration']) <= 0){
                $data['durationError'] = 'Duration cannot be zero or lower.';
            }
            if(empty($data['origin'])){
                $data['originError'] = 'Please select an airport.';
            }
            if(empty($data['destination'])){
                $data['destinationError'] = 'Please select an airport.';
            }elseif($data['destination'] == $data['origin']){
                $data['destinationError'] = 'Destination cannot be the same origin';
            }
            //check if all errors are clear
            if(empty($data['flightNumberError']) && empty($data['durationError']) && empty($data['originError']) && empty($data['destinationError'])){
                // $this->airportModel->add($data);
                if($this->flightModel->edit($data)){
                    header("location: " . URLROOT . "/flights");
                }else{
                    die("Something went wrong.");
                }
            }
        }else{
            $data = [
                'title' => 'Edit Flight',
                'flight' => $flight,
                'duration' => '',
                'origin' => '',
                'destination' =>  '',
                'type' => '',
                'airports' => $airports,
                'durationError' => '',
                'originError' => '',
                'destinationError' => '',
                'successMessage' => ''
            ];
        }
        


        $this->view("flights/edit", $data);
    }

    public function delete($num){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        if($this->flightModel->delete($num)){
            header("location:" . URLROOT . "/flights");
        }else{
            die("Something went wrong.");
        }
    }
    
}