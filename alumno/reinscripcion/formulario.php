<?php
include_once("../../login/check.php");
if(isset($_POST)){
	$CodAlumno=$_POST['CodAlumno'];
	include_once("../../class/tmp_alumno.php");
	$tmp_alumno=new tmp_alumno;
	$al=$tmp_alumno->mostrarDatosPersonales($CodAlumno,2);
	$al=array_shift($al);
	if(count($al)){
	?>
    <?php echo $idioma['DatosAlumno']?>:<br>
    <strong><?php echo capitalizar($al['Paterno'])?> <?php echo capitalizar($al['Materno'])?> <?php echo capitalizar($al['Nombres'])?></strong>
    <hr>
    <a href="inscribir.php?CodAlumno=<?php echo $CodAlumno?>" class="btn btn-success" id="inscribir"><?php echo $idioma['ReInscribirAlumno']?></a>
    <?php
	}else{?>
		<strong><?php echo $idioma['NoExisteAlumnos']?></strong>
	<?php
	}
}
?>