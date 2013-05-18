<?php
include_once("../../login/check.php");
include_once("../../class/agenda.php");
if(!empty($_POST)){
	$agenda=new agenda;
	$fecha=date("Y-m-d");
	$hora=date("H:i:s");
	$FechaObs=date("Y-m-d",strtotime($_POST['Fecha']));
	$CodUsuario=$_SESSION['CodUsuarioLog'];
	$agendaValues=array(
				"CodAgenda"=>'NULL',
				'CodCurso'=>$_POST['CodCurso'],
				'CodAlumno'=>$_SESSION['CodAl'],
				'CodMateria'=>$_POST['CodMateria'],
				'CodObservacion'=>$_POST['CodObs'],
				'Fecha'=>"'$FechaObs'",
				'FechaRegistro'=>"'$fecha'",
				'HoraRegistro'=>"'$hora'",
				'Detalle'=>"'{$_POST['Detalle']}'",
				'CodUsuario'=>$CodUsuario,
				'Resaltar'=>$_POST['Resaltar'],
				'Visible'=>1
		);
		//print_r($agendaValues);
		$res=$agenda->insertarRegistro($agendaValues);
	//print_r( $agendaValues);
		if($res)
			echo "OK";
		else
			echo "NO";
}
?>