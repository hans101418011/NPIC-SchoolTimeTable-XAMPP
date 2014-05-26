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
		include("function.php");


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


		$ref="";
		$target = "http://127.0.0.1/curl/input/sample/sample-AJ.htm";
		$web_page = http_get($target,$ref);
		$web_page['FILE'] = mb_convert_encoding($web_page['FILE'],"UTF-8","big5");
		
		$config = array('indent' => 0,
				'output-html' => TRUE,
				'wrap' => 0,
				'tidy-mark' => 0);
		$tidy = tidy_parse_string($web_page['FILE'],$config,'UTF8');
		$tidy->cleanRepair();

		$table_tag_array = parse_array($tidy,"<table","</table>");
		$tr_tag_array = parse_array($table_tag_array[0],"<tr>","</tr>");

		for($num_tr=0;$num_tr<count($tr_tag_array);$num_tr++)
		{
			$td_tag_array = parse_array($tr_tag_array[$num_tr],"<td>","</td>");
			for($num_td=0;$num_td<count($td_tag_array);$num_td++)
			{

				echo "<xmp>".$td_tag_array[$num_td]."|";
				$td_tag_array[$num_td] = str_replace("<td>" ,"", $td_tag_array[$num_td]);	//將td標籤去掉
				$td_tag_array[$num_td] = str_replace("</td>" ,"", $td_tag_array[$num_td]);	
				$td_tag_array[$num_td] = Noformat($td_tag_array[$num_td]);	//將td裡的多餘空白換行等格式去掉
				$td_21_chose="";
				if($num_td==9)
					$td_tag_array[$num_td] = str_replace("尾?富枝" , "尾﨑富枝" , $td_tag_array[$num_td]);

				echo $td_tag_array[$num_td]."</xmp>";
				
				if($num_td==21)		//額外處理第21個的td內容
				{
					$td_21_chose="";
					$class_PE=0;
					$td_tag_21 = explode("/",$td_tag_array[$num_td]);		//以斜線分割成陣列(3個)
					if(strlen($td_tag_array[$num_td])>=130)
						$td_tag_21[2] .=")";						//字串結尾加上再加上括號 (因為有些會缺)
					str_replace('體育' , "" , $td_tag_array[1],$class_PE);
					if($class_PE)
						$td_21_chose = td21_PE($num_dept,$td_21[2],$td_21_chose);
					if($search_dept[$num_dept]=="0-產學專班")
						$td_21[2] = td21_Society($td_tag_array[$num_td]);
					if($search_dept[$num_dept]=="")
						$td_21_chose = td21_GE($td_21[2],$td_21_chose);
				}

			}

			echo $num_tr."td =".$num_td."<br>";
		}
		echo "tr = ".$num_tr."";
		

	?>
</body>
</html>