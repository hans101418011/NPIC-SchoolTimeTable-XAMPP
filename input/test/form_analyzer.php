<?php
	include("_LIB_http/LIB_http.php");
	include("_LIB_http/LIB_parse.php");
	include("config.php");

	$action = "http://www.webbotsspidersscreenscrapers.com/form_analyzer.php";
	$ref = "";
	$method="POST";
	$data_array["dept"] = 1;
	$response = http($target=$action,$ref,$method,$data_array,EXCL_HEAD);
	echo "<pre>";
	print_r($response);
	echo "</pre>";
?>