<?php

	if(!defined("social")){
		die("Access deniad");
	}
	
	$title = ucwords($controllerName);
	include($appView."friends_view.php");

?>