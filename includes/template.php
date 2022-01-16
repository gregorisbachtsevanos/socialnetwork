<?php
session_start();
if (!defined('social') || !isset($_SESSION['user'])) {
	die('Access denied');
}
	
require_once('../app/model/settings.php');
$user = $_SESSION['user'];
	
// if(!isset($_SESSION['user']))
	// die("Access deniad");

function loadHeader($title, $styles = null){
	global $db;
	global $appName;
	global $cdnURL;
	global $appURL;
	global $appView;
	global $requestUrl;
	global $controllerName;
	global $user;
	global $title;
	global $styles;

	$title == "edit" ? $href = 'href="'.$styles.'"' : $href = 'href="'.$cdnURL.'assets/styles/style.css"';
	$title != '' ? $title .= ' - '.$appName : $title = $appName;

	echo 
	'<! DOCTYPE html>
		<html lang="el">
		<head>
		<base href="'.$controllerName.'">
			<meta charset="utf-8">
			<title>'.$title.'</title>
			<meta name="description" content="Social network">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<script src="https://kit.fontawesome.com/947f5ef4a5.js" crossorigin="anonymous"></script>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<link rel="preconnect" href="https://fonts.googleapis.com">
			<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
			<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
			<link rel="stylesheet" '.$href.'">
		</head>';
		include($appView.'common/navbar_view.php');
		echo "<script>let USERNAME = '$user'</script>";
}
;
	
function endBody(){
	echo 
		'<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="../js/app.js"></script>
	
	</body>
	</html>';
}
?>