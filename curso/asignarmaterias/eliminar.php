<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/cursomateria.php");
	$cursomateria=new cursomateria;
	$CodCursoMateria=$_POST['Cod'];	
	$cursomateria->actualizar("CodCursoMateria=$CodCursoMateria");
}
?>