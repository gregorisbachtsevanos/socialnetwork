<?php
    session_start();
    require_once "../model/settings.php";
    unset($_SESSION["user"]);
    header("Location: ".$appPublic."index.php");
?>