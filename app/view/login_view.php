<?php 
if(!defined('social')){
	die("Access denied");
}

loadIndexHeader($title, $styles, $err)?>
<div class="container login" id="particles-js" style="height:100vh;width:100vw;background-color:rgba(25,25,25,1);">
	<div class="form" style="z-index:10">
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
			<a href="<?php echo $appURL; ?>register" id="new-account" style="color: #cc4a7c;">Don't have an account yet? Create one.</a> or 
			<a href="<?php echo $appURL; ?>" style="color: #cc4a7c;">Go Back</a>
		</form>
	</div>
</div>
<?php endIndexBody()?>