<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/cursomateria.php");
	include_once("../../class/curso.php");
	include_once("../../class/materias.php");
	$cursomateria=new cursomateria;
	$cur=new curso;
	$materias=new materias;
	$CodCurso=$_POST['CodCurso'];
	$Curso=$cur->mostrarCurso($CodCurso);
	$Curso=array_shift($Curso);
	?>
    <?php echo $idioma['Curso']?>: <span class="resaltar"><?php echo $Curso['Nombre']?></span>
    <br>
    <?php echo $idioma['OrdenBoletin']?><br />
    <?php echo $idioma['NombreAdecuadoBoletin']?>
    <table class="table table-bordered table-striped table-hover ">
    <thead>
    <tr><th>N</th><th><?php echo $idioma['Materias']?></th><th><?php echo $idioma['NombreAlterno']?> 1</th><th><?php echo $idioma['NombreAlterno']?> 2</th><th width="50"><?php echo $idioma['Acciones']?></th></tr>
    </thead>
	<?php
	$i=0;
	foreach($cursomateria->mostrarMaterias($CodCurso) as $matbol){
		$CodMatBol=$matbol['CodCursoMateria'];
		$materia=$materias->mostrarMateria($matbol['CodMateria']);
		$materia=array_shift($materia);
		$i++;
		$ch='checked="checked"';
		?>
		<tr class="contenido">
        	<td><?php echo $i;?></td>
        	<td><label for="n<?php echo $CodMatBol;?>1" class="central"><input type="radio" name="nombre<?php echo $CodMatBol;?>" value="1" class="opcion" rel="<?php echo $CodMatBol;?>" <?php echo $matbol['Alterno']==1?$ch:'';?> id="n<?php echo $CodMatBol;?>1"/><?php echo $materia['Nombre'];?></label></td>
            <td><label for="n<?php echo $CodMatBol;?>2"><input type="radio" name="nombre<?php echo $CodMatBol;?>" value="2" class="opcion" rel="<?php echo $CodMatBol;?>" <?php echo $matbol['Alterno']==2?$ch:'';?> id="n<?php echo $CodMatBol;?>2"/><?php echo $materia['NombreAlterno1'];?></label></td>
            <td><label for="n<?php echo $CodMatBol;?>3"><input type="radio" name="nombre<?php echo $CodMatBol;?>" value="3" class="opcion" rel="<?php echo $CodMatBol;?>" <?php echo $matbol['Alterno']==3?$ch:'';?> id="n<?php echo $CodMatBol;?>3"/><?php echo $materia['NombreAlterno2'];?></label></td>
            <td><a href="#" class="btn btn-mini eliminar" rel="<?php echo $CodMatBol;?>"><?php echo $idioma['Eliminar']?></a></td></tr>
		<?php	
	}
	?></table><?php
}
?>