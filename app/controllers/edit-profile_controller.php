<?php

    session_start();
    require_once "../model/settings.php";
    if (isset($_SESSION['user'])){
        
        echo "OK";
    }else{
        die("Error");
    }

?>