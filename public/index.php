<?php
define('social', TRUE);
require_once('../app/model/settings.php');

$requestUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
// echo $requestUrl.'<br>';
$requestString = substr($requestUrl, strlen($appURL));
// echo $requestString.'<br>';
$urlParams = explode('/', $requestString);
// print_r($urlParams);
$requestString = rtrim($requestString, '/');
// echo '<br>'.$requestString.'<br>';
$controllerName = filter_var(strtolower(array_shift($urlParams)), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
// echo $controllerName.'<br>';
$controllerName = strstr($controllerName, '?', true) ?: $controllerName;
// echo $controllerName.'<br>';

if($controllerName == ''){
	$controllerName = 'index';
}elseif(substr($requestUrl, -1) == '/'){
	$requestUrl = rtrim($requestUrl, '/');
	header("Location:".$requestUrl);
	exit();
}
// echo $controllerName.'<br>';

$cParams = array();
while(Count($urlParams) > 0){
	$actionName = filter_var(strtolower(array_shift($urlParams)), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	// echo $actionName.'<br>';
	$actionName = strstr($actionName, '?', true) ?: $actionName;
	if($actionName != '')
		array_push($cParams, $actionName);
}
echo $cParams[0].'<br>';
if(isset($cParams[0]) && file_exists($appControllers.$controllerName.'/'.$cParams[0].'_controller.php')){
	$file = $cParams[0];
	unset($cParams[0]);
	$cParams = array_values($cParams);
	echo '<br>'.$appControllers.$controllerName.'/'.$cParams[0].'_controller.php';
	exit();
	include($appControllers.$controllerName.'/'.$file.'_controller.php');
}else if(file_exists($appControllers.$controllerName.'/index_controller.php')){
	include($appControllers.$controllerName.'/index_controller.php');
}else if(file_exists($appControllers.$controllerName.'_controller.php')){
	include($appControllers.$controllerName.'_controller.php');
}else{
	include($appControllers.'profile_controller.php');
}