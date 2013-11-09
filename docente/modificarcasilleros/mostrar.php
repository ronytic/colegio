<?php
include_once("../../login/check.php");
if(isset($_POST)){
	$CodDocente=$_POST['CodDocente'];
	$Periodo=$_POST['Periodo'];
	include_once("../../class/docentemateriacurso.php");
	include_once("../../class/materias.php");
	include_once("../../class/curso.php");
	include_once("../../class/docente.php");
	include_once("../../class/casilleros.php");
	include_once("../../class/config.php");
	$docentemateriacurso=new docentemateriacurso;
	$curso=new curso;
	$materias=new materias;
	$docente=new docente;
	$casilleros=new casilleros;
	$config=new config;
	$cnf=$config->mostrarConfig("PeriodoActual");
	$PeriodoActual=$cnf['Valor'];
	if(empty($Periodo)){$Periodo=$PeriodoActual;}
	$dmc=$docentemateriacurso->mostrarTodoDocente($CodDocente);
	$doc=$docente->mostrarDocente($CodDocente);
	$doc=array_shift($doc);
	$codigos=array();
	foreach($dmc as $docmateriacurso){
		array_push($codigos,$docmateriacurso['CodDocenteMateriaCurso']);
	}
	$codigos=implode(",",$codigos);
	?>
    <div class="tabbable"> <!-- Only required for left/right tabs -->
  		<ul class="nav nav-tabs">
        <?php for($j=1;$j<=4;$j++){?>
        <li class="<?php echo ($j==$Periodo)?'active':'';?>"><a href="#tab<?php echo $j ?>" data-toggle="tab"><?php echo $idioma['Periodo']?> <?php echo $j ?></a></li>
        <?php }?>
        </ul>
  		<div class="tab-content">
    <?php
	for($j=1;$j<=4;$j++){
	?>
    <div class="tab-pane <?php echo $j==$Periodo?'active':'';?>" id="tab<?php echo $j ?>">
    <a href="#" class="btn btn-success btn-mini" id="exportarexcel"><?php echo $idioma['ExportarExcel']?></a>
    <table class="table table-bordered table-striped table-hover table-condensed">
    	<thead>
        	<tr><th colspan="3"><?php echo $idioma['Docente']?>:</th><th colspan="4"><?php echo capitalizar($doc['Paterno'])?> <?php echo capitalizar($doc['Materno'])?> <?php echo capitalizar($doc['Nombres'])?></th></tr>
            <tr><th colspan="3"><?php echo $idioma['Periodo']?>:</th><th colspan="4"><?php echo $j ?></th></tr>
        	<tr><th>N</th><th><?php echo $idioma['Materias']?></th><th><?php echo $idioma['Curso']?></th><th><?php echo $idioma['Alumnos']?></th><th><span title="<?php echo $idioma['Casillas']?>"><?php echo recortarTexto($idioma['Casillas'],3,"")?></span></th><th><?php echo $idioma['Dps']?></th><th></th></tr>
        </thead>
    <?php
	$casi=$casilleros->mostrarHabilitadoTrimestre($codigos,$j);
	if(!count($casi)){?><tr><td colspan="7"><?php echo $idioma['NoTieneAsignadoCasilleros']; ?></td></tr><?php }
	$i=0;
	foreach($casi as $cas){$i++;
		$docmateriacurso=$docentemateriacurso->mostrarRegistro($cas['CodDocenteMateriaCurso']);
		$docmateriacurso=array_shift($docmateriacurso);
		$cur=$curso->mostrarCurso($docmateriacurso['CodCurso']);
		$cur=array_shift($cur);
		$mat=$materias->mostrarMateria($docmateriacurso['CodMateria']);
		$mat=array_shift($mat);
		switch($docmateriacurso['SexoAlumno']){
			case 0:{$sexo=$idioma['SoloMujeres'];}break;
			case 1:{$sexo=$idioma['SoloVarones'];}break;
			case 2:{$sexo=$idioma['AmbosSexos'];}break;
		}
		?>
        <tr>
        	<td><?php echo $i?></td>
            <td><?php echo $mat['Nombre']?></td>
            <td><?php echo $cur['Abreviado']?></td>
            <td><?php echo $sexo?></td>
            <td><?php echo $cas['Casilleros']?></td>
            <td><?php echo $cas['Dps']?$idioma['Si']:$idioma['No'];?></td>
            <td><a href="#" title="<?php echo $idioma['Modificar']?>" class="btn btn-mini modificar" rel="<?php echo $cas['CodCasilleros']?>"><i class="icon-pencil"></i></a>
            </td>
        </tr>
        <?php	
	}
	?>
    </table>
        </div>
    <?php
	}
	?>
    </div>
</div>
    <?php
}
?>
