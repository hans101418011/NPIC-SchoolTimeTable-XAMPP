<!doctype html>
<?php
	include("config.php");
	if(isset($_GET["department"])){
		$department = $_GET["department"];
		$temp = explode("-",$department);
		$institution = $temp[0];
		$department = $temp[1];
	}
	if(isset($_GET["grade"])){
		$grade = $_GET["grade"];
	}


	$q_inst = array(
		'o' => "產學專班", 
		'i' => "碩專班", 
		'p' => "研究所", 
		'd' => "四年制",
		'e' => "夜四技" 
	);
	$q_grade = array(
		'1' => "103", 
		'2' => "102", 
		'3' => "101", 
		'4' => "100"
	);
	$q_dept = array(
		'GE' => "通識",
		'AJ' => "應日",
		'BA' => "企管",
		'DAE' => "應英",
		'MDM' => "行銷",
		'CAM' => "商管",
		'COM' => "電通",
		'MIS' => "資管",
		'REM' => "不動",
		'CSIE' => "資工",
		'Acco' => "會計",
		'Trade' => "國貿",
		'Finance' => "財金",
		'Leisure' => "休閒"
	);
	if($institution=="i"||$institution=="o"||$institution=="p")
	{
		$q_dept['BA'] = "經管";
		$q_dept['CAM'] = "企電";
		$q_dept['Trade'] = "國企";
		$q_dept['Leisure'] = "休創";
	}

	

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
				<h2>103學年度 上學期</h2>
			</hgroup>
		</header>
		<div id="search">
			<form name="search" method="get" action="<?=$_SERVER['self']?>"> <!--
				年制
				<select name="institution">
					<option>All</option>
					<option value="industry">產學專班</option>
					<option value="industry">碩專班</option>
					<option value="daytime">日四技</option>
					<option value="evening">夜四技</option>
					<option value="postgraduate">研究所</option>
				</select> -->
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
				<label>年級
					<select name="grade">
						<option value="">All</option>
						<option value="1">一</option>
						<option value="2">二</option>
						<option value="3">三</option>
						<option value="4">四</option>
					</select>
				</label>
				<input type="hidden" name="query" value="true">
				<input class="bt" name="sent" type="submit" value="查詢">
				<a href="index.php" class="bt" id="reset">清除</a>
				<!--<input class="bt" name="reset" type="reset" value="清除">-->
			</form>
		</div>
		<div id="result">
			<?php
			if(($_GET["grade"]!="")&&($_GET["department"]!=""))
			{
				include("_class_table.php");
			}
			?>
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
						if($_GET["query"]==true)
						{
							include("_class_list.php");
						}
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
			Copyright&copy;2013-2014&nbsp;Some&nbsp;Rights&nbsp;Reserved<br />
			Web&nbsp;Design&nbsp;by&nbsp;CSIE&nbsp;Hans
		</footer>
	</body>
</html>
