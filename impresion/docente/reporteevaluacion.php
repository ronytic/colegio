<?php
include_once("../../login/check.php");
if(empty($_GET['CodDocente'])){exit();}
$CodDocente=$_GET['CodDocente'];
include_once '../../class/evaluaciondocpreguntas.php';
include_once '../../class/evaluaciondocrespuestas.php';
include_once '../../class/evaluaciondocopciones.php';
include_once '../../class/docentemateriacurso.php';
include_once '../../class/materias.php';
include_once '../../class/docente.php';
include_once '../../class/curso.php';
$evaluaciondocrespuestas=new evaluaciondocrespuestas;
$evaluaciondocpreguntas=new evaluaciondocpreguntas;
$evaluaciondocopciones=new evaluaciondocopciones;
$docentemateriacurso=new docentemateriacurso;
$materias=new materias;
$docente=new docente;
$curso=new curso;
$doc=$docente->mostrarTodoDatosDocente($CodDocente);
$doc=array_shift($doc);

include_once("../pdf.php");
$titulo=$idioma["NResultadosEvaluacionDocente"];
class PDF extends PPDF{
	function Cabecera(){
		global $idioma,$doc;
		$this->CuadroCabecera(30,$idioma["Docente"].":",60,capitalizar($doc['Paterno']." ".$doc['Materno']." ".$doc['Nombres']));
		$this->Pagina();
	}
}
$pdf=new PDF("P","mm","letter");
$pdf->AddPage();
foreach($docentemateriacurso->mostrarDocenteGrupo($CodDocente,"CodCurso") as $dmc){
	$cur=$curso->mostrarCurso($dmc['CodCurso']);
	$cur=array_shift($cur);
	$mat=$materias->mostrarMateria($dmc['CodMateria']);
	$mat=array_shift($mat);
	$pdf->CuadroCuerpoResaltar(180,$cur['Nombre']." - ".$mat['Nombre'],1,"L",0,3);
	$pdf->Ln();
	//$pdf->Output();
    foreach($evaluaciondocpreguntas->mostrarTodoRegistro() as $edp){$cant=0;$valorrespuesta=array();
		$pdf->CuadroCuerpo(150,$edp['Pregunta']);
		$pdf->ln();
			foreach($evaluaciondocopciones->mostrarTodoRegistro("CodEvaluacionDocPreguntas=".$edp['CodEvaluacionDocPreguntas']) as $edo) {
				$edr=$evaluaciondocrespuestas->mostrarTodoRegistro("CodDocente=$CodDocente and CodCurso=".$dmc['CodCurso']." and CodCampo=".$edp['CodEvaluacionDocPreguntas']." and Valor=".$edo['CodEvaluacionDocOpciones']);
				$canti=count($edr);
				$valorrespuesta[$edo['Opcion']]=$canti;
				$cant+=$canti;
				$max=max($valorrespuesta);
			}
			foreach($valorrespuesta as $vrk=>$vrv){
				if($max==$vrv){
					$pdf->CuadroCuerpoResaltar(20,$vrk,1,"C",0,3);
				}else{
					$pdf->CuadroCuerpo(20,$vrk,0,"C",0);
				}
			}
			$pdf->CuadroCuerpo(15,$idioma['Total'],0,"C",1);
			$pdf->Ln();
			foreach($valorrespuesta as $vrk=>$vrv){
				if($max==$vrv){
					$pdf->CuadroCuerpoResaltar(20,$vrv,1,"C",0,3);
				}else{
					$pdf->CuadroCuerpo(20,$vrv,0,"C",0);
				}
			}
			$pdf->CuadroCuerpo(15,$cant,0,"C",1);
			$pdf->Ln();
		}
		$pdf->Linea();
        $pdf->CuadroCuerpoResaltar(150,$idioma['Observaciones'],0,"",0,3);
		$pdf->Ln();
		foreach($evaluaciondocrespuestas->mostrarTodoRegistro("CodDocente=$CodDocente and CodCurso=".$dmc['CodCurso']." and CodCampo='Observaciones'") as $edr){
			if(!empty($edr['Valor'])){
				$pdf->CuadroCuerpoMulti(150,"- ".$edr['Valor']);
				$pdf->Ln();
			}
            
        }
        $pdf->Linea();
		$pdf->CuadroCuerpoResaltar(150,$idioma['Sugerencias'],0,"",0,3);
		$pdf->Ln();
		foreach($evaluaciondocrespuestas->mostrarTodoRegistro("CodDocente=$CodDocente and CodCurso=".$dmc['CodCurso']." and CodCampo='Sugerencias'") as $edr){
			if(!empty($edr['Valor'])){
				$pdf->CuadroCuerpoMulti(150,"- ".$edr['Valor']);
				$pdf->Ln();
			}
        }
}
$pdf->Output($titulo." ".capitalizar($doc['Paterno']." ".$doc['Materno']." ".$doc['Nombres']),"I");
?>