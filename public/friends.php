<?php

require_once "includes/header.php";

!isset($_SESSION['user']) ? header("Location: index.php") : null;

include $appIncludes."navigationbar.php";

$sql = "SELECT `follow_user_id` FROM `follow` WHERE `user_id` = ?";
$params = array($_SESSION["user"]);
$rows = $db -> fetch($sql, $params);

?>

<div id="friends-container">
	<?php echo count($rows) == 0 ? "<p class='follow'>Nothing to show. <a href='#'>Find people to follow.</a></p>" 	: null; ?> 
	<div class="friends-controller">
		<?php
		foreach($rows as $row){
			$sql = "SELECT `id`, `fullname`, `username`, `avatar` FROM `users` WHERE `id` = ?";
			$params = array($row->follow_user_id);
			$row = $db -> row($sql, $params);
			$row -> avatar	? $profileAvatar = "<img style='width:100%' src='../files/assets/img/avatars/".$row->avatar."'>" 
							: $profileAvatar = "<span class='user-icon'>".substr(ucwords($row->fullname),0,1)."</span>";	
		?>
			<div class="friend-card user" data-id="<?php echo $row->id ?>">
				<div class="profile-img">
					<?php echo $profileAvatar?>
				</div>
				<div class="info">
					<h2><?php echo $row->fullname ?> <a href="./profile.php?id=<?php echo $row->id?>">@<?php echo $row->username ?></a></h2>
				</div>
				<div class="btns">
					<button class="follow-btn">unfollow</button>
					<button>Message</button>
				</div>
			</div>
		
		<?php
		}
		?>
		</div> <!-- end friends-controller -->
</div> <!-- end friends-container -->

<?php require_once $appIncludes."footer.php" ?>