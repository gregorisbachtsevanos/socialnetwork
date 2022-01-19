<?php 
if(!defined("social")){
	die("Access denied");
}

loadHeader($title);?>
	<div id="per-feed-container">
		<div id="per-feed-controller">
			<div id="feed" class="feed" data-id="<?php echo $feedRow->id?>">
				<div class="feed-info">
					<div class="post-header">
						<a href='../public/<?php echo $userRow->username?>'>
							<div class="users-info">
								<div class="users-avatar">
									<?php echo $avatar?>
								</div>
								<h4><?php echo $userRow->fullname?> 
									<span> @<?php echo $userRow->username?></span>
								</h4>
							</div>
						</a>
						<?php echo $userRow->username == $_SESSION['user'] ? "<i class='far fa-trash-alt delete-feed' data-id='".$feedRow->id."'></i>" : ''?> 
					</div>
					<span class="date"><small><?php echo $date?></small></span>
					<hr>
				</div>

				<div class="feed-message">
					<p class="post-msg"><?php echo $feedRow->message?></p>
					<hr>
					<div class="reactions" id="comment-per-feed">
						<span class="fas fa-heart <?php echo !isset($likedRow->date) ?: 'liked' ?>">
							<small class="likes"><?php echo $feedRow->total_likes?></small>
						</span>  
						<span class="fas fa-comment" id="<?php echo $feedRow->id?>">
							<small class="comment-count"><?php echo $feedRow->total_comments?></small>
						</span>
					</div> 
				</div>
			</div>

			<div id="new-comment-container">
				<input type="text" name="comment" class="comment-field" autocomplete="off" placeholder="Add a comment" required>
				<small class="new-comment">Comment</small>
			</div>

			<div id="arrow-icon">
				<?php echo ($commetnsRow) ? '<p class="down-arrow"><i class="fas fa-level-down-alt"></i></p>' : '';?>
			</div>

			<div class="feed comment-container" data-id=<?php echo $feedRow->id ?>>
				<?php foreach($commetnsRow as $comment):
					$date = date("d/m/Y", strtotime($comment->date_created));
					$sql = "SELECT fullname, username, avatar FROM users WHERE id = $comment->user_id";
					$row = $db->row($sql);
					$row->avatar 
						? $avatar = "<img style='width:100%;height:100%' src=".$appFiles."assets/img/avatars/".$row->avatar." alt='image-profile'>"
						: $avatar = "<span class='user-icon'>".substr(ucwords($userRow->fullname),0,1)."</span>";?>
					
					<div class="comment" data-id=<?php echo $comment->id ?>>
						<div class="comment-header">
							<a href='../public/<?php echo $row->username;?>'>
								<h4>
									<div class="users-avatar"><?php echo $avatar ?></div>
									<?php echo $row->fullname.'&nbsp;<span>@'.$row->username.'</span>' ?>
								</h4>
							</a>
							<?php if($comment->user_id == $_SESSION["userId"]){?>
								<p style="color: #d4d4d4"><i class="far fa-trash-alt delete-comment" data-id=<?php echo $feedRow->id ?>></i></p>
							<?php } ?>
						</div>
						<small><?php echo $date ?></small>
						<hr>
						<p><?php echo $comment->message ?></p>
						<hr>
					</div>
				
				<?php endforeach ?>
			</div> <!-- end feed-->
		</div> <!-- end per-feed-controller -->
	</div> <!-- end per-feed-container -->
<?php endBody();?>