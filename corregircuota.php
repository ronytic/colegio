<?php
mysql_connect("localhost","root","admina");
mysql_select_db("colegio2017");
$sql=" SELECT * FROM `cuota` GROUP BY CodAlumno HAVING count(*)=9";
$res=mysql_query($sql);
while($reg=mysql_fetch_array($res)){
	//print_r($reg);
	$sql2="INSERT INTO cuota VALUES(NULL,".$reg['CodAlumno'].",'1','".$reg['MontoPagar']."','','0','2016-02-18 12:14:00','')";
	echo $sql2;	
	mysql_query($sql2);
}
?>
