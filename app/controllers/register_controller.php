<?php 
	if (!defined('social')) {
		die('Access denied');
	}
		
		$title = 'register';
		$styles = '';
		$error = '';
		$SIGN_UP = 1;

		if(isset($_POST['signup-btn'])){
			echo "<script>let sign_up = `<?php echo '$SIGN_UP';?>`</script>";
			if(empty($_POST["username"]) || empty($_POST["fullname"]) || empty($_POST["email"]) || empty($_POST["pwd"]) || empty($_POST["pwdRepeat"])){
				$error = "Some fields are";
			} else{
	
				$sql = 'SELECT `id` FROM users WHERE username = ?';
				$params = array($_POST['username']);
				$row = $db->row($sql, $params);
	
				if(isset($row->id)){
					$error = "Username is taken";
				}else{
					if(!(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))){
						$error = "Email is not valid";
					}else{
						$sql = 'SELECT `user_id` FROM users_login WHERE email = ?';
						$params = array($_POST['email']);
						$row = $db->row($sql, $params);
						
						if(isset($row->id)){
							$error = "Email in use.";
						}else{
							if(strlen($_POST["pwd"]) < 8){
								$error = "Password must have 8 characters or more";
							} elseif($_POST["pwd"] !== $_POST["pwdRepeat"]){
								$error = "Passwords not match";
							} else{
								$pwdHash = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
								$data = array(
										"username"	=>	$_POST["username"],
										"fullname"	=>	ucwords($_POST["fullname"]),
										'bio'		=>	null,
										'avatar'	=>	null,
										'type'		=>	1,
										'status'	=>	1,
										'followers'	=>	0,
										'following'	=>	0,
										'auth_key'	=> 	null,
									);
	
								$new_id = $db->insert('users', $data);
								// print_r($new_id);
								$data = array(
										'user_id'	=>	$new_id,
										'email'		=> $_POST["email"],
										"password"	=>	$pwdHash
									);
	
								$db -> insert("users_login", $data);
								
								$data = array(
										"user_id"			=>	$new_id,
										"cover_image"		=>	NULL,
										"phone_number"		=>	NULL,
										"website"			=>	NULL,
										"youtube"			=>	NULL,
										"date_registered"	=>	date("Y:m:d h:m:s")
									);
								
								$db -> insert("users_extra_info", $data);
								$_SESSION["user"] = $new_id;
								$_SESSION["fullname"] = $_POST["fullname"];
								header("Location: ".$appPublic."homepage");
							}
						}
					}
				}
			}
			
		}
		$err = $error;
	include($appView.'register_view.php');
?>