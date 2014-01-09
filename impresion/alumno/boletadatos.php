<?php
include_once("../../login/check.php");
if(!empty($_GET)){
	$CodAlumno=$_GET['CodAlumno'];
	
	include_once("../pdf.php");
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
	
	$Logo=$config->mostrarConfig("Logo",1);
	$Titulo=$config->mostrarConfig("Titulo",1);
	$UrlInternet=$config->mostrarConfig("UrlInternet",1);
	$UrlInternet=str_replace(array("http://","https://"),"",$UrlInternet);
	$Lema=$config->mostrarConfig("Lema",1);
	$titulo=$idioma["DatosAlumno"];
	function escribir($w=210,$h=10,$t="",$s=12,$tipo="",$align="",$u=1){
		global $pdf;	
		$pdf->SetFont("Arial",$tipo,$s);
		if($u)
			$pdf->Cell($w,$h,ucfirst(utf8_decode($t)),0,0,$align);
		else
			$pdf->Cell($w,$h,utf8_decode($t),0,0,$align);
	}
	class PDF extends PPDF{
	
	}
$pdf=new PDF("P","mm",array(216, 140));
$pdf->AddPage();
$pdf->SetAutoPageBreak(true,0);

//$pdf->Cell(196,80,"",1);

$pdf->CuadroCuerpoPersonalizado(100,$idioma["DatosPersonales"],1,"",0,"B");
$pdf->CuadroCuerpoPersonalizado(80,$idioma["NumerosContacto"],1,"",0,"B");
$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(40,$idioma["Paterno"].": ",0,"L",$borde,"B");
$pdf->CuadroCuerpo(60,capitalizar($al['Paterno']));

$pdf->CuadroCuerpoPersonalizado(50,$idioma["TelefonoCasa"].": ",0,"L",$borde,"B");
$pdf->CuadroCuerpo(60,capitalizar($al['TelefonoCasa']),0,"",$borde);

$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(40,$idioma["Materno"].": ",0,"L",$borde,"B");
$pdf->CuadroCuerpo(60,capitalizar($al['Materno']));

$pdf->CuadroCuerpoPersonalizado(50,$idioma["CelularPadre"].": ",0,"L",$borde,"B");
$pdf->CuadroCuerpo(60,capitalizar($al['CelularP']),0,"",$borde);

$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(40,$idioma["Nombre"].": ",0,"L",$borde,"B");
$pdf->CuadroCuerpo(60,capitalizar($al['Nombres']));

$pdf->CuadroCuerpoPersonalizado(50,$idioma["CelularMadre"].": ",0,"L",$borde,"B");
$pdf->CuadroCuerpo(60,capitalizar($al['CelularM']),0,"",$borde);

$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(40,$idioma["Sexo"].": ",0,"L",$borde,"B");
$pdf->CuadroCuerpo(60,$al['Sexo']?$idioma['Masculino']:$idioma['Femenino'],0,"",$borde);

$pdf->CuadroCuerpoPersonalizado(50,$idioma["ActivarSMS"].": ",0,"L",$borde,"B");
$pdf->CuadroCuerpo(60,capitalizar($al['ActivarSMS']?$idioma['Activado']:$idioma['Desactivado']),0,"",$borde);

$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(40,$idioma["FechaNacimiento"].": ",0,"L",$borde,"B");
$pdf->CuadroCuerpo(60,capitalizar(fecha2Str($al['FechaNac'])),0,"",$borde);

$pdf->CuadroCuerpoPersonalizado(50,$idioma["CelularSMS"].": ",0,"L",$borde,"B");
$pdf->CuadroCuerpo(60,capitalizar($al['CelularSMS']),0,"",$borde);

$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(40,$idioma["CedulaIdentidad"].": ",0,"L",$borde,"B");
$pdf->CuadroCuerpo(60,capitalizar($al['Ci']),0,"",$borde);
$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(40,$idioma["Curso"].": ",0,"L",$borde,"B");
$pdf->CuadroCuerpo(60,$cur['Nombre']);
$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(40,$idioma["Direccion"].": ",0,"L",$borde,"B");
$pdf->CuadroCuerpo(60,capitalizar($al['Zona'].", ".$al['Calle']." Nº ".$al['Numero']),0);
$pdf->ln();
$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(100,$idioma["DatosAccessoInternet"],1,"",0,"B");
$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(60,$idioma["UsuarioPadreFamilia"].": ",0,"L",$borde,"B");
$pdf->CuadroCuerpo(40,capitalizar($al['UsuarioPadre']),0,"",$borde);
$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(60,$idioma["ContrasenaPadreFamilia"].": ",0,"L",$borde,"B");
$pdf->CuadroCuerpo(40,capitalizar($al['PasswordP']),0,"",$borde);
$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(60,$idioma["UsuarioAlumno"].": ",0,"L",$borde,"B");
$pdf->CuadroCuerpo(40,minuscula($al['UsuarioAlumno']),0,"",$borde);
$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(60,$idioma["ContrasenaAlumno"].": ",0,"L",$borde,"B");
$pdf->CuadroCuerpo(40,capitalizar($al['Password']),0,"",$borde);
$pdf->ln();

$pdf->Output("Datos del Alumno.pdf","I");
}
?>