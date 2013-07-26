<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/cursomateriaexportar.php");
	$cursomateriaexportar=new cursomateriaexportar;
	$CodCursoMateriaExportar=$_POST['Cod'];	
	$cursomateriaexportar->actualizar("CodCursoMateriaExportar=$CodCursoMateriaExportar");
}
?>