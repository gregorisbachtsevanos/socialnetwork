<?php 
if(!defined("social"))
	die("Access denied");

	$title = $controllerName;

	$sql = "SELECT * FROM `users` WHERE username = ?";
	$params = array($controllerName);
	$row = $db -> row($sql, $params);

	!isset($row->id) ? header("Location: ".$appURL."404") : null;

	// sql for user's avatar
	$username = getURL($requestUrl, $appURL);
	// print_r($username);

	$sql = "SELECT * FROM users WHERE username = ?";
	$params = array($username[0]);
	$rowUserAvatar = $db->row($sql, $params);
	
	if($rowUserAvatar->avatar){
		$profileAvatar = "<img style='width:100%;height:100%' src='$appAvatars$row->avatar' alt='image-profile'>";
	}else{
		$profileAvatar = "<span class='user-icon'>".substr(ucwords($rowUserAvatar->fullname),0,1)."</span>";
	}

	// $userCheck = getUsername($requestUrl, $appURL);
	$userCheck = getURL($requestUrl, $appURL);
	if(isset($cParams[0]) && $cParams[0] == 'edit'){

		$title = 'edit';

		if (isset($_POST['submit'])){
			$success = array();
			$changeEvent = false;
			$sql = "SELECT * FROM users WHERE username = ?";
			// $sql = "SELECT * FROM users INNER JOIN users_login ON users_login.user_id = users.id INNER JOIN users_extra_info ON users_extra_info.user_id = users.id WHERE users.id = ?";
			$params = array($_SESSION["user"]);
			$row = $db->row($sql, $params);
			
			// if(!empty($_FILES["avatar"]["name"]) ){
			// 	$img = $_FILES["avatar"]["name"];
			// 	move_uploaded_file($_FILES["avatar"]["tmp_name"], "../../files/assets/img/avatars/".$img);
			// 	$db->update('users', 
			// 		array('avatar'=>$img),
			// 		array('id'=>$_SESSION["user"])
			// 	);
			// 	$success[] = "Profile Pic";
			// 	$changeEvent = true;
			  
			// }
			if(!empty($_POST["fullname"]) && $_POST["fullname"] != $row->fullname){
				$db->update('users', 
					array('fullname'=>$_POST["fullname"]),
					array('username'=>$_SESSION["user"])
				);
				$success[] = "Fullname";
				$changeEvent = true;
			}
			if(!empty($_POST["bio"]) && $_POST["bio"] != $row->bio){
				$success[] = "Bio";
				$db->update('users', 
					array('bio'=>$_POST["bio"]),
					array('username'=>$_SESSION["user"])
				);
				$success[] = "bio";
				$changeEvent = true;
			}
			if(!empty($_POST["email"]) && $_POST["email"] != $row->email){
	
				$sql = 'SELECT `user_id` FROM users_login WHERE email = ?';
				$params = array($row->id);
				$rowId = $db->row($sql, $params);
				print_r($rowId);
	
				if(!(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))){
					$error = "Email is not valid";
				}if(isset($row->id)){
					$error = "Email in use.";
				}else{
					$db->update('users_login', 
						array('email'=>$_POST["email"]),
						array('username'=>$_SESSION["user"])
					);
					$success[] = "Email";
					$changeEvent = true;
				}
	
			}
			// if(!empty($_POST["website"]) && $_POST["website"] != $row->website){
			// 	$db->update('users_extra_info', 
			// 		array('website'=>$_POST["website"]),
			// 		array('user_id'=>$_SESSION["user"])
			// 	);
			// 	$success[] = "Website";
			// 	$changeEvent = true;
			// }
			// if(!empty($_POST["youtube"]) && $_POST["youtube"] != $row->youtube){
			// 	$db->update('users_extra_info', 
			// 		array('youtube'=>$_POST["youtube"]),
			// 		array('user_id'=>$_SESSION["user"])
			// 	);
			// 	$success[] = "YouTube";
			// 	$changeEvent = true;
			// }
			// if(!empty($_POST["instagram"]) && $_POST["instagram"] != $row->instagram){
			// 	$db->update('users_extra_info', 
			// 		array('instagram'=>$_POST["instagram"]),
			// 		array('user_id'=>$_SESSION["user"])
			// 	);
			// 	$success[] = "Instagram";
			// 	$changeEvent = true;
			// }
			// if(!empty($_POST["tiktok"]) && $_POST["tiktok"] != $row->tiktok){
			// 	$db->update('users_extra_info', 
			// 		array('tiktok'=>$_POST["tiktok"]),
			// 		array('user_id'=>$_SESSION["user"])
			// 	);
			// 	$success[] = "TiktTok";
			// 	$changeEvent = true;
			// }
			// if(!empty($_POST["phone"]) && $_POST["phone"] != $row->phone_number){
			// 	$db->update('users_extra_info', 
			// 		array('phone_number'=>$_POST["phone"]),
			// 		array('user_id'=>$_SESSION["user"])
			// 	);
			// 	$success[] = "Phone Number";
			// 	$changeEvent = true;
			// }
			// if(!empty($_POST["password"])){
			// 	$sql = 'SELECT `user_id`, "password" FROM users_login WHERE `user_id` = ?';
			// 	$params = array($_SESSION["user"]);
			// 	$row = $db->row($sql, $params);
			// 	if(password_verify($_POST["password"],$row->password)){
					
			// 		if(!empty($_POST["new-password"]) && !empty($_POST["repeat-password"])){
			// 			if(strlen($_POST["new-password"]) < 8){
			// 				$error = "Password must have 8 characters or more";
			// 				header("Location: ".$appPublic."edit.php?error=".$error);
			// 				exit();
			// 			} elseif($_POST["new-password"] !== $_POST["repeat-password"]){
			// 				$error = "Passwords not match";
			// 				header("Location: ".$appPublic."edit.php?error=".$error);
			// 				exit();
			// 			}else{
			// 				$pwdHash = password_hash($_POST["new-password"], PASSWORD_DEFAULT);
			// 				$db->update('users_login',
			// 					array("password"=>$pwdHash),
			// 					array("user_id"=>$_SESSION["user"])
			// 				);
			// 				$success[] = "Password";
			// 				$changeEvent = true;
			// 			}
			// 		}
	
			// 	}else {
			// 		$error = "Wrong password";
			// 		header("Location: ".$appPublic."edit.php?error=".$error);
			// 		exit();
			// 	}
			// }
			// if($changeEvent){
			// 	header("Location: ".$appPublic."edit.php?success=".implode(" ",$success). " have change successfully");
			// 	exit();
			// }else{
			// 	header("Location: ".$appPublic."edit.php?noChanges=No changes are made");
			// 	exit();
			// }
		// }else{
		// 	die("Error");
		}

		include($appView."edit_view.php");
		exit();
	}

include($appView."profile_view.php");