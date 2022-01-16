<?php 
if(!defined('social')){
	die("Access denied");
}

loadIndexHeader($title, $styles, $err)?>
<div class="container login">
	<div class="form">
		<form action="<?php echo $appURL; ?>login" method="post">
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
			<a href="<?php echo $appURL; ?>register" id="new-account">Don't have an account yet? Create one.</a>
		</form>
	</div>
</div>
<?php endIndexBody()?>