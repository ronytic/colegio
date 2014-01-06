<?php
include_once("../../login/check.php");
$CodPeriodo=$_SESSION['CodPeriodo'];
$CodCasilleros=$_SESSION['CodCasilleros'];
$f=$_GET['f'];
include_once("../../class/config.php");
include_once("../../class/alumno.php");
include_once("../../class/casilleros.php");
include_once("../../class/docentemateriacurso.php");
include_once("../../class/registronotas.php");
include_once("../../class/curso.php");
include_once("../../class/docente.php");
include_once("../../class/materias.php");
$alumnos=new alumno;
$docentemateriacurso=new docentemateriacurso;
$casilleros=new casilleros;
$registroNotas=new registronotas;
$config=new config;
$curso=new curso;
$materias=new materias;
$docente=new docente;


$casillas=$casilleros->mostrar($CodCasilleros);
$casillas=array_shift($casillas);
$CodDocenteMateriaCurso=$casillas['CodDocenteMateriaCurso'];

$docmatcur=$docentemateriacurso->mostrarCodDocenteMateriaCurso($CodDocenteMateriaCurso);
$docmatcur=array_shift($docmatcur);

$CodCurso=$docmatcur['CodCurso'];
$mat=$materias->mostrarMateria($docmatcur['CodMateria']);
$mat=array_shift($mat);
$cur=$curso->mostrarCurso($docmatcur['CodCurso']);
$cur=array_shift($cur);
$doc=$docente->mostrarDocente($docmatcur['CodDocente']);
$doc=array_shift($doc);

$Sexo=$docmatcur['SexoAlumno'];
$numcasilleros=$casillas['Casilleros'];
$Dps=$casillas['Dps'];
$Periodo=$casillas['Trimestre'];
$FormulaCalificaciones=$casillas['FormulaCalificaciones'];
$NotaAprobacion=$cur['NotaAprobacion'];
$CodPeriodo=$Periodo;

$Titulo=$config->mostrarConfig("Titulo",1);
$LogoInicio=$config->mostrarConfig("LogoInicio",1);
$RegistroNotaHabilitado=$config->mostrarConfig("RegistroNotaHabilitado",1);
$PeriodoNotaHabilitado=$config->mostrarConfig("PeriodoNotaHabilitado",1);
$PeriodoNotaHabilitadoBimestre=$config->mostrarConfig("PeriodoNotaHabilitadoBimestre",1);

$RangoNotaDps1=$config->mostrarConfig("RangoNotaDps1",1);
$RangoNotaDps2=$config->mostrarConfig("RangoNotaDps2",1);
$RangoNotaDps3=$config->mostrarConfig("RangoNotaDps3",1);
$RangoNotaDps4=$config->mostrarConfig("RangoNotaDps4",1);
$RangoNotaDps5=$config->mostrarConfig("RangoNotaDps5",1);
$RangoNotaDps6=$config->mostrarConfig("RangoNotaDps6",1);


if($RegistroNotaHabilitado==1){
	if($cur['Bimestre']){
		if($CodPeriodo!=$PeriodoNotaHabilitadoBimestre){
			$restringir=1;
		}else{
			$restringir=0;
		}	
	}else{
		if($CodPeriodo!=$PeriodoNotaHabilitado){
			$restringir=1;
		}else{
			$restringir=0;
		}
	}
	
}else{
	$restringir=1;	
}
$a=$alumnos->mostrarAlumnosCurso($CodCurso,$Sexo);

/*
echo "<pre>";
print_r($casillas);
print_r($docmatcur);
echo "</pre>";*/
set_time_limit(0);
ini_set('memory_limit', '-1');
$formula=$FormulaCalificaciones;
$dps=$Dps;
$n1dps=$RangoNotaDps1;
$n2dps=$RangoNotaDps2;
$n3dps=$RangoNotaDps3;
$n4dps=$RangoNotaDps4;
$n5dps=$RangoNotaDps5;
$n6dps=$RangoNotaDps6;
$archivologo=$LogoInicio;
$cantidadalumnos=count($a);
$cantidadcasilleros=$numcasilleros;
$notaaprobacion=$NotaAprobacion;
$contrasenaexcel=sha1("PHPSAACRONY");
$codigodocente=$docmatcur['CodDocente'];
$codigocurso=$docmatcur['CodCurso'];
$codigomateria=$docmatcur['CodMateria'];
$codigocasilleros=$CodCasilleros;
$codigodocentemateriacurso=$CodDocenteMateriaCurso;
$materiaabreviado=$mat['Abreviado'];
$cursoabreviado=$cur['Abreviado'];
$periodoabreaviado=$Periodo;
$NombreDocente=$doc['Paterno']." ".$doc['Materno']." ".$doc['Nombres'];
$NombreCurso=$cur['Nombre'];
$NombreMateria=$mat['Nombre'];

