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
	$FechaLimiteEmision=$config->mostrarConfig("FechaLimiteEmision",1);
	$f=$factura->mostrarFacturas("NFactura='".trim($NFactura)."' and Estado='Activo'");
	if(count($f)){
		header("Location: ./?f=1&NFactura=".trim($NFactura));	
	}
	$FechaCodigo=date("Ymd",strtotime($FechaFactura));
	$TotalBsCodigo=round(str_replace(',', '.', $TotalBs), 0);
	
	include_once("../codigocontrol.class.php");
	$CodigoControl=new CodigoControl($NumeroAutorizacion,$NFactura,$Nit,$FechaCodigo,$TotalBsCodigo,$LlaveDosificacion);
	$TxtCodigoDeControl=$CodigoControl->generar();
	
	/*CódigoQR*/
	$NitEmisor=$config->mostrarConfig("NitEmisor",1);
	$RazonSocialEmisor=$config->mostrarConfig("RazonSocialEmisor",1);
	$SistemaFacturacion=$config->mostrarConfig("SistemaFacturacion",1);
	$ImagenFondoFactura=$config->mostrarConfig("ImagenFondoFactura",1);
	
	$ActividadEconomica=$config->mostrarConfig("ActividadEconomica",1);
	$LeyendaPiePagina=$config->mostrarConfig("LeyendaPiePagina",1);
	
	include "../../funciones/phpqrcode/qrlib.php";
	
	$FechaEmision=date("d/m/Y",strtotime($FechaFactura));
	$FechaLimiteEmision2=date("d/m/Y",strtotime($FechaLimiteEmision));
	
	$NitEmisor=($NitEmisor!="")?$NitEmisor:'0';
	$RazonSocialEmisor=($RazonSocialEmisor!="")?mayuscula($RazonSocialEmisor):'0';
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
	$TextoCodigoQR.=number_format($TotalBs,2)."|";
	$TextoCodigoQR.=$TxtCodigoDeControl."|";
	$TextoCodigoQR.=$FechaLimiteEmision2."|";
	$TextoCodigoQR.=$Nit."|";
	$TextoCodigoQR.=$NombreFactura;
	
	$TextoCodigoQR=mayuscula($TextoCodigoQR);
	//echo $TextoCodigoQR;
	QRcode::png($TextoCodigoQR,"../../imagenes/factura/codigos/".$CodFactura.".png", 'H', 8, 0);
	/*Fin CódigoQR*/
	
	//exit();
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
		"Tipo"=>"'General'",
		
		"NitEmisor"=>"'$NitEmisor'",
		"RazonSocialEmisor"=>"'$RazonSocialEmisor'",
		"ActividadEconomica"=>"'$ActividadEconomica'",
		"LeyendaPiePagina"=>"'$LeyendaPiePagina'",
		"TipoFactura"=>"'$SistemaFacturacion'",
		"ImagenFondo"=>"'$ImagenFondoFactura'",
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
				"Tipo"=>"'General'"
			);
			/*echo "<pre>";	
			print_r($ValoresFacturaDetalle);
			echo "</pre>";*/
			$facturadetalle->insertarRegistro($ValoresFacturaDetalle);
			switch($fd['CodCuota']){
				case"Todo":{
							for($numcuo=1;$numcuo<=10;$numcuo++){
								$cuo=$cuota->mostrarCuota($fd['CodAlumno'],$numcuo);
								$cuo=array_shift($cuo);
								$CodCuota=$cuo['CodCuota'];	
								$Valor=1;
								$Factura=trim($NFactura);
								$Observaciones="Facturado";
								$Fecha=fecha2Str($FechaFactura,0);
								$Hora= date("H:i:s");
								$Fecha=$Fecha." ".$Hora;
								$cuota->actualizar($CodCuota,$Valor,$Factura,$Observaciones,$Fecha);
							}
					}break;
				case"2a10":{
							for($numcuo=2;$numcuo<=10;$numcuo++){
								$cuo=$cuota->mostrarCuota($fd['CodAlumno'],$numcuo);
								$cuo=array_shift($cuo);
								$CodCuota=$cuo['CodCuota'];	
								$Valor=1;
								$Factura=trim($NFactura);
								$Observaciones="Facturado";
								$Fecha=fecha2Str($FechaFactura,0);
								$Hora= date("H:i:s");
								$Fecha=$Fecha." ".$Hora;
								$cuota->actualizar($CodCuota,$Valor,$Factura,$Observaciones,$Fecha);
							}
					}break;
				default:{
							/*Modificacion Cuota*/
							$CodCuota=$fd['CodCuota'];	
							$Valor=1;
							$Factura=trim($NFactura);
							$Observaciones="Facturado";
							$Fecha=fecha2Str($FechaFactura,0);
							$Hora= date("H:i:s");
							$Fecha=$Fecha." ".$Hora;
							$cuota->actualizar($CodCuota,$Valor,$Factura,$Observaciones,$Fecha);
					}break;
			}
			/*Fin de Modificacion Pago Cuota*/
		}
	}
	$factura->insertarRegistro($ValoresFactura);
	//echo $TxtCodigoDeControl;
	header("Location:ver.php?f=".$CodFactura);
}
?>