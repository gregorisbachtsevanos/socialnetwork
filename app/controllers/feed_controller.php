<?php 

	if(!defined('social')){
		die("Access denied");
	}

	
	if(isset($_GET["id"])){
		$title = $_GET["id"];

		$sql = "SELECT * FROM posts WHERE id = ?";
		$params = array($_GET["id"]);
		$row = $db->row($sql, $params);
		
	}
	// print_r($row);
	include($appView.'feed_view.php');

?>