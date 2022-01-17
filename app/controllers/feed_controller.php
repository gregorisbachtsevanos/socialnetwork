<?php 

	if(!defined('social')){
		die("Access denied");
	}

	
	if(isset($_GET["id"])){
		$title = $_GET["id"];

		$sql = "SELECT * FROM posts WHERE id = ?";
		$params = array($_GET["id"]);
		$feedRow = $db->row($sql, $params);

		$sql = "SELECT * FROM users WHERE id = ?";
		$params = array($feedRow->user_id);
		$userRow = $db->row($sql, $params);

		$userRow->avatar 
        ? $avatar = "<img style='width:100%;height:100%' src=".$appFiles."assets/img/avatars/".$userRow->avatar." alt='image-profile'>"
        : $avatar = "<span class='user-icon'>".substr(ucwords($row->fullname),0,1)."</span>";
		
	}
	// print_r($row);
	include($appView.'feed_view.php');

?>