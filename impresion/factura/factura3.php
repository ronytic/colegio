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
$NumeroAutorizacion=$config->mostrarConfig("NumeroAutorizacion",1);
$LlaveDosificacion=$config->mostrarConfig("LlaveDosificacion",1);
$FechaLimiteEmision=$config->mostrarConfig("FechaLimiteEmision",1);
$CodFactura=$_GET['f'];
$f=$factura->mostrarFactura($CodFactura);
$f=array_shift($f);

switch($f['Nivel']){
	case "1":{$Usuario=$idioma["Administrador"];}break;	
	case "2":{$Usuario=$idioma["Direccion"];}break;	
}
include_once("../fpdf/fpdf.php");

$pdf=new FPDF("P","mm","legal");
$pdf->SetFont("arial","",10);
$pdf->AddPage();
/*Primera Parte*/
$y=15;
$pdf->Image("../../imagenes/logos/".$Logo,15,$y-5,20,20);
$pdf->SetXY(15,$y);
$pdf->Cell(110,5,utf8_decode($Titulo),0,0,"C");
/*Borde*/
$pdf->SetXY(125,$y-5);
$pdf->Cell(80,20,"",1);
$pdf->SetXY(15,$y+18);
$pdf->Cell(190,8,"",1);
$pdf->SetXY(15,$y+28);
$pdf->Cell(130,40,"",1);
$pdf->SetXY(145,$y+28);
$pdf->Cell(60,40,"",1);
$pdf->SetXY(15,$y+69);
$pdf->Cell(190,15,"",1);

$pdf->SetXY(130,$y);
celda(30,$idioma['NAutorizacion'].": ","B");
celda(40,$NumeroAutorizacion,"");
$pdf->Ln();
$pdf->SetXY(130,$y+5);
celda(30,$idioma['Factura'].": ","B");
celda(40,$f['NFactura'],"");

$pdf->SetXY(15,$y+20);
celda(30,$idioma['ANombre'].": ","B");
celda(60,mb_strtoupper($f['Factura']),"");
celda(10,$idioma['Nit'].": ","B");
celda(30,mb_strtoupper($f['Nit']),"");
celda(15,$idioma['Fecha'].": ","B");
celda(20,mb_strtoupper(fecha2Str($f['FechaFactura'])),"");
celda(10,$idioma['Hora'].": ","B","8");
celda(15,(($f['HoraRegistro'])),"","8");

$pdf->SetXY(15,$y+30);
celda(130,$idioma['DetalleFacturacion'],"B",11,"C");
celda(60,$idioma['Sello'],"B",11,"C");
$i=$y+35;
foreach($facturadetalle->mostrarFacturaDetalles("CodFactura=".$CodFactura) as $fd){$i+=4;
	$al=$alumno->mostrarDatosPersonales($fd['CodAlumno']);
	$al=array_shift($al);
	$cur=$curso->mostrarCurso($al['CodCurso']);
	$cur=array_shift($cur);
	$cuo=$cuota->mostrarTodoCuota($fd['CodCuota']);
	$cuo=array_shift($cuo);
	$pdf->SetXY(15,$i);	
	celda(100,Capitalizar($al['Paterno']." ".$al['Materno']." ".$al['Nombres']." - ".$cur['Abreviado']." - ".$cuo['Numero']." ".$idioma['Cuota']),"","9");
	celda(30,number_format($fd['Total'],2),"",10,"R");
}
$pdf->SetXY(15,$y+70);
celda(10,$idioma['Son'].": ","B");
celda(80,mayuscula(num2letras($f['TotalBs'])),"","8");
celda(20,$idioma['TotalBs'].": ","B","8");
celda(20,number_format($f['TotalBs'],2),"",10,"R");

celda(35,$idioma['FechaLimiteEmision'].": ","B","8");
celda(20,fecha2Str($FechaLimiteEmision),"",8,"R");
$pdf->SetXY(105,$y+74);
celda(20,$idioma['Cancelado'].": ","B","8");
celda(20,number_format($f['Cancelado'],2),"",10,"R");

