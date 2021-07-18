<?php

if(isset($_POST['pass'])){
    echo 1;
}

class Tests extends Controller{
    public function __construct(){
        $this->testModel = $this->model('Test');
    }

    public function index(){
        $data = [
            'title' => "Test Page"

        ];
        
        $this->view('tests/index', $data);
    }

    public function fetchAirport($term){
        $airports = $this->testModel->getAirport($term);
        $data = [
            'airports' => json_encode($airports)
        ] ;
        $this->view("tests/fetchAirport", $data);
    }
}