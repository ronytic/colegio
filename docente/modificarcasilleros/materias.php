<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/docentemateriacurso.php");
	include_once("../../class/materias.php");
	$docentemateriacurso=new docentemateriacurso;
	$materias=new materias;
	$CodCurso=$_POST['CodCurso'];
	$CodDocente=$_POST['CodDocente'];
	foreach($docentemateriacurso->mostrarDocenteCurso($CodDocente,$CodCurso) as $curm){
		$ma=array_shift($materias->mostrarMateria($curm['CodMateria']));
		?>
		<option value="<?php echo $curm['CodMateria']?>"><?php echo $ma['Nombre']?></option>
        <?php
	}
}
?>