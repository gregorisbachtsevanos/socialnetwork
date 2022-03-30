<?php

	if(!defined('social')){
		die("Access denied");
	}
		
	$title = 'homepage';

	if(isset($user)){
		include($appView."homepage_view.php");
	}

?>