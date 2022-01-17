<?php 

	if(!defined('social')){
		die("Access denied");
	}

	$title = $_GET["id"];
	include($appView.'feed_view.php');

?>