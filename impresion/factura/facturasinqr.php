<?php
include_once("../../login/check.php");
if($_GET['f']!=""){
include_once("../../class/config.php");
include_once("../../class/curso.php");
include_once("../../class/cuota.php");
include_once("../../class/alumno.php");
include_once("../../class/factura.php");
include_once("../../class/facturadetalle.php");
$factura=new factura;
$facturadetalle=new facturadetalle;
$config=new config;
$alumno=new alumno;
$curso=new curso;
$cuota=new cuota;
$Logo=$cnf=$config->mostrarConfig("Logo",1);
$Titulo=$config->mostrarConfig("Titulo",1);

$LlaveDosificacion=$config->mostrarConfig("LlaveDosificacion",1);
$ActividadEconomica=$config->mostrarConfig("ActividadEconomica",1);
$LeyendaPiePagina=$config->mostrarConfig("LeyendaPiePagina",1);
$ImagenFondoFactura=$config->mostrarConfig("ImagenFondoFactura",1);
$CodFactura=$_GET['f'];
$f=$factura->mostrarFactura($CodFactura);
$f=array_shift($f);
$NumeroAutorizacion=$f['NumeroAutorizacion'];
$FechaLimiteEmision=$f['FechaLimiteEmision'];
switch($f['Nivel']){
	case "1":{$Usuario=$idioma["Administrador"];}break;	
	case "2":{$Usuario=$idioma["Direccion"];}break;	
}
define('FPDF_FONTPATH','../fpdf/font/');
include_once("../pdfs.php");

$pdf=new FPDF("P","mm",array(217,330));
$pdf->AddFont("Tahoma","",'tahoma.php');
$pdf->AddFont("Tahoma","B",'tahomabd.php');

$pdf->SetAutoPageBreak(true,0);

$pdf->AddPage();
$pdf->SetFont("Tahoma","",10);
if($ImagenFondoFactura==1){
//$pdf->Image("../../imagenes/factura/factura.jpg",0,0,217,330);
$pdf->Image("../../imagenes/factura/factura2014.jpg",0,-4,217,330);
}

if(!file_exists("../../imagenes/factura/codigos/".$CodFactura.".png")){
	//Si no Existe el Código QR
	$TotalBs=number_format($f['TotalBs'],2);
	$TxtCodigoDeControl=$f['CodigoControl'];
	$Nit=$f['Nit'];
	$NombreFactura=$f['Factura'];
	/*CódigoQR*/
	$NitEmisor=$config->mostrarConfig("NitEmisor",1);
	$RazonSocialEmisor=$config->mostrarConfig("RazonSocialEmisor",1);
	$SistemaFacturacion=$config->mostrarConfig("SistemaFacturacion",1);
	$ImagenFondoFactura=$config->mostrarConfig("ImagenFondoFactura",1);
	
	$ActividadEconomica=$config->mostrarConfig("ActividadEconomica",1);
	$LeyendaPiePagina=$config->mostrarConfig("LeyendaPiePagina",1);
	
	include "../../funciones/phpqrcode/qrlib.php";
	
	$FechaEmision=date("d/m/Y",strtotime($f['FechaFactura']));
	$FechaLimiteEmision2=date("d/m/Y",strtotime($FechaLimiteEmision));
	
	$NitEmisor=($NitEmisor!="")?$NitEmisor:'0';
	$RazonSocialEmisor=($RazonSocialEmisor!="")?mayuscula($RazonSocialEmisor):'0';
	$NFactura=($f['NFactura']!="")?$f['NFactura']:'0';
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
	$TextoCodigoQR.=$NombreFactura;
	
	$TextoCodigoQR=mayuscula($TextoCodigoQR);
	//echo $TextoCodigoQR;
	
	QRcode::png($TextoCodigoQR,"../../imagenes/factura/codigos/".$CodFactura.".png", 'H', 8, 0);
	/*Fin CódigoQR*/
	//echo "Si";	
}
/*Primera Parte*/
$x=-4+$_GET['x'];
$y=15+$_GET['y'];


/*Borde*/
/*
$pdf->SetXY($x+125,$y-5);
$pdf->Cell(80,20,"",1);
$pdf->SetXY($x+15,$y+18);
$pdf->Cell(190,8,"",1);
$pdf->SetXY($x+15,$y+28);
$pdf->Cell(130,40,"",1);
$pdf->SetXY($x+145,$y+28);
$pdf->Cell(60,40,"",1);
$pdf->SetXY($x+15,$y+69);
$pdf->Cell(190,15,"",1);*/

$Credito=1;
$TextoCredito= $idioma['DesarrolladoPor']." Ronald Nina";

$pdf->SetXY($x+155,$y);
celda(27,$idioma['NAutorizacion'].": ","B",9);
celda(40,$NumeroAutorizacion,"",8);
$pdf->Ln();
$pdf->SetXY($x+155,$y+5);
celda(35,$idioma['NFactura'].": ","B",8);
celda(40,$f['NFactura'],"",8);

$pdf->SetXY($x+20,$y+22);
celda(20,$idioma['ANombre'].": ","B");
celda(65,mayuscula($f['Factura']),"");
celda(15,$idioma['NitCi'].": ","B");
celda(30,($f['Nit']),"");
celda(15,$idioma['Fecha'].": ","B");
celda(40,strftime("%d de %B de %Y",strtotime($f['FechaFactura'])),"");

if($f['Estado']=="Anulado"){
	$pdf->SetXY($x+55,$y+50);
	celda(50,"ANULADO","",26,"C");
}
$pdf->SetXY($x+15,$y+30);
//celda(130,$idioma['DetalleFacturacion'],"B",11,"C");
//celda(60,$idioma['Sello'],"B",11,"C");
$i=$y+35;
foreach($facturadetalle->mostrarFacturaDetalles("CodFactura=".$CodFactura) as $fd){$i+=4;
	$pdf->SetXY($x+25,$i);	
	if($f['Tipo']=="Personalizado"){
		$TextoDetalle=$fd['Nombre'];
	}else{
		$al=$alumno->mostrarDatosPersonales($fd['CodAlumno']);
		$al=array_shift($al);
		$cur=$curso->mostrarCurso($al['CodCurso']);
		$cur=array_shift($cur);
		switch($fd['CodCuota']){
			case "Todo":{
				$cuo['Numero']="Todo";	
			}break;
			case "2a10":{
				$cuo['Numero']="2a10";	
			}break;
			default:{
				$cuo=$cuota->mostrarTodoCuota($fd['CodCuota']);
				$cuo=array_shift($cuo);
			}break;
		}
		
		$NombreAlumno=$al['Paterno']." ".$al['Materno']." ".$al['Nombres'];
		$NombreCurso=$cur['Abreviado'];
		$NombreCuota=cambiopalabra($cuo['Numero'])." ".$idioma['Cuota'].($cuo['Numero']=="Todo"?" - ".$idioma['AlContado']:'');
		
		$TextoDetalle=capitalizar($NombreAlumno." - ".$NombreCurso)." - ".$NombreCuota;
	}
	celda(115,$TextoDetalle,"","9");
	celda(35,number_format($fd['Total'],2),"",10,"R");
}
$pdf->SetXY($x+20,$y+59);
celda(10,$idioma['Son'].": ","B");
celda(110,mayuscula(num2letras($f['TotalBs']))." ".$idioma['Bolivianos'],"","8");
celda(15,$idioma['TotalBs'].": ","B","8");
celda(20,number_format($f['TotalBs'],2),"",10,"R");
$pdf->SetXY($x+177,$y+59);
celda(12,$idioma['Cajero'].": ","B","8");
celda(20,$Usuario,"",8,"");
$pdf->Ln();
$pdf->SetXY($x+140,$y+63);
celda(15,$idioma['Cancelado'].": ","B","8");
celda(20,number_format($f['Cancelado'],2),"",10,"R");

$pdf->SetXY($x+20,$y+67);
celda(37,$idioma['FechaLimiteEmision'].": ","B","8");
celda(15,fecha2Str($FechaLimiteEmision),"",8,"R");
if($Credito){
	$pdf->SetXY($x+100,$y+67);
	celda(35,$TextoCredito,"","6");
}

$pdf->SetXY($x+20,$y+63);
celda(30,$idioma['CodigoControl'].": ","B","8");
celda(55,$f['CodigoControl'],"",8,"");
$pdf->SetXY($x+140,$y+67);
celda(15,$idioma['Cambio'].": ","B","8");
celda(20,number_format($f['MontoDevuelto'],2),"",10,"R");

$pdf->SetXY($x+177,$y+63);
celda(22,$idioma['NTransaccion'].": ","B","8");
celda(10,(($f['NReferencia'])),"","8");

$pdf->SetXY($x+177,$y+67);
celda(10,$idioma['Hora'].": ","B","8");
celda(15,(($f['HoraRegistro'])),"","8");


$pdf->SetXY($x+47,$y+78);
celda(10,'"'.mayuscula($LeyendaPiePagina).'"',"B","8");

$pdf->SetXY($x+130,$y+13);
celda(10,$idioma['ActividadEconomica'].": ".capitalizar($ActividadEconomica),"B","8");


$pdf->Image("../../imagenes/factura/codigos/".$CodFactura.".png",$x+25,$y+72,17,17);

/*Segunda Parte*/
$y=120;
/*$pdf->Image("../../imagenes/logos/".$Logo,15,$y-5,20,20);
$pdf->SetXY($x+15,$y);
$pdf->Cell(110,5,utf8_decode($Titulo),0,0,"C");
/*Borde*/
/*
$pdf->SetXY($x+125,$y-5);
$pdf->Cell(80,20,"",1);
$pdf->SetXY($x+15,$y+18);
$pdf->Cell(190,8,"",1);
$pdf->SetXY($x+15,$y+28);
$pdf->Cell(130,40,"",1);
$pdf->SetXY($x+145,$y+28);
$pdf->Cell(60,40,"",1);
$pdf->SetXY($x+15,$y+69);
$pdf->Cell(190,15,"",1);*/


$pdf->SetXY($x+155,$y);
celda(27,$idioma['NAutorizacion'].": ","B",9);
celda(40,$NumeroAutorizacion,"",8);
$pdf->Ln();
$pdf->SetXY($x+155,$y+5);
celda(35,$idioma['NFactura'].": ","B",8);
celda(40,$f['NFactura'],"",8);

$pdf->SetXY($x+20,$y+22);
celda(20,$idioma['ANombre'].": ","B");
celda(65,mayuscula($f['Factura']),"");
celda(15,$idioma['NitCi'].": ","B");
celda(30,($f['Nit']),"");
celda(15,$idioma['Fecha'].": ","B");
celda(40,strftime("%d de %B de %Y",strtotime($f['FechaFactura'])),"");

if($f['Estado']=="Anulado"){
	$pdf->SetXY($x+55,$y+50);
	celda(50,"ANULADO","",26,"C");
}
$pdf->SetXY($x+15,$y+30);
//celda(130,$idioma['DetalleFacturacion'],"B",11,"C");
//celda(60,$idioma['Sello'],"B",11,"C");
$i=$y+35;
foreach($facturadetalle->mostrarFacturaDetalles("CodFactura=".$CodFactura) as $fd){$i+=4;
	$pdf->SetXY($x+25,$i);	
	if($f['Tipo']=="Personalizado"){
		$TextoDetalle=$fd['Nombre'];
	}else{
		$al=$alumno->mostrarDatosPersonales($fd['CodAlumno']);
		$al=array_shift($al);
		$cur=$curso->mostrarCurso($al['CodCurso']);
		$cur=array_shift($cur);
		switch($fd['CodCuota']){
			case "Todo":{
				$cuo['Numero']="Todo";	
			}break;
			case "2a10":{
				$cuo['Numero']="2a10";	
			}break;
			default:{
				$cuo=$cuota->mostrarTodoCuota($fd['CodCuota']);
				$cuo=array_shift($cuo);
			}break;
		}
		
		$NombreAlumno=$al['Paterno']." ".$al['Materno']." ".$al['Nombres'];
		$NombreCurso=$cur['Abreviado'];
		$NombreCuota=cambiopalabra($cuo['Numero'])." ".$idioma['Cuota'].($cuo['Numero']=="Todo"?" - ".$idioma['AlContado']:'');
		
		$TextoDetalle=capitalizar($NombreAlumno." - ".$NombreCurso)." - ".$NombreCuota;
	}
	celda(115,$TextoDetalle,"","9");
	celda(35,number_format($fd['Total'],2),"",10,"R");
}
$pdf->SetXY($x+20,$y+59);
celda(10,$idioma['Son'].": ","B");
celda(110,mayuscula(num2letras($f['TotalBs']))." ".$idioma['Bolivianos'],"","8");
celda(15,$idioma['TotalBs'].": ","B","8");
celda(20,number_format($f['TotalBs'],2),"",10,"R");
$pdf->SetXY($x+177,$y+59);
celda(12,$idioma['Cajero'].": ","B","8");
celda(20,$Usuario,"",8,"");
$pdf->Ln();
$pdf->SetXY($x+140,$y+63);
celda(15,$idioma['Cancelado'].": ","B","8");
celda(20,number_format($f['Cancelado'],2),"",10,"R");

$pdf->SetXY($x+20,$y+67);
celda(37,$idioma['FechaLimiteEmision'].": ","B","8");
celda(15,fecha2Str($FechaLimiteEmision),"",8,"R");
if($Credito){
	$pdf->SetXY($x+100,$y+67);
	celda(35,$TextoCredito,"","6");
}

$pdf->SetXY($x+20,$y+63);
celda(30,$idioma['CodigoControl'].": ","B","8");
celda(55,$f['CodigoControl'],"",8,"");
$pdf->SetXY($x+140,$y+67);
celda(15,$idioma['Cambio'].": ","B","8");
celda(20,number_format($f['MontoDevuelto'],2),"",10,"R");

$pdf->SetXY($x+177,$y+63);
celda(22,$idioma['NTransaccion'].": ","B","8");
celda(10,(($f['NReferencia'])),"","8");

$pdf->SetXY($x+177,$y+67);
celda(10,$idioma['Hora'].": ","B","8");
celda(15,(($f['HoraRegistro'])),"","8");


$pdf->SetXY($x+47,$y+78);
celda(10,'"'.mayuscula($LeyendaPiePagina).'"',"B","8");

$pdf->SetXY($x+130,$y+13);
celda(10,$idioma['ActividadEconomica'].": ".capitalizar($ActividadEconomica),"B","8");


$pdf->Image("../../imagenes/factura/codigos/".$CodFactura.".png",$x+25,$y+72,17,17);



/*Tercera Parte*/
$y=229;
/*
$pdf->Image("../../imagenes/logos/".$Logo,15,$y-5,20,20);
$pdf->SetXY($x+15,$y);
$pdf->Cell(110,5,utf8_decode($Titulo),0,0,"C");
/*Borde*/
/*$pdf->SetXY($x+125,$y-5);
$pdf->Cell(80,20,"",1);
$pdf->SetXY($x+15,$y+18);
$pdf->Cell(190,8,"",1);
$pdf->SetXY($x+15,$y+28);
$pdf->Cell(130,40,"",1);
$pdf->SetXY($x+145,$y+28);
$pdf->Cell(60,40,"",1);
$pdf->SetXY($x+15,$y+69);
$pdf->Cell(190,15,"",1);*/

$pdf->SetXY($x+155,$y);
celda(27,$idioma['NAutorizacion'].": ","B",9);
celda(40,$NumeroAutorizacion,"",8);
$pdf->Ln();
$pdf->SetXY($x+155,$y+5);
celda(35,$idioma['NFactura'].": ","B",8);
celda(40,$f['NFactura'],"",8);

$pdf->SetXY($x+20,$y+22);
celda(20,$idioma['ANombre'].": ","B");
celda(65,mayuscula($f['Factura']),"");
celda(15,$idioma['NitCi'].": ","B");
celda(30,($f['Nit']),"");
celda(15,$idioma['Fecha'].": ","B");
celda(40,strftime("%d de %B de %Y",strtotime($f['FechaFactura'])),"");

if($f['Estado']=="Anulado"){
	$pdf->SetXY($x+55,$y+50);
	celda(50,"ANULADO","",26,"C");
}
$pdf->SetXY($x+15,$y+30);
//celda(130,$idioma['DetalleFacturacion'],"B",11,"C");
//celda(60,$idioma['Sello'],"B",11,"C");
$i=$y+35;
foreach($facturadetalle->mostrarFacturaDetalles("CodFactura=".$CodFactura) as $fd){$i+=4;
	$pdf->SetXY($x+25,$i);	
	if($f['Tipo']=="Personalizado"){
		$TextoDetalle=$fd['Nombre'];
	}else{
		$al=$alumno->mostrarDatosPersonales($fd['CodAlumno']);
		$al=array_shift($al);
		$cur=$curso->mostrarCurso($al['CodCurso']);
		$cur=array_shift($cur);
		switch($fd['CodCuota']){
			case "Todo":{
				$cuo['Numero']="Todo";	
			}break;
			case "2a10":{
				$cuo['Numero']="2a10";	
			}break;
			default:{
				$cuo=$cuota->mostrarTodoCuota($fd['CodCuota']);
				$cuo=array_shift($cuo);
			}break;
		}
		
		$NombreAlumno=$al['Paterno']." ".$al['Materno']." ".$al['Nombres'];
		$NombreCurso=$cur['Abreviado'];
		$NombreCuota=cambiopalabra($cuo['Numero'])." ".$idioma['Cuota'].($cuo['Numero']=="Todo"?" - ".$idioma['AlContado']:'');
		
		$TextoDetalle=capitalizar($NombreAlumno." - ".$NombreCurso)." - ".$NombreCuota;
	}
	celda(115,$TextoDetalle,"","9");
	celda(35,number_format($fd['Total'],2),"",10,"R");
}
$pdf->SetXY($x+20,$y+59);
celda(10,$idioma['Son'].": ","B");
celda(110,mayuscula(num2letras($f['TotalBs']))." ".$idioma['Bolivianos'],"","8");
celda(15,$idioma['TotalBs'].": ","B","8");
celda(20,number_format($f['TotalBs'],2),"",10,"R");
$pdf->SetXY($x+177,$y+59);
celda(12,$idioma['Cajero'].": ","B","8");
celda(20,$Usuario,"",8,"");
$pdf->Ln();
$pdf->SetXY($x+140,$y+63);
celda(15,$idioma['Cancelado'].": ","B","8");
celda(20,number_format($f['Cancelado'],2),"",10,"R");

$pdf->SetXY($x+20,$y+67);
celda(37,$idioma['FechaLimiteEmision'].": ","B","8");
celda(15,fecha2Str($FechaLimiteEmision),"",8,"R");
if($Credito){
	$pdf->SetXY($x+100,$y+67);
	celda(35,$TextoCredito,"","6");
}

$pdf->SetXY($x+20,$y+63);
celda(30,$idioma['CodigoControl'].": ","B","8");
celda(55,$f['CodigoControl'],"",8,"");
$pdf->SetXY($x+140,$y+67);
celda(15,$idioma['Cambio'].": ","B","8");
celda(20,number_format($f['MontoDevuelto'],2),"",10,"R");

$pdf->SetXY($x+177,$y+63);
celda(22,$idioma['NTransaccion'].": ","B","8");
celda(10,(($f['NReferencia'])),"","8");

$pdf->SetXY($x+177,$y+67);
celda(10,$idioma['Hora'].": ","B","8");
celda(15,(($f['HoraRegistro'])),"","8");


$pdf->SetXY($x+47,$y+78);
celda(10,'"'.mayuscula($LeyendaPiePagina).'"',"B","8");

$pdf->SetXY($x+130,$y+13);
celda(10,$idioma['ActividadEconomica'].": ".capitalizar($ActividadEconomica),"B","8");


$pdf->Image("../../imagenes/factura/codigos/".$CodFactura.".png",$x+25,$y+72,17,17);


$pdf->Output("Factura","I");
}
function celda($ancho,$texto,$estilo="",$tam=10,$ali=""){
	global $pdf;
	$pdf->SetFont("Tahoma",$estilo,$tam);
	$pdf->Cell($ancho,4,utf8_decode($texto),0,0,$ali);
}
?>