<?php
include_once("../../login/check.php");
if(!empty($_POST['CodNotificaciones'])){
	include_once("../../class/notificaciones.php");
	$notificaciones=new notificaciones;
	$CodNotificaciones=$_POST['CodNotificaciones'];
	$notificaciones->eliminarRegistro("CodNotificaciones=$CodNotificaciones");
}
?>