<?php
include_once("../../login/check.php");
$titulo="HojaCasilleros";
$folder="../../";
include_once("../../cabecerahtml.php");
?>
<?php include_once("../../cabecera.php");?>
<div class="box span12">
	<div class="box-header"><h2><i class="icon-file"></i><span class="break"></span><?php echo $idioma['Configuracion']?></h2></div>
    <div class="box-content">
    	<a href="<?php echo $folder;?>documentos/Planilla de requerimiento de datos.docx" class="btn btn-success"><?php echo $idioma['DescargarHojaCasilleros']?></a>
    </div>
</div>
<?php include_once("../../pie.php");?>