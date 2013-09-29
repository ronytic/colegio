<?php
include_once("../../login/check.php");
if(!empty($_POST['CodMateria'])){
	include_once("../../class/materias.php");
	$materias=new materias;
	$CodMateria=$_POST['CodMateria'];
	$materias->eliminarRegistro("CodMateria=$CodMateria");
}
?>