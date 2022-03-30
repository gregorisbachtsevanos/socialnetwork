<?php
	if(!defined('social'))
		die('Access denied');

	loadIndexHeader($title);
?>
<div>
	<a href="<?php echo $appURL; ?>login"><button>login in</button></a>
	<a href="<?php echo $appURL; ?>register"><button>register</button></a>
</div>
<?php endIndexBody() ?>