$tipoarchivo=$f;
$nombrearchivo="SAAC_".quitarSimbolos($materiaabreviado)."_".quitarSimbolos($cursoabreviado)."_".quitarSimbolos($periodoabreaviado)."_".$tipoarchivo;
/** Mostrar Errores */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('America/La_Paz');

/** Incluir PHPExcel */
require_once 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/Worksheet/Drawing.php';
require_once 'funciones/funciones.php';
$nfx=adicionar("A",$cantidadcasilleros+4+2);
$doc=new PHPExcel();
$locale = 'es';
$validLocale = PHPExcel_Settings::setLocale($locale);
//Propiedades del Documento
$doc->getProperties()->setCreator("Desarrollado por Ronald Franz Nina Layme - Cel:73230568")
					 ->setLastModifiedBy("Desarrollado por Ronald Franz Nina Layme - Cel:73230568")
					 ->setTitle("Registro de Notas - Sistema Académico Administrativo para Colegios Desarrollado por Ronald Franz Nina Layme - Cel:73230568")
					 ->setSubject("Sistema Académico Administrativo para Colegios")
					 ->setDescription("Sistema Académico Administrativo para Colegios, Registro de Notas")
					 ->setKeywords("Sistema Académico Administrativo para Colegios")
					 ->setCategory("Sistema Académico Administrativo para Colegios");
$doc->getActiveSheet()->getPageSetup()->setOrientation('landscape');
$doc->getActiveSheet()->getPageSetup()->setPaperSize(1);
$doc->getActiveSheet()->getPageMargins()->setRight(0.39);
$doc->getActiveSheet()->getPageMargins()->setLeft(0.39);
$doc->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
//Insertar Logo
$oLogo=new PHPExcel_Worksheet_Drawing();
$oLogo->setName('Logo');
$oLogo->setDescription('Logo');
$oLogo->setPath("../../imagenes/logos/".$archivologo);
$oLogo->setHeight(80);
$oLogo->setCoordinates('B1');
$oLogo->setWorksheet($doc->getActiveSheet());


$doc->getActiveSheet()->getRowDimension('1')->setRowHeight(60);
$doc->getActiveSheet()->getColumnDimension('A')->setWidth(an(3.57));//N
$doc->getActiveSheet()->getColumnDimension('B')->setWidth(an(10.71));//Paterno
$doc->getActiveSheet()->getColumnDimension('C')->setWidth(an(10.71));//Materno
$doc->getActiveSheet()->getColumnDimension('D')->setWidth(an(20));//Nombres

//Titulo
$doc->getActiveSheet()->setCellValue('C1', $Titulo)
					->getStyle('C1')->applyFromArray(estilo(19,"000000","B","FFFFFF","left","center",''));

//Fecha
$doc->getActiveSheet()->mergeCells('E2:F2')
					->setCellValue('E2', mayuscula($idioma['Fecha']))
					->getStyle('E2:F2')->applyFromArray(estilo(11,"5b9bd5","B","FFFFFF","right","center",'thin','000000'));
$doc->getActiveSheet()->mergeCells('G2:K2')
					->setCellValue('G2', '=NOW()')
					->getStyle('G2:K2')->applyFromArray(estilo(11,"808080","B","FFFFFF","right","center",'thin','000000'));	
$doc->getActiveSheet()->getStyle('G2')->getNumberFormat()->setFormatCode('dd/mm/yyyy hh:mm');

//Periodo
$doc->getActiveSheet()->mergeCells('A2:B2')
					->setCellValue('A2', mayuscula($idioma['Periodo']))
					->getStyle('A2:B2')->applyFromArray(estilo(11,"5b9bd5","B","FFFFFF","right","center",'thin','000000'));
$doc->getActiveSheet()->mergeCells('C2:D2')
					->setCellValue('C2', $periodoabreaviado)
					->getStyle('C2:D2')->applyFromArray(estilo(11,"808080","B","FFFFFF","right","center",'thin','000000'));	

