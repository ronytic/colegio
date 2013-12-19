<?php
include_once("../../login/check.php");
$titulo="VerFactura";
$folder="../../";
$url="../../impresion/factura/factura3.php?f=".$_GET['f'];

include_once($folder."cabecerahtml.php");
?>
<?php include_once($folder."cabecera.php");?>
<div class="span12 box">
    <div class="box-content">
    	<a href="<?php echo $url?>" target="_blank" class="btn btn-danger"><?php echo $idioma['AbrirOtraVentana']?></a><hr>
	    <iframe src="<?php echo $url?>" width="100%" height="700"></iframe>
    </div>
</div>
<?php include_once($folder."pie.php");?>