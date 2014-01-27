<?php
include_once("../../login/check.php");
include_once("../../class/agenda.php");
if(!empty($_POST)){
	$agenda=new agenda;
	$fecha=date("Y-m-d");
	$hora=date("H:i:s");
	$FechaObs=date("Y-m-d",strtotime($_POST['Fecha']));
	$CodUsuario=$_SESSION['CodUsuarioLog'];
	$Nivel=$_SESSION['Nivel'];
	$agendaValues=array(
				"CodAgenda"=>'NULL',
				'CodCurso'=>$_POST['CodCurso'],
				'CodAlumno'=>$_SESSION['CodAl'],
				'CodMateria'=>$_POST['CodMateria'],
				'CodObservacion'=>$_POST['CodObs'],
				'Fecha'=>"'$FechaObs'",
				'FechaRegistro'=>"'$fecha'",
				'HoraRegistro'=>"'$hora'",
				'Activo'=>1,
				'Detalle'=>"'{$_POST['Detalle']}'",
				'CodUsuario'=>$CodUsuario,
				'Nivel'=>$Nivel,
				'Resaltar'=>$_POST['Resaltar'],
		);
		//print_r($agendaValues);
		$res=$agenda->insertarRegistro($agendaValues);
		$CodigoInsertado=$agenda->ultimo();
	//print_r( $agendaValues);
		if($res)
			$valores=array("Mensaje"=>"OK","Cod"=>$CodigoInsertado,"EnviadoSMS"=>0,"Accion"=>1);

		else
			$valores=array("Mensaje"=>"NO","Cod"=>$CodigoInsertado);
			
			echo json_encode($valores);
}
?>