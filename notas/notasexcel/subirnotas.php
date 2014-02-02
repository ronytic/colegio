<?php
include_once("../../login/check.php");
//print_r($_FILES);
$archivoexcel=$_FILES['archivoexcel']['name'];
$direccion=$_POST['direccion'];
if($archivoexcel!=""){
	$nombrearchivo=$_FILES['archivoexcel']['tmp_name'];
	include_once("../../class/config.php");
	include_once("../../class/casilleros.php");
	include_once("../../class/docentemateriacurso.php");
	include_once("../../class/registronotas.php");
	include_once("../../class/curso.php");
	include_once("../../class/docente.php");
	include_once("../../class/materias.php");
	include_once("../../class/registronotasexcel.php");
	$config=new config;
	$docentemateriacurso=new docentemateriacurso;
	$casilleros=new casilleros;
	$registroNotas=new registronotas;
	$curso=new curso;
	$materias=new materias;
	$docente=new docente;
	$registronotasexcel=new registronotasexcel;
	set_time_limit(0);
	ini_set('memory_limit', '-1');
	
	$RegistroNotaHabilitado=$config->mostrarConfig("RegistroNotaHabilitado",1);
	$PeriodoNotaHabilitado=$config->mostrarConfig("PeriodoNotaHabilitado",1);
	$PeriodoNotaHabilitadoBimestre=$config->mostrarConfig("PeriodoNotaHabilitadoBimestre",1);
	
	
	/*error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);*/
	
	date_default_timezone_set('America/La_Paz');
	//echo $nombrearchivo;
	
	/** Incluir PHPExcel */
	require_once 'Classes/PHPExcel.php';
	require_once 'funciones/funciones.php';
	$objPHPExcel = PHPExcel_IOFactory::load($nombrearchivo);
	/*
	$objReader = new PHPExcel_Reader_Excel2007();
	$objPHPExcel = $objReader->load("simple.xlsx");
	*/
	$dact=$objPHPExcel->getActiveSheet();
	$periodo=$dact->getCell('C2')->getValue();
	$codigodocente=$dact->getCell('E3')->getValue();
	$codigomateria=$dact->getCell('E4')->getValue();
	$codigocurso=$dact->getCell('E5')->getValue();
	$codigocasilleros=$dact->getCell('F3')->getValue();
	$codigodocentemateriacurso=$dact->getCell('G3')->getValue();
	$cantidadalumnos=$dact->getCell('E6')->getValue();
	$cantidadcasilleros=$dact->getCell('E7')->getValue();
	$notas=array();
	$totalalto=$cantidadalumnos+10;
	$columnacodigo=adicionar("D",$cantidadcasilleros+4);
	$columnanr=adicionar("D",$cantidadcasilleros+1);
	$columnandps=adicionar("D",$cantidadcasilleros+2);
	$columnanf=adicionar("D",$cantidadcasilleros+3);
	$creditosy=($cantidadalumnos+10+1+1);
	$codigo=$dact->getCell('A'.$creditosy)->getValue();
	
	$CantidadAprobados=$dact->getCell('C7')->getCalculatedValue();
	$CantidadReprobados=$dact->getCell('C8')->getCalculatedValue();
	/**/
	$reg=$registronotasexcel->estadoTabla();
	$codigo_registro=$reg['Auto_increment'];
	$NombreArchivoSubido=$codigo_registro."_".$_FILES['archivoexcel']['name'];
	//echo $NombreArchivoSubido;
	copy($nombrearchivo,"archivos/".$NombreArchivoSubido);
	$valores=array("NombreArchivo"=>"'".$NombreArchivoSubido."'",
				"Codigo"=>"'".$codigo."'",
				"CodDocenteMateriaCurso"=>"'$codigodocentemateriacurso'",
				"CodCasilleros"=>"'$codigocasilleros'",
				"CodDocente"=>"'$codigodocente'",
				"CodMateria"=>"'$codigomateria'",
				"CodCurso"=>"'$codigocurso'",
				"Direccion"=>"'$direccion'",
				"Ubicacion"=>"'Subida'",
	);
	
	//print_r($valores);
	$registronotasexcel->insertarRegistro($valores);
	
	//echo $NombreArchivoSubido;
	$_SESSION['CodigoRegistro']=$codigo_registro;
	//$NombreArchivoSubido="11_SAAC_COMP_2Sec_2_2007.xlsx";
	
	
	
	/**/
	
	/*
	for($i=11;$i<=$totalalto;$i++){
		$cod=$dact->getCell($columnacodigo.$i)->getValue();
		$n=array();
		$poscol="D";
		for($j=1;$j<=$cantidadcasilleros;$j++){
			$poscol=adicionar($poscol,1);
			$vn=$dact->getCell($poscol.$i)->getValue();
			$n[$j]=$vn;
		}
		$notaresultado=$dact->getCell($columnanr.$i)->getCalculatedValue();
		$notadps=$dact->getCell($columnandps.$i)->getCalculatedValue();
		$notanotafinal=$dact->getCell($columnanf.$i)->getCalculatedValue();
		$notas[$cod]=array("notas"=>$n,
							"resultado"=>$notaresultado,
							"dps"=>$notadps,
							"notafinal"=>$notanotafinal
						);
	}*/

	$folder="../../";
	$NoRevisar=1;
	$titulo="RegistroNotas";
	$mat=$materias->mostrarMateria($codigomateria);
	$mat=array_shift($mat);
	$cur=$curso->mostrarCurso($codigocurso);
	$cur=array_shift($cur);
	$doc=$docente->mostrarDocente($codigodocente);
	$doc=array_shift($doc);
	
	if($RegistroNotaHabilitado==1){
		if($cur['Bimestre']){
			if($periodo!=$PeriodoNotaHabilitadoBimestre){
				$restringir=1;
			}else{
				$restringir=0;
			}	
		}else{
			if($periodo!=$PeriodoNotaHabilitado){
				$restringir=1;
			}else{
				$restringir=0;
			}
		}
		
	}else{
		$restringir=1;	
	}
	
	if($direccion=="modificarnotasadministrativo"){
		$restringir=0;	
	}
	include_once($folder."cabecerahtml.php");
		
	include_once($folder."cabecera.php");
	?>
	<div class="span12 box">
    	<div class="box-header"><h2><?php echo $idioma['ConfirmacionSubida']?></h2></div>
        <div class="box-content">
        	<table class="table table-striped table-bordered table-hover">
            	<tr>
                	<td class="resaltar"><?php echo $idioma['Docente']?></td>
                    <td><?php echo capitalizar($doc['Paterno']." ".$doc['Materno']." ".$doc['Nombres'])?></td>
                </tr>
                <tr>
                	<td class="resaltar"><?php echo $idioma['Materia']?></td>
                    <td><?php echo capitalizar($mat['Nombre'])?></td>
                </tr>
                <tr>
                	<td class="resaltar"><?php echo $idioma['Curso']?></td>
                    <td><?php echo capitalizar($cur['Nombre'])?></td>
                </tr>
                <tr>
                	<td class="resaltar"><?php echo $idioma['Periodo']?></td>
                    <td><?php echo capitalizar($periodo)?></td>
                </tr>
                <tr>
                	<td class="resaltar"><?php echo $idioma['TotalAlumnos']?></td>
                    <td><?php echo capitalizar($cantidadalumnos)?></td>
                </tr>
                <tr>
                	<td class="resaltar"><?php echo $idioma['Aprobados']?></td>
                    <td><?php echo capitalizar($CantidadAprobados)?></td>
                </tr>
                <tr>
                	<td class="resaltar"><?php echo $idioma['Reprobados']?></td>
                    <td><?php echo capitalizar($CantidadReprobados)?></td>
                </tr>
                <tr>
                	<td class="resaltar"><?php echo $idioma['NombreArchivo']?></td>
                    <td><?php echo capitalizar($_FILES['archivoexcel']['name'])?></td>
                </tr>
                
            </table>
            <?php if($restringir==0){?>
            <div class="alert alert-error"><?php echo $idioma['SeguroRegistrarNotas']?></div>
            <a href="confirmado.php" class="btn btn-success"><?php echo $idioma['SiEstoySeguro']?></a>
            <a href="../<?php echo $direccion?>/?c=<?php echo $codigocasilleros?>" class="btn btn-danger"><?php echo $idioma['NoEstoySeguro']?></a>
            <?php }else{
			?>
            <div class="alert alert-error"><?php echo $idioma['RegistroNotasDesHabilitado']?> <?php echo $idioma['RegistroNotasDesHabilitadoArchivo']?></div>

            <a href="../<?php echo $direccion?>/?c=<?php echo $codigocasilleros?>" class="btn btn-success"><?php echo $idioma['VolverSeleccionarArchivo']?></a>
            <?php	
			}?>
        </div>
    </div>
	<?php
	include_once($folder."pie.php");
}else{
	header("Location:../docente/".$direccion."/");
}
?>