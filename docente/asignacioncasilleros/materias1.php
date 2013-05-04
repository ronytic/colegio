<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/cursomateria.php");
	include_once("../../class/materias.php");
	$cursomateria=new cursomateria;
	$materias=new materias;
	$CodCurso=$_POST['CodCurso'];
	foreach($cursomateria->mostrarMaterias($CodCurso) as $curm){
		$ma=array_shift($materias->mostrarMateria($curm['CodMateria']));
		?>
		<option value="<?php echo $curm['CodMateria']?>"><?php echo $ma['Nombre']?></option>
        <?php
	}
}
?>