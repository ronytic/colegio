<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NTodosLosBecados";
include_once("../../cabecerahtml.php");
//header("Location:../../impresion/reporte/becadostotal.php");
?>
<script language="javascript" type="text/javascript" src="../../js/reporte/becadostotal.js"></script>
<?php include_once("../../cabecera.php");?>
<div class="box span3">
	<div class="box-header"><h2><i class="icon-cog"></i><span class="break"></span><?php echo $idioma['Configuracion']?></h2></div>
    <div class="box-content">
	<input type="button" class="btn btn-success" value="<?php echo $idioma['VerReporte']?>" id="ver">
    </div>
</div>
<div class="box span9">
	<div class="box-header"><h2><i class="icon-file"></i><span class="break"></span><?php echo $idioma['Reporte']?></h2></div>
    <div class="box-content" id="contenidoreporte"></div>
</div>
<?php include_once("../../pie.php");?>