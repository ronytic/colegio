<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/materias.php");
	$materias=new materias;
	$materiasAll=$materias->mostrarMaterias("noall")
	?><select name="materias" size="<?php echo count($materiasAll);?>">
		<?php foreach($materiasAll as $ma){?>
        	<option value="<?php echo $ma['CodMateria']?>"><?php echo $ma['Nombre']?></option>
		<?php }?>
    </select>
	<input type="submit" id="guardar" class="btn btn-success" value="<?php echo $idioma['Añadir']?> >>"/>
	<?php 
}
?>
<script type="text/javascript">
var DeseaEliminarMateria="<?php echo $idioma['DeseaEliminarMateria']?>";
</script>