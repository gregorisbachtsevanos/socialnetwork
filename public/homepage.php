<?php

require_once "includes/header.php";


!isset($_SESSION['user']) ? header("Location: index.php") : null;

include "includes/navigationbar.php";
?>
<div id='welcome'>
<p>Welcome <br><span><?php echo ucwords($_SESSION['fullname'])?></span></p>
</div>


<div id="feed-container">

	<form method="post" action="../app/newFeed.php">
		<div id="textarea-container">
			<div id="textarea-controler">
				<textarea name="new-feed" id="new-feed" placeholder="share your thoughts"  rows="7" required></textarea>
			</div>
			<div id="feedBtn-controler">
				<div id="media">
					<span class='fas fa-image'></span>
					<span class='fas fa-video'></span>
					<span class='fas fa-microphone'></span>
				</div>
				<button id="feed-btn" type="submit" name="submit">Public</button>
			</div>
		</div>
	</form>

	<div id="feed-controler">
		<?php
			$sql = 'SELECT `id`, `user_id`, `parent_id`, `message`, `video`, `images`, `audio`, `date_created`, `total_views`, `total_reposts`, `total_likes`, `total_comments`, `mentions`, `hashtags`, `repost_id` FROM "posts" WHERE "parent_id" is Null';
			$rows = $db->fetch($sql);
			if($rows > 0){ 
				foreach($rows as $value){?>

				<div id="feed">
					<?php 
						$sql = "SELECT `fullname`, `username` FROM `users` WHERE `id` = '$value->user_id'";
						$row = $db->row($sql);
					?>
					<div id="feed-info">
						<h4><?php echo ucwords($row->fullname)."<small> @$row->username</small>" ?></h4>
						<span><small><?php echo  date("d/m/Y",strtotime($value->date_created)) ?></small></span><hr>
					</div>
					<div id="feed-message">
						<p id="post-msg"><?php echo $value->message ?></p><hr>
						<p id="reactions">
							<span class="far fa-eye"> <small><?php echo $value->total_views?></small></span>
							<span class="far fa-heart"> <small><?php echo $value->total_likes?></small></span>
							<span class="far fa-comment"> <small><?php echo $value->total_comments?></small></span>
						</p>
					</div>

				</div>
				<div id="comments-container" class="hide-comments">
					<div id="comment-info">
						
						<p>Lorems ipsum dolor sit amet consectetur adipisicing elit. Inventore quos perferendis qui possimus nesciunt consectetur molestias velit, blanditiis nostrum, voluptatibus, sed corporis quidem accusamus a facilis atque voluptas dicta culpa.</p>
					</div>
				</div>
				
			<?php 
				}
			}

		?>
	</div>

</div>

<?php require_once "includes/footer.php" ?>