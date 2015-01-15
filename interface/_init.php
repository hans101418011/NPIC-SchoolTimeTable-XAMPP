<?php
	$temp = NULL;
	$institution = NULL;
	$department = NULL;
	
	if($_GET["department"]!=""){
		$department = $_GET["department"];
		$temp = explode("-",$department);
		$institution = $temp[0];
		$department = $temp[1];
	}
	if($_GET["grade"]!=""){
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
		'4' => "100",
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