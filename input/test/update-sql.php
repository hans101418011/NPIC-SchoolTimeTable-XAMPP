<?php

	$sql = "UPDATE `subject` SET 
		`sn`='".$input_data_array['sn']."',
		`name`='".$input_data_array["name"]."',
		`sort`='".$input_data_array['sort']."',
		`elective`='".$input_data_array['elective']."',
		`credit`='".$input_data_array['credit']."',
		`semester`='".$input_data_array["semester"]."',
		`institution`='".$input_data_array["institution"]."',
		`department`='".$input_data_array["department"]."',
		`class`='".$input_data_array["class"]."',
		`teacher`='".$input_data_array["teacher"]."',
		`monday`='".$input_data_array["monday"]."',
		`tuesday`='".$input_data_array["tuesday"]."',
		`wednesday`='".$input_data_array["wednesday"]."',
		`thursday`='".$input_data_array["thursday"]."',
		`friday`='".$input_data_array["friday"]."',
		`saturday`='".$input_data_array["saturday"]."',
		`sunday`='".$input_data_array["sunday"]."',
		`student`='".$input_data_array["student"]."',
		`room`='".$input_data_array["room"]."',
		`web`='".$input_data_array["web"]."',
		`annex`='".$input_data_array["annex"]."',
		`max`='".$input_data_array["max"]."',
		`limitST`='".$input_data_array["limit"]."',
		`other`='".$input_data_array["other"]."',
		`chose`='".$input_data_array["chose"]."' WHERE 1";
?>