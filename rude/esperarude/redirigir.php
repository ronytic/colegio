<?php
include_once("../../login/check.php");
$CodAlumno=$_GET['CodAlumno'];
include_once("../../class/tmpcola.php");
$tmpcola=new tmpcola;
$tmpcola->actualizarRegistro(array("Estado"=>"'Proceso'"),"CodAlumno=".$CodAlumno);
header("Location:../editarrude/index.php?CodAlumno=".$CodAlumno);
?>