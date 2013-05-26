<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$CodCurso=$_POST['CodCurso'];
	$CodMateria=$_POST['CodMateria'];
	$CodDocente=$_SESSION['CodDocente'];
	$Sexo=$_SESSION['SexoAlumno'];
	include_once("../../class/alumno.php");
	include_once("../../class/docentemateriacurso.php");
	$alumnos=new alumno;
	$docmateriacurso=new docentemateriacurso;
	$dmc=$docmateriacurso->mostrarDocenteMateriaCurso($CodDocente,$CodMateria,$CodCurso);
	$dmc=array_shift($dmc);
	$Sexo=$dmc['SexoAlumno'];
	foreach($alumnos->mostrarAlumnosCurso($CodCurso,$Sexo) as $al){
		?>
        <option value="<?php echo $al['CodAlumno'];?>"><?php echo capitalizar($al['Paterno']);?> <?php echo capitalizar($al['Materno']);?> <?php echo capitalizar($al['Nombres']);?></option>
    <?php
	}
}
?>