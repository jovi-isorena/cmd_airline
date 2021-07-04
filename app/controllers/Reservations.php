<?php 


class Reservations extends Controller{
    public function __construct(){
        $this->reservationModel = $this->model('Reservation');
        $this->airportModel = $this->model('Airport');
        $this->scheduleModel = $this->model('Schedule');
        $this->scheduledAircraftModel = $this->model('ScheduledAircraft');
        $this->seatLayoutModel = $this->model('SeatLayout');
        $this->aircraftModel = $this->model('Aircraft');
        $this->flightExtraModel = $this->model('FlightExtra');
        $this->extraModel = $this->model('Extra');
        $this->flightFareModel = $this->model('FlightFare');
        $this->reservedFlightModel = $this->model('ReservedFlight');
        $this->passengerModel = $this->model('Passenger');
        $this->reservedSeatModel = $this->model('ReservedSeat');
        $this->purchasedExtraModel = $this->model('PurchasedExtra');
    }

    public function search(){
        if(isLoggedIn() !== "user"){
            $_SESSION['redirectTo'] = "location: " . URLROOT . "/reservations/search";
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $_SESSION['redirectData'] = $_POST;
            $_SESSION['redirectMessage'] = "Please login to continue.";
            header("location: " . URLROOT . "/users/login");
            exit(1);
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_SESSION['redirectData']) || isset($input)){
            //sanitize post
            if(isset($_SESSION['redirectData'])){
                $input = $_SESSION['redirectData'];
                
            }else{
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $input = $_POST;
            }
            $deptOrigin = $this->airportModel->getAirportByCode($input['origin']);
            $deptDestination = $this->airportModel->getAirportByCode($input['destination']);
            if($input['flightType'] == "roundTrip"){
                $retOrigin = $this->airportModel->getAirportByCode($input['destination']);
                $retDestination = $this->airportModel->getAirportByCode($input['origin']);
            }else{
                $retOrigin = '';
                $retDestination = '';
            }
            $data = [
                'title' => 'Search Flight',
                'flightType' => $input['flightType'],
                'dept' => new DateTime($input['departure']),
                'ret' => new DateTime($input['return']),
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
                'passenger' => $input['passenger'],
                'cabinClass' => $input['cabinClass'],
                'targetDate' => '',
                'targetOrigin' => '',
                'targetDestination' => '',
                'result' => []
            ];
            //validate inputs
            switch ($input['cabinClass']) {
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
        if(isset($_SESSION['redirectData'])) unset($_SESSION['redirectData']);
        if(isLoggedIn() !== "user"){
            header("location: " . URLROOT );
            exit(1);
        }
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
                'retFlightError' => ''
            ];
            //validate inputs
            if(isset($_POST['continue']) && (empty($data['deptFlight']) || empty($data['deptFare']))){
                $data['deptFlightError'] = "Please select a flight.";
            }
            if(isset($_POST['continue']) && ($data['flightType']=="roundTrip") && (empty($data['retFlight']) || empty($data['retFare']))){
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
                // $data['deptFareList'] = array_unique(array_merge($data['deptFareList'], $this->extractFareNames($flight->fares)));
                $data['deptFareList'] = array_unique(array_merge($data['deptFareList'], array_column($flight->fares, 'name')));
                //COMBINES THE FARE NAME AND FLIGHT FARE PRICES TO MAKE FARE MATRIX
            };
            $data['fareMatrix']["departureFlights"] =  $this->createFareMatrix($data['deptFareList'], $data['deptFlights']);
            
            
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
                // $data['retFareList'] = array_unique(array_merge($data['retFareList'], $this->extractFareNames($flight->fares)));
                $data['retFareList'] = array_unique(array_merge($data['retFareList'], array_column($flight->fares, 'name')));

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
                $_SESSION['reservationData'] = $data;
                header("location: " . URLROOT . "/reservations/passengers");
                
            }else{
                $this->view('reservations/select', $data);
            }
        }else{
            $this->view('reservations/select', $data);
        }
    }
 
    public function passengers(){
        // $data = json_decode($_COOKIE['reservationData'], true);
        if(isLoggedIn() !== "user"){
            header("location: " . URLROOT);
            exit(1);
        }
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

    public function seats(){
        if(isLoggedIn() !== "user"){
            header("location: " . URLROOT);
            exit(1);
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // $data = $_SESSION['reservationData'];
            $deptFlightDetail = $this->scheduleModel->getScheduleDetails($_SESSION['reservationData']['deptFlight']);
            $deptAircraft = $this->scheduledAircraftModel->getScheduledAircraft($deptFlightDetail->schedule_id, $_SESSION['reservationData']['dept']->format('l'));
            $deptAircraft->layout = json_decode($this->seatLayoutModel->getLayoutById($deptAircraft->layout_id)->layout);
            $deptAircraft->rowHeader = $this->getRowHeader($deptAircraft->layout);
            $deptAircraft->colHeader = $this->getColHeader($deptAircraft->layout); 
            $adetails = $this->aircraftModel->getAircraftById($deptAircraft->aircraft_id);
            $deptAircraft->name = $adetails->name;
            $deptAircraft->model = $adetails->model;
            $selectedDeptFare = $_SESSION['reservationData']['deptFare'];
            $departureDate = $_SESSION['reservationData']['dept'];
            $retFlightDetail = new \stdClass;
            $retAircraft = new \stdClass;
            $retAircraft->layout = '';
            $selectedRetFare = '';
            $returnDate = '';
            if($_SESSION['reservationData']['flightType'] == "roundTrip"){
                $retFlightDetail = $this->scheduleModel->getScheduleDetails($_SESSION['reservationData']['retFlight']);
                $retAircraft = $this->scheduledAircraftModel->getScheduledAircraft($retFlightDetail->schedule_id, $_SESSION['reservationData']['ret']->format('l'));
                $retAircraft->layout = json_decode($this->seatLayoutModel->getLayoutById($retAircraft->layout_id)->layout);
                $adetails = $this->aircraftModel->getAircraftById($retAircraft->aircraft_id);
                $retAircraft->name = $adetails->name;
                $retAircraft->model = $adetails->model;
                $retAircraft->rowHeader = $this->getRowHeader($retAircraft->layout);
                $retAircraft->colHeader = $this->getColHeader($retAircraft->layout);
                $returnDate = $_SESSION['reservationData']['ret'];
                $selectedRetFare = $_SESSION['reservationData']['retFare'];
            }

            $data = [
                'title' => "Choose Seats",
                'departureDate' => $departureDate,
                'returnDate' => $returnDate,
                'selectedDepartureFlight' => $deptFlightDetail,
                'departureAircraft' => $deptAircraft,
                'selectedDepartureFare' => $selectedDeptFare,
                'selectedReturnFlight' => $retFlightDetail,
                'returnAircraft' => $retAircraft,
                'selectedReturnFare' => $selectedRetFare,
                'passenger' => $_SESSION['reservationData']['passenger'],
                'flightType' => $_SESSION['reservationData']['flightType'],
                'cabinClass' => $_SESSION['reservationData']['cabinClass'],
                'passengers' => []
            ];
            
            for ($i=0; $i < $data['passenger']; $i++) { 
                $passenger = [];
                $passenger['firstname'] = trim($_POST['firstname'][$i]);
                $passenger['lastname'] = trim($_POST['lastname'][$i]);
                $passenger['gender'] = $_POST['gender'][$i];
                $passenger['dob'] = $_POST['dob'][$i];
                $passenger['doctype'] = $_POST['doctype'][$i];
                $passenger['docnumber'] = trim($_POST['docnumber'][$i]);
                $passenger['issuingcountry'] = $_POST['issuingcountry'][$i];
                $passenger['expiration'] = $_POST['expiration'][$i];
                array_push($data['passengers'], $passenger);
            }
            $_SESSION['reservationData'] = $data;
        }
        $this->view('reservations/seats', $data);
    }

    private function getColHeader($arr){
        $xCoor = [];
        $currentChar = 'A';
        $colCount = sizeof($arr[0]);
        $rowCount = sizeof($arr);
        
        for($index = 0; $index < $colCount; $index++){
            $hasElement = false;
            for ($index2 = 0; $index2 < $rowCount; $index2++) {
                if($arr[$index2][$index] != "0"){
                    $hasElement = true;
                    break;
                }
            }
            if($hasElement){
                $xCoor[$index] = $currentChar;
                $currentChar = ++$currentChar;
            }else{
                $xCoor[$index] = ' ';
            }
        }
        return $xCoor;
        
    }
    //naming rows
    private function getRowHeader($arr){
        $yCoor = [];
        $currentChar = 1;
        $colCount = sizeof($arr[0]);
        $rowCount = sizeof($arr);
        for($index = 0; $index < $rowCount; $index++){
            $hasElement = false;
            for ($index2 = 0; $index2 < $colCount; $index2++) {
                if($arr[$index][$index2] != "0"){
                    $hasElement = true;
                    break;
                }
            }
            if($hasElement){
                $yCoor[$index] = $currentChar;
                $currentChar += 1;
            }else{
                $yCoor[$index] = ' ';
            }
        }
        return $yCoor;
    }

    public function extras(){
        if(isLoggedIn() !== "user"){
            header("location: " . URLROOT);
            exit(1);
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $reservationData = $_SESSION['reservationData'];
            // $b = array_map(fn($n) => $n * $n * $n, $a);
            
            for($i=0; $i < intval($reservationData['passenger']); $i++){
                $reservationData['passengers'][$i]['departureSeat'] = $_POST['deptSeat'][$i];
                if($reservationData['flightType'] == "roundTrip"){
                    $reservationData['passengers'][$i]['returnSeat'] = $_POST['retSeat'][$i];
                }
            }
            $_SESSION['reservationData'] = $reservationData;

            $deptBaggage = $this->flightExtraModel->getBaggageByFlightNo($reservationData['selectedDepartureFlight']->flight_no);
            $deptMeal = $this->flightExtraModel->getMealByFlightNo($reservationData['selectedDepartureFlight']->flight_no);
            $deptRoaming = $this->flightExtraModel->getRoamingByFlightNo($reservationData['selectedDepartureFlight']->flight_no);
            $deptExtras = [
                'baggage' => $deptBaggage,
                'meal' => $deptMeal,
                'roaming' => $deptRoaming
            ];
            $retExtras = [];
            if($reservationData['flightType'] == 'roundTrip'){
                $retBaggage = $this->flightExtraModel->getBaggageByFlightNo($reservationData['selectedReturnFlight']->flight_no);
                $retMeal = $this->flightExtraModel->getMealByFlightNo($reservationData['selectedReturnFlight']->flight_no);
                $retRoaming = $this->flightExtraModel->getRoamingByFlightNo($reservationData['selectedReturnFlight']->flight_no);
                $retExtras = [
                    'baggage' => $retBaggage,
                    'meal' => $retMeal,
                    'roaming' => $retRoaming
                ];
            }
            $data = [
                'title' => 'Select Extras',
                'reservationData' => $reservationData,
                'post' => $_POST,
                'selectedDepartureFlight' => $reservationData['selectedDepartureFlight'],
                'selectedReturnFlight' => $reservationData['selectedReturnFlight'],
                'flightType' => $reservationData['flightType'],
                'deptExtras' => $deptExtras, 
                'retExtras' => $retExtras
            ];

        }
        $this->view("reservations/extras", $data);
    }

    public function payment(){
        if(isLoggedIn() !== "user"){
            header("location: " . URLROOT);
            exit(1);
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // deptBaggage[]
            // deptMeal[]
            // deptRoaming[]
            $reservationData = $_SESSION['reservationData'];
            for($i=0; $i < $reservationData['passenger']; $i++){
                $deptExtras = [];
                $deptExtras[] = $_POST['deptBaggage'][$i];
                $deptExtras[] = $_POST['deptMeal'][$i];
                $deptExtras[] = $_POST['deptRoaming'][$i];
                $reservationData['passengers'][$i]['deptExtras'] = $deptExtras;
            }
            if($reservationData['flightType'] == 'roundTrip'){
                for($i=0; $i < $reservationData['passenger']; $i++){
                    $retExtras = [];
                    $retExtras[] = $_POST['retBaggage'][$i];
                    $retExtras[] = $_POST['retMeal'][$i];
                    $retExtras[] = $_POST['retRoaming'][$i];
                    $reservationData['passengers'][$i]['retExtras'] = $retExtras;
                }
            }

            $data = [
                'title' => 'Payment',
                'flights' => [],
                // 'reservationData' => $reservationData 

            ];
            $flightDetail = [
                'flightDetail' => $reservationData['selectedDepartureFlight'],
                'flightFare' => $this->flightFareModel->getFlightFareById($reservationData['selectedDepartureFare']),
                'flightDate' => $reservationData['departureDate'],
                'passengers' => []
            ];
            foreach($reservationData['passengers'] as $key=>$passenger){
                $flightDetail['passengers'][$key] = $passenger;
                $extras = array_filter($passenger['deptExtras']);
                foreach($extras as $extra){
                    if($extra != 0){
                        $flightDetail['passengers'][$key]['extras'][] = $this->extraModel->getExtraById($extra);
                        // echo "<h1>HEYYYYYY ".$extra->name."</h1>";
                    }
                }
                $flightDetail['passengers'][$key]['seat'] = $passenger['departureSeat'];
                unset($flightDetail['passengers'][$key]['deptExtras']);
                unset($flightDetail['passengers'][$key]['retExtras']);
                unset($flightDetail['passengers'][$key]['departureSeat']);
                unset($flightDetail['passengers'][$key]['returnSeat']);
            }
            $data['flights'][] = $flightDetail;

            if($reservationData['flightType'] == 'roundTrip'){
                $flightDetail = [
                    'flightDetail' => $reservationData['selectedReturnFlight'],
                    'flightFare' => $this->flightFareModel->getFlightFareById($reservationData['selectedReturnFare']),
                    'flightDate' => $reservationData['returnDate'],
                    'passengers' => []
                ];
                foreach($reservationData['passengers'] as $key=>$passenger){
                    $flightDetail['passengers'][$key] = $passenger;
                    $extras = array_filter($passenger['retExtras']);
                    
                    foreach($extras as $extra){
                        if($extra != 0){
                            $flightDetail['passengers'][$key]['extras'][] = $this->extraModel->getExtraById($extra);
                            // echo "<h1>".$extra->name."</h1>";
                        }
                    }
                    $flightDetail['passengers'][$key]['seat'] = $passenger['returnSeat'];
                    unset($flightDetail['passengers'][$key]['deptExtras']);
                    unset($flightDetail['passengers'][$key]['retExtras']);
                    unset($flightDetail['passengers'][$key]['departureSeat']);
                    unset($flightDetail['passengers'][$key]['returnSeat']);
                }
                $data['flights'][] = $flightDetail;
            }
            $subtotal = $this->computeTotalAmount($data['flights']);
            // echo $subtotal . "<br>";
            $data['fees'] = $subtotal * 0.12;
            // echo $data['flights']['fees'] . "<br>";
            $data['total'] = $data['fees'] + $subtotal;
            // echo $data['flights']['total'] . "<br>";
            $_SESSION['reservationData']['payment'] = $data;

        }
        
        $this->view("reservations/payment", $data);
            //get data from post
            //add to reservation data
            //accept payment data
            //add to reservation data
            //execute reservation
    }

    private function computeTotalAmount($flights){
        $amount = 0;
        foreach($flights as $flight){
            // echo $amount . "+" . $flight['flightFare']->price;
            $amount += $flight['flightFare']->price;
            // echo "=".$amount . "<br>";
            // var_dump($flight['passengers']);
            // echo '<pre>';

            foreach($flight['passengers'] as $passenger){
                if(array_key_exists('extras', $passenger)){
                    foreach($passenger['extras'] as $extra){
                        // echo $amount . "+" . $extra->price;
                        $amount += $extra->price;
                        // echo "=".$amount . "<br>";

                    }

                }
            }
            // echo '</pre>';
        }
        // echo $amount;
        return $amount;
    }

    public function reserve(){
        if(isLoggedIn() !== "user"){
            header("location: " . URLROOT);
            exit(1);
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $reservationData = $_SESSION['reservationData']['payment'];

            $data = [
                'title' => 'Reservation Complete',
                'reservation' =>[]
            ];
            // $newId = "0000" . $intID;
            // $newId = "PR".substr($newId, strlen($newId) - 5, 5);
            // echo "ID: ".$newId;
            //create array to inser for reservation table
            
            $data['reservation']['creationDate'] = new DateTime(); 
            $data['reservation']['creationDate'] = $data['reservation']['creationDate']->format('Y-m-d H:i:s');
            $data['reservation']['totalFare'] = $reservationData['total'];
            $data['reservation']['cabinClass'] = $_SESSION['reservationData']['cabinClass'];
            $data['reservation']['creator'] = $_SESSION['user_id'];
            
            if($this->reservationModel->add($data)){
                $intID = $this->reservationModel->getMaxId();
                //insert to reserved_flight
                foreach($reservationData['flights'] as $flight){
                    $insertData = [];
                    $insertData['reservationId'] = $intID;
                    $insertData['scheduleId'] = $flight['flightDetail']->schedule_id;
                    $insertData['flightDate'] = $flight['flightDate']->format('Y-m-d');
                    if(!$this->reservedFlightModel->add($insertData)){
                        die("Something went wrong in reserving the flight. Error: 1");
                    }
                    $reservedFlightId = $this->reservedFlightModel->getMaxId();
                    //insert passenger
                    foreach($flight['passengers'] as $passenger){
                        $insertData = [];
                        $insertData['firstname'] = $passenger['firstname'];
                        $insertData['lastname'] = $passenger['lastname'];
                        $insertData['gender'] = $passenger['gender'];
                        $insertData['dob'] = $passenger['dob'];
                        $insertData['doctype'] = $passenger['doctype'];
                        $insertData['docnumber'] = $passenger['docnumber'];
                        $insertData['issuingcountry'] = $passenger['issuingcountry'];
                        $insertData['expiration'] = $passenger['expiration'];
                        $insertData['reservationId'] = $intID;
                        if(!$this->passengerModel->add($insertData)){
                            die("Something went wrong in reserving the flight. Error: 2");
                        }
                        $passengerId = $this->passengerModel->getMaxId();
                        //add seat
                        $insertData = [];
                        $insertData['resFlight'] = $reservedFlightId;
                        $insertData['passenger'] = $passengerId;
                        $insertData['seatNumber'] = $passenger['seat'];
                        if(!$this->reservedSeatModel->add($insertData)){
                            die("Something went wrong in reserving the flight. Error: 3");
                        }
                        //add extra
                        foreach($passenger['extras'] as $extra){
                            $insertData = [];
                            $insertData['passenger'] = $passengerId;
                            $insertData['extra'] = $extra->id;
                            $insertData['reservation'] = $intID;
                            if(!$this->purchasedExtraModel->add($insertData)){
                                die("Something went wrong in reserving the flight. Error: 4");
                            }
                        }
                    }
                }
                $data['successMessage'] = "Booking Completed.";
                unset($_SESSION['reservationData']);
            }else{
                die("Something went wrong in reserving the flight. Error: 5");

            }

            $this->view("reservations/reserve", $data);

        }
    }
}