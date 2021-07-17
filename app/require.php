<?php
    //require libraries from folder libraries
    require_once 'libraries/Core.php';
    require_once 'libraries/Controller.php';
    require_once 'libraries/Database.php';
    require_once 'helpers/session_helper.php';
    require_once 'config/config.php';
    require_once 'helpers/fpdf.php';
    $path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
    require_once $path . '\helpers\vendor\autoload.php';
    //initiate core class
    $init = new Core();