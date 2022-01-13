<?php 
	if(!defined("social"))
		die("Access denied");

	if(isset($_SESSION["user"])){
		header('Location: '.$appUrl.'homepage');
		exit();
	}
	$title = '';
	include($appView.'home/index_view.php');
?>