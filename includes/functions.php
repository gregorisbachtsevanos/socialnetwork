<?php 

	if(!defined('social')){
		die("Access denied");
	}
		
	require_once('../app/model/settings.php');

	// function getUsername($requestUrl, $appURL){
	// 	$requestString = substr($requestUrl, strlen($appURL));
	// 	$urlParams = explode('/', $requestString);
	// 	return $userProfile = $urlParams[0];
	// }

	function getURL($requestUrl, $appURL){
		$requestString = substr($requestUrl, strlen($appURL));
		$urlParams = explode('/', $requestString);
		return $urlParams;
	}

?>