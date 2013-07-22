<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/clases.php");
	$clases=new clases;
	$CodClases=$_POST['Cod'];	
	$clases->eliminarRegistro("CodClases=$CodClases");
}
?>