//Docente
$doc->getActiveSheet()->mergeCells('A3:B3')
					->setCellValue('A3', mayuscula($idioma['Docente']))
					->getStyle('A3:B3')->applyFromArray(estilo(11,"5b9bd5","B","FFFFFF","right","center",'thin','000000'));
$doc->getActiveSheet()->mergeCells('C3:D3')
					->setCellValue('C3', mayuscula($NombreDocente))
					->getStyle('C3:D3')->applyFromArray(estilo(11,"808080","B","FFFFFF","right","center",'thin','000000'));	
$doc->getActiveSheet()->setCellValue('E3', $codigodocente);
$doc->getActiveSheet()->setCellValue('F3', $codigocasilleros);
$doc->getActiveSheet()->setCellValue('G3', $codigodocentemateriacurso);
$doc->getActiveSheet()->getStyle('E3:G4')->applyFromArray(estilo(11,"FFFFFF","","FFFFFF","right","center",'none','000000'));	
//Materia
$doc->getActiveSheet()->mergeCells('A4:B4')
					->setCellValue('A4', mayuscula($idioma['Materia']))
					->getStyle('A4:B4')->applyFromArray(estilo(11,"5b9bd5","B","FFFFFF","right","center",'thin','000000'));
$doc->getActiveSheet()->mergeCells('C4:D4')
					->setCellValue('C4', mayuscula($NombreMateria))
					->getStyle('C4:D4')->applyFromArray(estilo(11,"808080","B","FFFFFF","right","center",'thin','000000'));	
$doc->getActiveSheet()->setCellValue('E4', $codigomateria)
					->getStyle('E4')->applyFromArray(estilo(11,"FFFFFF","","FFFFFF","right","center",'none','000000'));									
//Curso
$doc->getActiveSheet()->mergeCells('A5:B5')
					->setCellValue('A5', mayuscula($idioma['Curso']))
					->getStyle('A5:B5')->applyFromArray(estilo(11,"5b9bd5","B","FFFFFF","right","center",'thin','000000'));
$doc->getActiveSheet()->mergeCells('C5:D5')
					->setCellValue('C5',mayuscula($NombreCurso))
					->getStyle('C5:D5')->applyFromArray(estilo(11,"808080","B","FFFFFF","right","center",'thin','000000'));	
$doc->getActiveSheet()->setCellValue('E5', $codigocurso)
					->getStyle('E5')->applyFromArray(estilo(11,"FFFFFF","","FFFFFF","right","center",'none','000000'));	
//Todos los Alumnos
$doc->getActiveSheet()->mergeCells('A6:B6')
					->setCellValue('A6', ($idioma['TotalAlumnos']))
					->getStyle('A6:B6')->applyFromArray(estilo(11,"2f75b5","B","FFFFFF","right","center",'thin','000000'));
$doc->getActiveSheet()->mergeCells('C6:D6');
$doc->getActiveSheet()->setCellValue('C6', '=COUNT(A11:A'.($cantidadalumnos+10).')','f');
$doc->getActiveSheet()->getStyle('C6:D6')->applyFromArray(estilo(11,"2f75b5","B","FFFFFF","right","center",'thin','000000'));
$doc->getActiveSheet()->setCellValue('E6', $cantidadalumnos)
					->getStyle('E6')->applyFromArray(estilo(11,"FFFFFF","","FFFFFF","right","center",'none','000000'));		
//Aprobados
$doc->getActiveSheet()->mergeCells('A7:B7')
					->setCellValue('A7', mayuscula($idioma['Aprobados']))
					->getStyle('A7:B7')->applyFromArray(estilo(11,"70ad47","B","FFFFFF","right","center",'thin','000000'));
$doc->getActiveSheet()->mergeCells('C7:D7')
					->setCellValue('C7', '=COUNTIF('.$nfx.'11:'.$nfx.''.($cantidadalumnos+10).',">='.$notaaprobacion.'")')
					->getStyle('C7:D7')->applyFromArray(estilo(11,"70ad47","B","FFFFFF","right","center",'thin','000000'));	
$doc->getActiveSheet()->setCellValue('E7', $cantidadcasilleros)
					->getStyle('E7')->applyFromArray(estilo(11,"FFFFFF","","FFFFFF","right","center",'none','000000'));	
