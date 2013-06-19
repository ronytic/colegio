<?php
include_once("../login/check.php");
if(!empty($_POST) && isset($_POST)){
	$CodCurso=$_POST['CodCurso'];
	if(isset($_POST['CodAlumno'])){
		$CodAlumno=$_POST['CodAlumno'];
	}
	include_once("../class/tmp_alumno.php");
	$tmp_alumno=new tmp_alumno;
	/*?><option></option><?php*/
	foreach($tmp_alumno->mostrarDatosAlumnos($CodCurso,0) as $al){
		?><option value="<?php echo $al['CodAlumno']?>" <?php echo $al['CodAlumno']==$CodAlumno?'selected="selected"':'';?> ><?php echo ucwords(eliminarEspaciosDobles($al['Paterno']));?> <?php echo ucwords(eliminarEspaciosDobles($al['Materno']));?> <?php echo ucwords(eliminarEspaciosDobles($al['Nombres']));?></option> <?php
	}
}
?>
