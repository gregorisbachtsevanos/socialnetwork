<?php

if(!defined("social")){
	die("Access denied");
}

$title = $controllerName;

include($appView.'trending_view.php');