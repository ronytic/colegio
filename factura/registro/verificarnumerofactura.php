<?php
include_once("../../login/check.php");
if(!empty($_POST['NFactura'])){
	$NFactura=$_POST['NFactura'];
	include_once("../../class/factura.php");
	$factura=new factura;
	$f=$factura->mostrarFacturas("NFactura='".trim($NFactura)."'");
	if(count($f)){
		$valores=array("Estado"=>No,"Cantidad"=>count($f));
	}else{
		$valores=array("Estado"=>Si,"Cantidad"=>count($f));	
	}
	
	
	echo json_encode($valores);
}
?>