<?php

define('social', TRUE);
require_once('../app/model/settings.php');
require_once('../includes/index-template.php');
require_once('../includes/functions.php');

$requestUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
// echo $requestUrl;
$requestString = substr($requestUrl, strlen($appURL));
// echo $requestString;
$urlParams = explode('/', $requestString);
// print_r($urlParams);
$requestString = rtrim($requestString, '/');
// echo $requestString;
$controllerName = filter_var(strtolower(array_shift($urlParams)), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
// echo $controllerName;
$controllerName = strstr($controllerName, '?', true) ?: $controllerName;
if($controllerName == ''){
	$controllerName = 'index';
}elseif(substr($requestUrl, -1) == '/'){
	$requestUrl = rtrim($requestUrl, '/');
	header("Location: ".$requestUrl);
	exit();
}
// print_r($urlParams);

$cParams = array();
while(Count($urlParams) > 0){
	$actionName = filter_var(strtolower(array_shift($urlParams)), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	// echo $actionName."<br>";
	$actionName = strstr($actionName, '?', true) ?: $actionName;
	if($actionName != '')
	array_push($cParams, $actionName);
}

// print_r($cParams);
if(isset($cParams[0]) && file_exists($appControllers.$controllerName.'/'.$cParams[0].'_controller.php')){
	$file = $cParams[0];
	unset($cParams[0]);
	$cParams = array_values($cParams);
	require_once('../includes/template.php');
	include($appControllers.$controllerName.'/'.$file.'_controller.php');
	
}else if(file_exists($appControllers.$controllerName.'/index_controller.php')){
	require_once('../includes/template.php');
	include($appControllers.$controllerName.'/index_controller.php');
	
}else if(file_exists($appControllers.$controllerName.'_controller.php')){
	if($controllerName != "index" && $controllerName != "login" && $controllerName != "register"){
		require_once('../includes/template.php');
	}
	include($appControllers.$controllerName.'_controller.php');
	
}else{
	require_once('../includes/template.php');
	include($appControllers.'profile_controller.php');
}