//Reprobados
$doc->getActiveSheet()->mergeCells('A8:B8')
					->setCellValue('A8', mayuscula($idioma['Reprobados']))
					->getStyle('A8:B8')->applyFromArray(estilo(11,"d95911","B","FFFFFF","right","center",'thin','000000'));
$doc->getActiveSheet()->mergeCells('C8:D8')
					->setCellValue('C8', '=COUNTIF('.$nfx.'11:'.$nfx.''.($cantidadalumnos+10).',"<'.$notaaprobacion.'")')
					->getStyle('C8:D8')->applyFromArray(estilo(11,"d95911","B","FFFFFF","right","center",'thin','000000'));						
$doc->getActiveSheet()->setCellValue('E8', $idioma['FirmaSelloDocente']);
$doc->getActiveSheet()->mergeCells('E8:K8')->getStyle('E8:K8')->applyFromArray(estilo(11,"000000","","FFFFFF","center","center",'none','000000'));	
//Alto de Subtitulo
$doc->getActiveSheet()->getRowDimension('9')->setRowHeight(67.50);
//Registro de Notas
$doc->getActiveSheet()->mergeCells('A9:D9')
					->setCellValue('A9', $idioma['RegistroNotas'])
					->getStyle('A9:B9')->applyFromArray(estilo(18,"000000","B","FFFFFF","center","center",'none','000000'));
					
					
//N
$doc->getActiveSheet()->setCellValue('A10', 'N')
					->getStyle('A10')->applyFromArray(estilo(11,"000000","B","FFFFFF","center","center",'thin','000000'));
//Paterno
$doc->getActiveSheet()->setCellValue('B10', mayuscula($idioma['Paterno']))
					->getStyle('B10')->applyFromArray(estilo(11,"000000","B","FFFFFF","center","center",'thin','000000'));				
//Materno
$doc->getActiveSheet()->setCellValue('C10', mayuscula($idioma['Materno']))
					->getStyle('C10')->applyFromArray(estilo(11,"000000","B","FFFFFF","center","center",'thin','000000'));
//Nombres
$doc->getActiveSheet()->setCellValue('D10', mayuscula($idioma['Nombres']))
					->getStyle('D10')->applyFromArray(estilo(11,"000000","B","FFFFFF","center","center",'thin','000000'));
					
$col='';
$y='';					
for($j=1;$j<=$cantidadcasilleros;$j++){
	$col=adicionar('D',$j);
	$y=$col;
	$doc->getActiveSheet()->setCellValue($col.'10', sacarIniciales($casillas['NombreCasilla'.$j]))
					->getStyle($col.'10')->applyFromArray(estilo(11,"000000","B","FFFFFF","center","center",'thin','000000'));
	$doc->getActiveSheet()->setCellValue($col.'9', $casillas['NombreCasilla'.$j])
					->getStyle($col.'9')->applyFromArray(estilo(11,"000000","B","FFFFFF","center","bottom",'thin','000000'))->getAlignment()->setTextRotation(90);
	$doc->getActiveSheet()->getColumnDimension($col)->setWidth(an(3.57));
}
//NotaResultado
$col=adicionar($col,1);
	$doc->getActiveSheet()->setCellValue($col.'10', sacarIniciales($idioma['Nota']." ".$idioma['Resultado']))
					->getStyle($col.'10')->applyFromArray(estilo(11,"000000","B","FFFFFF","center","center",'thin','000000'));
	$doc->getActiveSheet()->setCellValue($col.'9', $idioma['Resultado'])
					->getStyle($col.'9')->applyFromArray(estilo(11,"000000","B","FFFFFF","center","bottom",'thin','000000'))->getAlignment()->setTextRotation(90);
	$doc->getActiveSheet()->getColumnDimension($col)->setWidth(an(3.57));	
//Dps
$col=adicionar($col,1);
	$doc->getActiveSheet()->setCellValue($col.'10', $idioma['Dps'])
					->getStyle($col.'10')->applyFromArray(estilo(11,"000000","B","FFFFFF","center","center",'thin','000000'));
	$doc->getActiveSheet()->setCellValue($col.'9', $idioma['Dps'])
					->getStyle($col.'9')->applyFromArray(estilo(11,"000000","B","FFFFFF","center","bottom",'thin','000000'))->getAlignment()->setTextRotation(90);
	$doc->getActiveSheet()->getColumnDimension($col)->setWidth(an(3.57));
	if(!$dps){
		$doc->getActiveSheet()->getColumnDimension($col)->setVisible(false);
	}
