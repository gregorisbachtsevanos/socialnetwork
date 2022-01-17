<?php

	require_once('../../model/settings.php');
	if(isset($_POST['user'])){
		$data = array();
		$sql = "SELECT id FROM users WHERE username = ?";
		$params = array($_POST['user']);
		$row = $db->row($sql, $params);

		$sql = "SELECT `follow_user_id` FROM `follow` WHERE `user_id` = $row->id";
		$rows = $db -> fetch($sql);

		foreach($rows as $row){
			$sql = "SELECT fullname, username, avatar FROM users WHERE id = $row->follow_user_id";
			$row = $db->row($sql);
			
			$row->avatar 
					? $avatar = "<img style='width:100%;height:100%' src='../files/assets/img/avatars/".$row->avatar."' alt='image-profile'>"
					: $avatar = "<span class='user-icon'>".substr(ucwords($row->fullname),0,1)."</span>";

			$data = array(
				'fullname' => $row->fullname,
				'username' => $row->username,
				'avatar' => $avatar
			);
		}
		echo json_encode($data);
	}

?>