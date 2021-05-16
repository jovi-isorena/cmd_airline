<?php

class Employees extends Controller{
    public function __construct(){
        $this->employeeModel = $this->model('Employee');
    }

    public function login(){
        $data = [
            'title' => 'Employee Login Page',
            'usernameError' => '',
            'passwordError' => '',
            'username' => '',
            'password' => ''
        ];
        //Checks for post
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Employee Login Page',
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'usernameError' => '',
                'passwordError' => ''
            ];

            //validate username
            if(empty($data['username'])){
                $data['usernameError'] = 'Please enter a username.';
            }
            //validate username
            if(empty($data['password'])){
                $data['passwordError'] = 'Please enter a password.';
            }
            //check if all errors are clear
            if(!empty($data['username']) && !empty($data['password']) ){
                $loggedInUser = $this->employeeModel->login($data['username'],$data['password']);

                if($loggedInUser){
                    // print_r($loggedInUser);
                    $this->createUserSession($loggedInUser);
                }else{
                    $data['passwordError'] = 'Username or Password is incorrect. Please try again.';
                    $this->view('employees/login', $data);
                }
            }

        }else{
            $data = [
                'title' => ' Employee Login Page',
                'usernameError' => '',
                'passwordError' => '',
                'username' => '',
                'password' => ''
            ];
        }
        
        $this->view('employees/login', $data);
    }
    public function register(){
        $data = [
            'title' => 'Employee Registration Page',
            'registrationComplete' => '',
            'registrationError' => '',
            'firstNameError' => '',
            'lastNameError' => '',
            'mobileNumberError' => '',
            'birthdayError' => '',
            'emailError' => '',
            'passwordError' => '',
            'repeatPasswordError' => '',
            'positionError' => '',
            'email' => '',
            'password' => '',
            'repeatPassword' => '',
            'firstName' => '',
            'middleName' => '',
            'lastName' => '',
            'suffix' => '',
            'mobileNo' => '',
            'birthday' => '',
        ];
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => 'Employee Registration Page',
                'registrationComplete' => '',
                'registrationError' => '',
                'firstNameError' => '',
                'lastNameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'repeatPasswordError' => '',
                'positionError' => '',
                'email' => trim($_POST['email']),
                'password' => trim($_POST['pass']),
                'repeatPassword' => trim($_POST['rep']),
                'firstName' => trim($_POST['fname']),
                'middleName' => trim($_POST['mname']),
                'lastName' => trim($_POST['lname']),
                'suffix' => trim($_POST['suffix']),
                'position' => trim($_POST['position']),
            ];

            // $passwordValidation = "/^(.{6,20}|[^a-z]*|[^\d]*)$/i";
            $passwordValidation = "/^(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d]{6,}$/";
            // ^[a-zA-Z0-9_]{1,}$
            // $nameValidation = "/^[a-zA-Z0-9]*$/";
            // //username validation
            // if(empty($data['username'])){
            //     $data['usernameError'] = 'Please enter username.';
            // }elseif(!preg_match($nameValidation, $data['username'])){
            //     $data['usernameError'] = 'Name can only contain letters and numbers.';
            // }

            //name validation
            if(empty($data['firstName'])){
                $data['firstNameError'] = 'This field is required.';
            }
            if(empty($data['lastName'])){
                $data['lastNameError'] = 'This field is required.';
            }
            //position validation
            if(empty($data['position'])){
                $data['positionError'] = 'Select a position.';
            }
            
            //email validation
            if(empty($data['email'])){
                $data['emailError'] = 'This field is required.';
            }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $data['emailError'] = "Invalid Email.";
            }else{
                if($this->employeeModel->findUserByEmail($data['email'])){
                    $data['emailError'] = 'Email already in use. Please use other email.';
                }
                
            }

            //validate password on length and numeric values
            if(empty($data['password'])){
                $data['passwordError'] = 'Please enter password';
            }elseif(strlen($data['password']) < 6 || strlen($data['password'] > 20)){
                $data['passwordError'] = 'Passwords should be 6 - 20 characters only.';
            }
            // elseif(!preg_match($passwordValidation, $data['password'])){
            //     $data['registrationError'] .= '\nPassword must have at least one numeric value.' . $data['password'];
            // }

            //validate confirm password
            if($data['repeatPassword'] != $data['password']){
                $data['repeatPasswordError'] = 'Passwords do not match.';
            }

            //make sure errors are empty
            if(empty($data['registrationError']) && empty($data['firstNameError']) && empty($data['lastNameError']) && empty($data['positionError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['repeatPasswordError'])){
                //hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                //register user from model function
                if($this->employeeModel->register($data)){
                    //redirect to login
                    // header('location: ' . URLROOT . 'users/login');
                    $data['registrationComplete'] = 'Registration Successful!';
                    $data['email'] = '';
                    $data['password'] = '';
                    $data['repeatPassword'] = '';
                    $data['firstName'] = '';
                    $data['middleName'] = '';
                    $data['lastName'] = '';
                    $data['suffix'] = '';
                    $data['position'] = '';

                }else{
                    die('Something went wrong.');
                }
            }
        }
        $this->view('employees/register', $data);
    }

    public function createUserSession($user){
        
        $_SESSION['user_id'] = $user->id;
        $_SESSION['email'] = $user->email;
        $_SESSION['firstname'] = $user->firstname;
        $_SESSION['middlename'] = $user->middlename;
        $_SESSION['lastname'] = $user->lastname;
        $_SESSION['suffix'] = $user->suffix;
        $_SESSION['position'] = $user->position;
    
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['email']);
        unset($_SESSION['firstname']);
        unset($_SESSION['middlename']);
        unset($_SESSION['lastname']);
        unset($_SESSION['suffix']);
        unset($_SESSION['position']);
        header("location: " . URLROOT . "/employees/login");
    }
}