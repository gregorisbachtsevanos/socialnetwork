<?php
require_once "includes/header.php";
isset($_SESSION['user']) ? header("Location: homepage.php") : null;
?>


	<?php
	$error = "";
	// login call
	 if(isset($_POST['login-btn'])){
		$sql = 'SELECT id, fullname FROM users WHERE username = ?';
		$params = array($_POST['username']);
		$row = $db->row($sql, $params);
		
		if(isset($row->id)){
			$fullname = $row->fullname;
			$sql = 'SELECT `user_id`, "password" FROM users_login WHERE `user_id` = ?';
			$params = array($row->id);
			$row = $db->row($sql, $params);

			if(password_verify($_POST["pwd"],$row->password)){
				$_SESSION['user'] = $row->user_id;
				$_SESSION["fullname"] = $fullname;
				header("Location: homepage.php");
				exit();
			}
			else {
				$error = 'Wrong password.';
			}
		}
		else {
			$error = 'The user not found.';
		}
	}
	?>
	<!-- login form -->
	<div class="container login">
		<div class="form">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<legend>Login</legend>
				<div class="input-controler">
					<label>Username <br>
						<input type="text" name="username" autocomplete="off" value="<?php if(isset($_POST["username"])){echo $_POST["username"];} ?>">
					</label>
				</div>
				<div class="input-controler">
					<label>Password <br>
						<input type="password" name="pwd">
					</label>
				</div>
				<div class="input-controler" id="submit-btn">
					<input type="submit" class="submit" name="login-btn" value="Login"></input><br>
				</div>
				<?php echo $error ?>
				<br>
				<a href="index.php" id="new-account">Don't have an account yet? Create one.</a>
			</form>
		</div>
	</div>

	<?php
	// signup call
	if(isset($_POST['signup-btn'])){
		$error = "";
		$SIGN_UP = 1;
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
							print_r($new_id);
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
							header("Location: homepage.php");
						}
					}
				}
			}
		}
		
	}
	?>

	<!-- signup form -->
	<div class="container signup hide">
		<div class="form">

			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<legend>Sign Up</legend>
				<div class="input-controler">
					<label>Username<br>
						<input type="text" autocomplete="off" name="username" value="<?php if(isset($_POST["username"])){echo $_POST["username"];} ?>">
					</label>
				</div>
				<div class="input-controler">
					<label>Fullname<br>
						<input type="text" autocomplete="off" name="fullname" value="<?php if(isset($_POST["fullname"])){echo $_POST["fullname"];} ?>">
					</label>
				</div>
				<div class="input-controler">
					<label>Email<br>
						<input type="email" autocomplete="off" name="email" value="<?php if(isset($_POST["email"])){echo $_POST["email"];} ?>">
					</label>
				</div>
				<div class="input-controler">
					<label>Password<br>
						<input type="password" autocomplete="off" name="pwd">
					</label>
				</div>
				<div class="input-controler">
					<label>Repeat Password<br>
						<input type="password" autocomplete="off" name="pwdRepeat">
					</label>
				</div>
				<div class="input-controler" id="submit-btn">
					<input type="submit" class="submit" name="signup-btn" value="Signup"></input><br>
				</div>
				<?php echo $error ?>
				<br>
				<a href="index.php" id="member">Are you a member already? Login.</a>

			</form>
		</div>

	</div>

<?php 
	require_once $appIncludes."footer.php";
?>