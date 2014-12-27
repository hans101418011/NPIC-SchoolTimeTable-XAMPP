<?php
include("config.php");
$x = md5(Config_Passwd);

if(md5($_POST["user"])!=$x)
{
	phpinfo();
}
else
{
	//echo "<p>".$x."<br>".mb_substr($x,10,11,'utf8')."</p>";
	
	$IDA = array(
		"sn"=>$_POST["sn"],
		"name"=>$_POST["name"],
		"sort"=>$_POST["sort"],
		"elective"=>$_POST["elective"],
		"credit"=>$_POST["credit"],
		"semester"=>$_POST["semester"],
		"institution"=>$_POST["institution"],
		"department"=>$_POST["department"],
		"class"=>$_POST["class"],
		"teacher"=>$_POST["teacher"],
		"monday"=>$_POST["monday"],
		"tuesday"=>$_POST["tuesday"],
		"wednesday"=>$_POST["wednesday"],
		"thursday"=>$_POST["thursday"],
		"friday"=>$_POST["friday"],
		"saturday"=>$_POST["saturday"],
		"sunday"=>$_POST["sunday"],
		"student"=>$_POST["student"],
		"room"=>$_POST["room"],
		"web"=>$_POST["web"],
		"annex"=>$_POST["annex"],
		"max"=>$_POST["max"],
		"limit"=>$_POST["limit"],
		"other"=>$_POST["other"],
		"chose"=>$_POST["chose"]
	);


/*
	$sql = "INSERT INTO `subject` (
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
		'".$IDA['sn']."',
		'".$IDA["name"]."',
		'".$IDA['sort']."',
		'".$IDA['elective']."',
		'".$IDA['credit']."',
		'".$IDA["semester"]."',
		'".$IDA["institution"]."',
		'".$IDA["department"]."',
		'".$IDA["class"]."',
		'".$IDA["teacher"]."',
		'".$IDA["monday"]."',
		'".$IDA["tuesday"]."',
		'".$IDA["wednesday"]."',
		'".$IDA["thursday"]."',
		'".$IDA["friday"]."',
		'".$IDA["saturday"]."',
		'".$IDA["sunday"]."',
		'".$IDA["student"]."',
		'".$IDA["room"]."',
		'".$IDA["web"]."',
		'".$IDA["annex"]."',
		'".$IDA["max"]."',
		'".$IDA["limit"]."',
		'".$IDA["other"]."',
		'".$IDA["chose"]."');";
*/
	$sql = "UPDATE `subject` SET `sn`='".$IDA['sn']."',`name`='".$IDA["name"]."',`sort`='".$IDA['sort']."',`elective`='".$IDA['elective']."',`credit`='".$IDA['credit']."',`semester`='".$IDA["semester"]."',`institution`='".$IDA["institution"]."',`department`='".$IDA["department"]."',`class`='".$IDA["class"]."',`teacher`='".$IDA["teacher"]."',`monday`='".$IDA["monday"]."',`tuesday`='".$IDA["tuesday"]."',`wednesday`='".$IDA["wednesday"]."',`thursday`='".$IDA["thursday"]."',`friday`='".$IDA["friday"]."',`saturday`='".$IDA["saturday"]."',`sunday`='".$IDA["sunday"]."',`student`='".$IDA["student"]."',`room`='".$IDA["room"]."',`web`='".$IDA["web"]."',`annex`='".$IDA["annex"]."',`max`='".$IDA["max"]."',`limitST`='".$IDA["limit"]."',`other`='".$IDA["other"]."',`chose`='".$IDA["chose"]."' WHERE 1";

	mysql_query($sql,$link) or die("寫入錯誤!\n".mysql_error()."<br />"); 
}


?>