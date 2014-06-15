<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	/*echo "<pre>";
	print_r($_POST);
	echo "</pre>";
	*/
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
	$FechaLimiteEmision=$config->mostrarConfig("FechaLimiteEmision",1);
	
	$NitEmisor=$config->mostrarConfig("NitEmisor",1);
	$RazonSocialEmisor=$config->mostrarConfig("RazonSocialEmisor",1);
	$SistemaFacturacion=$config->mostrarConfig("SistemaFacturacion",1);
	$ImagenFondoFactura=$config->mostrarConfig("ImagenFondoFactura",1);
	
	$ActividadEconomica=$config->mostrarConfig("ActividadEconomica",1);
	$LeyendaPiePagina=$config->mostrarConfig("LeyendaPiePagina",1);
	
	$f=$factura->mostrarFacturas("NFactura='".trim($NFactura)."' and Estado='Activo'");
	//echo count($f);
	if(count($f)>=1){
		header("Location: ./?f=1&NFactura=".trim($NFactura));	
	}
	$FechaCodigo=date("Ymd",strtotime($FechaFactura));
	$TotalBsCodigo=round(str_replace(',', '.', $TotalBs), 0);
	include_once("../codigocontrol.class.php");
	$CodigoControl=new CodigoControl($NumeroAutorizacion,$NFactura,$Nit,$FechaCodigo,$TotalBsCodigo,$LlaveDosificacion);
	$TxtCodigoDeControl=$CodigoControl->generar();
	
	/*CódigoQR*/
	include "../../funciones/phpqrcode/qrlib.php";
	
	$FechaEmision=date("d/m/Y",strtotime($FechaFactura));
	$FechaLimiteEmision2=date("d/m/Y",strtotime($FechaLimiteEmision));
	
	$NitEmisor=($NitEmisor!="")?$NitEmisor:'0';
	$RazonSocialEmisor=($RazonSocialEmisor!="")?$RazonSocialEmisor:'0';
	$NFactura=($NFactura!="")?$NFactura:'0';
	$NumeroAutorizacion=($NumeroAutorizacion!="")?$NumeroAutorizacion:'0';
	$FechaEmision=($FechaEmision!="")?$FechaEmision:'0';
	$TotalBs=($TotalBs!="")?$TotalBs:'0';
	$TxtCodigoDeControl=($TxtCodigoDeControl!="")?$TxtCodigoDeControl:'0';
	$FechaLimiteEmision2=($FechaLimiteEmision2!="")?$FechaLimiteEmision2:'0';
	$Nit=($Nit!="")?$Nit:'0';
	$NombreFactura=($NombreFactura!="")?$NombreFactura:'0';

	$TextoCodigoQR=$NitEmisor."|";
	$TextoCodigoQR.=$RazonSocialEmisor."|";
	$TextoCodigoQR.=$NFactura."|";
	$TextoCodigoQR.=$NumeroAutorizacion."|";
	$TextoCodigoQR.=$FechaEmision."|";
	$TextoCodigoQR.=$TotalBs."|";
	$TextoCodigoQR.=$TxtCodigoDeControl."|";
	$TextoCodigoQR.=$FechaLimiteEmision2."|";
	$TextoCodigoQR.=$Nit."|";
	$TextoCodigoQR.=$NombreFactura."|";
	
	$TextoCodigoQR=mayuscula($TextoCodigoQR);
	//echo $TextoCodigoQR;
	QRcode::png($TextoCodigoQR,"../../imagenes/factura/codigos/".$CodFactura.".png", 'H', 8, 0);
	/*Fin CódigoQR*/
	
	$ValoresFactura=array(
		"CodFactura"=>"'$CodFactura'",
		"FechaFactura"=>"'".fecha2Str($FechaFactura,0)."'",
		"NFactura"=>"'".trim($NFactura)."'",
		"NReferencia"=>"'".trim($NReferencia)."'",
		"FacturaAlumno"=>"'".trim($FacturaAlumno)."'",
		"CodAlumno"=>"'$CodAlumno'",
		"Nit"=>"'".trim($Nit)."'",
		"Factura"=>"'".trim($NombreFactura)."'",
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
		"FechaLimiteEmision"=>"'$FechaLimiteEmision'",
		"Tipo"=>"'Personalizado'",
		
		"NitEmisor"=>"'$NitEmisor'",
		"RazonSocialEmisor"=>"'$RazonSocialEmisor'",
		"ActividadEconomica"=>"'$ActividadEconomica'",
		"LeyendaPiePagina"=>"'$LeyendaPiePagina'",
		"TipoFactura"=>"'$SistemaFacturacion'",
		"ImagenFondo"=>"'$ImagenFondoFactura'",
		
	);
	
	//exit();
	/*echo "<pre>";
	print_r($ValoresFactura);
	echo "</pre>";*/
	foreach($a as $fd){
		if($fd['Nombre']!=""){
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
				"Tipo"=>"'Personalizado'"
			);
			/*echo "<pre>";	
			print_r($ValoresFacturaDetalle);
			echo "</pre>";*/
			$facturadetalle->insertarRegistro($ValoresFacturaDetalle);


		}
	}
	$factura->insertarRegistro($ValoresFactura);
	//echo $TxtCodigoDeControl;
	header("Location:ver.php?f=".$CodFactura);
}
?>