<?php

include("../_LIB_http/LIB_http.php");
include("../_LIB_http/LIB_parse.php");

$ref="";
$target = "http://127.0.0.1/curl/input/sample/sample-AJ.htm";
$web_page = http_get($target,$ref);
$html = $web_page['FILE'];
$html = mb_convert_encoding($html,"UTF-8","big5");


$config = array('indent' => TRUE,
				'output-html' => TRUE,
				'wrap' => 200);
$tidy = tidy_parse_string($html,$config,'UTF8');
$tidy->cleanRepair();


echo $tidy;
//echo "<xmp>".$tidy."</xmp>";


?>