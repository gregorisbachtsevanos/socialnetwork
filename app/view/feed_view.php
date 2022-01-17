<?php 
if(!defined("social")){
	die("Access denied");
}
loadHeader($title);?>
<div id="per-feed-container">
<div id="per-feed-controller">
	<div class="feed" data-id="">
		<div class="feed-info">
			<div class="post-header">
				<a href='../public/'>
					<div class="users-info">
						<div class="users-avatar">
							<?php echo $avatar?>
						</div>
						<h4><?php echo $userRow->fullname?> 
							<span> @<?php echo $userRow->username?></span>
						</h4>
					</div>
				</a>
				${post.username == CURRENT_USER ? `<i class='far fa-trash-alt delete-feed' data-id='${post.post_id}'></i>` : ''}
			</div>
			<span class="date"><small><?php echo $feedRow->date_created?></small></span>
			<hr>
		</div>

		<div class="feed-message">
			<p class="post-msg"><?php echo $feedRow->message?></p>
			<hr>
			<div class="reactions">
				<span class="fas fa-heart ${post.liked}">
					<small class="likes"><?php echo $feedRow->total_likes?></small>
				</span>  
				<div class="comment-body">
					<span class="fas fa-comment" id="${post.post_id}">
						<small class="comment-count"><?php echo $feedRow->total_comments?></small>
					</span>
					<div class="comment-info" data-id="${post.post_id}">
						<div class="post-comments">${post.post_id == comment.parent_id ? showComments.join(' ') : ''}</div>
						<input type="text" name="comment" class="comment-field" autocomplete="off" placeholder="Add a comment" required>
						<small class="new-comment">Comment</small>
					</div>
				</div>
			</div> 
		</div>
	</div>
</div> <!-- end feed-controller -->
</div>

<?php endBody();?>