//Nota Final
	$col=adicionar($col,1);
	$doc->getActiveSheet()->setCellValue($col.'10', sacarIniciales($idioma['NotaFinal']))
					->getStyle($col.'10')->applyFromArray(estilo(11,"000000","B","FFFFFF","center","center",'thin','000000'));
	$doc->getActiveSheet()->setCellValue($col.'9', $idioma['NotaFinal'])
					->getStyle($col.'9')->applyFromArray(estilo(11,"000000","B","FFFFFF","center","bottom",'thin','000000'))->getAlignment()->setTextRotation(90);
	$doc->getActiveSheet()->getColumnDimension($col)->setWidth(an(5));	
	$col=adicionar($col,1);
	$doc->getActiveSheet()->getColumnDimension($col)->setWidth(an(2));
	$doc->getActiveSheet()->getColumnDimension($col)->setVisible(false);
$x=0;
$i=0;

foreach($a as $al){$i++;
	$regNota=$registroNotas->mostrarRegistroNotas($CodCasilleros,$al['CodAlumno'],$CodPeriodo);
	$regNota=array_shift($regNota);
	//print_r($regNota);
	$x=10+$i;
	$colorfondo=$i%2==0?'FFE699':'FFFFFF';
	$doc->getActiveSheet()->getRowDimension($x)->setRowHeight(22.50);
	//N
	$doc->getActiveSheet()->setCellValue('A'.$x, $i)
						->getStyle('A'.$x)->applyFromArray(estilo(11,"000000","",$colorfondo,"right","center",'thin','000000'));
	//Paterno
	$doc->getActiveSheet()->setCellValue('B'.$x, capitalizar($al['Paterno']))
						->getStyle('B'.$x)->applyFromArray(estilo(11,"000000","",$colorfondo,"left","center",'thin','000000'));				
	//Materno
	$doc->getActiveSheet()->setCellValue('C'.$x, capitalizar($al['Materno']))
						->getStyle('C'.$x)->applyFromArray(estilo(11,"000000","",$colorfondo,"left","center",'thin','000000'));
	//Nombres
	$doc->getActiveSheet()->setCellValue('D'.$x, capitalizar($al['Nombres']))
						->getStyle('D'.$x)->applyFromArray(estilo(11,"000000","",$colorfondo,"left","center",'thin','000000'));
	//echo "<br>";
	for($j=1;$j<=$cantidadcasilleros;$j++){
		$no=$regNota['Nota'.$j];
		//echo $no.",";
		$col=adicionar('D',$j);
		$y=$col;
		//$no=60;
		$doc->getActiveSheet()->setCellValue($col.$x, $no)
						->getStyle($col.$x)->applyFromArray(estilo(11,"000000","",$colorfondo,"center","center",'thin','000000'));
		$notamin=$casillas['LimiteMinCasilla'.$j];
		$notamax=$casillas['LimiteCasilla'.$j];
		$notaminmax=$idioma['NotaEstarEntre']." ".$notamin." ".$idioma['Y']." ".$notamax;
		//Validación
		$dodv = $doc->getActiveSheet()->getCell($col.$x)->getDataValidation();
		$dodv->setType( PHPExcel_Cell_DataValidation::TYPE_WHOLE );
		$dodv->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_STOP );

		$dodv->setAllowBlank(true);
		$dodv->setShowInputMessage(true);
		$dodv->setShowErrorMessage(true);
		$dodv->setErrorTitle($idioma['ErrorNotaTitulo']);
		$dodv->setError($notaminmax);
		$dodv->setPromptTitle($idioma['Nota']);
		$dodv->setPrompt($notaminmax);
		$dodv->setFormula1($notamin);
		$dodv->setFormula2($notamax);	
		
		//Desprotejer
		if(!$restringir){
			$doc->getActiveSheet()->getStyle($col.$x)->getProtection()->setLocked('unprotected');
		}
	}
	$resultadoformula="=ROUND(".convertir($formula,"E",$x).",0)";
	//NotaResultado
	$col=adicionar($col,1);
	$nry=$col;
	$doc->getActiveSheet()->setCellValue($col.$x, $resultadoformula)
						->getStyle($col.$x)->applyFromArray(estilo(11,"000000","B",$colorfondo,"center","center",'thin','000000'));
		
	//Dps
	if($dps){
		$nrxy=$col.$x;
		$formuladps="=IF($nrxy<=$n1dps,5,IF($nrxy<=$n2dps,6,IF($nrxy<=$n3dps,7,IF($nrxy<=$n4dps,8,IF($nrxy<=$n5dps,9,IF($nrxy<=$n6dps,10,0))))))";
	}else{
		$formuladps="0";
	}
	$col=adicionar($col,1);
	$ndps=$col;
	$doc->getActiveSheet()->setCellValue($col.$x, $formuladps)
						->getStyle($col.$x)->applyFromArray(estilo(11,"000000","B",$colorfondo,"right","center",'thin','000000'));
		
	//Nota Final
	$col=adicionar($col,1);
	$nf=$col;
	$ff="=".$nry.$x."+".$ndps.$x;
	$doc->getActiveSheet()->setCellValue($col.$x, $ff)
						->getStyle($col.$x)->applyFromArray(estilo(14,"000000","B",$colorfondo,"right","center",'thin','000000'));
	$validaNotaFinal='[Red][<'.$NotaAprobacion.']#;[Black][>='.$NotaAprobacion.']#;';
	$doc->getActiveSheet()->getStyle($col.$x)->getNumberFormat()->setFormatCode($validaNotaFinal);
	
	$col=adicionar($col,1);
	$doc->getActiveSheet()->setCellValue($col.$x, $regNota['CodRegistroNotas'])
						->getStyle($col.$x)->applyFromArray(estilo(11,"FFFFFF","",'FFFFFF',"right","center",'none','000000'));					
}
//Creditos
$creditosy=($cantidadalumnos+10+1);
$doc->getActiveSheet()->mergeCells('A'.$creditosy.":J".$creditosy);
$doc->getActiveSheet()->setCellValue('A'.$creditosy, "Sistema Académico Administrativo para Colegios - Desarrollado por Ronald Nina Layme")->getStyle('A'.$creditosy)->applyFromArray(estilo(9,"000000","",'FFFFFF',"left","center",'none','000000'));
//$doc->getActiveSheet()->getCell('A'.$creditosy)->getHyperlink()->setUrl('http://www.fb.com/ronaldnina');
$dodv = $doc->getActiveSheet()->getCell('A'.$creditosy)->getDataValidation();
$dodv->setShowInputMessage(true);
$dodv->setPromptTitle('Creditos');
$dodv->setPrompt('Sistema Académico Administrativo para Colegios - Desarrollado por Ronald Nina Layme Cel: 73230568');
$doc->getActiveSheet()->setCellValue('A'.($creditosy+1),md5($codigocasilleros)." - ".date("d-m-Y H:i:s"))->getStyle('A'.($creditosy+1))->applyFromArray(estilo(9,"000000","",'FFFFFF',"left","center",'none','000000'));

