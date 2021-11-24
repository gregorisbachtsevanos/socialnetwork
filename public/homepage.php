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
				<button id="feed-btn" type="submit" name="submit"><i class="fa fa-paper-plane-o"></i></button>
			</div>
		</div>
	</form>

	<div id="feed-controler">
		<?php
			// get all posts
			$sql = 'SELECT * FROM "posts" WHERE "parent_id" is Null';
			$rows = $db->fetch($sql);
			if($rows > 0){ 
				foreach(array_reverse($rows) as $post):
					
					// get posts info
					$sql = "SELECT `fullname`, `username`, id FROM `users` WHERE `id` = '$post->user_id'";
					$row = $db->row($sql);

					// get post_id for like
					$liked_class = '';
					$sql = 'SELECT `date` FROM posts_likes WHERE post_id = ? AND user_id = ?';
					$params = array($post->id, $_SESSION['user']);
					$like = $db->row($sql, $params);
					if(isset($like->date)){
						$liked_class = ' liked';
					}

					// get comments info
					$sql = "SELECT `id`, `user_id`, `message`, `date_created` FROM `posts` WHERE `parent_id` = ?";
					$params = array($post->id);
					$rows = $db->fetch($sql, $params);
			?>
				
				<div class="feed" data-id="<?php echo $post->id ?>">
					<div class="feed-info">
						<div class="post-header">

							<?php echo "<h4>".ucwords($row->fullname)."<small> @$row->username</small></h4>"; 
							echo $_SESSION['user'] === $post->user_id ?  "<i class='far fa-trash-alt delete-feed' data-id='$post->id'></i>" : ""; ?>
						</div>
							<span><small><?php echo date("d/m/Y", strtotime($post->date_created)) ?></small></span>
						<hr>
					</div> <!-- end feed-info -->
				
					<div class="feed-message">
						<p class="post-msg"><?php echo $post->message ?></p>
						<hr>

							<span class="fas fa-heart <?php echo $liked_class?>">
								<small class="likes"><?php echo $post->total_likes?></small>
							</span>
							
							<span class="fas fa-comment" id="<?php echo $post->id ?>">
								<small class="comment"><?php echo $post->total_comments?></small>
								<div class="comment-info hide-comments" data-id="<?php echo $post->id ?>">
									<div class="post-comments">
										<?php
										foreach($rows as $comment){
											$sql = "SELECT `username` FROM `users` WHERE `id` = $comment->user_id";
											$row = $db->row($sql)
											?>
											<div class="comment" data-id='<?php echo $comment->id ?>'>
												<h4>
													<?php echo $row->username;
													echo $_SESSION['user'] === $comment->user_id ?  "<i class='far fa-trash-alt delete-comment'></i>" : "";?>
												</h4>
												<small><?php echo date("d/m/Y", strtotime($comment->date_created)) ?></small>
												<p><?php echo $comment->message ?></p>
												<hr>
											</div>
										<?php
										}
										?>
									</div> <!--end post-comments -->
									<input type="text" name="comment" class="comment-field" autocomplete="off" placeholder="Add a comment" required>
									<small class="new-comment">Comment</small>
								</div> <!--end comment-info -->
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