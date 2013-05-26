<?php
include_once("../../login/check.php");
include_once("../../class/tarea.php");
include_once("../../class/curso.php");
include_once("../../class/materias.php");
if(!empty($_SESSION)){
	$tarea=new tarea;
	$materias=new materias;
	$curso=new curso;
	$CodDocente=$_SESSION['CodUsuarioLog'];
	$CodCurso=$_POST['CodCurso'];
	$CodMateria=$_POST['CodMateria'];
	$ma=$materias->mostrarMateria($CodMateria);
	$ma=array_shift($ma);
	$cu=$curso->mostrarCurso($CodCurso);
	$cu=array_shift($cu);
	$tareas=$tarea->mostrarTareas($CodDocente,$CodCurso,$CodMateria);
	?>
    <a href="#" class="btn btn-success btn-mini" id="exportarexcel"><?php echo $idioma['ExportarExcel']?></a>
	<table class="table table-hover table-bordered table-striped">
    	<thead>
        	<tr><th colspan="2"><?php echo $idioma['Materia']?>:</th><th colspan="1"><?php echo $ma['Nombre']?></th><th colspan="2"><?php echo $idioma['FechaHoy']?></th></tr>
            <tr><th colspan="2"><?php echo $idioma['Curso']?>:</th><th colspan="1"><?php echo $cu['Nombre']?></th><th colspan="2"><?php echo date("d-m-Y")?></th></tr>
			<tr><th style="max-width:15px;width:15px;">N</th><th><?php echo $idioma['Tarea']?></th><th><?php echo $idioma['Descripcion']?></th><th style="max-width:75px;width:75px;"><?php echo $idioma['Fecha']?></th><th></th></tr>
		</thead>
    <?php
	$i=0;
	if(count($tareas)){
		foreach($tareas as $tar){$i++;
		?>
		<tr>
			<td class="der"><?php echo $i;?></td>
			<td><?php echo $tar['Nombre'];?></td>
			<td><?php echo $tar['Descripcion'];?></td>
			<td><?php echo fecha2Str($tar['FechaPresentacion']);?></td>
			<td><a href="#" class="btn btn-mini eliminar" rel="<?php echo $tar['CodTarea']?>" title="<?php echo $idioma['Eliminar']?>"><i class="icon-remove"></i></a></td>
		</tr>
		<?php }
	}else{
		?><tr><td colspan="5"><strong><?php echo $idioma['NoHayTareasRegistradas']?></strong></td></tr><?php	
	}
	?>
	</table>
    <?php
}
?>