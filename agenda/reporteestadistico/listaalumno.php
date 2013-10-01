<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$CodCurso=$_POST['CodCurso'];


	$Sexo=$_SESSION['SexoAlumno'];
	include_once("../../class/alumno.php");
	include_once("../../class/docentemateriacurso.php");
	$alumnos=new alumno;
	?><option value=""><?php echo $idioma['Seleccionar']?></option><?php
	foreach($alumnos->mostrarAlumnosCurso($CodCurso,"2") as $al){
		?>
        <option value="<?php echo $al['CodAlumno'];?>"><?php echo capitalizar($al['Paterno']);?> <?php echo capitalizar($al['Materno']);?> <?php echo capitalizar($al['Nombres']);?></option>
    <?php
	}
}
?>