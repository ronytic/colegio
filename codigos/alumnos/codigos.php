<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$CodCurso=$_POST['CodCurso'];
	$CodAlumno=$_POST['CodAlumno'];
	$urlc="curso.php?CodCurso=".$CodCurso;
	$urla="alumnos.php?CodAlumno=".$CodAlumno;
	?>
    <?php echo $idioma['CodigosBarraCurso']?> - <a href="<?php echo $urlc?>" class="btn btn-danger" target="_blank"><?php echo $idioma['AbrirOtraVentana']?></a><hr>
    <iframe src="<?php echo $urlc?>" width="100%" height="450"></iframe>
    <hr>
    <?php echo $idioma['CodigosBarraAlumno']?> - <a href="<?php echo $urla?>" class="btn btn-danger" target="_blank"><?php echo $idioma['AbrirOtraVentana']?></a><hr>
    <iframe src="<?php echo $urla?>" width="100%" height="450"></iframe>
    <?php	
}
?>