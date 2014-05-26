<?php

function Noformat($in_string)
{
	$in_string=str_replace("\t" , "" , $in_string);
	$in_string=str_replace("\r\n" , "" , $in_string);
	$in_string=str_replace("\n" , "" , $in_string);
	$in_string=str_replace("　" , "" , $in_string);
	return $in_string;
}

function td21_Society($td_21)
{
	$td_21_Soc = explode("/",$td_21);
	for($td21_society=2;$td21_society<count($td_21_Soc);$td21_society++)
	{
		if($td21_society==count($td_21_Soc)-1)
			$td_21_S.=$td_21_Soc[$td21_society];
		else
			$td_21_S.=$td_21_Soc[$td21_society]."/";
	}
	return $td_21_S;
}

?>