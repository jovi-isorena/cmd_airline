<?php

class Extras extends Controller{
    public function __construct(){
        $this->extraModel = $this->model('Extra');
    }
    
    public function index($type = '%'){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $type = str_replace("-"," ",$type);
        $extras = $this->extraModel->getAllActiveExtrasByType($type);
        $types = $this->extraModel->getAllTypes();
        $data = [
            'title' => 'Extras',
            'extras' => $extras,
            'types' => $types,
            'selectedType' => $type
        ];
        $this->view("extras/index", $data);
    }

    public function create(){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'title' => 'Add Extra',
                'type' => trim($_POST['type']),
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'price' => $_POST['price'],
                'typeError' => '',
                'nameError' => '',
                'descriptionError' => '',
                'priceError' => '',
                'successMessage' => ''
            ];

            //validate input
            if(empty($data['type'])){
                $data['typeError'] = 'Please select a type.';
            }
            if(empty($data['name'])){
                $data['nameError'] = 'Please enter a name.';
            }
            if(empty($data['description'])){
                $data['descriptionError'] = 'Please enter a description.';
            }
            if(intval($data['price']) < 0){
                $data['priceError'] = 'Price cannot go lower than 0.';
            }
            //check if all errors are clear
            if(empty($data['typeError']) && empty($data['nameError']) && empty($data['descriptionError']) && empty($data['priceError']) ){
                // $this->airportModel->add($data);
                if($this->extraModel->add($data)){
                    $data['successMessage'] = "Extra successfully added.";
                    $data['type'] = '';
                    $data['name'] = '';
                    $data['description'] = '';
                    $data['price'] = '';
                    
                }else{
                    die("Something went wrong.");
                }
            }
        }else{
            $data = [
                'title' => 'Add Extra',
                'type' => '',
                'name' => '',
                'description' => '',
                'price' => '',
                'typeError' => '',
                'nameError' => '',
                'descriptionError' => '',
                'priceError' => '',
                'successMessage' => ''
            ];
        }
        $this->view("extras/create", $data);
    }

    public function edit($id){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        $extra = $this->extraModel->getExtraById($id);

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'title' => 'Edit Extra',
                'extra' => $extra,
                'type' => trim($_POST['type']),
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'price' => trim($_POST['price']),
                'typeError' => '',
                'nameError' => '',
                'descriptionError' => '',
                'priceError' => '',
                'successMessage' => ''
            ];

            //validate input
            if(empty($data['type'])){
                $data['typeError'] = 'Please select a type.';
            }
            if(empty($data['name'])){
                $data['nameError'] = 'Please enter a name.';
            }
            if(empty($data['description'])){
                $data['descriptionError'] = 'Please enter a description.';
            }
            if(intval($data['price']) < 0){
                $data['priceError'] = 'Price cannot go lower than 0.';
            }
            //check if all errors are clear
            if(empty($data['typeError']) && empty($data['nameError']) && empty($data['descriptionError']) && empty($data['priceError']) ){
                // $this->airportModel->add($data);
                if($this->extraModel->edit($data)){
                    header('location: ' . URLROOT . '/extras');
                }else{
                    die("Something went wrong.");
                }
            }
        }else{
            $data = [
                'title' => 'Edit Extra',
                'extra' => $extra,
                'type' => $extra->type,
                'name' => $extra->name,
                'description' => $extra->description,
                'price' => $extra->price,
                'typeError' => '',
                'nameError' => '',
                'descriptionError' => '',
                'priceError' => '',
                'successMessage' => ''
            ];
        }
        $this->view("extras/edit", $data);
    }

    public function delete($id){
        if(isLoggedIn()!="employee"){
            header("location: " . URLROOT . "/employees/login");
        }
        if($this->extraModel->delete($id)){
            header('location: ' . URLROOT . '/extras');
        }else{
            die('Something went wrong');
        }
    }
}