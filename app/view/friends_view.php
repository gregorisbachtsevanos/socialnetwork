<?php

if(!defined("social"))
	die("Access deniad");

loadheader($title)?>

	<div id="friends-container">
		<?php //echo count($rows) == 0 ? "<p class='follow'>Nothing to show. <a href='#'>Find people to follow.</a></p>" : null; ?> 
		<div class="friends-controller">
			
				<div class="friend-card user" data-id="<?php // echo $row->id ?>">
					<div class="profile-img">
						<?php //echo $profileAvatar?>
					</div>
					<div class="info">
						<h2><?php //echo $row->fullname ?> <a href="./profile.php?id=<?php// echo $row->id?>">@<?php //echo $row->username ?></a></h2>
					</div>
					<div class="btns">
						<button class="follow-btn">unfollow</button>
						<button>Message</button>
					</div>
				</div>
			
			<?php
			?>
			</div> <!-- end friends-controller -->
	</div> <!-- end friends-container -->

<?php endBody()?>