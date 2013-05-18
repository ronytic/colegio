<?php
include_once("../../login/check.php");
include_once("../../class/agenda.php");
if(!empty($_POST)){
	$agenda=new agenda;
	$CodAgenda=$_POST['CodAgenda'];
	$Fecha=date("Y-m-d");
	$Hora=date("H:i:s");
	$CodUsuario=$_SESSION['CodUsuarioLog'];
	$values=array('CodUsuarioElimina'=>$CodUsuario,
				'Visible'=>0,
				'FechaElimina'=>"'$Fecha'",
				'HoraElimina'=>"'$Hora'"
	);
	$res=$agenda->actualizarAgendaE($values,"CodAgenda=$CodAgenda");
			echo "OK";
}
?>