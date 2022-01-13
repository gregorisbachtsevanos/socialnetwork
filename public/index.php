<?php
require_once('../app/model/settings.php');
define('social', TRUE);

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

require_once('../includes/template.php');
if($controllerName == ''){
	$controllerName = 'index';
}elseif(substr($requestUrl, -1) == '/'){
	$requestUrl = rtrim($requestUrl, '/');
	header("Location: ".$requestUrl);
	exit();
}
// echo $controllerName;

$cParams = array();
while(Count($urlParams) > 0){
	$actionName = filter_var(strtolower(array_shift($urlParams)), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	// echo $actionName;
	$actionName = strstr($actionName, '?', true) ?: $actionName;
	if($actionName != '')
	array_push($cParams, $actionName);
}
// echo $urlParams;
if(isset($cParams[0]) && file_exists($appControllers.$controllerName.'/'.$cParams[0].'_controller.php')){
	// echo $appControllers.$controllerName.'/'.$cParams[0].'_controller.php';
	$file = $cParams[0];
	unset($cParams[0]);
	$cParams = array_values($cParams);
	// echo $appControllers.$controllerName.'/'.$file.'_controller.php';
	include($appControllers.$controllerName.'/'.$file.'_controller.php');

}else if(file_exists($appControllers.$controllerName.'/index_controller.php')){
	include($appControllers.$controllerName.'/index_controller.php');

}else if(file_exists($appControllers.$controllerName.'_controller.php')){
	include($appControllers.$controllerName.'_controller.php');

}else{
	include($appControllers.'profile_controller.php');
}

