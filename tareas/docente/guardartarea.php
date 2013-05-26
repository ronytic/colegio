<?php
include_once("../../login/check.php");
include_once("../../class/tarea.php");
include_once("../../config.php");
if(!empty($_POST)){
	$tarea=new tarea;
	$fecha=date("Y-m-d");
	$hora=date("H:i:s");
	$CodDocente=$_SESSION['CodUsuarioLog'];
	$FechaTarea=date("y-m-d",strtotime($_POST['FechaTarea']));
	$tareaValues=array(
		'CodTarea'=>'Null',
		'CodDocente'=>$CodDocente,
		'CodCurso'=>$_POST['CodCurso'],
		'CodMateria'=>$_POST['CodMateria'],
		'Nombre'=>"'{$_POST['Nombre']}'",
		'Descripcion'=>"'{$_POST['Descripcion']}'",
		'FechaPresentacion'=>"'$FechaTarea'",
		'FechaGuardado'=>"'$fecha'",
		'HoraGuardado'=>"'$hora'",
		'Visible'=>1
	);
	$tarea->insertarTarea($tareaValues);
//	include_once("mostrarTarea.php");
}
?>