<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	/*echo "<pre>";
	print_r($_POST);
	echo "</pre>";*/
	extract($_POST);
	include_once("../../class/config.php");
	include_once("../../class/factura.php");
	include_once("../../class/cuota.php");
	include_once("../../class/facturadetalle.php");
	$config=new config;
	$factura=new factura;
	$facturadetalle=new facturadetalle;
	$cuota=new cuota;
	$estado=$factura->statusTable();
	$CodFactura=$estado['Auto_increment'];
	$NumeroAutorizacion=$config->mostrarConfig("NumeroAutorizacion",1);
	$LlaveDosificacion=$config->mostrarConfig("LlaveDosificacion",1);
	$f=$factura->mostrarFacturas("NFactura='".trim($NFactura)."'");
	if(count($f)){
		header("Location: ./?f=1&NFactura=".trim($NFactura));	
	}
	$FechaCodigo=date("Ymd",strtotime($FechaFactura));
	$TotalBsCodigo=round(str_replace(',', '.', $TotalBs), 0);
	
	include_once("../codigocontrol.class.php");
	$CodigoControl=new CodigoControl($NumeroAutorizacion,$NFactura,$Nit,$FechaCodigo,$TotalBsCodigo,$LlaveDosificacion);
	$TxtCodigoDeControl=$CodigoControl->generar();
	$ValoresFactura=array(
		"CodFactura"=>"'$CodFactura'",
		"FechaFactura"=>"'".fecha2Str($FechaFactura,0)."'",
		"NFactura"=>"'".trim($NFactura)."'",
		"NReferencia"=>"'".trim($NReferencia)."'",
		"FacturaAlumno"=>"'".trim($FacturaAlumno)."'",
		"CodAlumno"=>"'$CodAlumno'",
		"Nit"=>"'".trim($Nit)."'",
		"Factura"=>"'".trim($Factura)."'",
		"TotalDescuento"=>"'$TotalDescuento'",
		"TotalInteres"=>"'$TotalInteres'",
		"TotalBs"=>"'$TotalBs'",
		"Cancelado"=>"'$Cancelado'",
		"MontoDevuelto"=>"'$MontoDevuelto'",
		"Observacion"=>"'$Observacion'",
		"Estado"=>"'Valido'",
		"MontoCodigo"=>"'$TotalBsCodigo'",
		"NumeroAutorizacion"=>"'$NumeroAutorizacion'",
		"LlaveDosificacion"=>"'$LlaveDosificacion'",
		"CodigoControl"=>"'$TxtCodigoDeControl'",
	);
	/*echo "<pre>";
	print_r($ValoresFactura);
	echo "</pre>";*/
	foreach($a as $fd){
		if($fd['CodCuota']!=""){
			$ValoresFacturaDetalle=array(
				"CodFactura"=>"'$CodFactura'",
				"CodAlumno"=>"'".$fd['CodAlumno']."'",
				"Nombre"=>"'".$fd['Nombre']."'",
				"CodCuota"=>"'".$fd['CodCuota']."'",
				"MontoCuota"=>"'".$fd['MontoCuota']."'",
				"ImporteCobrado"=>"'".$fd['ImporteCobrado']."'",
				"Interes"=>"'".$fd['Interes']."'",
				"Descuento"=>"'".$fd['Descuento']."'",
				"Total"=>"'".$fd['Total']."'",
			);
			/*echo "<pre>";	
			print_r($ValoresFacturaDetalle);
			echo "</pre>";*/
			$facturadetalle->insertarRegistro($ValoresFacturaDetalle);
			
			/*Modificacion Cuota*/
			/*$CodCuota=$fd['CodCuota'];	
			$Valor=1;
			$Factura=trim($NFactura);
			$Observaciones="Facturado";
			$Fecha=fecha2Str($FechaFactura,0);
			$Hora= date("H:i:s");
			$Fecha=$Fecha." ".$Hora;
			$cuota->actualizar($CodCuota,$Valor,$Factura,$Observaciones,$Fecha);
			/*Fin de Modificacion Pago Cuota*/
		}
	}
	$factura->insertarRegistro($ValoresFactura);
	//echo $TxtCodigoDeControl;
	header("Location:ver.php?f=".$CodFactura);
}
?>