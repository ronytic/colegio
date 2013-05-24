<?php
include_once("../../login/check.php");
if(isset($_POST)){
	$CodAlumno=$_POST['CodAlumno'];
	include_once("../../class/alumno.php");
	$alumno=new alumno;
	$al=$alumno->mostrarDatosPersonales($CodAlumno);
	$al=array_shift($al);
	?>
    <?php echo $idioma['DatosAlumno']?>:<br>
    <strong><?php echo capitalizar($al['Paterno'])?> <?php echo capitalizar($al['Materno'])?> <?php echo capitalizar($al['Nombres'])?></strong>
    <hr>
    <a href="inscribir.php?CodAlumno=<?php echo $CodAlumno?>" class="btn btn-success" id="inscribir"><?php echo $idioma['InscribirHermano']?></a>
    <?php
}
?>