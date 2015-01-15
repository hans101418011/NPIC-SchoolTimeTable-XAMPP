<?php
	session_start(); 
	include("config.php");
	
	$user_id = $_POST['user_id'];
	$user_pw = $_POST['user_pw'];
	if($_POST['login']=='1')
	{
		if($user_id!="")
		{
			$sql = "SELECT * FROM `member` WHERE `email` LIKE '".$user_id."' LIMIT 0,1";
			$result = mysql_query($sql,$link);
			$memberdata = mysql_fetch_assoc($result);
			if($memberdata)
			{
				if(md5($user_pw)==$memberdata['password'])
				{
					$_SESSION['login'] = 'success';
					$_SESSION['user_name'] = $memberdata['name'];
				}
			}
		}
	}

?>
<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>非官方課程查詢系統</title>
		<link rel="stylesheet" type="text/css" href="styles/reset.css">
		<link rel="stylesheet" type="text/css" href="styles/pure-min.css">
		<link rel="stylesheet" type="text/css" href="styles/grids-responsive-min.css">
		<link rel="stylesheet" type="text/css" href="styles/base.css">
		<link rel="stylesheet" type="text/css" href="styles/color.css">
		<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
	</head>
	<body>
		<?php
			include("_menu.php");
		?>
		<div id="register">
			<form class="pure-form pure-form-aligned" action="<?=$_SERVER['PHP_SELF']?>" method="post" accept-charset="utf-8">
				<fieldset>
					<legend>登入</legend>
					<div class="pure-control-group">
						<label for="email">帳戶</label>
						<input id="email" type="email" placeholder="Email">
					</div>
					<div class="pure-control-group">
						<label for="password">密碼</label>
						<input id="password" type="password" placeholder="Password">
					</div>
					<div class="pure-controls">
						<input type="submit" class="pure-button pure-button-primary" value="登入">
					</div>
				</fieldset>
			</form>
		</div>
		<footer>
			<a href="about.php" title="About this">About&nbsp;this&nbsp;!?</a><br />Support&nbsp;
			<a href="http://moztw.org/firefox/" title="下載最新Firefox" target="_blank" rel="external">Firefox 3↑</a>&nbsp;
			<a href="http://www.google.com/chrome/" title="下載最新Chrome" target="_blank" rel="external">Chrome 9↑</a>&nbsp;
			<a href="http://www.opera.com/download/" title="下載最新Opera" target="_blank" rel="external">Opera 11↑</a><br />
			Copyright&copy;2013-2015&nbsp;Some&nbsp;Rights&nbsp;Reserved<br />
			Web&nbsp;Design&nbsp;by&nbsp;CSIE&nbsp;Hans
		</footer>
	</body>
</html>
<?php

//$sql="INSERT INTO `npic_subject`.`member` (`id`, `name`, `email`, `password`) VALUES (NULL, 'Hans', 's101418011@stmail.nptu.edu.tw', MD5('chen')");

?>