celda(12,$idioma['Cajero'].": ","B","8");
celda(25,$Usuario,"",8,"R");
$pdf->SetXY(15,$y+78);
celda(30,$idioma['CodigoControl'].": ","B","8");
celda(60,$f['CodigoControl'],"",8,"");
celda(20,$idioma['Cambio'].": ","B","8");
celda(20,number_format($f['MontoDevuelto'],2),"",10,"R");

/*Segunda Parte*/
$y=115;
$pdf->Image("../../imagenes/logos/".$Logo,15,$y-5,20,20);
$pdf->SetXY(15,$y);
$pdf->Cell(110,5,utf8_decode($Titulo),0,0,"C");
/*Borde*/
$pdf->SetXY(125,$y-5);
$pdf->Cell(80,20,"",1);
$pdf->SetXY(15,$y+18);
$pdf->Cell(190,8,"",1);
$pdf->SetXY(15,$y+28);
$pdf->Cell(130,40,"",1);
$pdf->SetXY(145,$y+28);
$pdf->Cell(60,40,"",1);
$pdf->SetXY(15,$y+69);
$pdf->Cell(190,15,"",1);

$pdf->SetXY(130,$y);
celda(30,$idioma['NAutorizacion'].": ","B");
celda(40,$NumeroAutorizacion,"");
$pdf->Ln();
$pdf->SetXY(130,$y+5);
celda(30,$idioma['Factura'].": ","B");
celda(40,$f['NFactura'],"");

$pdf->SetXY(15,$y+20);
celda(30,$idioma['ANombre'].": ","B");
celda(60,mb_strtoupper($f['Factura']),"");
celda(10,$idioma['Nit'].": ","B");
celda(30,mb_strtoupper($f['Nit']),"");
celda(15,$idioma['Fecha'].": ","B");
celda(20,mb_strtoupper(fecha2Str($f['FechaFactura'])),"");
celda(10,$idioma['Hora'].": ","B","8");
celda(15,(($f['HoraRegistro'])),"","8");

$pdf->SetXY(15,$y+30);
celda(130,$idioma['DetalleFacturacion'],"B",11,"C");
celda(60,$idioma['Sello'],"B",11,"C");
$i=$y+35;
foreach($facturadetalle->mostrarFacturaDetalles("CodFactura=".$CodFactura) as $fd){$i+=4;
	$al=$alumno->mostrarDatosPersonales($fd['CodAlumno']);
	$al=array_shift($al);
	$cur=$curso->mostrarCurso($al['CodCurso']);
	$cur=array_shift($cur);
	$cuo=$cuota->mostrarTodoCuota($fd['CodCuota']);
	$cuo=array_shift($cuo);
	$pdf->SetXY(15,$i);	
	celda(100,Capitalizar($al['Paterno']." ".$al['Materno']." ".$al['Nombres']." - ".$cur['Abreviado']." - ".$cuo['Numero']." ".$idioma['Cuota']),"","9");
	celda(30,number_format($fd['Total'],2),"",10,"R");
}
$pdf->SetXY(15,$y+70);
celda(10,$idioma['Son'].": ","B");
celda(80,mayuscula(num2letras($f['TotalBs'])),"","8");
celda(20,$idioma['TotalBs'].": ","B","8");
celda(20,number_format($f['TotalBs'],2),"",10,"R");

celda(35,$idioma['FechaLimiteEmision'].": ","B","8");
celda(20,fecha2Str($FechaLimiteEmision),"",8,"R");
$pdf->SetXY(105,$y+74);
celda(20,$idioma['Cancelado'].": ","B","8");
celda(20,number_format($f['Cancelado'],2),"",10,"R");

celda(12,$idioma['Cajero'].": ","B","8");
celda(25,$Usuario,"",8,"R");
$pdf->SetXY(15,$y+78);
celda(30,$idioma['CodigoControl'].": ","B","8");
celda(60,$f['CodigoControl'],"",8,"");
celda(20,$idioma['Cambio'].": ","B","8");
celda(20,number_format($f['MontoDevuelto'],2),"",10,"R");


