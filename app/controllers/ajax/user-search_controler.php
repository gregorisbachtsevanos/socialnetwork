<?php 

    session_start();
    require_once "../../model/settings.php";
    
    if(isset($_POST["searchInput"])){
        $sql = "SELECT * FROM users WHERE username LIKE ?";
        $params = array('%'.$_POST["searchInput"].'%');
        $row = $db->fetch($sql, $params);
        echo json_encode($row);
    }

?>