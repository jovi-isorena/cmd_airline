<?php 


class Reservations extends Controller{
    public function __construct(){
        $this->reservationModel = $this->model('Reservation');
        $this->airportModel = $this->model('Airport');
    }

    public function search(){
        // $data = [
        //     'title' => 'Search Flight',
        //     'date' => '',
        //     'day' => '',
        //     'origin' => '',
        //     'destination' => '',
        //     'result' => ''
        // ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $deptOrigin = $this->airportModel->getAirportByCode($_POST['origin']);
            $deptDestination = $this->airportModel->getAirportByCode($_POST['destination']);
            if($_POST['flightType'] == "roundTrip"){
                $retOrigin = $this->airportModel->getAirportByCode($_POST['destination']);
                $retDestination = $this->airportModel->getAirportByCode($_POST['origin']);
            }else{
                $retOrigin = '';
                $retDestination = '';
            }
            $data = [
                'title' => 'Search Flight',
                'flightType' => $_POST['flightType'],
                'dept' => new DateTime($_POST['departure']),
                'ret' => new DateTime($_POST['return']),
                'monday' => false,
                'tuesday' => false,
                'wednesday' => false,
                'thursday' => false,
                'friday' => false,
                'saturday' => false,
                'sunday' => false,
                'deptOrigin' => $deptOrigin,
                'deptDestination' => $deptDestination,
                'retOrigin' => $retOrigin,
                'retDestination' => $retDestination,
                'passenger' => $_POST['passenger'],
                'cabinClass' => $_POST['cabinClass'],
                'targetDate' => '',
                'targetOrigin' => '',
                'targetDestination' => '',
                'result' => [],
                'entered' => $_POST
            ];
            //validate inputs
            switch ($_POST['cabinClass']) {
                case '1':
                    $data['cabinClass'] = 'economy';
                    break;
                case '2':
                    $data['cabinClass'] = 'premium economy';
                    break;
                case '3':
                    $data['cabinClass'] = 'business';
                    break;
                

            }
            $enteredDate = clone $data['dept'];
            $data['targetOrigin'] = $data['deptOrigin'];
            $data['targetDestination'] = $data['deptDestination'];
            $enteredDate->sub(new DateInterval('P3D'));
            for($i = 0; $i < 7; $i++){
                $wd = getdate(date_timestamp_get($enteredDate))['weekday'];
                // echo getdate(date_timestamp_get($enteredDate))['weekday'];
                switch ($wd) {
                    case 'Monday':
                        $data['monday'] = true;
                        break;
                    case 'Tuesday':
                        $data['tuesday'] = true;
                        break;
                    case 'Wednesday':
                        $data['wednesday'] = true;
                        break;
                    case 'Thursday':
                        $data['thursday'] = true;
                        break;
                    case 'Friday':
                        $data['friday'] = true;
                        break;
                    case 'Saturday':
                        $data['saturday'] = true;
                        break;
                    case 'Sunday':
                        $data['sunday'] = true;
                        break;
                }
                $data['targetDate'] = $enteredDate->format('Y-m-d'); 
                $data['resultDept'][$enteredDate->format('Y-m-d')] = ($this->reservationModel->searchMinimumPrice($data));
                $data['resultDept'][$enteredDate->format('Y-m-d')]->day = $wd;
                $data['resultDept'][$enteredDate->format('Y-m-d')]->date = $enteredDate;
                $enteredDate->add(new DateInterval('P1D'));
                $data['monday'] = false;
                $data['tuesday'] = false;
                $data['wednesday'] = false;
                $data['thursday'] = false;
                $data['friday'] = false;
                $data['saturday'] = false;
                $data['sunday'] = false;
            }
            if($data['flightType'] == "roundTrip"){
                $enteredDate = clone $data['ret']; 
                $data['targetOrigin'] = $data['retOrigin'];
                $data['targetDestination'] = $data['retDestination'];
                $enteredDate->sub(new DateInterval('P3D'));
                for($i = 0; $i < 7; $i++){
                    $wd = getdate(date_timestamp_get($enteredDate))['weekday'];
                    // echo getdate(date_timestamp_get($enteredDate))['weekday'];
                    switch ($wd) {
                        case 'Monday':
                            $data['monday'] = true;
                            break;
                        case 'Tuesday':
                            $data['tuesday'] = true;
                            break;
                        case 'Wednesday':
                            $data['wednesday'] = true;
                            break;
                        case 'Thursday':
                            $data['thursday'] = true;
                            break;
                        case 'Friday':
                            $data['friday'] = true;
                            break;
                        case 'Saturday':
                            $data['saturday'] = true;
                            break;
                        case 'Sunday':
                            $data['sunday'] = true;
                            break;
                    }
                    $data['targetDate'] = $enteredDate->format('Y-m-d'); 
                    $data['resultRet'][$enteredDate->format('Y-m-d')] = ($this->reservationModel->searchMinimumPrice($data));
                    $data['resultRet'][$enteredDate->format('Y-m-d')]->day = $wd;
                    $data['resultRet'][$enteredDate->format('Y-m-d')]->date = $enteredDate;
                    $enteredDate->add(new DateInterval('P1D'));
                    $data['monday'] = false;
                    $data['tuesday'] = false;
                    $data['wednesday'] = false;
                    $data['thursday'] = false;
                    $data['friday'] = false;
                    $data['saturday'] = false;
                    $data['sunday'] = false;
                }
            }

            //check all errors
            // if(empty($data['nameError']) && empty($data['classError']) && empty($data['baggageError']) && empty($data['dateChangeError']) && empty($data['cancelFeeError']) && empty($data['noShowFeeError']) && empty($data['accrualError']) ){
            //     if($this->fareModel->add($data)){
            //         $data['successMessage'] = "Fare successfully added.";
            //         $data['name'] ='';
            //         $data['class'] ='';
            //         $data['baggage'] ='';
            //         $data['dateChange'] ='';
            //         $data['cancelFee'] ='';
            //         $data['noShowFee'] ='';
            //         $data['accrual'] ='';
            //     }else{
            //         die('Something went wrong.');
            //     }
            // }
            // $data['result'] = $this->reservationModel->searchFlight($data);
            // $data['result'][] = $this->reservationModel->searchMinimumPrice($data);
        }

