<?php
session_start();
    require "../model/settings.php";
    if(isset($_POST["submit"])){
        // if(empty($_POST["new-feed"])){
        //     header("Location: ".$appPublic."homepage.php");
        //     exit();
        // }
        // else{
            $sql = "SELECT `id` FROM users WHERE username = ?";
			$params = array($_SESSION['user']);
			$row = $db->row($sql, $params);

            $data["user_id"] = $row->id;
            $data["message"] = $_POST["new-feed"];
            $data["date_created"] =  date("Y/m/d-H:m:s");
            $data["total_views"] = 0;
            $db -> insert("posts", $data);
            // header("Location: ".$appPublic."homepage.php");
            header('Location: '.$appURL.'homepage');
        // }
    }

?>