<?php
include_once("../../login/check.php");
$titulo="NAlumnosNoReinscritos";
$folder="../../";
include_once($folder."cabecerahtml.php");
$url="../../impresion/reporte/noreinscritos.php";
?>
<?php
include_once($folder."cabecera.php");
?>
<div class="span12 box">
	<div class="box-header"><?php echo $idioma['Reporte']?></div>
    <div class="box-content">
	<a href="<?php echo $url?>" class="btn btn-danger" target="_blank"><?php echo $idioma['AbrirOtraVentana']?></a>    
    <hr>
    <iframe width="100%" height="850" src="<?php echo $url?>"></iframe>
    </div>
</div>

<?php include_once($folder."pie.php");?>
