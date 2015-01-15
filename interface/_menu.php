<nav class="pure-menu pure-menu-open pure-menu-horizontal">
	<ul>
		<li><a href="index.php">查詢</a></li>
	<?php
		if($_GET['logout']==1)
		{
			destroy_session_and_data();
			unset($user_id);
		}

		if($_SESSION['login']=='success')
		{
	?>
			<li><a href="myclass.php">紀錄</a></li>
			<li><a href="setup.php">設定</a></li>
	<?php
			echo '<li><a href="'+$_SERVER['PHP_SELF']+'?logout=1">登入</a></li>';
		}
		else
		{
			echo '<li><a href="register.php">註冊</a></li>';
			echo '<li><a href="login.php">登入</a></li>';
		}
	?>
	</ul>
</nav>
