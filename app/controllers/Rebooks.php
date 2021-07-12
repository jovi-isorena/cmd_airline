<?php 


class Rebooks extends Controller{
    public function __construct()
    {
        $this->reservationModel = $this->model('Reservation');
        $this->reservedFlightModel = $this->model('ReservedFlight');
        $this->passengerModel = $this->model('Passenger');
        $this->purchasedExtraModel = $this->model('PurchasedExtra');
        $this->reservedSeatModel = $this->model('ReservedSeat');
        $this->scheduleModel = $this->model('Schedule');
        $this->flightModel = $this->model('Flight');
        $this->flightFareModel = $this->model('FlightFare');
        $this->scheduledAircraftModel = $this->model('ScheduledAircraft');
        $this->seatLayoutModel = $this->model('SeatLayout');
        $this->aircraftModel = $this->model('Aircraft');
    }

    public function initiate($id){
        if(isLoggedIn()!="user"){
            header("location: " . URLROOT . "/users/login");
        }
        if(empty($id) || $id == 0){
            header("location: " . URLROOT . "/users/mybooking");
        }
        $reservedFlight = $this->reservedFlightModel->getFlightById($id);
        $reservedFlight->scheduleDetail = $this->scheduleModel->getScheduleDetails($reservedFlight->schedule_id);
        $reservedFlight->fareDetail = $this->flightFareModel->getFlightFareById($reservedFlight->fare_id);
        $reservation = $this->reservationModel->getReservationById($reservedFlight->reservation_id);
        
        $reservedFlight->passengers = $this->passengerModel->getAllPassengersByReservationId($reservation->reservation_id, $reservedFlight->id);
        foreach($reservedFlight->passengers as $passenger){
            $passenger->seat = $this->reservedSeatModel->getReservedSeatByPassengerId($passenger->id);
        }
        $_SESSION['rebook']['step1data'] = [];
        $_SESSION['rebook']['step1data'][] = $reservation;
        $_SESSION['rebook']['step1data'][] = $reservedFlight;
        
        $data = [
            'title' => 'Rebook - Select new date',
            'reservation' => $reservation,
            'reservedFlight' => $reservedFlight,
            'selectedDate' => new DateTime($reservedFlight->flight_date),
            'selectedFlight' => $reservedFlight->schedule_id,
            'selectedFare' => $reservedFlight->fare_id,
            'flightError' => '',
            'monday' => false,
            'tuesday' => false,
            'wednesday' => false,
            'thursday' => false,
            'friday' => false,
            'saturday' => false,
            'sunday' => false,
            'fareList' => []

        ]; 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // sanitize post
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // if(isset($_POST['selectedFlight'])){
            //     $data['selectedFlight'] = $_POST['selectedFlight'];
            // }
            
            // if(isset($_POST['selectedFare'])){
            //     $data['selectedFare'] = $_POST['selectedFare'];
            // }
            if(isset($_POST['deptDate'])){
                $data['selectedDate'] = new DateTime($_POST['deptDate']);
            }
            if(isset($_POST['btnNewDate'])){
                $data['selectedDate'] = new DateTime($_POST['newDate']);

            }
            $data['selectedFlight'] = $_POST['selectedFlight'];
            $data['selectedFare'] = $_POST['selectedFare'];
            if(isset($_POST['continue'])){
                
                $_SESSION['rebook']['step2data']['newDate'] = $data['selectedDate'];
                $_SESSION['rebook']['step2data']['newFlight'] = $data['selectedFlight'];
                $_SESSION['rebook']['step2data']['newFlightDetail'] = $this->scheduleModel->getScheduleDetails($data['selectedFlight']);
                $_SESSION['rebook']['step2data']['newFare'] = $data['selectedFare'];
                $_SESSION['rebook']['step2data']['newFareDetail'] = $this->flightFareModel->getFlightFareById($data['selectedFare']);

                header("location: " . URLROOT . "/rebooks/seat");
                exit();
            }
        }
            $enteredDate = clone $data['selectedDate'];
            $data['targetOrigin'] = $data['reservedFlight']->scheduleDetail->airport_origin;
            $data['targetDestination'] = $data['reservedFlight']->scheduleDetail->airport_destination;
            $enteredDate->sub(new DateInterval('P3D'));
            for($i = 0; $i < 7; $i++){
                $wd = $enteredDate->format('l');
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
                $data['result'][$enteredDate->format('Y-m-d')] = ($this->reservationModel->searchMinimumPriceRebook($data));
                $data['result'][$enteredDate->format('Y-m-d')]->day = $wd;
                $data['result'][$enteredDate->format('Y-m-d')]->date = $enteredDate;
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
            $wd = $data['selectedDate']->format('l');
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
            $data['flights'] = $this->reservationModel->searchFlightRebook($data);
            foreach($data['flights'] as $flight){
                $flight->fares = $this->reservationModel->getFaresByFareId($flight->schedule_id, $data['reservedFlight']->fareDetail->fare_id);
                //GETS ALL FARE AVAILABLE FROM DEPARTING FLIGHTS
                $data['fareList'] = array_unique(array_merge($data['fareList'], array_column($flight->fares, 'name')));
                //COMBINES THE FARE NAME AND FLIGHT FARE PRICES TO MAKE FARE MATRIX
            };
            $data['fareMatrix']["flights"] =  $this->createFareMatrix($data['fareList'], $data['flights']);
            

        $this->view("rebooks/initiate", $data);
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

    public function seat(){
        if(isLoggedIn()!="user"){
            header("location: " . URLROOT . "/users/login");
        }
        $rebookData1 = $_SESSION['rebook']['step1data'];
        $rebookData2 = $_SESSION['rebook']['step2data'];
        $passengers = $this->passengerModel->getAllPassengersByReservationId($rebookData1[0]->reservation_id,$rebookData1[1]->id);
        $newFlightDetail = $this->scheduleModel->getScheduleDetails($rebookData2['newFlight']);
        
        $deptAircraft = $this->scheduledAircraftModel->getScheduledAircraft($newFlightDetail->schedule_id, $rebookData2['newDate']->format('l'));
        $deptAircraft->layout = json_decode($this->seatLayoutModel->getLayoutById($deptAircraft->layout_id)->layout);
        $deptAircraft->rowHeader = $this->getRowHeader($deptAircraft->layout);
        $deptAircraft->colHeader = $this->getColHeader($deptAircraft->layout); 
        $adetails = $this->aircraftModel->getAircraftById($deptAircraft->aircraft_id);
        $deptAircraft->name = $adetails->name;
        $deptAircraft->model = $adetails->model;
        $data = [
            'title' => 'Choose Seat',
            'rebookData1' => $rebookData1,
            'rebookData2' => $rebookData2,
            'selectedFlightDetail' => $newFlightDetail,
            'aircraft' => $deptAircraft,
            'passengers' => $passengers,
            'newSeats' => []
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // sanitize post
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data['newSeats'] = $_POST['deptSeat'];
            if(sizeof($data['newSeats']) != 0){
                $_SESSION['rebook']['step3data']['newSeats'] = $data['newSeats'];
                header("location: " . URLROOT . "/rebooks/confirm");
                exit();
            }
        }
            $this->view("rebooks/seat", $data);
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

    public function confirm(){
        $rebookData1 = $_SESSION['rebook']['step1data'];
        $rebookData2 = $_SESSION['rebook']['step2data'];
        $rebookData3 = $_SESSION['rebook']['step3data'];

        $data = [
            'title' => 'Confirm Rebook',
            'rebookData1' => $rebookData1,
            'rebookData2' => $rebookData2,
            'rebookData3' => $rebookData3

        ];

        $this->view("rebooks/confirm", $data);
    }
}

//process sa rebooking
//kunin ang data ng existing booking.
//same process pero hanggang date, flight, seat
//umpisa sa date select flight at fare

//kunin data sa database

//update process
//update old reserved flight
//create new reserved flight
//update reserved_flight_id in passenger
//update reserved_flight_id in reserved_seat