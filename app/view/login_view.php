<?php 
if(!defined('social'))
	die("Access denied");

loadHeader($title)?>
<div class="container login">
	<div class="form">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<legend>Login</legend>
			<div class="input-controller">
				<label>Username <br>
					<input type="text" name="username" autocomplete="off" value="<?php if(isset($_POST["username"])){echo $_POST["username"];} ?>">
				</label>
			</div>
			<div class="input-controller">
				<label>Password <br>
					<input type="password" name="pwd">
				</label>
			</div>
			<div class="input-controller" id="submit-btn">
				<input type="submit" class="submit" name="login-btn" value="Login"></input><br>
			</div>
			<?php echo $error ?>
			<br>
			<a href="index.php" id="new-account">Don't have an account yet? Create one.</a>
		</form>
	</div>
</div>
<?php endBody()?>