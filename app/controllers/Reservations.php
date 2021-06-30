<?php 


class Reservations extends Controller{
    public function __construct(){
        $this->reservationModel = $this->model('Reservation');
        $this->airportModel = $this->model('Airport');
        $this->scheduleModel = $this->model('Schedule');
        $this->scheduledAircraftModel = $this->model('ScheduledAircraft');
        $this->seatLayoutModel = $this->model('SeatLayout');
        $this->aircraftModel = $this->model('Aircraft');
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
                $_SESSION['reservationData'] = $data;
                header("location: " . URLROOT . "/reservations/passengers");
                
            }else{
                $this->view('reservations/select', $data);
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
            $departureDate = $_SESSION['reservationData']['dept'];
            $retFlightDetail = new \stdClass;
            $retAircraft = new \stdClass;
            $retAircraft->layout = '';
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
            }

            $data = [
                'title' => "Choose Seats",
                'departureDate' => $departureDate,
                'returnDate' => $returnDate,
                'selectedDepartureFlight' => $deptFlightDetail,
                'departureAircraft' => $deptAircraft,
                'selectedReturnFlight' => $retFlightDetail,
                'returnAircraft' => $retAircraft,
                'passenger' => $_SESSION['reservationData']['passenger'],
                'flightType' => $_SESSION['reservationData']['flightType'],
                'cabinClass' => $_SESSION['reservationData']['cabinClass'],
                'passengers' => []
            ];
            // $data['passengers'] = [];
            // //get data ng schedule
            

            
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
            $data = [
                'title' => 'Select Extras'
            ];
        }
    }

}