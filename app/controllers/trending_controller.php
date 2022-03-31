<?php

if(!defined("social")){
	die("Access denied");
}

$title = ucwords($controllerName);



include($appView.'trending_view.php');