<?php
include_once("../../login/check.php");
include_once("../../class/alumno.php");
include_once("../../class/casilleros.php");
include_once("../../class/registronotas.php");
include_once("../../class/curso.php");
include_once("../../class/materias.php");
include_once("../../class/config.php");
if(!empty($_GET) && md5("lock")==$_GET['lock']){
	$CodCurso=$_GET['CodCurso'];
	$CodMateria=$_GET['CodMateria'];
	$CodDocente=$_GET['CodDocente'];
	$CodPeriodo=$_GET['CodPeriodo'];
	$titulo=$idioma["ReporteNotas"];
	include_once("../pdf.php");
	
	class PDF extends PPDF{
		
		function Cabecera(){
			global $cur;
			global $mat,$CodPeriodo;
			global $Etiquetas,$idioma;
			$this->CuadroCabecera(13,$idioma['Curso'].":",35,$cur['Nombre']);
			$this->CuadroCabecera(15,$idioma['Materia'].":",35,$mat['Nombre']);
			$this->CuadroCabecera(25,($cur['Bimestre']?$idioma['Bimestre']:$idioma['Trimestre']).":",10,$CodPeriodo);
			$this->Pagina();
			$this->ln();
			$this->TituloCabecera(5,"Nº");
			$this->TituloCabecera(24,$idioma['Paterno']);
			$this->TituloCabecera(24,$idioma['Materno']);
			$this->TituloCabecera(35,$idioma['Nombres']);
			if(count($Etiquetas)>0){
				foreach($Etiquetas as $et){
					$this->TituloCabecera(5,$et,9);
				}
			}
			$this->TituloCabecera(8,recortarTexto($idioma['Promedio'],3,""));
			$this->TituloCabecera(8,$idioma['Dps']);
			$this->TituloCabecera(8,sacarIniciales($idioma["NotaFinal"]));
		}
	}
	
	
	$alumnos=new alumno;
	$casilleros=new casilleros;
	$registroNotas=new registronotas;
	$curso=new curso;
	$materia=new materias;
	
	$cur=($curso->mostrarCurso($CodCurso));
	$cur=array_shift($cur);
	$mat=($materia->mostrarMateria($CodMateria));
	$mat=array_shift($mat);

	$casillas=array_shift($casilleros->mostrarDocenteMateriaCursoTrimestre($CodDocente,$CodMateria,$CodCurso,$CodPeriodo));
	$CodCasilleros=$casillas['CodCasilleros'];
	$Sexo=$casillas['SexoAlumno'];
	$numcasilleros=$casillas['Casilleros'];
	$Dps=$casillas['Dps'];
	$FormulaCalificaciones=$casillas['FormulaCalificaciones'];
	
	//$cnf=array_shift($config->mostrarConfig("NotaReprobacion"));
	$notaReprobado=$cur['NotaAprobacion'];
	
	for($i=1;$i<=$numcasilleros;$i++){
		$Etiquetas[$i]=sacarIniciales($casillas['NombreCasilla'.$i]);
	}
	$pdf=new PDF("P","mm","letter");//612,792
	$pdf->AddPage();
	$relleno=0;
	foreach($alumnos->mostrarAlumnosCurso($CodCurso,$Sexo) as $al){$na++;
		$regNota=$registroNotas->mostrarRegistroNotas($CodCasilleros,$al['CodAlumno'],$CodPeriodo);
		$regNota=array_shift($regNota);
		
		if($na%2==0)$relleno=1;else $relleno=0;
		$pdf->CuadroCuerpo(5,$na,$relleno,"R");
		$pdf->CuadroNombreSeparado(24,$al['Paterno'],24,$al['Materno'],35,$al['Nombres'],1,$relleno);
		
		for($i=1;$i<=$numcasilleros;$i++){
			$pdf->CuadroCuerpo(5,$regNota['Nota'.$i],$relleno,"C");
		}
		$pdf->CuadroCuerpo(8,$regNota['Resultado'],$relleno,"C");
		$pdf->CuadroCuerpo(8,$regNota['Dps'],$relleno,"C");
		
		if($regNota['NotaFinal']<$notaReprobado){
			$pdf->SetFillColor(179,179,179);
			$pdf->CuadroCuerpoResaltar(8,$regNota['NotaFinal'],1,"C",1);
		}else{
			$pdf->CuadroCuerpo(8,$regNota['NotaFinal'],$relleno,"C",1);
		}
		

		$pdf->Ln(5);
	}
	@$pdf->Output($titulo,"I");
}
?>