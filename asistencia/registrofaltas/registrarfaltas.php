<?php
include_once("../../login/check.php");
if(empty($_GET)){
	exit();	
}
include_once("../../class/asistencia.php");
include_once("../../class/alumno.php");
include_once("../../class/cursoarea.php");
include_once("../../class/curso.php");
include_once("../../class/config.php");
include_once("../../class/agenda.php");
$asistencia=new asistencia;
$alumno=new alumno;
$curso=new curso;
$cursoarea=new cursoarea;
$config=new config;
$agenda=new agenda;
$cnf=$config->mostrarConfig("FaltaAgenda");
$FaltaAgenda=$cnf['Valor'];
$FechaActual=$_GET['Fecha'];
$HoraActual=date("H:i:s");
$Dia=date("N",strtotime($FechaActual));
$asis=$asistencia->listadoFaltasHoy($FechaActual);
$Cantidad=count($asis);
if($Cantidad){
	foreach($asis as $a){
			$al=$alumno->mostrarTodoDatos($a['CodAlumno']);
			$al=array_shift($al);
			$cur=$curso->mostrarCurso($al['CodCurso']);
			$cur=array_shift($cur);
			$cArea=$cursoarea->mostrarArea($cur['CodCursoArea']);
			$cArea=array_shift($cArea);
			switch($Dia){
				case 1:{$HoraInicio=$cArea['HoraInicioL'];$HoraAtraso=$cArea['HoraEsperaL'];}break;
				case 2:{$HoraInicio=$cArea['HoraInicioM'];$HoraAtraso=$cArea['HoraEsperaM'];}break;
				case 3:{$HoraInicio=$cArea['HoraInicioMi'];$HoraAtraso=$cArea['HoraEsperaMi'];}break;
				case 4:{$HoraInicio=$cArea['HoraInicioJ'];$HoraAtraso=$cArea['HoraEsperaJ'];}break;
				case 5:{$HoraInicio=$cArea['HoraInicioV'];$HoraAtraso=$cArea['HoraEsperaV'];}break;
				case 6:{$HoraInicio=$cArea['HoraInicioS'];$HoraAtraso=$cArea['HoraEsperaS'];}break;
				case 7:{$HoraInicio=$cArea['HoraInicioD'];$HoraAtraso=$cArea['HoraEsperaD'];}break;
			}
			if($HoraInicio!='00:00:00' || $HoraAtraso!="00:00:00"){
				$valores=array("CodAlumno"=>$a['CodAlumno'],
							"Tipo"=>"'F'",
							"Dia"=>$Dia,
							"Fecha"=>"'".$FechaActual."'",
							"Hora"=>"'".$HoraActual."'"
							);
				$asistencia->insertarRegistro($valores);
				if($FaltaAgenda){
					$agendaValues=array(
						'CodCurso'=>$al['CodCurso'],
						'CodAlumno'=>$al['CodAlumno'],
						'CodMateria'=>20,//Secretaria
						'CodObservacion'=>6,//Falta Mañana
						'Fecha'=>"'$FechaActual'",
						'FechaRegistro'=>"'$FechaActual'",
						'HoraRegistro'=>"'$HoraActual'",
						'Activo'=>1,
						'Detalle'=>"''",
						'CodUsuario'=>$_SESSION['CodUsuarioLog'],
						'Nivel'=>$_SESSION['Nivel'],
						'Resaltar'=>0,
					);
					$agenda->insertarRegistro($agendaValues);
				}
			}
	}
}
header("Location:faltas.php");
?>