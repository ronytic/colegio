<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$Cod=$_POST['Cod'];	
	$Valor=$_POST['Valor'];
	include_once("../../class/factura.php");
	$factura=new factura;
	$val=array("Estado"=>"'$Valor'");
	$factura->actualizarRegistro($val,"CodFactura=$Cod");
}
?>