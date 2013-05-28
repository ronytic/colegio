<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/agenda.php");
	include_once("../../class/materias.php");
	include_once("../../class/alumno.php");
	include_once("../../class/config.php");
	include_once("../../class/curso.php");
	include_once("../../class/observaciones.php");
	
	$agenda=new agenda;
	$materias=new materias;
	$obser=new observaciones;
	$alumno=new alumno;
	$config=new config;
	$curso=new curso;
	$CodDocente=$_SESSION['CodDocente'];
	$CodCurso=$_POST['CodCurso'];
	$CodMateria=$_POST['CodMateria'];
	
	$cur=$curso->mostrarCurso($CodCurso);
	$cur=array_shift($cur);
	/*Sacando Fecha de Trimestre*/
	if($cur['Bimestre']){
		$cnf=$config->mostrarConfig("InicioBimestre1");
		$fechaInicioBimestre1=$cnf['Valor'];
		$cnf=$config->mostrarConfig("FinBimestre1");
		$fechaFinBimestre1=$cnf['Valor'];
		$cnf=$config->mostrarConfig("InicioBimestre2");
		$fechaInicioBimestre2=$cnf['Valor'];
		$cnf=$config->mostrarConfig("FinBimestre2");
		$fechaFinBimestre2=$cnf['Valor'];
		$cnf=$config->mostrarConfig("InicioBimestre3");
		$fechaInicioBimestre3=$cnf['Valor'];
		$cnf=$config->mostrarConfig("FinBimestre3");
		$fechaFinBimestre3=$cnf['Valor'];
		$cnf=$config->mostrarConfig("InicioBimestre4");
		$fechaInicioBimestre4=$cnf['Valor'];
		$cnf=$config->mostrarConfig("FinBimestre4");
		$fechaFinBimestre4=$cnf['Valor'];
	}else{
		$cnf=$config->mostrarConfig("InicioTrimestre1");
		$fechaInicioTrimestre1=$cnf['Valor'];
		$cnf=$config->mostrarConfig("FinTrimestre1");
		$fechaFinTrimestre1=$cnf['Valor'];
		$cnf=$config->mostrarConfig("InicioTrimestre2");
		$fechaInicioTrimestre2=$cnf['Valor'];
		$cnf=$config->mostrarConfig("FinTrimestre2");
		$fechaFinTrimestre2=$cnf['Valor'];
		$cnf=$config->mostrarConfig("InicioTrimestre3");
		$fechaInicioTrimestre3=$cnf['Valor'];
		$cnf=$config->mostrarConfig("FinTrimestre3");
		$fechaFinTrimestre3=$cnf['Valor'];
	}
	
	
	
	//echo "CodAl".$_POST['Cod'];
	/*if(isset($_POST['CodCurso'])){
		$CodCurso=$_POST['CodCurso'];
		$ag=$agenda->mostrarRegistroCurso($CodDocente,$CodCurso);
	}*/
	if(isset($_POST['CodAlumno'])){
		$ag=$agenda->mostrarRegistroMateriaAlumno($CodDocente,$CodCurso,$CodMateria,$_POST['CodAlumno']);
	}else{
		$ag=$agenda->mostrarRegistroMateria($CodDocente,$CodCurso,$CodMateria);
	}
	$ma=$materias->mostrarMateria($CodMateria);
	$ma=array_shift($ma);
	/*if(isset($_POST['CodAlumno'])){
		$CodCurso=$_POST['CodCurso'];
		$CodMateria=$_POST['CodMateria'];
		$CodAlumno=$_POST['CodAlumno'];
		$ag=$agenda->mostrarRegistroAlumno($CodDocente,$CodCurso,$CodMateria,$CodAlumno);
	}*/
	//echo "CodCurso".$_POST['CodCurso'];
	//echo "CodMateri".$_POST['CodMateria'];
	
	?>
<a href="#" class="btn btn-success btn-mini" id="exportarexcel"><?php echo $idioma['ExportarExcel']?></a>
<table class="table table-bordered table-striped table-hover table-condensed">
    <thead>
        <tr><th colspan="3"><?php echo $idioma['Curso']?>:</th><th colspan="2"><?php echo $cur['Nombre']?></th></tr>
        <tr><th colspan="3"><?php echo $idioma['Materia']?>:</th><th colspan="2"><?php echo $ma['Nombre']?></th></tr>
        <tr><th style="min-width:15px"></th><th><?php echo $idioma['Alumnos']?></th><th><?php echo $idioma['Observacion']?></th><th width="60"><?php echo $idioma['Fecha']?></th><th><?php echo $idioma['Detalle']?></th></tr>
    </thead>
    <?php
	foreach($ag as $a){
		$o=$obser->mostrarObser($a['CodObservacion']);
		$o=array_shift($o);
		$al=$alumno->mostrarDatosPersonales($a['CodAlumno']);
		$al=array_shift($al);
		
		if($cur['Bimestre']){
			if(strtotime($a['Fecha'])>=strtotime($fechaInicioBimestre1) and strtotime($a['Fecha'])<=strtotime($fechaFinBimestre1)){$tipo=1;}
			if(strtotime($a['Fecha'])>=strtotime($fechaInicioBimestre2) and strtotime($a['Fecha'])<=strtotime($fechaFinBimestre2)){$tipo=2;}
			if(strtotime($a['Fecha'])>=strtotime($fechaInicioBimestre3) and strtotime($a['Fecha'])<=strtotime($fechaFinBimestre3)){$tipo=3;}
			if(strtotime($a['Fecha'])>=strtotime($fechaInicioBimestre4) and strtotime($a['Fecha'])<=strtotime($fechaFinBimestre4)){$tipo=4;}
			$mensaje=$tipo." ".$idioma['Bimestre'];
		}else{
			if(strtotime($a['Fecha'])>=strtotime($fechaInicioTrimestre1) and strtotime($a['Fecha'])<=strtotime($fechaFinTrimestre1)){$tipo=1;}
			if(strtotime($a['Fecha'])>=strtotime($fechaInicioTrimestre2) and strtotime($a['Fecha'])<=strtotime($fechaFinTrimestre2)){$tipo=2;}
			if(strtotime($a['Fecha'])>=strtotime($fechaInicioTrimestre3) and strtotime($a['Fecha'])<=strtotime($fechaFinTrimestre3)){$tipo=3;}
			$mensaje=$tipo." ".$idioma['Trimestre'];
		}
	?>
	<tr class="contenido">
		<td><?php switch($tipo){case 1:{?><div class="cverde" title="<?php echo $mensaje?>"></div><?php }break;       case 2:{?><div class="cazul" title="<?php echo $mensaje?>"></div><?php }break;case 3:{?><div class="cnaranja" title="<?php echo $mensaje?>"></div><?php }break;case 4:{?><div class="cnegro" title="<?php echo $mensaje?>"></div><?php }break;}?><?php if($a['Resaltar']){?><div class="crojo" title="<?php echo $idioma['Importante']?>"></div><?php }?></td>
    	<td><?php echo capitalizar($al['Paterno']." ".acortarPalabra($al['Nombres']))?></td>
        <td><small><?php echo $o['Nombre'];?></small></td>
        <td><?php echo fecha2Str($a['Fecha']);?></td>
        <td><?php echo $a['Detalle'];?></td>
	</tr>
	<?php	
	}
    ?>
</table>
    <?php
}
?>