<?php
include_once '../../login/check.php';
include_once("../pdf.php");
include_once("../../class/alumno.php");
include_once("../../class/curso.php");
$titulo=$idioma['NominaAlumnos'];
$cur=new curso;
$alumno=new alumno;
$CodCurso=$_GET['CodCurso'];
$Sexo=$_GET['Sexo'];
class PDF extends PPDF
{
	function Cabecera(){
		global $curso,$idioma;
		$this->CuadroCabecera(15,$idioma["Curso"].":",30,$curso['Nombre']);
		$this->Pagina();
		$this->ln();
		$this->TituloCabecera(10,"Nº");
		$this->TituloCabecera(30,$idioma["Paterno"]);
		$this->TituloCabecera(30,$idioma["Materno"]);
		$this->TituloCabecera(50,$idioma["Nombres"]);
		$this->TituloCabecera(55,$idioma["Telefono"]);
	}	
}
$curso=array_shift($cur->mostrarCurso($CodCurso));

$pdf=new PDF("P","mm","letter");//612,792
$pdf->AddPage();
$i=0;
foreach($alumno->mostrarAlumnosCurso($CodCurso,$Sexo) as $al)
{	
	$i++;
	if($i%2==0){$relleno=1;}else{$relleno=0;}
	$pdf->CuadroCuerpo(10,$i,$relleno,"R");
	$pdf->CuadroCuerpo(30,mb_strtoupper($al['Paterno'],"utf8"),$relleno);
	$pdf->CuadroCuerpo(30,mb_strtoupper($al['Materno'],"utf8"),$relleno);
	$pdf->CuadroCuerpo(50,mb_strtoupper($al['Nombres'],"utf8"),$relleno);
	$pdf->CuadroCuerpo(60,$al['TelefonoCasa'],$relleno);
	$pdf->ln();
}
$pdf->Output();
?>