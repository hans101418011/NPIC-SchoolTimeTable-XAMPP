<?php
if($_GET['logout']==1)
{
	destroy_session_and_data();
	unset($user_id);
}

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
			else
				echo "login error ";
		}
		else
			echo "login error ";
	}
	else
		echo "login error ";
}


if($_SESSION['login']=='success')
{
	echo $memberdata["name"]."你好";
?>
	<a href="./index.php" class="bt">查詢</a>
	<a href="./user.php" class="bt">模擬選課</a>
	<a href="./setup.php" class="bt">設定</a>
	<a href="./index.php?logout=1" class="bt">登出</a>
<?php
}
else
{
?>
	<form name="login" method="post" action="index.php">
		<input type="text" name="user_id" value="<?=$user_id?>" placeholder="User ID">
		<input type="password" name="user_pw" placeholder="Password">
		<input type="hidden" name="login" value="1">
		<input type="submit" value="登入" class="bt">
	</form>
	<a href="./register.php" class="bt">註冊</a>
<?php
}	
?>

<?php

function destroy_session_and_data()
{
	session_start();
	$_SESSION=array();
	if(session_id()!= "" || isset($_COOKIE[session_name()]))
		setcookie(session_name(),'',time()-2592000,'/');
	session_destroy();
}
?>