<?php
if(!defined("social")){
	die("Access denied");
}

loadHeader($title)?>

<script>const PAGE = "trending";</script>

<div class="trending-container">
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
<div class="trending-users-container"></div>
<div class="trending-posts-container"></div>
<div class="trending-images-container"></div>
<?php endBody(); ?>