/*Tercera Parte*/
$y=215;
$pdf->Image("../../imagenes/logos/".$Logo,15,$y-5,20,20);
$pdf->SetXY(15,$y);
$pdf->Cell(110,5,utf8_decode($Titulo),0,0,"C");
/*Borde*/
$pdf->SetXY(125,$y-5);
$pdf->Cell(80,20,"",1);
$pdf->SetXY(15,$y+18);
$pdf->Cell(190,8,"",1);
$pdf->SetXY(15,$y+28);
$pdf->Cell(130,40,"",1);
$pdf->SetXY(145,$y+28);
$pdf->Cell(60,40,"",1);
$pdf->SetXY(15,$y+69);
$pdf->Cell(190,15,"",1);

$pdf->SetXY(130,$y);
celda(30,$idioma['NAutorizacion'].": ","B");
celda(40,$NumeroAutorizacion,"");
$pdf->Ln();
$pdf->SetXY(130,$y+5);
celda(30,$idioma['Factura'].": ","B");
celda(40,$f['NFactura'],"");

$pdf->SetXY(15,$y+20);
celda(30,$idioma['ANombre'].": ","B");
celda(60,mb_strtoupper($f['Factura']),"");
celda(10,$idioma['Nit'].": ","B");
celda(30,mb_strtoupper($f['Nit']),"");
celda(15,$idioma['Fecha'].": ","B");
celda(20,mb_strtoupper(fecha2Str($f['FechaFactura'])),"");
celda(10,$idioma['Hora'].": ","B","8");
celda(15,(($f['HoraRegistro'])),"","8");

$pdf->SetXY(15,$y+30);
celda(130,$idioma['DetalleFacturacion'],"B",11,"C");
celda(60,$idioma['Sello'],"B",11,"C");
$i=$y+35;
foreach($facturadetalle->mostrarFacturaDetalles("CodFactura=".$CodFactura) as $fd){$i+=4;
	$al=$alumno->mostrarDatosPersonales($fd['CodAlumno']);
	$al=array_shift($al);
	$cur=$curso->mostrarCurso($al['CodCurso']);
	$cur=array_shift($cur);
	$cuo=$cuota->mostrarTodoCuota($fd['CodCuota']);
	$cuo=array_shift($cuo);
	$pdf->SetXY(15,$i);	
	celda(100,Capitalizar($al['Paterno']." ".$al['Materno']." ".$al['Nombres']." - ".$cur['Abreviado']." - ".$cuo['Numero']." ".$idioma['Cuota']),"","9");
	celda(30,number_format($fd['Total'],2),"",10,"R");
}
$pdf->SetXY(15,$y+70);
celda(10,$idioma['Son'].": ","B");
celda(80,mayuscula(num2letras($f['TotalBs'])),"","8");
celda(20,$idioma['TotalBs'].": ","B","8");
celda(20,number_format($f['TotalBs'],2),"",10,"R");

celda(35,$idioma['FechaLimiteEmision'].": ","B","8");
celda(20,fecha2Str($FechaLimiteEmision),"",8,"R");
$pdf->SetXY(105,$y+74);
celda(20,$idioma['Cancelado'].": ","B","8");
celda(20,number_format($f['Cancelado'],2),"",10,"R");

celda(12,$idioma['Cajero'].": ","B","8");
celda(25,$Usuario,"",8,"R");
$pdf->SetXY(15,$y+78);
celda(30,$idioma['CodigoControl'].": ","B","8");
celda(60,$f['CodigoControl'],"",8,"");
celda(20,$idioma['Cambio'].": ","B","8");
celda(20,number_format($f['MontoDevuelto'],2),"",10,"R");

$pdf->Output();
}
function celda($ancho,$texto,$estilo="",$tam=10,$ali=""){
	global $pdf;
	$pdf->SetFont("arial",$estilo,$tam);
	$pdf->Cell($ancho,4,utf8_decode($texto),0,0,$ali);
}
?>