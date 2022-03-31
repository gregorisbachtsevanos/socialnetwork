<?php

	if(!defined("social")){
		die("Access denied");
	}

	$title	= substr(ucwords($controllerName),0,1);
	include($appView."chat_view.php");?>
	