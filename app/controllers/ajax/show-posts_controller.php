<?php 
    session_start();
    require_once '../../model/settings.php';
    if(isset($_POST["userId"])){
        
        $sql = "SELECT * FROM posts WHERE parent_id is Null";
        $rows = $db->fetch($sql);
        echo json_encode($rows);
        
    }

?>