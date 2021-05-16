<?php
    session_start();

    function isLoggedIn(){
        if(isset($_SESSION['user_id'])){
            if(isset($_SESSION['position'])){
                return "employee";
            }else{
                return "user";
            }
        }else{
            return false;
        }
    }