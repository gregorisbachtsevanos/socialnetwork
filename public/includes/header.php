<?php
	session_start();
	require_once "../app/model/settings.php";

	if(isset($_GET["logout"])){
		unset($_SESSION["user"]);
		header("Location: ../public/index.php");
	}
	
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" href="../styles/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>