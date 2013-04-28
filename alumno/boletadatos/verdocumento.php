<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$CodAlumno=$_POST['CodAlumno'];
	?>
    	<strong><?php echo $idioma['ReporteImpresion'];?></strong>
     	<iframe src="../../impresion/alumno/boletadatos.php?CodAlumno=<?php echo $CodAlumno;?>" height="400" width="100%" name="pdf"></iframe>
	<?php	
}
?>