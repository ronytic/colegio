<?php
include_once("../../login/check.php");
if(!empty($_GET)){
	$CodAlumno=$_GET['CodAlumno'];
	
	//mysql_query("UPDATE `csb2012`.`alumno` SET `CiPadre` = (SELECT CedulaPadre FROM Rude WHERE CodAlumno=$CodAlumno),Zona = (SELECT ZonaE FROM Rude WHERE CodAlumno=$CodAlumno),Calle = (SELECT AvenidaE FROM Rude WHERE CodAlumno=$CodAlumno),Numero = (SELECT NumeroE FROM Rude WHERE CodAlumno=$CodAlumno) WHERE `alumno`.`CodAlumno` = $CodAlumno LIMIT 1;");
	//
	include_once("../../class/alumno.php");
	include_once("../../class/curso.php");
	include_once("../../class/config.php");
	$config=new config;
	$alumno=new alumno;
	$curso=new curso;
	$al=$alumno->mostrarTodoDatos($CodAlumno);
	$al=array_shift($al);
	$cur=$curso->mostrarCurso($al['CodCurso']);
	$cur=array_shift($cur);
	$c=$config->mostrarConfig("Logo");
	$Logo=$c['Valor'];
	$cnf=$config->mostrarConfig("Titulo");
	$Titulo=$cnf['Valor'];
	$cnf=$config->mostrarConfig("UrlInternet");
	$UrlInternet=$cnf['Valor'];
	$UrlInternet=str_replace(array("http://","https://"),"",$UrlInternet);
	$cnf=$config->mostrarConfig("Lema");
	$Lema=$cnf['Valor'];
include_once("../fpdf/fpdf.php");
function escribir($w=210,$h=10,$t="",$s=12,$tipo="",$align="",$u=1){
	global $pdf;	
	$pdf->SetFont("Arial",$tipo,$s);
	if($u)
		$pdf->Cell($w,$h,ucfirst(utf8_decode($t)),0,0,$align);
	else
		$pdf->Cell($w,$h,utf8_decode($t),0,0,$align);
}
class PDF extends FPDF{
	function Footer(){
		global $Lema;
		$this->SetY(-10);
		$this->SetFont('Arial',"I",9);
		$this->Cell(196,4,utf8_decode($Lema),0,0,"C");	
	}	
}
$pdf=new PDF("L","mm",array(216, 140));
$pdf->AddPage();
$pdf->SetAutoPageBreak(true,0);
if(file_exists("../../imagenes/logos/".$Logo)|| empty($Logo)){
	$pdf->Image("../../imagenes/logos/".$Logo,185,15,15,15);
}
$pdf->Cell(196,120,"",1);
$pdf->SetXY(10,10);
$h=10;
escribir(190,10,$Titulo,12,"UB","C");
$pdf->Ln();
escribir(190,10,$idioma["DatosAlumno"],12,"UB","L");
$pdf->Ln();
escribir(50,$h,$idioma['NombreAlumno'].":",12,"B","");escribir(30,$h,capitalizar($al['Paterno']." ".$al['Materno']." ".$al['Nombres']),12,"","");
$pdf->ln();
escribir(50,$h,$idioma['Ci'].":",12,"B","");escribir(30,$h,$al['Ci']." ",12,"","");
$pdf->ln();
escribir(50,$h,$idioma["FechaNacimiento"].":",12,"B","");escribir(30,$h,date("d-m-Y",strtotime($al['FechaNac'])),12,"","");
$pdf->ln();
escribir(50,$h,$idioma['Curso'].":",12,"B","");escribir(30,$h,$cur['Nombre'],12,"","");
$pdf->ln();
escribir(50,$h,$idioma['Direccion'].":",12,"B","");escribir(30,$h,$al['Zona'].", ".$al['Calle']." Nº ".$al['Numero'],12,"","");
$pdf->ln();
$pdf->cell(196,0,"",1);
$pdf->ln();
escribir(100,10,$idioma["DatosAccesoParaSistema"],12,"UB","L");escribir(40,$h,$idioma['PaginaColegio'].": ".$UrlInternet,10,"","",0);
$pdf->ln();
escribir(80,$h,$idioma["UsuarioPadreFamilia"].":",12,"B","");escribir(30,$h,$al['UsuarioPadre'],12,"","");
$pdf->ln();
escribir(80,$h,$idioma["ContrasenaPadreFamilia"].":",12,"B","");escribir(30,$h,$al['PasswordP'],12,"","");

$pdf->ln();
escribir(80,$h,$idioma["UsuarioAlumno"].":",12,"B","");escribir(30,$h,$al['UsuarioAlumno'],12,"","",0);
$pdf->ln();
escribir(80,$h,$idioma["ContrasenaAlumno"].":",12,"B","");escribir(30,$h,$al['Password'],12,"","");
//$pdf->Image("../../code/barcode.php?code=123",100,100);
$pdf->Output("Datos del Alumno.pdf","I");
}
?>