<?php 

    session_start();
    require_once "../../model/settings.php";
    
    if(isset($_POST["searchInput"])){
        $sql = "SELECT * FROM users WHERE username LIKE ? OR fullname LIKE ?";
        $params = array('%'.$_POST["searchInput"].'%', '%'.$_POST["searchInput"].'%');
        $rows = $db->fetch($sql, $params);
        // foreach($rows as $rowId){
        //     $sql = "SELECT * FROM follow WHERE follow_user_id = $rowId->id";
        //     $row = $db->fetch($sql, $params);
        //     if($row){
        //         $isFollowed = true ;
        //     }else{
        //         $isFollowed = false;
        //     }
        //     $rows["isFollowed"] = $isFollowed;
            
            echo json_encode($rows);
        // }
        
    }

?>