<?php 

    session_start();
    require_once "../../model/settings.php";
    
    if(isset($_POST["userId"])){

        $sql = "SELECT * FROM follow WHERE user_id = ? AND follow_user_id = ?";
        $params = array($_POST["userId"], $_SESSION["user"]);
        
        $db -> insert("follow", array(
                                    "follow_user_id"    => $_POST["userId"],
                                    "user_id"           => $_SESSION["user"],
                                    "date_followed"     => date('Y-m-d H:i:s')
                                )
                        );

    }

?>