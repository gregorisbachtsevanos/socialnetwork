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
				<textarea name="new-feed" id="new-feed" placeholder="share your thoughts" rows="7" required></textarea>
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
				foreach($rows as $value):?>

					<div id="feed" data-id="<?php echo $value->id ?>">
				<?php 	
						// feed info
						$sql = "SELECT `fullname`, `username`, id FROM `users` WHERE `id` = '$value->user_id'";
						$row = $db->row($sql);
						?>
						<div id="feed-info">
							<h4><?php echo ucwords($row->fullname)."<small> @$row->username</small>" ?></h4>
							<span><small><?php echo date("d/m/Y", strtotime($value->date_created)) ?></small></span>
							<hr>
						</div>
						<?php 
						
							$sql = "SELECT `post_id` FROM posts_likes WHERE user_id = ?";
							$params = array($row->id);
							$row = $db->fetch($sql, $params);
							if($row->post_id){
								print_r($row);
							}
						?>
						<div id="feed-message">
							<p id="post-msg"><?php echo $value->message ?></p>
							<hr>
								<span class="fas fa-heart">
									<small id="likes"><?php echo $value->total_likes?></small>
								</span>
								<span class="fas fa-comment">
									<small id="comment"><?php echo $value->total_comments?></small>
								</span>
						</div>

					</div>
					<div id="comments-container" class="hide-comments">
						<div id="comment-info">

							<p>Lorems ipsum dolor sit amet consectetur adipisicing elit. Inventore quos perferendis qui possimus nesciunt consectetur molestias velit, blanditiis nostrum, voluptatibus, sed corporis quidem accusamus a facilis atque voluptas dicta culpa.</p>
						</div>
					</div>

				<?php 
				endforeach;
			}
		?>
	</div>

</div>

<?php require_once "includes/footer.php" ?>