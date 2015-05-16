<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/cursomateriaexportar.php");
	$cursomateria=new cursomateriaexportar;
	$CodCursoMateria=$_POST['Cod'];	
	$Value=$_POST['Val'];
	$cursomateria->cambiarCombinada($Value,"CodCursoMateriaExportar=$CodCursoMateria");
}
?>