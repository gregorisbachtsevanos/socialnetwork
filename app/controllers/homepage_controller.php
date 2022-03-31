<?php

	if(!defined('social')){
		die("Access denied");
	}
		
	$title = 'Homepage';

	if(isset($user)){
		include($appView."homepage_view.php");
	}

?>