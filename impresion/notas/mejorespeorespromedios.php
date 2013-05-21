<?php
session_start();
include_once("../../login/check.php");
include_once("../../class/alumno.php");
include_once("../../class/casilleros.php");
include_once("../../class/docentemateriacurso.php");
include_once("../../class/registronotas.php");
include_once("../../class/curso.php");
include_once("../../class/materias.php");
if(!empty($_GET) && md5("lock")==$_GET['lock']){
	$Cantidad=$_GET['Cantidad'];
	$Periodo=$_GET['Periodo'];
	$Orden=$_GET['Orden'];
	$titulo=$idioma["ReportePromedioUnidad"];
	include_once("../pdf.php");
	class PDF extends PPDF{
		function Cabecera(){
			global $Periodo,$idioma;
			$this->CuadroCabecera(20,$idioma["Periodo"].":",30,$Periodo);
			$this->Pagina();
			$this->ln();
			$this->TituloCabecera(8,"Nº");
			$this->TituloCabecera(25,$idioma["Paterno"]);
			$this->TituloCabecera(25,$idioma["Materno"]);
			$this->TituloCabecera(35,$idioma["Nombres"]);
			$this->TituloCabecera(30,$idioma["Promedio"]);
		}
	}
	$alumnos=new alumno;
	$docenteMateriaCurso=new docentemateriacurso;
	$casilleros=new casilleros;
	$registroNotas=new registronotas;
	$cur=new curso;
	$materia=new materias;
	
	$pdf=new PDF("P","mm","letter");//612,792
	$pdf->AddPage();
	$pdf->SetFont("Arial","",9);
	$relleno=0;
	
	$Orden=$Orden=="1"?$Orden="DESC":$Orden="ASC";
	
	foreach($cur->mostrar() as $curso){//cambiar para los diferentes Cursos
	$na=0;
		$pdf->CuadroCuerpoPersonalizado(30,$curso['Nombre'],0,"L",0,"UB");
		$pdf->Ln(5);
		$codigosmateria=array();
		foreach($docenteMateriaCurso->mostrarCurso($curso['CodCurso']) as $docMateriaCurso){
			foreach($casilleros->mostrarTrimestre($docMateriaCurso['CodDocenteMateriaCurso'],$Periodo) as $casillas){
				array_push($codigosmateria,$casillas['CodCasilleros']);
			}
		}
		$codmateria=implode(",",$codigosmateria);
		$Sexo=$docMat['SexoAlumno'];
			foreach($registroNotas->mostrarPromedioCurso($codmateria,$Orden,$Cantidad) as $regNota){
			
			$al=array_shift($alumnos->mostrarDatosPersonales($regNota['CodAlumno']));
			if(count($al)!=0){
				$na++;
				if($na%2==1)
					$relleno=1;
				else
					$relleno=0;
					$pdf->CuadroCuerpo(8,$na,$relleno,"R");
					$pdf->CuadroNombreSeparado(25,$al['Paterno'],25,$al['Materno'],35,$al['Nombres'],1,$relleno);
					$pdf->CuadroCuerpo(30,number_format(round($regNota['Promedio'],2),2),$relleno,"C");
					$pdf->Ln(5);
			}
		}
	}
	@$pdf->Output();
}
?>