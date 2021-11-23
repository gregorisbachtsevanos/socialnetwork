<?php 

    session_start();
    require_once "../../model/settings.php";
    if(isset($_POST["data"])){
        echo "ok";
    }
    $dta = array();
    echo json_encode($dta);
    // echo "PL";
?>