<?php
include_once("../../login/check.php");
//sleep(1);
if(!empty($_POST)){
	include_once("../funciones.php");
	include_once("../../class/config.php");
	$config=new config;
	$PuertoUsb=$config->mostrarConfig("PuertoUsb",1);
	
	include_once("../../class/smsenviado.php");
	$smsenviado=new smsenviado;
	
	$Posicion=$_POST['Posicion'];
	$Total=$_POST['Total'];
	$Mensaje=$_POST['Mensaje'];
	$NumeroSMS=$_POST['NumeroSMS'];
	$NumeroSMS=trim($NumeroSMS);
	$Mensaje=quitarTilde($Mensaje);
	
if($NumeroSMS!="" || !empty($NumeroSMS)){
	$res=enviarSms1("COM".$PuertoUsb,$NumeroSMS,$Mensaje);
	//$res=true;
}else{
	$res=false;
}

//$res=0;
if($res){
	$valores=array("Numero"=>"'$NumeroSMS'",
					"Mensaje"=>"'$Mensaje'");
	$smsenviado->insertarRegistro($valores);
	$Salida=array("Estado"=>"Correcto","Posicion"=>$Posicion,"Total"=>$Total,"Mensaje"=>$idioma["Enviado"]);
}else{
	$Salida=array("Estado"=>"Error","Posicion"=>$Posicion,"Total"=>$Total,"Mensaje"=>$idioma["NoEnviado"]);
}
echo json_encode($Salida);
}
?>