<?php
	session_start();
	require_once "../app/model/settings.php";

	// if(isset($_GET["logout"])){
	// 	unset($_SESSION["user"]);
	// 	header("Location: ".$appPublic."index.php");
	// }
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<script>
		const userId = <?php echo isset($_GET['id']) ? $_GET['id'] : $_SESSION["user"] ?>
	</script>
	<meta charset="utf-8">
	<title>Social Network</title>
	<meta name="description" content="Social network">
	<link rel="stylesheet" href="../styles/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/947f5ef4a5.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
	<!-- <link rel="preload" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" as="font"> -->

</head>
<body>