//Ocultar Grilla
$doc->getActiveSheet()->setShowGridlines(false);
//Aplicando Seguridad en Excel
$doc->getSecurity()->setLockWindows(true);
$doc->getSecurity()->setLockStructure(true);
$doc->getSecurity()->setWorkbookPassword($contrasenaexcel);

$doc->getActiveSheet()->getProtection()->setPassword($contrasenaexcel);
$doc->getActiveSheet()->getProtection()->setSheet(true);
$doc->getActiveSheet()->getProtection()->setSort(true);
$doc->getActiveSheet()->getProtection()->setInsertRows(true);
$doc->getActiveSheet()->getProtection()->setFormatCells(true);

$doc->getActiveSheet()->getStyle('D8')->getProtection()->setLocked(
PHPExcel_Style_Protection::PROTECTION_UNPROTECTED
);
//Inmovilizar Paneles
$doc->getActiveSheet()->freezePane('A11');
//Cambiar Nombre a Pestaña
$doc->getActiveSheet()->setTitle('Registro de Notas');

//Seleccionando Pestaña Principal
$doc->setActiveSheetIndex(0);

//Codigo Final de Exportación
if($tipoarchivo=="2007"){
	// Redirect output to a client’s web browser (Excel2007)
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="'.$nombrearchivo.'.xlsx"');
	header('Cache-Control: max-age=0');
	
	$objWriter = PHPExcel_IOFactory::createWriter($doc, 'Excel2007');
}else{
	// Redirect output to a client’s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'.$nombrearchivo.'.xls"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');
	
	// If you're serving to IE over SSL, then the following may be needed
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
}
$objWriter->save('php://output');
exit;
?>