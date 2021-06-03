<?php 

if(isset($_POST['save'])){
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //sanitize post data
        // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // $pass = json_decode($_POST['pass']);
        $pass = $_POST['pass'];
        // $data = [
        //     'title' => 'Test Page',
        //     'pass' => json_decode($_POST['pass'])
        // ];

        //validate input
        
        //check if all errors are clear
        
    }else{
        // $data = [
        //     'title' => 'Test Page',
        //     'pass' => 'no passed'
        // ];
        $pass = "no passed";
    }
    echo $pass;
}

class SeatLayouts extends Controller{
    public function __construct(){
        $this->seatLayoutModel = $this->model('SeatLayout');
    }

    //ajax request
    public function save($aircraft, $name, $layout){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        
        $data = [
            'aircraft' => $aircraft,
            'layout' => $layout,
            'name' => $name,
            'message' => ''
        ];
        
        if($this->seatLayoutModel->add($data)){
            $data['message'] = "Success";
        }else{
            
            $data['message'] = "Failed";
        }

        echo $data['message'];
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
}