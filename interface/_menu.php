<nav class="pure-menu pure-menu-open pure-menu-horizontal">
	<ul>
		<li><a href="index.php">查詢</a></li>
	<?php
		if (1)
		{
			echo '<li><a href="myclass.php">紀錄</a></li>';
			echo '<li><a href="setup.php">設定</a></li>';
			echo '<li><a href="logout.php">登出</a></li>';
		}
		else
		{
			echo '<li><a href="register.php">註冊</a></li>';
			echo '<li><a href="login.php">登入</a></li>';
		}
	?>
	</ul>
</nav>
