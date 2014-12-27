<!doctype html>
<html>
<head>
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
	//include("config.php");
	set_time_limit(3600);

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
		//echo "<div>";
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
			//echo "<pre>$option_tag_array[$num_option]</pre>";
		}
		//echo "</div>";
	}
	/*
	echo "<pre>";
	print_r($search_dept);
	echo "</pre>";
	echo "<pre>";
	print_r($search_sect);
	echo "</pre>";
*/
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