<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$CodAlumno=$_POST['CodAlumno'];
	$CodCurso=$_POST['CodCurso'];	
	$_SESSION['CodAl']=$CodAlumno;
	?>
    <form action="agenda.php" method="get">
    	
    	<input type="submit" value="Revisar Alumno" class="corner-all"/>
    </form>
    <?php
}
?>