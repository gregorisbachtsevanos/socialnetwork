<?php
	session_start();
	require_once "../app/model/settings.php";

	if(isset($_GET["logout"])){
		unset($_SESSION["user"]);
		header("Location: ".$appPublic."index.php");
	}
	
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Social Network</title>
	<link rel="stylesheet" href="../styles/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/947f5ef4a5.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
