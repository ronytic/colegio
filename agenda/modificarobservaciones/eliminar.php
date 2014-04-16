<?php
include_once("../../login/check.php");
if(!empty($_POST['CodObservacion'])){
	include_once("../../class/observaciones.php");
	$observaciones=new observaciones;
	$CodObservacion=$_POST['CodObservacion'];
	$observaciones->eliminarRegistro("CodObservacion=$CodObservacion");
}
?>