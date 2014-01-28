<?php
include_once("../../login/check.php");
include_once("../../class/alumno.php");
include_once("../../class/docentemateriacurso.php");
include_once("../../class/casilleros.php");
include_once("../../class/registronotas.php");
include_once("../../class/curso.php");
include_once("../../class/materias.php");
include_once("../../notas/fn.php");
include_once("../../class/config.php");
if(!empty($_GET) && md5("lock")==$_GET['lock']){
	$CodCurso=$_GET['CodCurso'];
	$CodMateria=$_GET['CodMateria'];
	$CodDocente=$_GET['CodDocente'];
	$titulo=$idioma["NotasPromedioAnual"];
	include_once("../pdf.php");
	
	class PDF extends PPDF{
		
		function Cabecera(){
			global $curso,$idioma,$mat;
			$Periodo=$curso['Bimestre']?$idioma['Bimestre']:$idioma['Trimestre'];
			$Periodo=recortarTexto($Periodo,4,"");
			$this->CuadroCabecera(13,$idioma['Curso'].":",35,$curso['Nombre']);
			$this->CuadroCabecera(15,$idioma['Materia'].":",35,$mat['Nombre']);
			$this->Pagina();
			$this->ln();
			$this->TituloCabecera(5,"N");
			
			$this->TituloCabecera(24,$idioma["Paterno"]);
			$this->TituloCabecera(24,$idioma["Materno"]);
			$this->TituloCabecera(35,$idioma["Nombres"]);
			for($i=1;$i<=$curso['CantidadEtapas'];$i++){
			$this->TituloCabecera(15,$i." ".$Periodo);	
			}
			$this->TituloCabecera(20,$idioma["Promedio"]);
		}
	}

	$alumnos=new alumno;
	$docentemateriacurso=new docentemateriacurso;
	$registroNotas=new registronotas;
	$fn=new funciones;
	$cur=new curso;
	$materia=new materias;
	$casilleros=new casilleros;

	$curso=array_shift($cur->mostrarCurso($CodCurso));
	$mat=array_shift($materia->mostrarMateria($CodMateria));
	$docmateriacurso=array_shift($docentemateriacurso->mostrarDocenteMateriaCurso($CodDocente,$CodMateria,$CodCurso));

	$Sexo=$docmateriacurso['SexoAlumno'];
	$cnf=($config->mostrarConfig("NotaReprobacion"));
	$notaReprobado=$cnf['Valor'];

	$pdf=new PDF("P","mm","letter");//612,792
	$pdf->AddPage();
	$relleno=0;

	foreach($alumnos->mostrarAlumnosCurso($CodCurso,$Sexo) as $al){
		$regNotaFinal=0;
		for($i=1;$i<=$curso['CantidadEtapas'];$i++){
			$cas=array_shift($casilleros->mostrarMateriaCursoSexoTrimestre($CodMateria,$CodCurso,$Sexo,$i));
			$CodCasilleros=$cas['CodCasilleros'];
			${"regNota".$i}=array_shift($registroNotas->mostrarRegistroNotas($CodCasilleros,$al['CodAlumno'],$i));
			$regNotaFinal+=${"regNota".$i}['NotaFinal'];
		}
		$regNotaFinal=round($regNotaFinal/$curso['CantidadEtapas']);

		$na++;
		if($na%2==0)
			$relleno=1;
		else
			$relleno=0;
		$pdf->CuadroCuerpo(5,$na,$relleno,"C");
		$pdf->CuadroNombreSeparado(24,$al['Paterno'],24,$al['Materno'],35,$al['Nombres'],1,$relleno);
		
		for($i=1;$i<=$curso['CantidadEtapas'];$i++){
			$pdf->CuadroCuerpo(15,${"regNota".$i}['NotaFinal'],$relleno,"C");
		}
		//$pdf->CuadroCuerpo(15,${"regNota".$i}['NotaFinal'],$relleno,"C");
		//$pdf->CuadroCuerpo(15,$regNota2['NotaFinal'],$relleno,"C");
		//$pdf->CuadroCuerpo(15,$regNota3['NotaFinal'],$relleno,"C");

		
		if($regNotaFinal<$curso['NotaAprobacion']){
			$pdf->SetFillColor(179,179,179);
			$pdf->CuadroCuerpoResaltar(20,$regNotaFinal,1,"C",1);
		}else{
			$pdf->CuadroCuerpo(20,$regNotaFinal,$relleno,"C",1);
		}
		

		$pdf->Ln(5);
	}
	@$pdf->Output($titulo,"I");
}
?>