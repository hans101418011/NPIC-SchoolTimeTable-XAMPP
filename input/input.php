<!doctype html>
<html>
<head>
	<title>Input local</title>
</head>
<body>
	<?php
		include("_LIB_http/LIB_http.php");
		include("_LIB_http/LIB_parse.php");
		include("config.php");

		$search_dept = array("0-產學專班","6-碩專班","3-研究所","7-夜四技","4-四年制","");
		$search_grade = array(3,2,2,4,4,4);
		$search_grade_conver = array("1","2","3","4");
		$search_sect = array(
			array(""),
			array(""),
			array("19-休閒遊憩與創意產業管理研究所","20-企業電子化研究所","14-國際企業研究所","15-經營管理研究所","11-行銷與流通管理系","18-資訊工程系","3-財務金融系(科)","6-資訊管理系","21-應用英語系","5-不動產經營系"),
			array("1-國際貿易系(科)","2-企業管理系(科)","3-財務金融系(科)","6-資訊管理系"),
			array("1-國際貿易系(科)","10-應用日語系","11-行銷與流通管理系","12-商業自動化與管理系","16-電腦與通訊系","18-資訊工程系","2-企業管理系(科)","21-應用英語系","3-財務金融系(科)","4-會計系(科)","5-不動產經營系","6-資訊管理系","8-休閒事業經營系"),
			array("0-通識教育中心")
		);
		$data_array = array("dept"=>"", "sect"=>"", "grade"=>"", "cscn"=>"", "thname"=>"", "dayinweek"=>"", "selnscode"=>"", "periods"=>"", "room"=>"");
	?>
	


</body>
</html>