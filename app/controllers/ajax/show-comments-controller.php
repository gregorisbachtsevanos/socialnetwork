<?php 

    session_start();
    require_once "../../model/settings.php";
    if(isset($_POST['postId'])){
        $sql = "SELECT `user_id`, `message`, `date_created` FROM `posts` WHERE `parent_id` = ?";
        $params = array($_POST['postId']);
        $row = $db->fetch($sql, $params);
        echo json_encode($row); 
        
    }
?>