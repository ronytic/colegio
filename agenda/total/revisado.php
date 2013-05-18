<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/agenda.php");
	$agenda=new agenda;
	$CodAgenda=$_POST['CodAgenda'];
	$Valor=$_POST['Valor'];
	$values=array("resaltar2"=>$Valor);
	$agenda->actualizarAgendaE($values,"CodAgenda=$CodAgenda");
	echo "OK";
}
?>