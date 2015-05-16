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
    		<tr><th width="15">N</th><th><?php echo $idioma['Materias']?></th><th width="150"><?php echo $idioma["MateriaCombinada"];?></th><th width="50"></th></tr>
	    </thead>
	<?php
	$i=0;
	foreach($cursomateriaexportar->mostrarMaterias($CodCurso) as $matbol){$i++;
		$CodMatBol=$matbol['CodCursoMateriaExportar'];
		$materia=$materias->mostrarMateria($matbol['CodMateria']);
		$materia=array_shift($materia);
		?>
		<tr>
			<td class="der"><?php echo $i;?></td>
        	<td>
                <?php echo $materia['Nombre'];?>
            </td>
            <td>
                <select name="Combinada" class="combinada" data-rel="<?php echo $CodMatBol;?>">
                    <option value="0" <?php echo $matbol['Combinada']=="0"?'selected="selected"':''?>><?php echo $idioma['Ninguno']?></option>
                    <option value="1" <?php echo $matbol['Combinada']=="1"?'selected="selected"':''?>><?php echo $idioma["MateriaCombinada"];?> 1</option>
                    <option value="2" <?php echo $matbol['Combinada']=="2"?'selected="selected"':''?>><?php echo $idioma["MateriaCombinada"];?> 2</option>
                    <option value="3" <?php echo $matbol['Combinada']=="3"?'selected="selected"':''?>><?php echo $idioma["MateriaCombinada"];?> 3</option>
                    <option value="4" <?php echo $matbol['Combinada']=="4"?'selected="selected"':''?>><?php echo $idioma["MateriaCombinada"];?> 4</option>
                    <option value="5" <?php echo $matbol['Combinada']=="5"?'selected="selected"':''?>><?php echo $idioma["MateriaCombinada"];?> 5</option>
                </select>
            </td>
            <td><a href="#" class="btn btn-mini eliminar" rel="<?php echo $CodMatBol;?>"><?php echo $idioma['Eliminar']?></a></td></tr>
		<?php	
	}
	?></table><?php
}
?>