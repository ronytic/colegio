<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/agenda.php");
	$agenda=new agenda;
	$CodAgenda=$_POST['CodAgenda'];
	$a=$agenda->MostrarAgenda($CodAgenda);
	$a=array_shift($a);
	$Valor=$_POST['Valor'];
	$values=array("resaltar2"=>$Valor);
	$agenda->actualizarAgendaE($values,"CodAgenda=$CodAgenda");
	$valores=array("Mensaje"=>"OK","EnviadoSMS"=>$a['EnviadoSMS'],"Accion"=>0);
	echo json_encode($valores);
}
?>