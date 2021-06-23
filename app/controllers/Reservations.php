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
        // $list = [];
        // $combine = function($flight){
        //     $matrix = [];
        //     foreach(){

        //     }
        //     return [$flight->schedule_id => $matrix];
        // };
        // $list = array_map($combine, $flights);
        
        // foreach($flights as $flight){
        //     $row = [];
        //     foreach($fareNames as $fareName){
        //         $row[] = [$fareName => array_filter($flight,function($fareName){
        //             foreach($flight->fares as $fare){
        //                 if (array_search($fareName, $fare)){
        //                     return $fare->price;
        //                 }
        //             }
        //             return "Not Available";
        //         }, )];
        //     }
        //     $list[] = $row;
        // }
        // return $list;
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
            }else{
                $retOrigin = '';
                $retDestination = '';
            }
            $data = [
                'title' => 'Select Flight',
                'flightType' => $_POST['flightType'],
                'dept' => new DateTime($_POST['selectedDeptDate']),
                'ret' => new DateTime($_POST['selectedRetDate']),
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
                'fareMatrix' => [],
                'entered' => $_POST
            ];
            // //validate inputs
            // switch ($_POST['cabinClass']) {
            //     case '1':
            //         $data['cabinClass'] = 'economy';
            //         break;
            //     case '2':
            //         $data['cabinClass'] = 'premium economy';
            //         break;
            //     case '3':
            //         $data['cabinClass'] = 'business';
            //         break;
            // }
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
                $data['fareMatrix'] = array_unique(array_merge($data['fareMatrix'], $this->extractFareNames($flight->fares)));
                //COMBINES THE FARE NAME AND FLIGHT FARE PRICES TO MAKE FARE MATRIX
                // $data['fareMatrix'] = createFareMatrix($data['fareMatrix'], $data['deptFlight']);
            };
            // $data['fareMatrix'] = $this->extractFareNames($data['deptFlights']);
            
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

        $this->view('reservations/select', $data);
    }

    private function extractFareNames($fares){
        $list = [];
        foreach($fares as $fare){
            $list[] = $fare->name;
        }
        return $list;
    }
    
     
}