        $this->view('reservations/search', $data);
    }

    
    private function createFareMatrix($fareNames, $flights){
        $list = [];
        foreach($flights as $flight){
            $row = [];
            foreach($fareNames as $fareName){
                $chosenFare = array_filter($flight->fares, function($fare) use($fareName){
                    return $fare->name === $fareName;
                });
                $chosenFare = array_values($chosenFare);
                if(isset($chosenFare[0]))
                    $row[$fareName] =  $chosenFare[0]->price;
                else
                    $row[$fareName] = "Not Available";
            }
            $list[$flight->schedule_id] = $row;
        }

        return $list;
    }

    public function select(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $deptOrigin = $this->airportModel->getAirportByCode($_POST['deptOrigin']);
            $deptDestination = $this->airportModel->getAirportByCode($_POST['deptDestination']);
            if($_POST['flightType'] == "roundTrip"){
                $retOrigin = $this->airportModel->getAirportByCode($_POST['deptDestination']);
                $retDestination = $this->airportModel->getAirportByCode($_POST['deptOrigin']);
                $retDate = new DateTime($_POST['selectedRetDate']);
            }else{
                $retOrigin = '';
                $retDestination = '';
                $retDate = new DateTime();
            }
            if(isset($_POST['selectedDeptFlight'])){
                $selectedDeptFlight = $_POST['selectedDeptFlight'];
            }else{
                $selectedDeptFlight = '';
            }
            if(isset($_POST['selectedRetFlight'])){
                $selectedRetFlight = $_POST['selectedRetFlight'];
            }else{
                $selectedRetFlight = '';
            }
            if(isset($_POST['selectedDeptFare'])){
                $selectedDeptFare = $_POST['selectedDeptFare'];
            }else{
                $selectedDeptFare = '';
            }
            if(isset($_POST['selectedRetFare'])){
                $selectedRetFare = $_POST['selectedRetFare'];
            }else{
                $selectedRetFare = '';
            }
            $data = [
                'title' => 'Select Flight',
                'flightType' => $_POST['flightType'],
                'dept' => new DateTime($_POST['selectedDeptDate']),
                'ret' => $retDate,
                'deptFlights' => [],
                'retFlights' => [],
                'availableFares' => [],
                'monday' => false,
                'tuesday' => false,
                'wednesday' => false,
                'thursday' => false,
                'friday' => false,
                'saturday' => false,
                'sunday' => false,
                'deptOrigin' => $deptOrigin,
                'deptDestination' => $deptDestination,
                'retOrigin' => $retOrigin,
                'retDestination' => $retDestination,
                'passenger' => $_POST['passenger'],
                'cabinClass' => $_POST['cabinClass'],
                'targetDate' => '',
                'targetOrigin' => '',
                'targetDestination' => '',
                'result' => [],
                'deptFareList' => [],
                'retFareList' => [],
                'deptFlight' => $selectedDeptFlight,
                'retFlight' => $selectedRetFlight,
                'deptFare' => $selectedDeptFare,
                'retFare' => $selectedRetFare,
                'deptFlightError' => '',
                'retFlightError' => '',
                'entered' => $_POST
            ];
            //validate inputs
            if(isset($_POST['continue']) && (empty($data['deptFlight']) || empty($data['deptFare']))){
                $data['deptFlightError'] = "Please select a flight.";
            }
            if(isset($_POST['continue']) && (empty($data['retFlight']) || empty($data['retFare']))){
                $data['retFlightError'] = "Please select a flight.";
            }
            



            $enteredDate = clone $data['dept'];
            $data['targetOrigin'] = $data['deptOrigin'];
            $data['targetDestination'] = $data['deptDestination'];
            $enteredDate->sub(new DateInterval('P3D'));
            for($i = 0; $i < 7; $i++){
                $wd = $enteredDate->format('l');
                // echo getdate(date_timestamp_get($enteredDate))['weekday'];
                switch ($wd) {
                    case 'Monday':
                        $data['monday'] = true;
                        break;
                    case 'Tuesday':
                        $data['tuesday'] = true;
                        break;
                    case 'Wednesday':
                        $data['wednesday'] = true;
                        break;
                    case 'Thursday':
                        $data['thursday'] = true;
                        break;
                    case 'Friday':
                        $data['friday'] = true;
                        break;
                    case 'Saturday':
                        $data['saturday'] = true;
                        break;
                    case 'Sunday':
                        $data['sunday'] = true;
                        break;
                }
                $data['targetDate'] = $enteredDate->format('Y-m-d'); 
                $data['resultDept'][$enteredDate->format('Y-m-d')] = ($this->reservationModel->searchMinimumPrice($data));
                $data['resultDept'][$enteredDate->format('Y-m-d')]->day = $wd;
                $data['resultDept'][$enteredDate->format('Y-m-d')]->date = $enteredDate;
                $enteredDate->add(new DateInterval('P1D'));
                $data['monday'] = false;
                $data['tuesday'] = false;
                $data['wednesday'] = false;
                $data['thursday'] = false;
                $data['friday'] = false;
                $data['saturday'] = false;
                $data['sunday'] = false;
            }

            //get the flights
            $wd = $data['dept']->format('l');
            switch ($wd) {
                case 'Monday':
                    $data['monday'] = true;
                    break;
                case 'Tuesday':
                    $data['tuesday'] = true;
                    break;
                case 'Wednesday':
                    $data['wednesday'] = true;
                    break;
                case 'Thursday':
                    $data['thursday'] = true;
                    break;
                case 'Friday':
                    $data['friday'] = true;
                    break;
                case 'Saturday':
                    $data['saturday'] = true;
                    break;
                case 'Sunday':
                    $data['sunday'] = true;
                    break;
            }
            $data['deptFlights'] = $this->reservationModel->searchFlight($data);
            foreach($data['deptFlights'] as $flight){
                $flight->fares = $this->reservationModel->getFaresByFlightClass($flight->schedule_id, $data['cabinClass']);
                //GETS ALL FARE AVAILABLE FROM DEPARTING FLIGHTS
                $data['deptFareList'] = array_unique(array_merge($data['deptFareList'], $this->extractFareNames($flight->fares)));
                //COMBINES THE FARE NAME AND FLIGHT FARE PRICES TO MAKE FARE MATRIX
            };
            $data['fareMatrix']["departureFlights"] =  $this->createFareMatrix($data['deptFareList'], $data['deptFlights']);
            // $data['deptFareList'] = $this->extractFareNames($data['deptFlights']);
            
            if($data['flightType'] == "roundTrip"){
                $enteredDate = clone $data['ret']; 
                $data['targetOrigin'] = $data['retOrigin'];
                $data['targetDestination'] = $data['retDestination'];
                $enteredDate->sub(new DateInterval('P3D'));
                for($i = 0; $i < 7; $i++){
                    $wd = getdate(date_timestamp_get($enteredDate))['weekday'];
                    // echo getdate(date_timestamp_get($enteredDate))['weekday'];
                    switch ($wd) {
                        case 'Monday':
                            $data['monday'] = true;
                            break;
                        case 'Tuesday':
                            $data['tuesday'] = true;
                            break;
                        case 'Wednesday':
                            $data['wednesday'] = true;
                            break;
                        case 'Thursday':
                            $data['thursday'] = true;
                            break;
                        case 'Friday':
                            $data['friday'] = true;
                            break;
                        case 'Saturday':
                            $data['saturday'] = true;
                            break;
                        case 'Sunday':
                            $data['sunday'] = true;
                            break;
                    }
                    $data['targetDate'] = $enteredDate->format('Y-m-d'); 
                    $data['resultRet'][$enteredDate->format('Y-m-d')] = ($this->reservationModel->searchMinimumPrice($data));
                    $data['resultRet'][$enteredDate->format('Y-m-d')]->day = $wd;
                    $data['resultRet'][$enteredDate->format('Y-m-d')]->date = $enteredDate;
                    $enteredDate->add(new DateInterval('P1D'));
                    $data['monday'] = false;
                    $data['tuesday'] = false;
                    $data['wednesday'] = false;
                    $data['thursday'] = false;
                    $data['friday'] = false;
                    $data['saturday'] = false;
                    $data['sunday'] = false;
                }
                //get the flights
                $wd = $data['ret']->format('l');
                switch ($wd) {
                    case 'Monday':
                        $data['monday'] = true;
                        break;
                    case 'Tuesday':
                        $data['tuesday'] = true;
                        break;
                    case 'Wednesday':
                        $data['wednesday'] = true;
                        break;
                    case 'Thursday':
                        $data['thursday'] = true;
                        break;
                    case 'Friday':
                        $data['friday'] = true;
                        break;
                    case 'Saturday':
                        $data['saturday'] = true;
                        break;
                    case 'Sunday':
                        $data['sunday'] = true;
                        break;
                }
            $data['retFlights'] = $this->reservationModel->searchFlight($data);
            foreach($data['retFlights'] as $flight){
                $flight->fares = $this->reservationModel->getFaresByFlightClass($flight->schedule_id, $data['cabinClass']);
                //GETS ALL FARE AVAILABLE FROM DEPARTING FLIGHTS
                $data['retFareList'] = array_unique(array_merge($data['retFareList'], $this->extractFareNames($flight->fares)));
                //COMBINES THE FARE NAME AND FLIGHT FARE PRICES TO MAKE FARE MATRIX
            };
            $data['fareMatrix']["returnFlights"] = $this->createFareMatrix($data['retFareList'], $data['retFlights']);
            }

            //check all errors
            // if(empty($data['nameError']) && empty($data['classError']) && empty($data['baggageError']) && empty($data['dateChangeError']) && empty($data['cancelFeeError']) && empty($data['noShowFeeError']) && empty($data['accrualError']) ){
            //     if($this->fareModel->add($data)){
            //         $data['successMessage'] = "Fare successfully added.";
            //         $data['name'] ='';
            //         $data['class'] ='';
            //         $data['baggage'] ='';
            //         $data['dateChange'] ='';
            //         $data['cancelFee'] ='';
            //         $data['noShowFee'] ='';
            //         $data['accrual'] ='';
            //     }else{
            //         die('Something went wrong.');
            //     }
            // }
            // $data['result'][] = $this->reservationModel->searchMinimumPrice($data);
        }
        if(isset($_POST['continue'])){
            if(empty($data['deptFlightError']) && empty($data['retFlightError'])){
                // header("location: " . URLROOT . "/reservations/passengers?val=". urlencode(serialize($data)));
                // header("Location:http://localhost/PhpSample/target.php?vals=" ));
                // $this->view('reservations/passengers', $data);
                // $_COOKIE
                // setcookie('reservationData', json_encode($data), time()+24*60*60);
                // unset($_COOKIE['test']);
                // setcookie('test',json_encode($data), time()+60*60*24);
                $_SESSION['reservationData'] = $data;
                header("location: " . URLROOT . "/reservations/passengers");
                // $this->view('reservations/select', $data);
            }
        }else{
            $this->view('reservations/select', $data);
        }
    }

    private function extractFareNames($fares){
        $list = [];
        foreach($fares as $fare){
            $list[] = $fare->name;
        }
        return $list;
    }
    
     
    public function passengers(){
        // $data = json_decode($_COOKIE['reservationData'], true);

        if(isset($_SESSION['reservationData'])){
            $data = $_SESSION['reservationData'];
            // unset($_SESSION['reservationData']);
            $data['title'] = 'Passengers Information';
            // $data['']



            $this->view('reservations/passengers', $data);

        }else{
            header("location: " . URLROOT);
        }
    }
}