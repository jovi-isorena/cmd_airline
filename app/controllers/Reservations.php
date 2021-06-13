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
            $origin = $this->airportModel->getAirportByCode($_POST['origin']);
            $destination = $this->airportModel->getAirportByCode($_POST['destination']);
            $data = [
                'title' => 'Search Flight',
                'dept' => new DateTime($_POST['departure']),
                'monday' => false,
                'tuesday' => false,
                'wednesday' => false,
                'thursday' => false,
                'friday' => false,
                'saturday' => false,
                'sunday' => false,
                'origin' => $origin,
                'destination' => $destination,
                'passenger' => $_POST['passenger'],
                'cabinClass' => $_POST['cabinClass'],
                'targetDate' => '',
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
            $enteredDate = new DateTime($_POST['departure']); 
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
                $data['result'][$enteredDate->format('Y-m-d')] = ($this->reservationModel->searchMinimumPrice($data));
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
}