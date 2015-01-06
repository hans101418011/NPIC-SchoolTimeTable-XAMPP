<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>sql</title>
</head>
<style type="text/css">
<!--
	table {
		border-collapse:collapse;
	}
	table, th, td {
		border: 1px solid black;
		vertical-align:bottom;
	}


-->
</style>
<body>
<?php
	include("_LIB_http/LIB_http.php");
	include("_LIB_http/LIB_parse.php");
	include("config.php");
	$total_tr=0;
	set_time_limit(3600);

/*---------------------------------------------------
利用cURL模擬檢索通識課取得結果

即時擷取表單資料建立搜索迴圈
----------------------------------------------------*/
	$search_grade_conver = array("1","2","3","4");

	$ref = "http://webs3.npic.edu.tw/selectn/clist.asp";
	$action = "http://webs3.npic.edu.tw/selectn/search.asp";
	$method = "GET";
	$response = http($target=$action,$ref,$method,$data_array,EXCL_HEAD);
	//$web_page['FILE']=iconv("big5","UTF-8",$response['FILE']); 
	$web_page['FILE'] = mb_convert_encoding($response['FILE'],"UTF-8","big5");
	$form_tag_array = parse_array($web_page['FILE'],"<form","</form>");
	$select_tag_array = parse_array($form_tag_array[0],"<select","/select>");

	for($num_select=0;$num_select<2;$num_select++)
	{
		$option_tag_array = parse_array($select_tag_array[$num_select],"option>","<");
		for($num_option=1;$num_option<count($option_tag_array);$num_option++)
		{
			$option_tag_array[$num_option] = str_replace("option>" , "" , $option_tag_array[$num_option]);
			$option_tag_array[$num_option] = str_replace("<" , "" , $option_tag_array[$num_option]);
			$option_tag_array[$num_option] = str_replace(" " , "" , $option_tag_array[$num_option]);
			$option_tag_array[$num_option] = Noformat($option_tag_array[$num_option]);
			if($num_select==0)
				$search_dept[]=$option_tag_array[$num_option];
			if($num_select==1)
				$search_sect[]=$option_tag_array[$num_option];
		}
	}

	$data_array = array("dept"=>"", "sect"=>"", "grade"=>"", "cscn"=>"", "thname"=>"", "dayinweek"=>"", "selnscode"=>"", "periods"=>"", "room"=>"");

	echo "<table>\n";
	for($num_dept=0;$num_dept<count($search_dept);$num_dept++)
	{
		for($num_sect=0;$num_sect<count($search_sect);$num_sect++)
		{
			echo "<tr>\n";
			for($num_grade=0;$num_grade<4;$num_grade++)
			{
				echo "<td>\n";	
				$data_array["dept"] = $search_dept[$num_dept];
				$data_array["sect"] = $search_sect[$num_sect];
				$data_array["grade"] = $search_grade_conver[$num_grade];
				$data_array["dept"] = iconv("UTF-8","big5",$data_array["dept"]);
				$data_array["sect"] = iconv("UTF-8","big5",$data_array["sect"]);
				$data_array["grade"] = iconv("UTF-8","big5",$data_array["grade"]);
				
				$action = "http://webs3.npic.edu.tw/selectn/clist.asp";
				$ref = "http://webs3.npic.edu.tw/selectn/search.asp";
				$method="POST";
				$response = http($target=$action,$ref,$method,$data_array,EXCL_HEAD);
				//$web_page['FILE']=iconv("big5","UTF-8",$response['FILE']); 
				$web_page['FILE'] = mb_convert_encoding($response['FILE'],"UTF-8","big5");

		/*---------------------------------------------------
			處理取得的網頁資料
		----------------------------------------------------*/
				$table_tag_array = parse_array($web_page['FILE'],"<table","</table>");	//擷取table內的內容
				$tr_tag_array = parse_array($table_tag_array[0],"<tr","</tr>");			//擷取tr內的內容，依tr個數編成陣列
				for($num_tr=1;$num_tr<count($tr_tag_array);$num_tr++)		//跑tr陣列的內容
				{
					$td_tag_array = parse_array($tr_tag_array[$num_tr],"<td>","</td>");	//將tr內多個td編成陣列

					for($num_td=0;$num_td<22;$num_td++)		//最多21個td
					{
						$td_tag_array[$num_td]=str_replace("<TD>" , "" , $td_tag_array[$num_td]);	//將td標籤去掉
						$td_tag_array[$num_td]=str_replace("</TD>" , "" , $td_tag_array[$num_td]);	
						$td_tag_array[$num_td]=Noformat($td_tag_array[$num_td]);	//將td裡的多餘空白換行等格式去掉

						if($num_dept==4&&$num_sect==1&&$num_grade==1&&$num_td==9)
						{
							$td_tag_array[$num_td] = str_replace("?" , "劄" , $td_tag_array[$num_td]);	
						}
		/*---------------------------------------------------
			針對備註欄位的資料做處理
		----------------------------------------------------*/
						$td_21_chose="";
						if($num_td==21)		//額外處理第21個的td內容
						{
							$td_21 = explode("/",$td_tag_array[$num_td]);		//以斜線分割成陣列(3個)
							if(strlen($td_tag_array[$num_td])>=130)
							{
								$td_21[2] .=")";									//字串結尾加上再加上括號 (因為有些會缺)
							}

							str_replace('體育' , "" , $td_tag_array[1],$class_PE);
							if($class_PE)
							{
								$td_21_chose = td21_PE($num_dept,$td_21[2],$td_21_chose);
							}
							if($num_dept==0)
							{
								$td_21[2] = td21_Society($td_tag_array[$num_td]);
							}
							if($num_dept==5)
							{
								$td_21_chose = td21_GE($td_21[2],$td_21_chose);
							}
						}
						else
						{
		/*---------------------------------------------------
			非備註欄位的資料處理
		----------------------------------------------------*/
							str_replace('href=http' , "" , $td_tag_array[$num_td],$a);
							if($a)
							{
								$td_tag_array[$num_td]=str_replace('href=http' , 'href="http' , $td_tag_array[$num_td],$a);
								$td_tag_array[$num_td]=str_replace(' target' , '" target' , $td_tag_array[$num_td],$a);
							}
							$td_tag_array[$num_td] = str_replace('"' , "\"" , $td_tag_array[$num_td]);
						}
						
					}


		/*---------------------------------------------------
			將資料存到陣列
			再次利用cURL
			POST陣列資料到負責寫入資料庫的檔案
		----------------------------------------------------*/
					$input_data_array = array(
						"sn"=>$td_tag_array[0],
						"name"=>$td_tag_array[1],
						"sort"=>$td_tag_array[2],
						"elective"=>$td_tag_array[3],
						"credit"=>$td_tag_array[4],
						"semester"=>$td_tag_array[5],
						"institution"=>$td_tag_array[6],
						"department"=>$td_tag_array[7],
						"class"=>$td_tag_array[8],
						"teacher"=>$td_tag_array[9],
						"monday"=>$td_tag_array[10],
						"tuesday"=>$td_tag_array[11],
						"wednesday"=>$td_tag_array[12],
						"thursday"=>$td_tag_array[13],
						"friday"=>$td_tag_array[14],
						"saturday"=>$td_tag_array[15],
						"sunday"=>$td_tag_array[16],
						"student"=>$td_tag_array[17],
						"room"=>$td_tag_array[18],
						"web"=>$td_tag_array[19],
						"annex"=>$td_tag_array[20],
						"max"=>$td_21[0],
						"limit"=>$td_21[1],
						"other"=>$td_21[2],
						"chose"=>$td_21_chose,
						"user"=>Config_Passwd
					);
					$action = "http://127.0.0.1/NPTU-SchoolTimeTable-XAMPP/input/test/test-sql-receive.php";
					$ref = "http://127.0.0.1";
					$method="POST";
					$response = http($target=$action,$ref,$method,$input_data_array,EXCL_HEAD);
					echo($response['FILE']);

					unset($td_21_chose);
				}


		/*---------------------------------------------------
			將迴圈跑的次數印出
		----------------------------------------------------*/
				echo $search_dept[$num_dept]." ".$search_sect[$num_sect]." ".$search_grade_conver[$num_grade]." 共".($num_tr-1)."筆資料</td>\n";
				$total_tr+=$num_tr-1;

				if(count($tr_tag_array)==0)
				{
					$num_grade--;
					$time_rnd=1;
					sleep($time_rnd);
				}
				else
				{
					$time_rnd=1;
					sleep($time_rnd);
				}

			}	
			echo "</tr>\n";
		}
	}
	echo "</table><p>共 ".$total_tr." 筆資料</p>\n";

	

	function td21_Society($td_21)
	{
		$td_21_S="";
		$td_21_Soc = explode("/",$td_21);
		for($td21_society=2;$td21_society<count($td_21_Soc);$td21_society++)
		{
			if($td21_society==count($td_21_Soc)-1)
			{
				$td_21_S.=$td_21_Soc[$td21_society];
			}
			else
			{
				$td_21_S.=$td_21_Soc[$td21_society]."/";
			}
		}
		return $td_21_S;
	}

	function td21_PE($num_dept,$string,$td_21_chose)
	{
		
		if($num_dept==3)
		{
			str_replace('102' , "" , $string,$grade102);
			if($grade102)
			{
				$x = str_replace("選項" , "" , $string);
				$x = str_replace("進四" , "" , $x);
				$x = parse_array($x,"\(","\)");
				$x = str_replace(")" , "" , $x[0]);
				$x = str_replace("(" , "" , $x);
				$y = explode("、",$x);

				for($num=0;$num<count($y);$num++)
				{
					if($num==count($y)-1)
					{
						$td_21_chose.="進四".$y[$num];;
					}
					else
					{
						$td_21_chose.="進四".$y[$num].",";
					}
				}
			}
		}
		if($num_dept==4)
		{
			str_replace('102' , "" , $string,$grade102);
			if($grade102)
			{
				$x = parse_array($string,"\(","\)");
				$x = str_replace(")" , "" , $x[0]);
				$x = str_replace("(" , "" , $x);
				$x = str_replace('102' , "、" ,$x);
				$y = explode("、",$x);
				for($num=1;$num<count($y);$num++)
				{
					if($num==count($y)-1)
					{
						$td_21_chose.="102".$y[$num];;
					}
					else
					{
						$td_21_chose.="102".$y[$num].",";
					}
				}
			}
		}

		return $td_21_chose;
	}

	function td21_GE($td_21_GE,$td_21_chose)
	{
		$td_yc[20]="";
		$x=0;
		$td_21_o = str_replace("適用" , ")、" , $td_21_GE);	//將前面分割陣列最後一個內容 適用 這詞取代
		$td_21_year = parse_array($td_21_o,"\)","\(");		//擷取多個右括和左刮中的入學年存為陣列(反斜線是因為正規表達式)
		$td_21_class = parse_array($td_21_o,"\(","\)");		//擷取多個左刮和右括中的系所存為陣列(反斜線是因為正規表達式)
		for($h=0;$h<count($td_21_class);$h++)				//跑迴圈
		{
			$td_21_c[$h] = explode("、",$td_21_class[$h]);	//分割系所
		}
		$x=0;
		for($i=0;$i<count($td_21_year);$i++)				
		{
			$td_21_year[$i] = str_replace(")、" , "" , $td_21_year[$i]);	//將用來分割的字串刪掉
			$td_21_year[$i] = str_replace("(" , "" , $td_21_year[$i]);		//將用來分割的字串刪掉
			for($j=0;$j<count($td_21_c[$i]);$j++)
			{
				$td_21_c[$i][$j] = str_replace(")" , "" , $td_21_c[$i][$j]);	//將用來分割的字串刪掉
				$td_21_c[$i][$j] = str_replace("(" , "" , $td_21_c[$i][$j]);	//將用來分割的字串刪掉
				$td_yc[$x++]=$td_21_year[$i].$td_21_c[$i][$j];			//新創陣列將入學年和系所合併
			}
		}
		for($k=0;$k<$x;$k++)		//印出第21個td處裡過後的內容
		{
			if($k==$x-1)
			{
				$td_21_chose.=$td_yc[$k];
			}
			else
			{
				$td_21_chose.=$td_yc[$k].",";
			}
		}
		$td_other = explode(")",$td_21_o);	//印出額外註記
		if($td_other[count($td_other)-1])
		{
			$td_21_chose.="，(".$td_other[count($td_other)-1].")";
		}
		return $td_21_chose;
	}

/*---------------------------------------------------
一個清除換行和空行的function
----------------------------------------------------*/
	function Noformat($in_string)
	{
		$in_string=str_replace("\t" , "" , $in_string);
		$in_string=str_replace("\r\n" , "" , $in_string);
		$in_string=str_replace("\n" , "" , $in_string);
		return $in_string;
	}
?>	
</body>
</html>