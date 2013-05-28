<?php
$link1=mysql_connect("localhost","root","");
$c1=mysql_select_db("colegio",$link1);


$res1=mysql_query($sql="SELECT * FROM alumno",$link1);
$datos1=array();
while($reg=mysql_fetch_assoc($res1)){
	array_push($datos1,$reg);	
}

$link2=mysql_connect("localhost","root","");
$c2=mysql_select_db("csb2013",$link2);

$res2=mysql_query($sql="SELECT * FROM alumno",$link2);
$datos2=array();
while($reg=mysql_fetch_assoc($res2)){
	array_push($datos2,$reg);	
}
//print_r($datos2);
$datosUnidos=array_unique(array_merge($datos1,$datos2));
print_r($datosUnidos);
echo "<br>Cantidad:".count($datosUnidos);
?>