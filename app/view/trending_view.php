<?php
if(!defined("social")){
	die("Access denied");
}

loadHeader($title)?>
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
</div> <!-- end actions-container -->
<?php endBody(); ?>