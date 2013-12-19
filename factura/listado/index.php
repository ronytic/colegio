<?php
include_once("../../login/check.php");
$titulo="ListadoFacturas";
$folder="../../";
include_once("../../class/factura.php");
$factura=new factura;
include_once($folder."cabecerahtml.php");
?>
<script language="javascript" type="text/javascript">
$.post("listado.php",{},function(data){
	$("#respuestalistado").html(data)
	});
</script>
<?php include_once($folder."cabecera.php");?>
<div class="span12 box">
	<div class="box-header"><h2><?php echo $idioma['ListadoFacturas']?></h2></div>
    <div class="box-content" id="respuestalistado">
    	
    </div>
</div>
<?php include_once($folder."pie.php");?>