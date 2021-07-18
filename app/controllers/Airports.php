<?php

class Airports extends Controller{
    public function __construct(){
        $this->airportModel = $this->model('Airport');
    }

    public function index(){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $airports = $this->airportModel->getAllActiveAirports();
        $data = [
            'airports' => $airports,
            'title' => 'Airports'
        ];
        $this->view("airports/index", $data);
    }

    public function create(){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Add Airport',
                'airportCode' => trim($_POST['airportCode']),
                'name' => trim($_POST['name']),
                'address' => trim($_POST['address']),
                'type' => trim($_POST['type']),
                'airportCodeError' => '',
                'nameError' => '',
                'addressError' => '',
                'typeError' => '',
                'successMessage' => ''
            ];

            //validate input
            if(empty($data['airportCode'])){
                $data['airportCodeError'] = 'Please enter a code.';
            }elseif($this->airportModel->getAirportByCode($data['airportCode'])){
                $data['airportCodeError'] = 'Airport Code already exist.';
            }
            if(empty($data['name'])){
                $data['nameError'] = 'Please enter a name.';
            }
            if(empty($data['address'])){
                $data['addressError'] = 'Please enter an address.';
            }
            if(empty($data['type'])){
                $data['typeError'] = 'Please select airport type.';
            }

            //check if all errors are clear
            if(empty($data['airportCodeError']) && empty($data['nameError']) && empty($data['addressError']) && empty($data['typeError'])){
                // $this->airportModel->add($data);
                if($this->airportModel->add($data)){
                    $data['successMessage'] = "Airport successfully added.";
                    $data['airportCode'] = '';
                    $data['name'] = '';
                    $data['address'] = '';
                    $data['type'] = '';
                }else{
                    die("Something went wrong.");
                }
            }
        }else{
            $data = [
                'title' => 'Add Airport',
                'airportCode' => '',
                'name' => '',
                'address' => '',
                'type' => '',
                'airportCodeError' => '',
                'nameError' => '',
                'addressError' => '',
                'typeError' => '',
                'successMessage' => ''
            ];
        }
        $this->view("airports/create", $data);
    }

    public function edit($code){
        $airport = $this->airportModel->getAirportByCode($code);
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $data = [
            'title' => 'Edit Airport',
            'airport' => $airport,
            'code' => $code,
            'name' => '',
            'address' => '',
            'type' => '',
            'airportCodeError' => '',
            'nameError' => '',
            'addressError' => '',
            'typeError' => '',
            'successMessage' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Edit Airport',
                'airport' => $airport,
                'code' => $code,
                'name' => trim($_POST['name']),
                'address' => trim($_POST['address']),
                'type' => trim($_POST['type']),
                'airportCodeError' => '',
                'nameError' => '',
                'addressError' => '',
                'typeError' => '',
                'successMessage' => ''
            ];

            //validate input
            
            if(empty($data['name'])){
                $data['nameError'] = 'Please enter a name.';
            }
            // elseif($data['name'] == $data['airport']->name){
            //     $data['nameError'] = "No change made.";
            // }
            if(empty($data['address'])){
                $data['addressError'] = 'Please enter an address.';
            }
            // elseif($data['address'] == $data['airport']->address){
            //     $data['addressError'] = "No change made.";
            // }
            if(empty($data['type'])){
                $data['typeError'] = 'Please select airport type.';
            }
            //check if all errors are clear
            if(empty($data['airportCodeError']) && empty($data['nameError']) && empty($data['addressError']) && empty($data['typeError'])){
                // $this->airportModel->add($data);
                if($this->airportModel->edit($data)){
                    header("location:" . URLROOT . "/airports");
                }else{
                    die("Something went wrong.");
                }
            }
            // else{
            //     $this->view("airports/edit/" . $airport->airport_code, $data);
            // }
        }
        // else{
            
        //     $data = [
        //         'airport' => $airport,
        //         'airportCode' => $code,
        //         'name' => '',
        //         'address' => '',
        //         'airportCodeError' => '',
        //         'nameError' => '',
        //         'addressError' => '',
        //         'successMessage' => ''
        //     ];
        // }
        


        $this->view("airports/edit", $data);
    }

    public function delete($code){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        if($this->airportModel->delete($code)){
            header("location:" . URLROOT . "/airports");
        }else{
            die("Something went wrong.");
        }

    }

    public function fetchAirport($term){
        $airports = $this->airportModel->fetchAirport($term);
        $data = [
            'airports' => json_encode($airports)
        ] ;
        $this->view("airports/fetchAirport", $data);
    }
} 