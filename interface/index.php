<?php
	session_start(); 
	include("config.php");
	include("_init.php");
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
		<div id="search">
			<form name="search" method="get" action="<?=$_SERVER['PHP_SELF']?>">
				<div class="pure-g">
					<div class="pure-u-1 pure-u-md-5-12 pure-u-lg-1-3">
						<label>系所
							<select name="department">
								<option value="">All</option>
								<option value="-GE">通識教育中心</option>
								<optgroup label="產學專班">
									<option value="o-MDM">行銷與流通管理系</option>
								</optgroup>
								<optgroup label="碩專班">
									<option value="i-Trade">國際企業研究所</option>
								</optgroup>
								<optgroup label="研究所">
									<option value="p-Trade">國際企業研究所</option>
									<option value="p-Finance">財務金融研究所</option>
									<option value="p-BA">經營管理研究所</option>
									<option value="p-CAM">企業電子化研究所</option>
									<option value="p-Leisure">休閒遊憩與創意產業管理研究所</option>
									<option value="p-MDM">行銷與流通管理研究所</option>
									<option value="p-REM">不動產經營研究所</option>
									<option value="p-MIS">資訊管理研究所</option>
									<option value="p-CSIE">資訊工程研究所</option>
									<option value="p-DAE">應用英語研究所</option>
								</optgroup>
								<optgroup label="日四技">
									<option value="d-Trade">國際貿易系</option>
									<option value="d-Finance">財務金融系</option>
									<option value="d-Acco">會計系</option>
									<option value="d-BA">企業管理系</option>
									<option value="d-REM">不動產經營系</option>
									<option value="d-Leisure">休閒事業經營系</option>
									<option value="d-MDM">行銷與流通管理系</option>
									<option value="d-CAM">商業自動化與管理系</option>
									<option value="d-MIS">資訊管理系</option>
									<option value="d-CSIE">資訊工程系</option>
									<option value="d-COM">電腦與通訊系</option>
									<option value="d-DAE">應用英語系</option>
									<option value="d-AJ">應用日語系</option>
								</optgroup>
								<optgroup label="夜四技">
									<option value="e-Trade">國際貿易系</option>
									<option value="e-BA">企業管理系</option>
									<option value="e-Finance">財務金融系</option>
									<option value="e-MIS">資訊管理系</option>
								</optgroup>
							</select>
						</label>
					</div>
					<div class="pure-u-1 pure-u-md-1-8 pure-u-lg-1-12">
						<label>年級
							<select name="grade">
								<option value="">All</option>
								<option value="1">一</option>
								<option value="2">二</option>
								<option value="3">三</option>
								<option value="4">四</option>
							</select>
						</label>
					</div>
					<div class="pure-u-1-3 pure-u-md-1-12 pure-u-lg-1-12">
						<input class="pure-button pure-button-primary" name="sent" type="submit" value="查詢">
					</div>
					<div class="pure-u-1-3 pure-u-md-1-12 pure-u-lg-1-12">
						<a href="index.php" class="pure-button pure-button-primary">清除</a>
					</div>
					<input type="hidden" name="query" value="true">
				</div>
			</form>
		</div>
		<div id="result">
			<?php
			if( ( isset($_GET["grade"]) ) && ( isset($_GET["department"]) ) )
			{
				include("_class_table.php");
			}
			?>
			<div id="list">
				<?php
					if($_GET["query"]==true)
					{
						if($institution!="")
							echo $q_inst[$institution]." ";
						if(@$grade!="")
							echo $q_grade[$grade];
						if($department!="")
							echo $q_dept[$department];
					}
				?>
				<table>
					<thead>
						<tr>
							<td>通識<br>領域</td>
							<td>課程名稱</td>
							<td>必選修</td>
							<td>學<br>分</td>
							<td>開課<br>年班</td>
							<td>教授</td>
							<td>一</td>
							<td>二</td>
							<td>三</td>
							<td>四</td>
							<td>五</td>
							<td>六</td>
							<td>日</td>
							<td>教室</td>
							<td>已修<br>人數</td>
							<td>選課<br>限額</td>
							<td>教學<br>網站</td>
							<td>教學<br>附件</td>
							<td>備註</td>
						</tr>
					</thead>
					<tbody>
						<?php
						if(isset($_GET["query"]))
						{
							include("_class_list.php");
						}
						?>
					</tbody>
				</table>
			</div>
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