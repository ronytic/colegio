<?php
include_once("../../login/check.php");
if(!empty($_POST['CodCurso'])){
	include_once("../../class/curso.php");
	$curso=new curso;
	$CodCurso=$_POST['CodCurso'];
	$curso->eliminarRegistro("CodCurso=$CodCurso");
}
?>