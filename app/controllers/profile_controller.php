<?php 
if(!defined("social")){
	die("Access denied");
}

	$title = ucwords($controllerName);
	$username = getURL($requestUrl, $appURL);

	        $sql = "SELECT * FROM users INNER JOIN users_login ON users_login.user_id = users.id INNER JOIN users_extra_info ON users_extra_info.user_id = users.id WHERE users.username = ?";

	$params = array($username[0]);
	$row = $db -> row($sql, $params);

	!isset($row->id) ? header("Location: ".$appURL."404") : null;

	// sql for user's avatar
	if(!isset(($cParams[0]))){

		$sql = "SELECT * FROM users WHERE username = ?";
		$params = array($username[0]);
		$row = $db->row($sql, $params);
		
		if($row->avatar){
			$avatar = "<img style='width:100%;height:100%' src=".$appAvatars.$row->avatar." alt='image-profile'>";
		}else{
			$avatar = "<span class='user-icon'>".substr(ucwords($row->fullname),0,1)."</span>";
		}
		
	}

	// $userCheck = getUsername($requestUrl, $appURL);
	$userCheck = getURL($requestUrl, $appURL);
	if(isset($cParams[0]) && $cParams[0] == 'edit'){
		
		$title = 'Edit';
		if (isset($_POST['submit'])){
			$msg = "No changes have been made";
			$success = array();
			$changeEvent = false;
			
			if(!empty($_FILES["avatar"]["name"]) ){
				$img = $_FILES["avatar"]["name"];
				move_uploaded_file($_FILES["avatar"]["tmp_name"], $appAvatars.$img);
				$db->update('users', 
					array('avatar'=>$img),
					array('username'=>$_SESSION["user"])
				);
				$success[] = "Profile Pic";
				$changeEvent = true;
			  
			}
			if(!empty($_POST["fullname"]) && $_POST["fullname"] != $row->fullname){
				$db->update('users', 
					array('fullname'=>$_POST["fullname"]),
					array('username'=>$row->username)
				);
				$success[] = "Fullname";
				$changeEvent = true;
			}
			if(!empty($_POST["bio"]) && $_POST["bio"] != $row->bio){
				$db->update('users', 
					array('bio'=>$_POST["bio"]),
					array('username'=>$row->username)
				);
				$success[] = "Bio";
				$changeEvent = true;
			}

			$sql = 'SELECT * FROM users_login WHERE user_id = ?';
			$params = array($row->id);
			$rowLogin = $db->row($sql, $params);
			
			if(!empty($_POST["email"]) && $_POST["email"] != $rowLogin->email){
				

				if(!(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))){
					$error = "Email is not valid";
				}if(isset($rowId->email)){
					echo $_POST["email"];
					$error = "Email in use.";
				}else{
					$db->update('users_login', 
						array('email'=>$_POST["email"]),
						array('user_id'=>$row->id)
					);
					$success[] = "Email";
					$changeEvent = true;
				}
	
			}
			
			$sql = 'SELECT * FROM users_extra_info WHERE user_id = ?';
			$params = array($row->id);
			$rowInfo = $db->row($sql, $params);

			if(!empty($_POST["website"]) && $_POST["website"] != $rowInfo->website){
				$db->update('users_extra_info', 
					array('website'=>$_POST["website"]),
					array('user_id'=>$row->id)
				);
				$success[] = "Website";
				$changeEvent = true;
			}
			if(!empty($_POST["youtube"]) && $_POST["youtube"] != $rowInfo->youtube){
				$db->update('users_extra_info', 
					array('youtube'=>$_POST["youtube"]),
					array('user_id'=>$row->id)
				);
				$success[] = "YouTube";
				$changeEvent = true;
			}
			if(!empty($_POST["instagram"]) && $_POST["instagram"] != $rowInfo->instagram){
				$db->update('users_extra_info', 
					array('instagram'=>$_POST["instagram"]),
					array('user_id'=>$row->id)
				);
				$success[] = "Instagram";
				$changeEvent = true;
			}
			if(!empty($_POST["tiktok"]) && $_POST["tiktok"] != $rowInfo->tiktok){
				$db->update('users_extra_info', 
					array('tiktok'=>$_POST["tiktok"]),
					array('user_id'=>$row->id)
				);
				$success[] = "TiktTok";
				$changeEvent = true;
			}
			if(!empty($_POST["phone"]) && $_POST["phone"] != $rowInfo->phone_number){
				$db->update('users_extra_info', 
					array('phone_number'=>$_POST["phone"]),
					array('user_id'=>$row->id)
				);
				$success[] = "Phone Number";
				$changeEvent = true;
			}
			if(!empty($_POST["password"])){
				if(password_verify($_POST["password"], $rowLogin->password)){
					if(!empty($_POST["new-password"]) && !empty($_POST["repeat-password"])){
						if(strlen($_POST["new-password"]) < 8){
							$error = "Password must have 8 characters or more";
						} elseif($_POST["new-password"] !== $_POST["repeat-password"]){
							$error = "Passwords not match";
						}else{
							$msg = "changed";
							$pwdHash = password_hash($_POST["new-password"], PASSWORD_DEFAULT);
							$db->update('users_login',
								array("password"=>$pwdHash),
								array("user_id"=>$row->id)
							);
							$success[] = "Password";
							$changeEvent = true;
						}
					}
	
				}else {
					$error = "Wrong password";
				}
			}
			// echo(count($success));
			if($changeEvent){
				$msg = implode(', ', $success).' update successfully.';
			}
			// }else{
				// 	die("msg");
			}

		include($appView."edit_view.php");
		exit();
	}

include($appView."profile_view.php");