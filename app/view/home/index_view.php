<?php
	if(!defined('social'))
		die('Access denied');

	loadIndexHeader($title);
?>
<div id="particles-js" style="height:100vh;width:100vw;background-color:rgba(25,25,25,1);">
	<div class="row" style="margin:auto;display:flex;align-items:center;justify-content:center;">
			<a href="<?php echo $appURL; ?>login" style="background-color:#cc4a7ca9;color:rgb(12, 12, 12);text-decoration:none;width:10%;margin:15% 2%;text-align:center;border:none;padding:1%;border-radius:10px;z-index:1;">
				Login in
			</a>
			<a href="<?php echo $appURL; ?>register" style="background-color:#cc4a7ca9;color:rgb(12, 12, 12);text-decoration:none;width:10%;margin:15% 2%;text-align:center;border:none;padding:1%;border-radius:10px;z-index:1;">
				Register
			</a>
	</div>
</div>
<?php endIndexBody() ?>
