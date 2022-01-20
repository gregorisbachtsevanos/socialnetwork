<?php
if(!defined('social')){
	die("Access denied");
}
loadHeader($title)?>
<script>const PAGE = "homepage";</script>

<div id="feed-container">

	<form method="post" action="<?php echo $appControllers."newFeed-controller.php"?>">
		<div id="textarea-container">
			<div id="textarea-controller">
				<textarea name="new-feed" id="new-feed" placeholder="share your thoughts" rows="7" required></textarea>
				<div id="display-feed" value="share your thoughts"></div>
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
		
	</div> <!-- end feed-controller -->

	<div id="loading-container">
		<button class="load-posts">more...</button>
		<?php require_once $appFiles."/assets/img/svg/loading.svg" ?>
		<p class="no-more-posts"></p>
	</div>

</div> <!-- end feed-container -->
<?php endBody()?>
