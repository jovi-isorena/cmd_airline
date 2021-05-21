<?php

class Fares extends Controller{
    public function __construct(){
        $this->fareModel = $this->model('Fare');
        $this->flightModel = $this->model('Flight');
    }

    public function index(){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $fares = $this->fareModel->getAllActiveFares();
        $data = [
            'title' => 'Fares',
            'fares' => $fares
        ];
        $this->view("fares/index", $data);
    }

    public function create(){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Add Fare',
                'name' => trim($_POST['name']),
                'class' => trim($_POST['class']),
                'baggage' => trim($_POST['baggage']),
                'dateChange' => trim($_POST['dateChange']),
                'cancelFee' => trim($_POST['cancelFee']),
                'noShowFee' => trim($_POST['noShowFee']),
                'accrual' => trim($_POST['accrual']),
                'nameError' => '',
                'classError' => '',
                'baggageError' => '',
                'dateChangeError' => '',
                'cancelFeeError' => '',
                'noShowFeeError' => '',
                'accrualError' => '',
                'successMessage' => ''
            ];
            //validate inputs
            if(empty($data['name'])){
                $data['nameError'] = 'Please enter a name.';
            }
            if(empty($data['class'])){
                $data['classError'] = 'Please select a class.';
            }
            if(empty($data['baggage'])){
                $data['baggageError'] = 'Please enter something.';
            }
            if(empty($data['dateChange'])){
                $data['dateChangeError'] = 'Please enter something.';
            }
            if(empty($data['cancelFee'])){
                $data['cancelFeeError'] = 'Please enter something.';
            }
            if(empty($data['noShowFee'])){
                $data['noShowFeeError'] = 'Please enter something.';
            }
            if(intval($data['accrual']) < 0){
                $data['accrualError'] = 'Value cannot be lower than zero';
            }

            //check all errors
            if(empty($data['nameError']) && empty($data['classError']) && empty($data['baggageError']) && empty($data['dateChangeError']) && empty($data['cancelFeeError']) && empty($data['noShowFeeError']) && empty($data['accrualError']) ){
                if($this->fareModel->add($data)){
                    $data['successMessage'] = "Fare successfully added.";
                    $data['name'] ='';
                    $data['class'] ='';
                    $data['baggage'] ='';
                    $data['dateChange'] ='';
                    $data['cancelFee'] ='';
                    $data['noShowFee'] ='';
                    $data['accrual'] ='';
                }else{
                    die('Something went wrong.');
                }
            }
        }else{
            $data = [
                'title' => 'Add Fare',
                'name' => '',
                'class' => '',
                'baggage' => '',
                'dateChange' => '',
                'cancelFee' => '',
                'noShowFee' => '',
                'accrual' => '',
                'nameError' => '',
                'classError' => '',
                'baggageError' => '',
                'dateChangeError' => '',
                'cancelFeeError' => '',
                'noShowFeeError' => '',
                'accrualError' => '',
                'successMessage' => ''
            ];
        }
        
        $this->view("fares/create", $data);
    }

    public function edit($id){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $fare = $this->fareModel->getFareById($id);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Edit Fare',
                'fare' => $fare,
                'name' => trim($_POST['name']),
                'class' => trim($_POST['class']),
                'baggage' => trim($_POST['baggage']),
                'dateChange' => trim($_POST['dateChange']),
                'cancelFee' => trim($_POST['cancelFee']),
                'noShowFee' => trim($_POST['noShowFee']),
                'accrual' => trim($_POST['accrual']),
                'nameError' => '',
                'classError' => '',
                'baggageError' => '',
                'dateChangeError' => '',
                'cancelFeeError' => '',
                'noShowFeeError' => '',
                'accrualError' => '',
                'successMessage' => ''
            ];
            //validate inputs
            if(empty($data['name'])){
                $data['nameError'] = 'Please enter a name.';
            }
            if(empty($data['class'])){
                $data['classError'] = 'Please select a class.';
            }
            if(empty($data['baggage'])){
                $data['baggageError'] = 'Please enter something.';
            }
            if(empty($data['dateChange'])){
                $data['dateChangeError'] = 'Please enter something.';
            }
            if(empty($data['cancelFee'])){
                $data['cancelFeeError'] = 'Please enter something.';
            }
            if(empty($data['noShowFee'])){
                $data['noShowFeeError'] = 'Please enter something.';
            }
            if(intval($data['accrual']) < 0){
                $data['accrualError'] = 'Value cannot be lower than zero';
            }

            //check all errors
            if(empty($data['nameError']) && empty($data['classError']) && empty($data['baggageError']) && empty($data['dateChangeError']) && empty($data['cancelFeeError']) && empty($data['noShowFeeError']) && empty($data['accrualError']) ){
                if($this->fareModel->edit($data)){
                    header("location: " . URLROOT . "/fares");
                }else{
                    die('Something went wrong.');
                }
            }
        }else{
            $data = [
                'title' => 'Edit Fare',
                'fare' => $fare,
                'name' => $fare->name,
                'class' => $fare->class,
                'baggage' => $fare->checked_baggage,
                'dateChange' => $fare->flight_date_change,
                'cancelFee' => $fare->cancellation_before_depart,
                'noShowFee' => $fare->no_show_fee,
                'accrual' => $fare->mileage_accrual,
                'nameError' => '',
                'classError' => '',
                'baggageError' => '',
                'dateChangeError' => '',
                'cancelFeeError' => '',
                'noShowFeeError' => '',
                'accrualError' => '',
                'successMessage' => ''
            ];
        }
        
        $this->view("fares/edit", $data);
    }

    public function delete($id){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        if($this->fareModel->delete($id)){
            header("location: " . URLROOT . "/fares");
        }else{
            die('Something went wrong');
        }
    }


}