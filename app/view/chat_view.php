<?php 
	if(!defined("social")){
		die("Access denied");
	}

	loadHeader($title);
?>

	<div id="chat-container">
		<div id="conversations">
			<div class="conversation">
				<img src="../files/assets/img/avatars/1.jpg" alt="profile-pic">
				<h3>Fullname <br> <span>@username</span></h3>
			</div>
			<hr>
			<div class="conversation">
				<img src="../files/assets/img/avatars/2.jpg" alt="profile-pic">
				<h3>Fullname <br> <span>@username</span></h3>
			</div>
			<hr>
			<div class="conversation">
				<img src="../files/assets/img/avatars/3.jpg" alt="profile-pic">
				<h3>Fullname <br> <span>@username</span></h3>
			</div>
			<hr>
			<div class="conversation">
				<img src="../files/assets/img/avatars/4.jpg" alt="profile-pic">
				<h3>Fullname <br> <span>@username</span></h3>
			</div>
			<hr>
			<div class="conversation">
				<img src="../files/assets/img/avatars/5.jpg" alt="profile-pic">
				<h3>Fullname <br> <span>@username</span></h3>
			</div>
			<hr>
			<div class="conversation">
				<img src="../files/assets/img/avatars/6.jpg" alt="profile-pic">
				<h3>Fullname <br> <span>@username</span></h3>
			</div>
			<hr>
			<div class="conversation">
				<img src="../files/assets/img/avatars/7.jpg" alt="profile-pic">
				<h3>Fullname <br> <span>@username</span></h3>
			</div>
			<hr>
			<div class="conversation">
				<img src="../files/assets/img/avatars/8.jpg" alt="profile-pic">
				<h3>Fullname <br> <span>@username</span></h3>
			</div>
			<hr>
		</div>
		<div id="chat">
			<div class="chat-status">
				<div class="user">
					<img src="../files/assets/img/avatars/9.jpg" alt="profile-pic">
					<h3>Fullname <span>@username</span></h3>
				</div>
				<hr>
				<div class="msg-container">
					<div class="msg">
						<div class="sended">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus quisquam architecto eaque ut ex aliquid esse consequuntur, nostrum libero labore!</div>
						<div class="received">Lorem ipsum dolor sit amet consectetur adipisicing elit. Non sunt itaque vitae similique fugit neque, aliquid accusamus minus impedit, voluptates quae odit perspiciatis doloremque molestias nisi alias, nesciunt porro! Deleniti?</div>
						<div class="received">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus quisquam architecto eaque ut ex aliquid esse consequuntur, nostrum libero labore!</div>
						<div class="sended">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus quisquam architecto eaque ut ex aliquid esse consequuntur, nostrum libero labore!</div>
						<div class="sended">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus quisquam architecto eaque ut ex aliquid esse consequuntur, nostrum libero labore!</div>
						<div class="received">Lorem ipsum dolor sit amet consectetur adipisicing elit. Non sunt itaque vitae similique fugit neque, aliquid accusamus minus impedit, voluptates quae odit perspiciatis doloremque molestias nisi alias, nesciunt porro! Deleniti?</div>
						<div class="received">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus quisquam architecto eaque ut ex aliquid esse consequuntur, nostrum libero labore!</div>
						<div class="sended">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus quisquam architecto eaque ut ex aliquid esse consequuntur, nostrum libero labore!</div>
						<div class="sended">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus quisquam architecto eaque ut ex aliquid esse consequuntur, nostrum libero labore!</div>
						<div class="received">Lorem ipsum dolor sit amet consectetur adipisicing elit. Non sunt itaque vitae similique fugit neque, aliquid accusamus minus impedit, voluptates quae odit perspiciatis doloremque molestias nisi alias, nesciunt porro! Deleniti?</div>
						<div class="received">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus quisquam architecto eaque ut ex aliquid esse consequuntur, nostrum libero labore!</div>
						<div class="sended">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus quisquam architecto eaque ut ex aliquid esse consequuntur, nostrum libero labore!</div>
						<div class="sended">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus quisquam architecto eaque ut ex aliquid esse consequuntur, nostrum libero labore!</div>
						<div class="received">Lorem ipsum dolor sit amet consectetur adipisicing elit. Non sunt itaque vitae similique fugit neque, aliquid accusamus minus impedit, voluptates quae odit perspiciatis doloremque molestias nisi alias, nesciunt porro! Deleniti?</div>
						<div class="received">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus quisquam architecto eaque ut ex aliquid esse consequuntur, nostrum libero labore!</div>
						<div class="sended">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus quisquam architecto eaque ut ex aliquid esse consequuntur, nostrum libero labore!</div>
						
					</div>
				</div>
				
				<form action="">
					<label for="chat">
						<input type="text" placeholder="Message">
						<input type="submit" value="Send">
					</label>
				</form>
			</div>
		</div>
	</div>

<?php endBody();?>
