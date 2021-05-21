<?php

class FlightFares extends Controller{
    public function __construct(){
        $this->flightFareModel = $this->model("FlightFare");
        $this->flightModel = $this->model("Flight");
        $this->fareModel = $this->model('Fare');
    }

    public function manage_fare($flight_no){
        $flight = $this->flightModel->getFlightByNumber($flight_no);
        $flightFares = $this->flightFareModel->getAllFlightFaresByFlight($flight_no);
        $data=[
            'title' => 'Manage Flight Fare',
            'flight' => $flight,
            'flightFares' => $flightFares 
        ];
        
        $this->view("flightFares/manage_fare", $data);
    }

    public function create($flight){
        $fares = $this->fareModel->getAllActiveFares();
        $flight = $this->flightModel->getFlightByNumber($flight);
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data =[
                'title' => 'Add Flight Fare',
                'fares' => $fares,
                'flight' => $flight,
                'fare' => $_POST['fare'],
                'slots' => $_POST['slots'],
                'price' => $_POST['price'],
                'fareError' => '',
                'slotError' => '',
                'priceError' => '',
                'successMessage' => ''
                
            ];
            //validate
            if(empty($data['fare'])){
                $data['fareError'] = 'Please Select a Fare Type.';
            }elseif($this->flightFareModel->isExist($data)){
                $data['fareError'] = 'Fare Type already added in this flight.';
            }
            if(intval($data['slots']) <= 0){
                $data['slotError'] = 'Slot cannot be zero or lower';
            }
            if(intval($data['price']) <= 0){
                $data['priceError'] = 'Price cannot be zero or lower';
            }
            //check all error
            if(empty($data['fareError']) && empty($data['slotError']) && empty($data['priceError'])){
                if($this->flightFareModel->add($data)){
                    $data['successMessage'] = "Flight Fare successfully added.";
                    $data['fare'] = '';
                    $data['slots'] = '';
                    $data['price'] = '';

                }
            }
        }else{
            $data =[
                'title' => 'Add Flight Fare',
                'fares' => $fares,
                'flight' => $flight,
                'fare' => '',
                'slots' => '',
                'price' => '',
                'fareError' => '',
                'slotError' => '',
                'priceError' => '',
                'successMessage' => ''
                
            ];
        }
        $this->view("flightFares/create", $data);
    }
}