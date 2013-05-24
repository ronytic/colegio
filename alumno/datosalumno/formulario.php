<?php
include_once("../../login/check.php");
if(isset($_POST)){
	$CodAlumno=$_POST['CodAlumno'];
?>
<a class="btn" id="reportedatos"><?php echo $idioma['ReporteDatosAlumno']?></a>
<a class="btn btn-info" id="reporteimpresion"><?php echo $idioma['ReporteDatosImpresion']?></a>
<a class="btn btn-success" href="alumno.php?CodAlumno=<?php echo $CodAlumno?>"><?php echo $idioma['ModificarDatos']?></a>
<hr />
<div id="reporte"></div>
<?php	
}
?>