<?php
$cfg_str = file_get_contents("../config.json");
$cfg = json_decode($cfg_str, true);

# The Internet gets to set these values. Be conservative.
function s($str) { return preg_replace("([^A-Za-z0-9 \#]+)", "", $str); }
function scfg($name) { global $cfg; return s($cfg[$name]); }

$s_user_name = htmlspecialchars($_POST['name']);
?>
<html>
<head><title>Live configuration demo</title></head>

<style>
	body {
		font-size: 14px;
		font-family: '<?=scfg('font')?>';
		background-color: <?=scfg('background')?>;
	}

	.name {
		font-size: 18px;
	}

	.refresh-link a {
		font-size: 12px;
		color: #000;
	}
	.refresh-link {
		padding-bottom: 14px;
	}
</style>
<?php
?>

<body>

<center class="refresh-link"><a href="?x=<?=rand()?>">Refresh</a></center>

<b>Please enter your name:</b><br>
<form action="index.php" method="POST"><input type="text" name="name" value="<?=$s_user_name?>"><input type="submit" value="Say Hello"></form>

<div class="name">
<? if ($s_user_name) { ?>
Hello, <?= ($cfg['uppercase']?strtoupper($s_user_name):$s_user_name) ?>!
<? } ?>

</body>
</html>

