<?php

require_once "includes/header.php";

!isset($_SESSION['user']) ? header("Location: index.php") : null;

include "includes/navigationbar.php";
?>
<div id='welcome'>
	<p>Welcome <br><span><?php echo ucwords($_SESSION['fullname'])?></span></p>
</div>

<div id="feed-container">

	<form method="post" action="../app/controllers/newFeed-controller.php">
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
				foreach(array_reverse($rows) as $value):
					
					// get post_id for like
					$liked_class = '';
					$sql = 'SELECT `date` FROM posts_likes WHERE post_id = ? AND user_id = ?';
					$params = array($value->id, $_SESSION['user']);
					$like = $db->row($sql, $params);
					if(isset($like->date)){
						$liked_class = ' liked';
					}?>
				
					<div class="feed" data-id="<?php echo $value->id ?>">
					<?php 	
						// feed info
					$sql = "SELECT `fullname`, `username`, id FROM `users` WHERE `id` = '$value->user_id'";
					$row = $db->row($sql);
						
					?>
						<div class="feed-info">
							<h4><?php echo ucwords($row->fullname)."<small> @$row->username</small>" ?></h4>
							<span><small><?php echo date("d/m/Y", strtotime($value->date_created)) ?></small></span>
							<hr>
						</div> <!-- end feed-info -->
					
						<div class="feed-message">
							<p class="post-msg"><?php echo $value->message ?></p>
							<hr>
					
							<span class="fas fa-heart <?php echo $liked_class?>">
								<small class="likes"><?php echo $value->total_likes?></small>
							</span>
								
							<span class="fas fa-comment" id="<?php echo $value->id ?>">
								<small class="comment"><?php echo $value->total_comments?></small>
								<div class="comment-info hide-comments" data-id="<?php echo $value->id ?>">
									<div class="post-comments">
										<?php
										
											$sql = "SELECT `user_id`, `message`, `date_created` FROM `posts` WHERE `parent_id` = ?";
											$params = array($value->id);
											$rows = $db->fetch($sql, $params);
											
											foreach($rows as $index){
												$sql = "SELECT `username` FROM `users` WHERE `id` = $index->user_id";
												$row = $db->row($sql)
												
												?>
												<div>
													<h4><?php echo $row->username ?></h4>
													<small><?php echo date("d/m/Y", strtotime($index->date_created)) ?></small>
													<p><?php echo $index->message ?></p>
													<hr>
												</div>
										<?php	}
										
										?>
									</div>
									<input type="text" name="comment" class="comment-field" autocomplete="off" placeholder="Add a comment" required>
									<small class="new-comment">Comment</small>
								</div>
							</span>
						</div> <!-- end feed-message -->

					</div> <!-- end feed -->
				<?php 
				endforeach;
			}
		?>
	</div> <!-- end feed-controler -->

</div> <!-- end feed-container -->

<?php require_once "includes/footer.php" ?>