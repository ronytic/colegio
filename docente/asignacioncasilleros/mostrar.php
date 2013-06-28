<?php
include_once("../../login/check.php");
if(isset($_POST)){
	$CodDocente=$_POST['CodDocente'];
	include_once("../../class/docentemateriacurso.php");
	include_once("../../class/materias.php");
	include_once("../../class/curso.php");
	include_once("../../class/docente.php");
	$docentemateriacurso=new docentemateriacurso;
	$curso=new curso;
	$materias=new materias;
	$docente=new docente;
	$dmc=$docentemateriacurso->mostrarTodoDocente($CodDocente);
	$doc=$docente->mostrarDocente($CodDocente);
	$doc=array_shift($doc);
	?>
    <table class="table table-bordered table-striped table-hover table-condensed">
    	<thead>
        	<tr><th colspan="2"><?php echo $idioma['Docente']?>:</th><th colspan="3"><?php echo capitalizar($doc['Paterno'])?> <?php echo capitalizar($doc['Materno'])?> <?php echo capitalizar($doc['Nombres'])?></th></tr>
        	<tr><th>N</th><th><?php echo $idioma['Materias']?></th><th><?php echo $idioma['Curso']?></th><th><?php echo $idioma['Alumnos']?></th><th></th></tr>
        </thead>
    <?php
	foreach($dmc as $docmateriacurso){$i++;
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
            <td><?php echo $cur['Nombre']?></td>
            <td><?php echo $sexo?></td>
            <td><a href="#" title="<?php echo $idioma['Modificar']?>" class="btn btn-mini modificar" rel="<?php echo $docmateriacurso['CodDocenteMateriaCurso']?>" data-materia="<?php echo $docmateriacurso['CodMateria']?>" data-curso="<?php echo $docmateriacurso['CodCurso']?>" data-alumnos="<?php echo $docmateriacurso['SexoAlumno']?>" data-docente="<?php echo $docmateriacurso['CodDocente']?>"><i class="icon-pencil"></i></a> 
            <a href="#" class="btn btn-mini eliminar" title="<?php echo $idioma['Eliminar']?>" rel="<?php echo $docmateriacurso['CodDocenteMateriaCurso']?>"><i class="icon-remove"></i></td>
        </tr>
        <?php
	}
	?>
    </table>
    <?php
}
?>