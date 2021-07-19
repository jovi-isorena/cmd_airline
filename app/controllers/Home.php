<?php
class Home extends Controller{
    public function __construct(){
        $this->userModel = $this->model('User');
        $this->airportModel = $this->model('Airport');
    }

    public function index(){
        if(isLoggedIn() === 'employee'){
            header("Location: " . URLROOT . "/home/dashboard");
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            
            $data = [
                'title' => SITENAME,
                'flightType' => $_POST['flightType'],
                'origin' => $_POST['origin'],
                'originPlaceholder' => '',
                'destination' => $_POST['destination'],
                'destinationPlaceholder' => '',
                'departure' => $_POST['departure'],
                'return' => $_POST['return'],
                'passenger' => $_POST['passenger'],
                'cabinClass' => $_POST['cabinClass'],
                'originError' => '',
                'destinationError' => '',
                'departureError' => '',
                'returnError' => '',
                'passengerError' => '',
                'cabinClassError' => ''
            ];
            
            //validate
            if(empty($data['origin'])){
                $data['originError'] = '<br>Please select an aiport.';
            }else{
                $originAirport = $this->airportModel->getAirportByCode($_POST['origin']);
                $data['originPlaceholder'] = $originAirport->airport_code . " - " . $originAirport->name;
            }
            if(empty($data['destination'])){
                $data['destinationError'] = '<br>Please select an aiport.';
            }else{
                $destinationAirport = $this->airportModel->getAirportByCode($_POST['destination']);
               $data['destinationPlaceholder'] = $destinationAirport->airport_code . " - " . $destinationAirport->name;
            }
            if(empty($data['departure'])){
                $data['departureError'] = '<br>Please select a date.';
            }else{
                $selectedDept = new DateTime($data['departure']);
                $today = new DateTime();
                if($selectedDept < $today){
                    $data['departureError'] = '<br>Invalid date.';
                }
            }
            if($data['flightType'] == 'roundTrip' && empty($data['return'])){
                $data['returnError'] = '<br>Please select a date.';
            }else{
                $selectedRet = new DateTime($data['return']);
                $today = new DateTime();
                if($selectedRet < $today || $selectedRet < $selectedDept){
                    $data['returnError'] = '<br>Invalid date.';
                }
            }
            if(empty($data['passenger']) || $data['passenger'] < 1){
                $data['passengerError'] = '<br>Minimum of 1 passenger.';
            }else if($data['passenger'] > 10){
                $data['passengerError'] = 'Maximum of 10 passengers per booking.';
            }
            if(empty($data['cabinClass']) || $data['cabinClass'] == '0'){
                $data['cabinClassError'] = '<br>Please select a cabin.';
            }

            //check all errors
            if(empty($data['originError']) && empty($data['destinationError']) && empty($data['departureError']) && empty($data['returnError']) && empty($data['passengerError']) && empty($data['cabinClassError'])){
                $_SESSION['reservation']['step1'] = $data;
                header("Location: " . URLROOT . "/reservations/search");
            }

        }
        else{
            $data = [
                'title' => SITENAME,
                'flightType' => '',
                'origin' => '',
                'originPlaceholder' => '',
                'destination' => '',
                'destinationPlaceholder' => '',
                'departure' => '',
                'return' => '',
                'passenger' => '',
                'cabinClass' => '',
                'originError' => '',
                'destinationError' => '',
                'departureError' => '',
                'returnError' => '',
                'passengerError' => '',
                'cabinClassError' => ''
            ];
        }
        
        
        $this->view('home/index', $data);
    }

    public function about(){
        $this->view('home/about');
    }

    public function dashboard(){
        $data = [
            'title' => 'Dashboard'
        ];
        $this->view("home/dashboard", $data);
    }
}