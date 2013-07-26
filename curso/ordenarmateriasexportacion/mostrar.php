<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/cursomateriaexportar.php");
	include_once("../../class/curso.php");
	include_once("../../class/materias.php");
	$cursomateriaexportar=new cursomateriaexportar;
	$cur=new curso;
	$materias=new materias;
	$CodCurso=$_POST['CodCurso'];
	$Curso=$cur->mostrarCurso($CodCurso);
	$Curso=array_shift($Curso);
	?>
    <?php echo $idioma['Curso']?>: <strong><?php echo $Curso['Nombre']?>.</strong> <?php echo $idioma['OrdenExportar']?>
    
    <table class="table table-bordered table-striped table-hover">
    	<thead>
    		<tr><th>N</th><th><?php echo $idioma['Materias']?></th><th width="50"></th></tr>
	    </thead>
	<?php
	$i=0;
	foreach($cursomateriaexportar->mostrarMaterias($CodCurso) as $matbol){$i++;
		$CodMatBol=$matbol['CodCursoMateriaExportar'];
		$materia=$materias->mostrarMateria($matbol['CodMateria']);
		$materia=array_shift($materia);
		?>
		<tr>
			<td><?php echo $i;?></td>
        	<td>
            	<?php
                if($matbol['CodMateria']==1000){
					echo $idioma["MateriaCombinada"];
				}else{
					?><?php echo $materia['Nombre'];?><?php
				}
				?>
            </td>
            <td><a href="#" class="btn btn-mini eliminar" rel="<?php echo $CodMatBol;?>"><?php echo $idioma['Eliminar']?></a></td></tr>
		<?php	
	}
	?></table><?php
}
?>