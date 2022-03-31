<?php 
if(!defined('social')){
	die("Access denied");
}

loadIndexHeader($title, $styles, $err)?>
<div class="container" id="particles-js" style="height:100vh;width:100vw;background-color:rgba(25,25,25,1);"> <!-- class hide -->
	<div class="form" style="z-index:10">

		<form action="<?php echo $appURL; ?>register" method="post">
			<legend>Sign Up</legend>
			<div class="input-controller">
				<label>Username<br>
					<input type="text" autocomplete="off" name="username" value="<?php if(isset($_POST["username"])){echo $_POST["username"];} ?>">
				</label>
			</div>
			<div class="input-controller">
				<label>Fullname<br>
					<input type="text" autocomplete="off" name="fullname" value="<?php if(isset($_POST["fullname"])){echo $_POST["fullname"];} ?>">
				</label>
			</div>
			<div class="input-controller">
				<label>Email<br>
					<input type="email" autocomplete="off" name="email" value="<?php if(isset($_POST["email"])){echo $_POST["email"];} ?>">
				</label>
			</div>
			<div class="input-controller">
				<label>Password<br>
					<input type="password" autocomplete="off" name="pwd">
				</label>
			</div>
			<div class="input-controller">
				<label>Repeat Password<br>
					<input type="password" autocomplete="off" name="pwdRepeat">
				</label>
			</div>
			<div class="input-controller" id="submit-btn">
				<input type="submit" class="submit" name="signup-btn" value="Signup"></input><br>
			</div>
			<?php echo $error ?>
			<br>
			<a href="<?php echo $appURL; ?>login" id="member" style="color: #cc4a7c;">Are you a member already? Login.</a> or 
			<a href="<?php echo $appURL; ?>" style="color: #cc4a7c;">Go Back</a>

		</form>

	</div>
</div>
<?php endIndexBody()?>