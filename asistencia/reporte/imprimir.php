<?php
include_once("../../login/check.php");
if(!empty($_GET)){
	extract($_GET);
	
	
	//http://localhost/colegio/asistencia/reporte/imprimir.php?FechaInicio=17-07-2013&FechaFin=17-07-2013&CodCurso=Todo&CodAlumno=&TipoObservacion=Todos
	$url="../../impresion/asistencia/reporte.php"."?FechaInicio=$FechaInicio&FechaFin=$FechaFin&CodCurso=$CodCurso&CodAlumno=$CodAlumno&TipoObservacion=$TipoObservacion";
	?>
    <a class="btn btn-danger" href="<?php echo $url?>" target="_blank"><?php echo $idioma['AbrirOtraVentana']?></a><hr>
    <iframe width="100%" height="650" src="<?php echo $url?>"></iframe>
    <?php	
}
?>