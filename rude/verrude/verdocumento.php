<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$CodAlumno=$_POST['CodAlumno'];
	?>
    	<strong><?php echo $idioma['ReporteImpresion']?></strong>
     	<iframe src="../../impresion/rude/verrude.php?CodAlumno=<?php echo $CodAlumno;?>" height="600" width="100%" name="pdf" ></iframe>
	<?php	
}
?>