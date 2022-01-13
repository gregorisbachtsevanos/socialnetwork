<?php 
if(!defined("social"))
	die("Access denied");

	$title = $controllerName;

	$sql = "SELECT * FROM `users` WHERE username = ?";
	$params = array($controllerName);
	$row = $db -> row($sql, $params);

	!isset($row->id) ? die("Not found") : null;
	// if(isset($_GET['id'])){

	// 	// sql for user's avatar
    //     $sql = "SELECT * FROM users WHERE id = ?";
    //     $params = array($_GET['id']);
    //     $rowUserAvatar = $db->row($sql, $params);
        
    //     if($rowUserAvatar->avatar){
    //         $profileAvatar = "<img style='width:100%;height:100%' src='../files/assets/img/avatars/".$row->avatar."' alt='image-profile'>";
    //     }else{
    //         $profileAvatar = "<span class='user-icon'>".substr(ucwords($rowUserAvatar->fullname),0,1)."</span>";
    //     }
    // }
	include($appView."profile_view.php");