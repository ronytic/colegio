<?php
include_once("../../login/check.php");
if(!empty($_POST['CodCursoArea'])){
	include_once("../../class/cursoarea.php");
	$cursoarea=new cursoarea;
	$CodCursoArea=$_POST['CodCursoArea'];
	$cursoarea->eliminarRegistro("CodCursoArea=$CodCursoArea");
}
?>