<?php
include_once("../../login/check.php");
if(!empty($_POST)){
extract($_POST);
$url="?FechaInicio=$FechaInicio&FechaFin=$FechaFin&CodCurso=$CodCurso&CodAlumno=$CodAlumno&TipoObservacion=$TipoObservacion";
//echo $url;
?>
<a href="reporte.php<?php echo $url?>" class="btn btn-info enlace" id="reporte"><?php echo $idioma['VerReporte']?></a>
<a href="imprimir.php<?php echo $url?>" class="btn btn-alert enlace"><?php echo $idioma['ReporteImprimir']?></a>
<hr>
<div id="respuesta" name></div>
<?php	
}
?>