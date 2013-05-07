<?php
include_once("../../login/check.php");
if(isset($_POST)){
	include_once("../../class/docente.php");
	$docente=new docente;
	extract($_POST);
	$contra=mb_strtolower(generarPalabra(),"utf8");	
	$valores=array("Password"=>"'$contra'");
	
	if($docente->actualizarRegistro($valores,$CodDocente)){
		echo $contra;	
	}else{
		echo $idioma['NoseGuardo'];	
	}
}
?>