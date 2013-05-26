<?php
include_once("../../login/check.php");
include_once("../../class/tarea.php");
if(!empty($_POST)){
	$tarea=new tarea;
	$CodTarea=$_POST['CodTarea'];
	$Values=array("Visible"=>0);
	$where="CodTarea=$CodTarea";
	$tarea->actualizarTarea($Values,$where);
}
?>