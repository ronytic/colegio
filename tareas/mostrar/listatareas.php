<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$CodCurso=$_POST['CodCurso'];
	$CodMateria=$_POST['CodMateria'];
	include_once("../../class/tarea.php");
	include_once("../../class/curso.php");
	include_once("../../class/materias.php");
	$tarea=new tarea;
	$curso=new curso;
	$materias=new materias;
	$tar=$tarea->mostrarTareasCursoMateria($CodCurso,$CodMateria);
	$cur=$curso->mostrarCurso($CodCurso);
	$cur=array_shift($cur);
	$mat=$materias->mostrarMateria($CodMateria);
	$mat=array_shift($mat);
	?>
    <a href="#" id="exportarexcel" class="btn btn-mini btn-success"><?php echo $idioma['ExportarExcel']?></a>
    <table class="table table-bordered table-striped table-hover">
    	<thead>
        <tr><th colspan="2"><?php echo $idioma['Curso']?>: <?php echo $cur['Nombre']?></th><th colspan="2"><?php echo $idioma['Materia']?>: <?php echo $mat['Nombre']?></th></tr>
        <tr><th>N</th><th><?php echo $idioma['Nombre']?></th><th><?php echo $idioma['Descripcion']?></th><th><?php echo $idioma['FechaPresentacion']?></th></tr>
        </thead>
    <?php
		if(count($tar)){
			foreach($tar as $t){$i++;
				?>
				<tr><td><?php echo $i?></td><td><?php echo $t['Nombre']?></td><td><?php echo $t['Descripcion']?></td><td><?php echo fecha2Str($t['FechaPresentacion'])?></td></tr>
				<?php	
			}
		}else{
			?><tr class="error"><td colspan="4"><?php echo $idioma['NoExisteTareasRegistradas']?></td></tr><?php	
		}
	?>
    </table>
    <?php
}
?>