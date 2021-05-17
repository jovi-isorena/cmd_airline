<?php

class Fares extends Controller{
    public function __construct(){
        $this->fareModel = $this->model('Fare');
    }

    public function index(){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $fares = $this->fareModel->getAllActiveFares();
        $data = [
            'title' => 'Fares',
            'fares' => $fares
        ];
        $this->view("fares/index", $data);
    }

    public function create(){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $data = [
            'title' => 'Add Fare'
        ];
        $this->view("fares/create", $data);
    }
}