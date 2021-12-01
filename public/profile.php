<?php
require_once "includes/header.php";

!isset($_SESSION['user']) ? header("Location: index.php") : null;
if(isset($_GET["id"])){
	$sql = "SELECT * FROM `users` WHERE id = ?";
	$params = array($_GET["id"]);
	$row = $db -> row($sql, $params);

	!isset($row->id) ? die("Not found") : null;

	include "includes/navigationbar.php";
}

?>

<div class="profile-container">	
	<div class="user-container">
		<div class="user">
			<div class="img">
				<img <?php echo "src=../files/assets/img/avatars/".$row->avatar ?>>
			</div>
			<div class="name">
				<h3><?php echo $row->fullname ?> <small><?php echo "@".$row->username ?></small></h3>
			</div>
			<div class="info">
				<p><?php echo $row->followers ?> followers</p>
				<p><?php echo $row->following ?> following</p>
			</div>
		</div>
		<p><?php echo $row->bio ?></p>
		<p id="edit-profile"><?php echo $_SESSION['user'] === $_GET["id"] ? "<a href='edit.php'>edit</a>" : null ?></p>
		
	</div>
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
	</div>
	<div class="status-container">
		<div class='get-posts'>

			<?php
			
			// get users posts
			$sql = "SELECT * FROM posts WHERE user_id = ? AND parent_id is NULL";
			$params = array($_GET["id"]);
			$rows = $db->fetch($sql, $params);
			echo count((array)$rows) == 0 ? "No posts" : null;
			
			include "includes/feeds.php"; ?>
		</div>
		<div class='get-comments show-action'>

			<?php
			
			// get users comments
			$sql = "SELECT * FROM posts WHERE user_id = ? AND parent_id is not NULL";
			$params = array($_GET["id"]);
			$rows = $db->fetch($sql, $params);
			echo count((array)$rows) == 0 ? "No comments" : null;
			
			foreach($rows as $index){
				$sql = "SELECT * FROM posts WHERE id = ?";
				$params = array($index->parent_id);
				$rows = $db->fetch($sql, $params);

				include "includes/feeds.php";
			}?>
			
		</div>

		<div class='get-mentions show-action'>

			<?php
			
			// get users mentions
			$sql = "SELECT * FROM posts_mentions WHERE user_id = ?";
			$params = array($_GET["id"]);
			$rows = $db->fetch($sql, $params);
			echo count((array)$rows) == 0 ? "No mentions" : null;
			
			foreach($rows as $index){
				$sql = "SELECT * FROM posts WHERE id = ?";
				$params = array($index->post_id);
				$rows = $db->fetch($sql, $params);

				include "includes/feeds.php";
			}?>
			
		</div>
		<div class='get-likes show-action'>

			<?php
			
			// get users likes
			$sql = "SELECT * FROM posts_likes WHERE user_id = ?";
			$params = array($_GET["id"]);
			$rows = $db->fetch($sql, $params);
			echo count((array)$rows) == 0 ? "No likes" : null;
			
			foreach($rows as $index){
				$sql = "SELECT * FROM posts WHERE id = ?";
				$params = array($index->post_id);
				$rows = $db->fetch($sql, $params);
				
				include "includes/feeds.php";
			}?>
			
		</div>
		

	</div>
</div>

<?php require_once "includes/footer.php" ?>