<?php 

class Aircrafts extends Controller{
    public function __construct(){
        $this->aircraftModel = $this->model('Aircraft');
        $this->seatLayoutModel = $this->model('SeatLayout');
    }

    public function index(){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $aircrafts = $this->aircraftModel->getAllActiveAircrafts();
        $data = [
            'title' => 'Aircrafts',
            'aircrafts' => $aircrafts
        ];
        $this->view("aircrafts/index", $data);
    }

    public function create(){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Add Aircraft',
                'name' => trim($_POST['name']),
                'model' => trim($_POST['model']),
                'capacity' => ($_POST['capacity']),
                'nameError' => '',
                'modelError' => '',
                'capacityError' => '',
                'successMessage' => ''
            ];
            //validate inputs
            if(empty($data['name'])){
                $data['nameError'] = 'Please enter a name.';
            }elseif($this->aircraftModel->isExisting($data['name'])){
                $data['nameError'] = 'Aircraft already exist';
            }
            if(empty($data['model'])){
                $data['modelError'] = 'Pleaes enter a model.';
            }
            if($data['capacity'] <= 0){
                $data['capacityError'] = 'Capacity cannot be less than 1.';
            }elseif($data['capacity'] > 9999){
                $data['capacityError'] = 'Capacity value cannot exceed 9999';
            }
            

            //check all errors
            if(empty($data['nameError']) && empty($data['modelError']) && empty($data['capacityError'])){
                if($this->aircraftModel->add($data)){
                    $data['successMessage'] = "Aircraft successfully added.";
                    $data['name'] ='';
                    $data['model'] ='';
                    $data['capacity'] ='';
                }else{
                    die('Something went wrong.');
                }
            }
        }else{
            $data = [
                'title' => 'Add Aircraft',
                'name' => '',
                'model' => '',
                'capacity' => '',
                'nameError' => '',
                'modelError' => '',
                'capacityError' => '',
                'successMessage' => ''
            ];
        }
        
        $this->view("aircrafts/create", $data);
    }

    public function edit($id){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $aircraft = $this->aircraftModel->getAircraftById($id);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Edit Aircraft',
                'aircraft' => $aircraft,
                'name' => trim($_POST['name']),
                'model' => trim($_POST['model']),
                'capacity' => ($_POST['capacity']),
                'nameError' => '',
                'modelError' => '',
                'capacityError' => '',
                'successMessage' => ''
            ];
            //validate inputs
            if(empty($data['name'])){
                $data['nameError'] = 'Please enter a name.';
            }
            if(empty($data['model'])){
                $data['modelError'] = 'Pleaes enter a model.';
            }
            if($data['capacity'] <= 0){
                $data['capacityError'] = 'Capacity cannot be less than 1.';
            }elseif($data['capacity'] > 9999){
                $data['capacityError'] = 'Capacity value cannot exceed 9999';
            }

            //check all errors
            if(empty($data['nameError']) && empty($data['modelError']) && empty($data['capacityError'])){
                if($this->aircraftModel->edit($data)){
                    header("location: " . URLROOT . "/aircrafts");
                }else{
                    die('Something went wrong.');
                }
            }
        }else{
            $data = [
                'title' => 'Edit Fare',
                'aircraft' => $aircraft,
                'name' => $aircraft->name,
                'model' => $aircraft->model,
                'capacity' => $aircraft->passenger_capacity,
                'nameError' => '',
                'modelError' => '',
                'capacityError' => '',
                'successMessage' => ''
            ];
        }
        
        $this->view("aircrafts/edit", $data);
    }

    public function delete($id){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        if($this->aircraftModel->delete($id)){
            header("location: " . URLROOT . "/aircrafts");
        }else{
            die('Something went wrong');
        }
    }

    public function seatplan($id){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $aircraft = $this->aircraftModel->getAircraftById($id);
        $layouts = $this->seatLayoutModel->getLayoutsByAircraft($aircraft->id);
        $data = [
            'title' => 'Manage Seat Plan',
            'aircraft' => $aircraft,
            'layouts' => $layouts
        ];
        $this->view("aircrafts/seatplan", $data);
    }
}