<?php
require_once "includes/header.php";
include $appIncludes."navigationbar.php";

!isset($_SESSION['user']) ? header("Location: index.php") : null;
if(isset($_GET["id"])){
	// get user's info
	$sql = "SELECT * FROM `users` WHERE id = ?";
	$params = array($_GET["id"]);
	$row = $db -> row($sql, $params);

	!isset($row->id) ? die("Not found") : null;
	if(isset($_GET['id'])){

		// sql for user's avatar
        $sql = "SELECT * FROM users WHERE id = ?";
        $params = array($_GET['id']);
        $rowUserAvatar = $db->row($sql, $params);
        
        if($rowUserAvatar->avatar){
            $profileAvatar = "<img style='width:100%;height:100%' src='../files/assets/img/avatars/".$row->avatar."' alt='image-profile'>";
        }else{
            $profileAvatar = "<span class='user-icon'>".substr(ucwords($rowUserAvatar->fullname),0,1)."</span>";
        }
    }

}

?>
<script>
	const PAGE = "profile"
</script>

<div class="profile-container">	
	<div class="user-container user" data-id="<?php echo $row->id ?>">
		<div class="user">
			<div class="img">
				<?php echo $profileAvatar; ?>
			</div>
			<div class="name">
				<h3><?php echo $row->fullname ?> <small><?php echo "@".$row->username ?></small></h3>
			</div>
			<div class="info">
				<p><span id="followers"><?php echo $row->followers ?></span> followers</p>
				<p><span id="following"><?php echo $row->following ?></span> following</p>
			</div>
		</div>
		<p class="bio"><?php echo $row->bio ?></p>
		<p id="btn-profile">
			<?php 
				// get follow unfollow btn
				$sql = "SELECT * FROM `follow` WHERE `user_id` = ? AND `follow_user_id` = ?";
				$params = array($_SESSION["user"], $_GET["id"]);
				$rowFollow = $db->row($sql, $params);
				if($rowFollow){
					$follow = "<button class='follow-btn'>unfollow</button>";
				}else{
					$follow = "<button class='follow-btn'>follow</button>";
				}

			echo $_SESSION['user'] === $_GET["id"] ? "<a href='edit.php'>edit</a>" : $follow ?>
		</p>
		
	</div> <!-- end user-container -->

	<div class="actions-container">
		<div class="action-type">
			<div class="action post-action"> 
				<h4>Posts</h4>
			</div>
			<div class="action comment-action">
				<h4>Comments</h4>
			</div>
			<div class="action mention-action">
				<h4>Mentions</h4>
			</div>
			<div class="action like-action">
				<h4>Likes</h4>
			</div>
		</div>
	</div> <!-- end actions-container -->

	<div class="status-container">
		<div class='get-posts'>

			<div class="users-posts"></div> <!-- load users posts with ajax -->
			<div id="loading-container">
				<button id="load-posts">more...</button>
				<?php require_once "../files/assets/img/svg/loading.svg" ?>
			</div>
		</div>

		<div class='get-comments show-action'>

			<div class="users-comments"></div> <!-- load users comments with ajax -->
			<div id="loading-container">
				<button id="load-posts">more...</button>
				<?php require_once "../files/assets/img/svg/loading.svg" ?>
			</div>
			<?php
			// $sql = "SELECT * FROM posts WHERE user_id = ? AND parent_id is not NULL";
			// $params = array($_GET["id"]);
			// $rows = $db->fetch($sql, $params);
			// echo count((array)$rows) == 0 ? "No comments" : null;
			// foreach($rows as $index){
			// $sql = "SELECT * FROM posts WHERE id = ?";
			// $params = array($index->parent_id);
			// $rows = $db->fetch($sql, $params);
			// include $appIncludes."feeds.php";
			// }?>
		</div>

		<div class='get-mentions show-action'>

			<div class="users-mentions"></div> <!-- load users mentions with ajax -->
			<div id="loading-container">
				<button id="load-posts">more...</button>
				<?php require_once "../files/assets/img/svg/loading.svg" ?>
			</div>
			<?php
			// $sql = "SELECT * FROM posts_mentions WHERE user_id = ?";
			// $params = array($_GET["id"]);
			// $rows = $db->fetch($sql, $params);
			// echo count((array)$rows) == 0 ? "No mentions" : null;
			// foreach($rows as $index){
			// $sql = "SELECT * FROM posts WHERE id = ?";
			// $params = array($index->post_id);
			// $rows = $db->fetch($sql, $params);
			// include $appIncludes."feeds.php";
			// }?>
		</div>

		<div class='get-likes show-action'>

			<div class="users-mentions"></div> <!-- load users mentions with ajax -->
			<div id="loading-container">
				<button id="load-posts">more...</button>
				<?php require_once "../files/assets/img/svg/loading.svg" ?>
			</div>
			<?php
			// $sql = "SELECT * FROM posts_likes WHERE user_id = ?";
			// $params = array($_GET["id"]);
			// $rows = $db->fetch($sql, $params);
			// echo count((array)$rows) == 0 ? "No likes" : null;
			// foreach($rows as $index){
			// $sql = "SELECT * FROM posts WHERE id = ?";
			// $params = array($index->post_id);
			// $rows = $db->fetch($sql, $params);
			// include $appIncludes."feeds.php";
			// }?>
		</div>
		
	</div> <!-- end status-container -->	
	
</div> <!-- end profile-container -->
<?php require_once $appIncludes."footer.php" ?>