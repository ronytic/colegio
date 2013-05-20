<?php
include_once("../../login/check.php");
include_once("../../class/agenda.php");
if(!empty($_POST)){
	$agenda=new agenda;
	$CodAgenda=$_POST['CodAgenda'];
	$Fecha=date("Y-m-d");
	$Hora=date("H:i:s");
	$CodUsuario=$_SESSION['CodUsuarioLog'];
	$Nivel=$_SESSION['Nivel'];
	$values=array('CodUsuarioElimina'=>$CodUsuario,
				'NivelElimina'=>$Nivel,
				'Activo'=>0,
				'FechaElimina'=>"'$Fecha'",
				'HoraElimina'=>"'$Hora'"
	);
	$res=$agenda->actualizarAgendaE($values,"CodAgenda=$CodAgenda");
			echo "OK";
}
?>