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
				
				echo $_SESSION['user'] === $_GET["id"] 
					? "<button class='edit'><a href='edit.php'>edit profile</a></button>" 
					: $follow."<button class='msg'>Message</button>"?>
		</p>
		<p class="bio"><?php echo $row->bio ?></p>
		
	</div> <!-- end user-container -->

	<div class="actions-container">
		<div class="action-type">
			<div class="action post-action"> 
				<button>Posts</button>
			</div>
			<div class="action image-action">
				<button>Images</button>
			</div>
			<div class="action followers-action">
				<button>Followers</button>
			</div>
			<div class="action following-action">
				<button>Following</button>
			</div>
		</div>
	</div> <!-- end actions-container -->

	<div class="status-container">
				
		<!-- user's posts -->
		<div class='get-posts'>
			<div class="users-posts"></div> <!-- load user's posts with ajax -->
			<div id="loading-container">
				<button class="load-posts">more...</button>
				<?php require_once "../files/assets/img/svg/loading.svg" ?>
				<p class="no-more-posts"></p>
			</div>
		</div>

		<!-- user's images -->
		<div class='get-images show-action'>
			<div class="users-images"></div> <!-- load user's images with ajax -->
			<div id="loading-container">
				<button class="load-posts">more...</button>
				<?php require_once "../files/assets/img/svg/loading.svg" ?>
				<p class="no-more-posts"></p>
			</div>
		</div>

		<!-- user's following -->
		<div class='get-following show-action'>
			<div class="users-following"></div> <!-- load user's following with ajax -->
			<div id="loading-container">
				<button class="load-posts">more...</button>
				<?php require_once "../files/assets/img/svg/loading.svg" ?>
				<p class="no-more-posts"></p>
			</div>
		</div>

		<!-- user's followers -->
		<div class='get-followers show-action'>
			<div class="users-followers"></div> <!-- load user's followers with ajax -->
			<div id="loading-container">
				<button class="load-posts">more...</button>
				<?php require_once "../files/assets/img/svg/loading.svg" ?>
				<p class="no-more-posts"></p>
			</div>
		</div>
		
	</div> <!-- end status-container -->	
	
</div> <!-- end profile-container -->
<?php require_once $appIncludes."footer.php" ?>