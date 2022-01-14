<?php 
if(!defined("social"))
	die("Access denied");

	$title = $controllerName;

	$sql = "SELECT * FROM `users` WHERE username = ?";
	$params = array($controllerName);
	$row = $db -> row($sql, $params);

	!isset($row->id) ? header("Location: ".$appURL."404") : null;

	// sql for user's avatar
	$sql = "SELECT * FROM users WHERE username = ?";
	$params = array($_SESSION["user"]);
	$rowUserAvatar = $db->row($sql, $params);
	
	if($rowUserAvatar->avatar){
		$profileAvatar = "<img style='width:100%;height:100%' src='$appAvatars$row->avatar' alt='image-profile'>";
	}else{
		$profileAvatar = "<span class='user-icon'>".substr(ucwords($rowUserAvatar->fullname),0,1)."</span>";
	}

	$userCheck = getUsername($requestUrl, $appURL);
	if(isset($cParams[0]) && $cParams[0] == 'edit'){

		// $requestString = substr($requestUrl, strlen($appURL));
		// $urlParams = explode('/', $requestString);
		// $userProfile = $urlParams[0];

		$title = 'edit';
		include($appView."edit_view.php");
		exit();
	}

include($appView."profile_view.php");