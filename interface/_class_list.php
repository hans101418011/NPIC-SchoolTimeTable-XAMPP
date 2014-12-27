<?php
$sql = 'SELECT * FROM `subject` WHERE `name` NOT LIKE \'%體育%\' AND `institution` LIKE \'%'.$q_inst[$institution].'%\' AND `class` LIKE \'%'.$q_grade[$grade].$q_dept[$department].'%\' LIMIT 0, 200 ';
$result = mysql_query($sql,$link);
while($data=mysql_fetch_assoc($result)):
?>
	<tr>
		<td class="sort"><?=$data['sort']?></td>
		<td class="name"><?=$data['name']?></td>
		<td class="elec"><?=$data['elective']?></td>
		<td class="cred"><?=$data['credit']?></td>
		<td class="clas"><?=$data['class']?></td>
		<td class="teac"><?=$data['teacher']?></td>
		<td class="mon"><?=$data['monday']?></td>
		<td class="tue"><?=$data['tuesday']?></td>
		<td class="wed"><?=$data['wednesday']?></td>
		<td class="thu"><?=$data['thursday']?></td>
		<td class="fri"><?=$data['friday']?></td>
		<td class="sat"><?=$data['saturday']?></td>
		<td class="sun"><?=$data['sunday']?></td>
		<td class="room"><?=$data['room']?></td>
		<td class="stud"><?=$data['student']?></td>
		<td class="max"><?=$data['max']?></td>
		<td class="web"><?=$data['web']?></td>
		<td class="anne"><?=$data['annex']?></td>
		<td class="othe"><?=$data['other']?></td>
	</tr>
<?php
endwhile;

//體育
if((102-$q_grade[$grade])<2 && $department!="GE"):
	$sql = 'SELECT * FROM `subject` WHERE `name` LIKE \'%體育%\' AND `institution` LIKE \'%'.$q_inst[$institution].'%\' AND `class` LIKE \'%'.$q_grade[$grade].'%\'';
	if($q_grade[$grade]!=101)
	{
		$sql = $sql.'AND `chose` LIKE \'%'.$q_grade[$grade].$q_dept[$department].'%\'';
	}
	$sql = $sql.' LIMIT 0, 200 ';
	$result = mysql_query($sql,$link);
	while($data=mysql_fetch_assoc($result)):
	?>
		<tr>
			<td class="sort">R<?=$data['sort']?></td>
			<td class="name"><?=$data['name']?></td>
			<td class="elec"><?=$data['elective']?></td>
			<td class="cred"><?=$data['credit']?></td>
			<td class="clas"><?=$data['class']?></td>
			<td class="teac"><?=$data['teacher']?></td>
			<td class="mon"><?=$data['monday']?></td>
			<td class="tue"><?=$data['tuesday']?></td>
			<td class="wed"><?=$data['wednesday']?></td>
			<td class="thu"><?=$data['thursday']?></td>
			<td class="fri"><?=$data['friday']?></td>
			<td class="sat"><?=$data['saturday']?></td>
			<td class="sun"><?=$data['sunday']?></td>
			<td class="room"><?=$data['room']?></td>
			<td class="stud"><?=$data['student']?></td>
			<td class="max"><?=$data['max']?></td>
			<td class="web"><?=$data['web']?></td>
			<td class="anne"><?=$data['annex']?></td>
			<td class="othe"><?=$data['other']?></td>
		</tr>
	<?php
	endwhile;
endif;

//通識
$sql = 'SELECT * FROM `subject` WHERE `name` NOT LIKE \'%體育%\' AND `institution` LIKE \'%'.$q_inst[$institution].'%\' AND  `chose` LIKE \'%'.$q_grade[$grade].$q_dept[$department].'%\' LIMIT 0, 200 ';
$result = mysql_query($sql,$link);
while($data=mysql_fetch_assoc($result)):
?>
	<tr>
		<td class="sort"><?=$data['sort']?></td>
		<td class="name"><?=$data['name']?></td>
		<td class="elec"><?=$data['elective']?></td>
		<td class="cred"><?=$data['credit']?></td>
		<td class="clas"><?=$data['class']?></td>
		<td class="teac"><?=$data['teacher']?></td>
		<td class="mon"><?=$data['monday']?></td>
		<td class="tue"><?=$data['tuesday']?></td>
		<td class="wed"><?=$data['wednesday']?></td>
		<td class="thu"><?=$data['thursday']?></td>
		<td class="fri"><?=$data['friday']?></td>
		<td class="sat"><?=$data['saturday']?></td>
		<td class="sun"><?=$data['sunday']?></td>
		<td class="room"><?=$data['room']?></td>
		<td class="stud"><?=$data['student']?></td>
		<td class="max"><?=$data['max']?></td>
		<td class="web"><?=$data['web']?></td>
		<td class="anne"><?=$data['annex']?></td>
		<td class="othe"><?=$data['other']?></td>
	</tr>
<?php
endwhile;
?>