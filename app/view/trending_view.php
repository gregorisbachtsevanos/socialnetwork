<?php
if(!defined("social")){
	die("Access denied");
}

loadHeader($title)?>

<script>const PAGE = "trending";</script>

<div class="trending-btns-container">
	<div class="trending-type">
		<div class="trending trending-users">
			<button>Users</button>
		</div>
		<div class="trending trending-post"> 
			<button>Posts</button>
		</div>
		<div class="trending trending-images">
			<button>Images</button>
		</div>
		
	</div>
</div> <!-- end trending-container -->

<div class="trending-container">
	<div class="trending-categories-container">
		<div class="trending-categories-contoller">
			<div class="trending-users-container">

		</div>
			<div class="trending-posts-container">
			<h4>Most liked posts of the last seven  days</h4>

			</div>
			<div class="trending-images-container">

			</div>
		</div>
	</div>
	<div class="suggestions-container">
		<div class="suggestions-controller">
			<h4>Suggestions</h4>
			<div class="suggestions-accounts">
				<div class="suggestions-card user" data-id="">
					<div class="profile">
						<div class="profile-img">

						</div>
						<div class="info">
							<h2>fullname&nbsp;<a href="../public/">@username</a></h2>
							<div class="btns">
								<button class="follow-btn">follow</button>
								<button>Message</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="suggestions-accounts">
				<div class="suggestions-card user" data-id="">
					<div class="profile">
						<div class="profile-img">

						</div>
						<div class="info">
							<h2>fullname&nbsp;<a href="../public/">@username</a></h2>
							<div class="btns">
								<button class="follow-btn">follow</button>
								<button>Message</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="suggestions-accounts">
				<div class="suggestions-card user" data-id="">
					<div class="profile">
						<div class="profile-img">

						</div>
						<div class="info">
							<h2>fullname&nbsp;<a href="../public/">@username</a></h2>
							<div class="btns">
								<button class="follow-btn">follow</button>
								<button>Message</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endBody(); ?>