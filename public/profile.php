<?php
require_once "includes/header.php";

!isset($_SESSION['user']) ? header("Location: index.php") : null;
if(isset($_GET["id"])){
	$sql = "SELECT * FROM `users` WHERE id = ?";
	$params = array($_GET["id"]);
	$row = $db -> row($sql, $params);

	!isset($row->id) ? die("Not found") : null;

	include "includes/navigationbar.php";
	$data = $db->update("users", array("avatar" => "man.png"), array('id'=>$_GET['id']));
}

?>

<div class="profile-contrainer">
	<div class="user-controler">
		<div class="user">
			<div class="img">
				<img <?php echo "src=../files/assets/img/avatars/".$row->avatar ?>>
			</div>
			<div class="name">
				<h3><?php echo $row->fullname ?> <small><?php echo "@".$row->username ?></small></h3>
			</div>
			<div class="info">
				<p><?php echo $row->followers ?> followers</p>
				<p><?php echo $row->followers ?> following</p>
			</div>
		</div>
		<p><?php echo $row->bio ?></p>
		<?php echo $_SESSION['user'] === $_GET["id"] ? "<a href='edit.php'>edit</a>" : null ?>
		
	</div>
	<div class="status-controler">
		<?php
			
			// get users posts
			$sql = "SELECT * FROM posts WHERE user_id = ? AND parent_id is NULL";
			$params = array($_GET["id"]);
			$rows = $db->fetch($sql, $params);
	
			require "includes/feeds.php"; ?>

	</div>
</div>

<?php require_once "includes/footer.php" ?>