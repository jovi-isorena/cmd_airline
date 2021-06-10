<?php 


class Reservations extends Controller{
    public function __construct(){
        $this->reservationModel = $this->model('Reservation');
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
            
            $data = [
                'title' => 'Search Flight',
                'date' => $_POST['departure'],
                'monday' => false,
                'tuesday' => false,
                'wednesday' => false,
                'thursday' => false,
                'friday' => false,
                'saturday' => false,
                'sunday' => false,
                'origin' => $_POST['origin'],
                'destination' => $_POST['destination'],
                'result' => '',
                'entered' => $_POST
            ];
            //validate inputs
            $wd = getdate(strtotime($_POST['departure']))['weekday'];
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
            $data['result'] = $this->reservationModel->searchFlight($data);
        }

        $this->view('reservations/search', $data);
    }
}