<?php
session_start();
    require "../model/settings.php";
    if(isset($_POST["submit"])){
        if(empty($_POST["new-feed"])){
            exit();
        }
        else{

            $data["user_id"] = $_SESSION['user'];
            $data["message"] = $_POST["new-feed"];
            $data["date_created"] =  date("Y/m/d-H:m:s");
            $data["total_views"] = 0;
            $db -> insert("posts", $data);
            header("Location: ".$appPublic."homepage.php");
        }
    }

?>