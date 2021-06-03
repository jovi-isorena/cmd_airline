<?php

if(isset($_POST['pass'])){
    echo 1;
}

class Tests extends Controller{
    public function __construct(){
        $this->testModel = $this->model('Test');
    }

    public function index($pass, $pass2){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
            'pass' => $pass,
            'pass2' => $pass2

        ];
        // if(isset($_POST['pass'])){
        //     $data = [
        //         'pass' =>$_POST['pass']
        //     ];
            
        // }
        // else
        // $this->view('tests/index');
        $this->view('tests/index', $data);
    }
}