<?php

class FlightExtras extends Controller{
    public function __construct(){
        $this->flightExtraModel = $this->model("FlightExtra");
        $this->extraModel = $this->model("Extra");
    }

    public function addBaggage($flight_no){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $baggages = $this->extraModel->getAllActiveExtrasByType("Baggage");
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'title' => 'Add Baggage in Flight',
                'flightNo' => $flight_no,
                'baggages' => $baggages,
                'extraId' => $_POST['extra'],
                'extraError' => '',
                'successMessage' => ''
            ];

            //validate input
            if(empty($data['extraId'])){
                $data['extraError'] = 'Please select a Baggage.';
            }elseif($this->flightExtraModel->isExist($data['flightNo'],$data['extraId'])){
                $data['extraError'] = 'Baggage already added in this flight.';
            }
            //check if all errors are clear
            if(empty($data['extraError'])){
                // $this->airportModel->add($data);
                if($this->flightExtraModel->add($data)){
                    $data['successMessage'] = "Extra successfully added.";
                    $data['extraId'] = '';
                    
                }else{
                    die("Something went wrong.");
                }
            }
        }else{
            $data = [
                'title' => 'Add Baggage in Flight',
                'flightNo' => $flight_no,
                'baggages' => $baggages,
                'extraId' => '',
                'extraError' => '',
                'successMessage' => ''
            ];
        }

        $this->view("flightExtras/addBaggage", $data);
    }
    public function addMeal($flight_no){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $meals = $this->extraModel->getAllActiveExtrasByType("Meal");
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'title' => 'Add Meal in Flight',
                'flightNo' => $flight_no,
                'meals' => $meals,
                'extraId' => $_POST['extra'],
                'extraError' => '',
                'successMessage' => ''
            ];

            //validate input
            if(empty($data['extraId'])){
                $data['extraError'] = 'Please select a Meal.';
            }elseif($this->flightExtraModel->isExist($data['flightNo'],$data['extraId'])){
                $data['extraError'] = 'Meal already added in this flight.';
            }
            //check if all errors are clear
            if(empty($data['extraError'])){
                // $this->airportModel->add($data);
                if($this->flightExtraModel->add($data)){
                    $data['successMessage'] = "Extra successfully added.";
                    $data['extraId'] = '';
                    
                }else{
                    die("Something went wrong.");
                }
            }
        }else{
            $data = [
                'title' => 'Add Meal in Flight',
                'flightNo' => $flight_no,
                'meals' => $meals,
                'extraId' => '',
                'extraError' => '',
                'successMessage' => ''
            ];
        }

        $this->view("flightExtras/addMeal", $data);
    }
    public function addRoaming($flight_no){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $roaming = $this->extraModel->getAllActiveExtrasByType("Roaming Service");
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'title' => 'Add Roaming Service',
                'flightNo' => $flight_no,
                'roaming' => $roaming,
                'extraId' => $_POST['extra'],
                'extraError' => '',
                'successMessage' => ''
            ];

            //validate input
            if(empty($data['extraId'])){
                $data['extraError'] = 'Please select a Roaming Service.';
            }elseif($this->flightExtraModel->isExist($data['flightNo'],$data['extraId'])){
                $data['extraError'] = 'Roaming Service already added in this flight.';
            }
            //check if all errors are clear
            if(empty($data['extraError'])){
                // $this->airportModel->add($data);
                if($this->flightExtraModel->add($data)){
                    $data['successMessage'] = "Extra successfully added.";
                    $data['extraId'] = '';
                    
                }else{
                    die("Something went wrong.");
                }
            }
        }else{
            $data = [
                'title' => 'Add Roaming Service',
                'flightNo' => $flight_no,
                'roaming' => $roaming,
                'extraId' => '',
                'extraError' => '',
                'successMessage' => ''
            ];
        }

        $this->view("flightExtras/addRoaming", $data);
    }

    public function delete($id){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $flightExtra = $this->flightExtraModel->getFlightExtraById($id);
        // var_dump($flightExtra->flight_no);
        // echo $flight_no->flight_no;
        if($this->flightExtraModel->delete($id)){
            header("location: " . URLROOT . "/flights/manage/" . $flightExtra->flight_no);
        }else{
            die("Something went wrong.");
        }
    }
}