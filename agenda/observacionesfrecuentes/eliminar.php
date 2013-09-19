<?php
include_once("../../login/check.php");
if(!empty($_POST['CodObservacionesFrecuentes'])){
	include_once("../../class/observacionesfrecuentes.php");
	$observacionesfrecuentes=new observacionesfrecuentes;
	$CodObservacionesFrecuentes=$_POST['CodObservacionesFrecuentes'];
	$observacionesfrecuentes->eliminarRegistro("CodObservacionesFrecuentes=$CodObservacionesFrecuentes");
}
?>