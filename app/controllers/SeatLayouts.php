<?php 

class SeatLayouts extends Controller{
    public function __construct(){
        $this->seatLayoutModel = $this->model('SeatLayout');
        $this->aircraftModel = $this->model('Aircraft');
    }

    //ajax request
    public function save($aircraft, $layout, $name='' ){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $aircraft = $this->aircraftModel->getAircraftById($aircraft);
        $data = [
            'aircraft' => $aircraft,
            'layout' => $layout,
            'name' => $name,
            'errorMessage' => '',
            'message' => ''
        ];

        if(empty($data['aircraft'])){
            $data['errorMessage'] = "Invalid Aircraft.";
        }elseif(empty($data['layout'])){
            $data['errorMessage'] = "Empty Layout. Please add some seats.";
        }elseif(empty($data['name'])){
            $data['errorMessage'] = "Please enter a name for the layout.";
        }elseif($this->seatLayoutModel->isExistingName($data['name'])){
            $data['errorMessage'] = "Layout name already exist. Please enter another name.";
        }
        
        if(!empty($data['errorMessage'])){
            // echo "<div class='alert alert-danger text-danger'>" . $data['errorMessage'] . "</div>";
        }else{
            if($this->seatLayoutModel->add($data)){
                $data['message'] = "<div class='alert alert-success text-success'>Successfully saved.</div>";
            }else{
                
                $data['message'] = "<div class='alert alert-danger text-danger'>Failed to save.</div>";
            }
    
            // echo $data['message'];
        }
        echo json_encode($data);
        // $this->view("seatlayouts/save", $data);
    }
    //ajax request
    public function getLayoutById($id){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $layout = $this->seatLayoutModel->getLayoutById($id);
        echo json_encode($layout);
    }
    //ajax request
    public function getLayoutsByAircraft($aircraft){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $layouts = $this->seatLayoutModel->getLayoutsByAircraft($aircraft);
        echo json_encode($layouts);
    }
}