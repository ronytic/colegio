<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/config.php");
	$config=new config;
	$PuertoUsb=$config->mostrarConfig("PuertoUsb",1);
	$Sigla=$config->mostrarConfig("Sigla",1);
	
	$CodAgenda=$_POST['Codigo'];
	include_once("../../sms/funciones.php");
	include_once("../../class/alumno.php");
	include_once("../../class/agenda.php");
	include_once("../../class/materias.php");
	include_once("../../class/curso.php");
	include_once("../../class/observaciones.php");
	$agenda=new agenda;
	$alumno=new alumno;
	$materias=new materias;
	$observaciones=new observaciones;
	$curso=new curso;
	$ag=$agenda->MostrarAgenda($CodAgenda);
	$ag=array_shift($ag);
	//print_r($ag);
	$cur=$curso->mostrarCurso($ag['CodCurso']);
	$cur=array_shift($cur);
	$mat=$materias->mostrarMateria($ag['CodMateria']);
	$mat=array_shift($mat);
	$obs=$observaciones->mostrarObser($ag['CodObservacion']);
	$obs=array_shift($obs);
	$al=$alumno->mostrarTodoDatos($ag['CodAlumno']);
	$al=array_shift($al);
	/*
	AGenda CSB:
Ronald Nina
Obs: No Presento, Trabajo en Flash de Computacion 
10-05-2013
	*/
	$mensaje=quitarTilde($idioma['Agenda'])." $Sigla: ".quitarTilde(capitalizar($al['Paterno']))." ".quitarTilde(capitalizar(acortarPalabra($al['Nombres']))).", Obs: ".quitarTilde($obs['Nombre'],false)." ".quitarTilde($ag['Detalle'],false).", ".quitarTilde($mat['Nombre'],false).", ".date("Y-m-d",strtotime($ag['Fecha']));
	$mensaje=($mensaje);
	//echo $mensaje;
	
	$NumeroCelular=$al['CelularSMS'];
	$NumeroCelular=trim($NumeroCelular);
	$Mensaje=$mensaje;
	include_once("../../class/smsenviado.php");
	$smsenviado=new smsenviado;
	extract($_POST);
	if($al['ActivarSMS']){
		if($NumeroCelular!="" ||!empty($NumeroCelular)){
			$res=enviarSms("COM".$PuertoUsb,$NumeroCelular,$Mensaje);	
		}else{
			$res=false;	
		}
		
		//$res=true;
	
		if($res){
			$valores=array("Numero"=>"'$NumeroCelular'",
						"Mensaje"=>"'$Mensaje'");
			$smsenviado->insertarRegistro($valores);
			$agenda->actualizarAgendaE(array("EnviadoSMS"=>"'1'"),"CodAgenda=".$CodAgenda);
		}else{
			echo $idioma['MensajeEnviadoError'];
		}
	}
}
?>