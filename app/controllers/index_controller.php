<?php 
	if(!defined("social"))
		die("Access denied");

	// if(isset($user)){
	// 	header('Location: '.$appUrl.'homepage');
	// 	exit();
	// }
	$title = '';
	include($appView.'home/index_view.php');
?>