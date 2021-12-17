<?php

require_once "includes/header.php";

!isset($_SESSION['user']) ? header("Location: index.php") : null;

include $appIncludes."navigationbar.php";
?>
<script>
	const PAGE = "<?php echo "homepage" ?>"
</script>




<div id="feed-container">

	<form method="post" action="<?php echo $appControllers."newFeed-controller.php"?>">
		<div id="textarea-container">
			<div id="textarea-controller">
				<textarea name="new-feed" id="new-feed" placeholder="share your thoughts" rows="7" required></textarea>
			</div>
			<div id="feedBtn-controller">
				<div id="media">
					<span class='fas fa-image'></span>
					<span class='fas fa-video'></span>
					<span class='fas fa-microphone'></span>
				</div>
				<button id="feed-btn" type="submit" name="submit" aria-label="submit-feed"><i class="fa fa-paper-plane-o"></i></button>
			</div>
		</div>
	</form>

	<div id="feed-controller">
		<?php
			// get all posts
			// $sql = 'SELECT * FROM "posts" WHERE "parent_id" is Null';
			// // $sql = 'SELECT follow_user_id FROM "follow" WHERE "user_id" = ?'; post of followers
			// $rows = $db->fetch($sql);
										
			// require $appIncludes."feeds.php";

		?>
	</div> <!-- end feed-controller -->
	<!-- <button>More posts</button> -->

</div> <!-- end feed-container -->

<?php require_once $appIncludes."footer.php" ?>