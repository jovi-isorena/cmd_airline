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
            if(isset($_POST['continue'])){
                $_SESSION['rebook']['step2data'] = $data;
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
        $data = [
            'title' => 'Choose Seat',
            'rebookData' => $_SESSION['rebook']['step2data']
        ];

        $this->view("rebooks/seat", $data);
    }
}

//process sa rebooking
//kunin ang data ng existing booking.
//same process pero hanggang date, flight, seat
//umpisa sa date select flight at fare

//kunin data sa database