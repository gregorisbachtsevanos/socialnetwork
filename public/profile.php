<?php

require_once "includes/header.php";

!isset($_SESSION['user']) ? header("Location: index.php") : null;
if(isset($_GET["id"])){
	$sql = "SELECT * FROM `users` WHERE id = ?";
	$params = array($_GET["id"]);
	$row = $db -> row($sql, $params);
	print_r($row);

	!isset($row->id) ? die("Not found") : null;




	include "includes/navigationbar.php";
	// $data = $db->update("users", array("avatar" => "man.png"), array('id'=>$_GET['id']));
}

?>


<div class="profile-contrainer">
	<div class="userprofile-controler">
		<div class="profile-pic">
			<img <?php echo "src=../files/assets/img/avatars/".$row->avatar ?>>

			<h3><?php echo $row->fullname ?> <small><?php echo "@".$row->username ?></small></h3>
			<p></p>
		</div>
	</div>
	<div class="userinfo-controler">

	</div>
</div>

<?php 
require_once "includes/footer.php" ?>