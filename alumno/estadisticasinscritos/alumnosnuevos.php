<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$CodCurso=$_POST['CodCurso'];
	include_once("../../class/alumno.php");
	include_once("../../class/curso.php");
	$alumno=new alumno;
	$curso=new curso;
	$cur=array_shift($curso->mostrarCurso($CodCurso));
	$alumnosNuevos=$alumno->verInscritosNuevosCurso($CodCurso);
	if(count($alumnosNuevos)>0){
		?>
        <a href="#" id="exportarexcel" class="btn btn-success btn-mini"><?php echo $idioma['ExportarExcel']?></a>
        <table class="table table-bordered table-hover table-striped">
        <thead>
        	<tr><th><?php echo $idioma['Curso']?>:</th><th><?php echo $cur['Nombre']?></th></tr>
      		<tr><th>Nº</th><th><?php echo $idioma['Nombres']?></th><th><?php echo $idioma['Rude']?></th><th><?php echo $idioma['Colegio']?></th></tr>
        </thead>
        <?php
		$i=0;
		foreach($alumnosNuevos as $al){$i++;
			?>
            <tr>
            	<td><?php echo $i;?></td>
                <td><?php echo capitalizar($al['Paterno'])?> <?php echo capitalizar($al['Materno'])?> <?php echo capitalizar($al['Nombres'])?></td>
                <td><?php echo $al['Rude'];?></td>
                <td><?php echo capitalizar($al['NombreUnidad'])?></td>
            </tr>
            <?php			
		}
		?>
        </table>
        <?php
	}else{
		echo $idioma['NoHayAlumnoNuevo'];
	}
}
?>