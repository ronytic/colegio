<?php
include_once("../../login/check.php");
$titulo="NListadoAlumnosPorPagar";
$folder="../../";
$url="../../impresion/cuotas/porpagar.php";
include_once("../../cabecerahtml.php");
?>
<?php include_once("../../cabecera.php");?>
<div class="span12 box">
	<div class="box-header"><h2><?php echo $idioma['Reporte']?></h2></div>
    <div class="box-content">
    <a href="<?php echo $url?>" class="btn btn-danger" target="_blank"><?php echo $idioma['AbrirOtraVentana']?></a>
    <hr>
    <iframe src="<?php echo $url?>" frameborder="0" width="100%" height="700"></iframe>
    </div>
</div>
<?php include_once("../../pie.php");?>