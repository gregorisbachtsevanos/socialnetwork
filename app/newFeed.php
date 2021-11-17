<?php
    require "../public/includes/header.php";
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
            header("Location: ../public/homepage.php");
        }
    }

?>