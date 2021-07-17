<?php
class Home extends Controller{
    public function __construct(){
        $this->userModel = $this->model('User');
    }

    public function index(){
        if(isLoggedIn() === 'employee'){
            header("Location: " . URLROOT . "/home/dashboard");
        }
        $data = [
            'title' => SITENAME
        ];
        $this->view('home/index', $data);
    }

    public function about(){
        $this->view('home/about');
    }

    public function dashboard(){
        $data = [
            'title' => 'Dashboard'
        ];
        $this->view("home/dashboard", $data);
    }
}