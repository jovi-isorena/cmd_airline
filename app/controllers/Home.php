<?php
class Home extends Controller{
    public function __construct(){
        $this->userModel = $this->model('User');
    }

    public function index(){
        $users = $this->userModel->getUsers();
        $data = [
            'title' => SITENAME,
            'users' => $users
        ];
        $this->view('home/index', $data);
    }

    public function about(){
        $this->view('home/about');
    }
}