<?php
include_once("../../login/check.php");
$CodAlumno=$_GET['CodAlumno'];
$Ruta=$_GET['Ruta'];
include_once("../../class/tmpcola.php");
$tmpcola=new tmpcola;
//$tmpcola->actualizarRegistro(array("Estado"=>"'Proceso'"),"CodAlumno=".$CodAlumno);
header("Location:".$Ruta."?CodAlumno=".$CodAlumno);
?>