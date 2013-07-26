<?php
include_once("../class/alumno.php");
$alumno=new alumno;
include_once("csv.php");
$datos=array();
foreach($alumno->mostrarTodo() as $al){
	array_push($datos,array($al['CodAlumno'],$al['Nombres'],$al['Paterno']));

}
archivocsv("reporte.csv",$datos,";",";");
?>