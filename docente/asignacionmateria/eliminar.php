<?php
include_once("../../login/check.php");
if(isset($_POST)){
	$Cod=$_POST['Cod'];
	include_once("../../class/docentemateriacurso.php");
	$docentemateriacurso=new docentemateriacurso;
	$docentemateriacurso->eliminarRegistro("CodDocenteMateriaCurso=".$Cod);
}
?>