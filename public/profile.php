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
		<?php echo $_SESSION['user'] === $_GET["id"] ? "<a href='edit.php'>edit</a>" : null ?>
		
	</div>
	<div class="actions-container">
		<div class="action-type">
			<div class="action">
				<h4>Posts</h4>
			</div>
			<div class="action">
				<h4>Comments</h4>
			</div>
			<div class="action">
				<h4>Mentions</h4>
			</div>
			<div class="action">
				<h4>Likes</h4>
			</div>
		</div>
	</div>
	<div class="status-container">
		<?php
			
			// get users posts
			$sql = "SELECT * FROM posts WHERE user_id = ? AND parent_id is NULL";
			$params = array($_GET["id"]);
			$rows = $db->fetch($sql, $params);
	
			require "includes/feeds.php"; ?>

	</div>
</div>

<?php require_once "includes/footer.php" ?>