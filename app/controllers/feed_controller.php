<?php 
	if(!defined('social')){
		die("Access denied");
	}

	
	if(isset($_GET["id"])){
		$title = $_GET["id"];

		// get post info 
		$sql = "SELECT * FROM posts WHERE id = ?";
		$params = array($_GET["id"]);
		$feedRow = $db->row($sql, $params);
		$date = date('d/m/Y', strtotime($feedRow->date_created));

		// get user's info 
		$sql = "SELECT * FROM users WHERE id = ?";
		$params = array($feedRow->user_id);
		$userRow = $db->row($sql, $params);

		// get like 
		$sql = "SELECT `date` FROM posts_likes WHERE user_id = ? AND post_id = ?";
		$params = array($_SESSION['userId'], $feedRow->id);
		$likedRow = $db->row($sql, $params);

		// get comments 
		$sql = "SELECT * FROM posts WHERE parent_id = ?";
		$params = array($feedRow->id);
		$commetnsRow = $db->fetch($sql, $params);

		$userRow->avatar 
        ? $avatar = "<img style='width:100%;height:100%' src=".$appFiles."assets/img/avatars/".$userRow->avatar." alt='image-profile'>"
        : $avatar = "<span class='user-icon'>".substr(ucwords($userRow->fullname),0,1)."</span>";
		
	}
	// print_r($row);
	include($appView.'feed_view.php');

?>