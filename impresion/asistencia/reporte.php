<?php
include_once("../../login/check.php");
if(!empty($_GET)){
	include_once("../pdf.php");	
	$titulo=$idioma["NReporteAsistencias"];
	class PDF extends PPDF{
		function Cabecera(){
			global $idioma;
			$this->TituloCabecera(10,"N");
			$this->TituloCabecera(65,$idioma['Nombres']);
			$this->TituloCabecera(30,$idioma['Curso']);
			$this->TituloCabecera(20,$idioma['Fecha']);
			$this->TituloCabecera(15,$idioma['Hora']);
			$this->TituloCabecera(40,$idioma['TipoObservacion']);
		}	
	}
	include_once("../../class/asistencia.php");
	include_once("../../class/alumno.php");
	include_once("../../class/curso.php");
	$alumno=new alumno;
	$asistencia=new asistencia;
	$curso=new curso;
	extract($_GET);
	$FechaInicio=fecha2Str($FechaInicio,0);
	$FechaFin=fecha2Str($FechaFin,0);
	$where="";
	if($CodCurso!="Todo"){
		$where.=" CodCurso=$CodCurso";
		if($CodAlumno!=""){
			$where.=" and CodAlumno=$CodAlumno";
		}
	}
	//echo $where;
	$Cod=array();
	foreach($alumno->mostrarDatosAlumnosCursoWhere($where) as $al){
		array_push($Cod,$al['CodAlumno']);
	}
	$Cod=implode(",",$Cod);
	//echo $Cod;
	$where="CodAlumno IN($Cod)";
	if($TipoObservacion!="Todos"){
		$where.=" and Tipo='$TipoObservacion'";
	}
	$where.=" and (Fecha BETWEEN  '$FechaInicio' AND  '$FechaFin')";
	//echo $where;
	$asis=$asistencia->mostrarAsistenciaWhere($where);
	
	$pdf=new PDF("P","mm","letter");
	$pdf->AddPage();
	foreach($asis as $a){$i++;
		$al=$alumno->mostrarTodoDatos($a['CodAlumno']);
		$al=array_shift($al);
		//print_r($al);
		$cur=$curso->mostrarCurso($al['CodCurso']);
		$cur=array_shift($cur);
		switch($a['Tipo']){
			case 'C':{$t=$idioma["Asistencia"];}break;
			case 'F':{$t=$idioma["Falta"];}break;
			case 'A':{$t=$idioma["Atraso"];}break;	
		}
		
		if($i%2==0){$relleno=1;}else{$relleno=0;}
		
		$pdf->CuadroCuerpo(10,$i,$relleno,"R");
		$pdf->CuadroCuerpo(65,capitalizar($al['Paterno']." ".$al['Materno']." ".$al['Nombres']),$relleno);
		$pdf->CuadroCuerpo(30,$cur['Nombre'],$relleno);
		$pdf->CuadroCuerpo(20,fecha2Str($a['Fecha']),$relleno,"C",0);
		$pdf->CuadroCuerpo(15,hora2Str($a['Hora']),$relleno,"C",0);
		$pdf->CuadroCuerpo(40,$t,$relleno);
		$pdf->Ln();
	}
	$pdf->Output();
}
?>