<?php
if (!defined('social')){
	die('Access denied');
}
	
function loadIndexHeader($title, $err = null){
	global $db;
	global $appName;
	if($title != ''){
		$title .= ' - '.$appName;
	}else{
		$title = $appName;
	}
	// echo $title;
	echo 
	'<!DOCTYPE html>
		<html lang="el">
		<head>
			<meta charset="utf-8">
			<title>'.$title.'</title>
			<meta name="description" content="Social network">
			<link rel="stylesheet" href="../styles/style.css">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<script src="https://kit.fontawesome.com/947f5ef4a5.js" crossorigin="anonymous"></script>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<link rel="preconnect" href="https://fonts.googleapis.com">
			<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
			<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
			<style>
			#particles-js{
				width: 100%;
				height: 100%;
				background-image: url("");
				background-size: cover;
				background-position: 50% 50%;
				background-repeat: no-repeat;
			}
			.particles-js-canvas-el{
				position:absolute;
				top:0;
			</style>
		</head>
		<body>';
}

function endIndexBody(){
	echo 
		'<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="../js/lib/particles.js"></script>
		<script src="../js/app.js"></script>
	
	</body>
	</html>';
}
?>