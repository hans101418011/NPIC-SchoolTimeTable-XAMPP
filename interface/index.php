<!doctype html>
<?php
	include("config.php");
	$_POST["name"]=isset($_POST["name"])?$_POST["name"]:Null;
	$_POST["sort"]=isset($_POST["sort"])?$_POST["sort"]:Null;
	$_POST["elective"]=isset($_POST["elective"])?$_POST["elective"]:Null;
	$_POST["credit"]=isset($_POST["credit"])?$_POST["credit"]:Null;
	$_POST["class"]=isset($_POST["class"])?$_POST["class"]:Null;
	$_POST["teacher"]=isset($_POST["teacher"])?$_POST["teacher"]:Null;
	$_POST["monday"]=isset($_POST["monday"])?$_POST["monday"]:Null;
	$_POST["tuesday"]=isset($_POST["tuesday"])?$_POST["tuesday"]:Null;
	$_POST["wednesday"]=isset($_POST["wednesday"])?$_POST["wednesday"]:Null;
	$_POST["thursday"]=isset($_POST["thursday"])?$_POST["thursday"]:Null;
	$_POST["friday"]=isset($_POST["friday"])?$_POST["friday"]:Null;
	$_POST["saturday"]=isset($_POST["saturday"])?$_POST["saturday"]:Null;
	$_POST["sunday"]=isset($_POST["sunday"])?$_POST["sunday"]:Null;
	$_POST["room"]=isset($_POST["room"])?$_POST["room"]:Null;
	$_POST["web"]=isset($_POST["web"])?$_POST["web"]:Null;
	$_POST["max"]=isset($_POST["max"])?$_POST["max"]:Null;
	$_POST["annex"]=isset($_POST["annex"])?$_POST["annex"]:Null;
	$_POST["other"]=isset($_POST["other"])?$_POST["other"]:Null;
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>非官方課程查詢系統</title>
		<link href="reset.css" rel="stylesheet" type="text/css" />
		<link href="base.css" rel="stylesheet" type="text/css" />
		<link href="color.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<header>
			<hgroup>
				<h1>非官方課程查詢系統</h1>
				<h2>102學年度 上學期</h2>
			</hgroup>
		</header>
		<div>
			<?php
				if(isset($_POST["name"])){
					$fp=fopen("sn.txt", "r");
	                                $sn = fgets($fp);
	                                fclose($fp);
                                	$sn=(int)$sn+1;
                                	$sn=str_pad($sn,6,"0",STR_PAD_LEFT);
					$sql= "INSERT INTO `subject` (
						`sn`, 
						`name`, 
						`sort`, 
						`elective`, 
						`credit`, 
						`semester`, 
						`institution`, 
						`department`, 
						`class`, 
						`teacher`, 
						`monday`, 
						`tuesday`, 
						`wednesday`, 
						`thursday`, 
						`friday`, 
						`saturday`, 
						`sunday`, 
						`student`, 
						`room`, 
						`web`, 
						`annex`, 
						`max`, 
						`limitST`, 
						`other`, 
						`chose`
						) VALUES (
						'".$sn."',
						'".$_POST["name"]."',
						'".$_POST['sort']."',
						'".$_POST['elective']."',
						'".$_POST['credit']."',
						'1',
						'1',
						'".$_POST["class"]."',
						'".$_POST["class"]."',
						'".$_POST["teacher"]."',
						'".$_POST["monday"]."',
						'".$_POST["tuesday"]."',
						'".$_POST["wednesday"]."',
						'".$_POST["thursday"]."',
						'".$_POST["friday"]."',
						'".$_POST["saturday"]."',
						'".$_POST["sunday"]."',
						'"."0"."',
						'".$_POST["room"]."',
						'".$_POST["web"]."',
						'".$_POST["annex"]."',
						'".$_POST["max"]."',
						'".$_POST["max"]."',
						'".$_POST["other"]."',
						Null);";

					$fp=fopen("sn.txt", "w");
					fwrite($fp,$sn);
					fclose($fp);
					mysql_query($sql,$link) or die("寫入錯誤!\n".mysql_error()."<br>");
				}else if(isset($_GET['delete'])){
                                        $sql="DELETE FROM `subject` WHERE `sn` = '".$_GET['delete']."'";
                                        mysql_query($sql,$link) or die("刪除錯誤!\n".mysql_error()."<br>");
                                }			
			?>
		</div>
		<div id="insert">
			<form name="insert" method="post" action="">
				<table>
					<thead></thead>
					<tbody>
						<tr><td colspan="3">通識領域<select id="sort" name="sort">
							<option value="">Null</option>
							<option value="人文">人文</option>
							<option value="自然">自然</option>
							<option value="社會">社會</option>
						</select></td>
						<td colspan="4">課程名稱<input type="text" id="name" name="name"></td></tr>
						<tr><td colspan="3">必選修<select id="elective" name="elective">
							<option value="必修">必修</option>
							<option value="選修">選修</option>
						</select></td>
						<td colspan="4">學分<input type="number" id="credit" name="credit" class="numInput" min="0" max="3" value="3"></td></tr>
						<tr><td colspan="7">開課年班<input type="text" id="class" name="class" placeholder="ex:101資工"></td></tr>
						<tr><td colspan="7">教授<input type="text" id="teacher" name="teacher"></td></tr>

						<tr><td colspan="7">上課時間</td></tr>
						<tr><td>週一</td><td>週二</td><td>週三</td><td>週四</td><td>週五</td><td>週六</td><td>週日</td></tr>
						<tr><td><input type="text" id="monday" name="monday" class="sortInput" placeholder="ex:23"></td>
							<td><input type="text" id="tuesday" name="tuesday" class="sortInput"></td>
							<td><input type="text" id="wednesday" name="wednesday" class="sortInput"></td>
							<td><input type="text" id="thursday" name="thursday" class="sortInput"></td>
							<td><input type="text" id="friday" name="friday" class="sortInput"></td>
							<td><input type="text" id="saturday" name="saturday" class="sortInput"></td>
							<td><input type="text" id="sunday" name="sunday" class="sortInput"></td></tr>

						<tr><td colspan="4">教室<input type="text" id="room" name="room"></td>
							<td colspan="3">選課限額<input type="number" id="max" name="max" class="numInput" max="80" min="25" value="60"></td>
						</tr>
						<tr><td colspan="7">教學網站<input type="text" id="web" name="web" class="longInput"></td></tr>
						<tr><td colspan="7">教學附件<input type="text" id="annex" name="annex" class="longInput"></td></tr>
						<tr><td colspan="7">備註<input type="text" id="other" name="other" class="longInput"></td></tr>
						<tr><td colspan="7"><input type="submit" value="新增課程"><input type="reset" value="重新填寫"></td></tr>
					</tbody>
				</table>
			</form>
		</div>
		<div id="result">
			<div id="list">
				<table>
					<thead></thead>
					<tbody>
						<tr class="directions">
							<td rowspan="2">通識<br>領域</td>
							<td rowspan="2">課程名稱</td>
							<td rowspan="2">必選修</td>
							<td rowspan="2">學<br>分</td>
							<td rowspan="2">開課<br>年班</td>
							<td rowspan="2">教授</td>
							<td colspan="7">上課時間</td>
							<td rowspan="2">教室</td>
							<td rowspan="2">已修<br>人數</td>
							<td rowspan="2">選課<br>限額</td>
							<td rowspan="2">教學<br>網站</td>
							<td rowspan="2">教學<br>附件</td>
							<td rowspan="2">備註</td>
						</tr>
						<tr class="directions">
							<td>一</td><td>二</td><td>三</td><td>四</td><td>五</td><td>六</td><td>日</td>
						</tr>
						<?php
							$sql = 'SELECT * FROM `subject` ORDER BY `sn` ASC LIMIT 0, 30 ';
							$result = mysql_query($sql,$link);
							while($data=mysql_fetch_assoc($result)):
						?>
								<tr id="<?=$data['sn']?>">
										<td class="sort"><?=$data['sort']?></td>
										<td class="name"><?=$data['name']?></td>
										<td class="elec"><?=$data['elective']?></td>
										<td class="cred"><?=$data['credit']?></td>
										<td class="clas"><?=$data['class']?></td>
										<td class="teac"><?=$data['teacher']?></td>
										<td class="mon"><?=$data['monday']?></td>
										<td class="tue"><?=$data['tuesday']?></td>
										<td class="wed"><?=$data['wednesday']?></td>
										<td class="thu"><?=$data['thursday']?></td>
										<td class="fri"><?=$data['friday']?></td>
										<td class="sat"><?=$data['saturday']?></td>
										<td class="sun"><?=$data['sunday']?></td>
										<td class="room"><?=$data['room']?></td>
										<td class="stud"><?=$data['student']?></td>
										<td class="max"><?=$data['max']?></td>
										<td class="web"><?=$data['web']?></td>
										<td class="anne"><?=$data['annex']?></td>
										<td class="othe"><?=$data['other']?></td>
										<td><a href="./index.php?delete=<?=$data['sn']?>">Delete</a></td>
								</tr>
						<?php
							endwhile;
						?>
					</tbody>
				</table>
			</div>
		</div>
		<footer>
			本站最佳解析度為 1024*768 以上<br />最佳瀏覽器為&nbsp;
			<a href="http://moztw.org/firefox/" title="下載最新Firefox" target="_blank" rel="external">Firefox 3↑</a>&nbsp;
			<a href="http://www.google.com/chrome/" title="下載最新Chrome" target="_blank" rel="external">Chrome 9↑</a>&nbsp;
			<a href="http://www.opera.com/download/" title="下載最新Opera" target="_blank" rel="external">Opera 11↑</a><br />
			Copyright&copy;2013&nbsp;Some&nbsp;Rights&nbsp;Reserved<br />
			Web&nbsp;Design&nbsp;by&nbsp;CSIE&nbsp;Hans
		</footer>
	</body>
</html>
