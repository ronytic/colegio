<?php
include_once("../../login/check.php");
$titulo="NRevisarAgendaCodigo";
$folder="../../";
?>
<?php include_once($folder."cabecerahtml.php");?>
<script language="javascript" type="text/javascript" src="../../js/agenda/buscarcodigo.js"></script>
<script language="javascript">
$(document).ready(function(e) {
	$("#Codigo").val("").focus();
});
</script>
<?php include_once($folder."cabecera.php");?>
<div class="span12 box">
	<div class="box-header"><h2><i class="icon-barcode"></i><span class="break"></span><?php echo $idioma['IngresarCodigoBarra']?></h2></div>
	<div class="box-content">
		<form action="revisarCodigo.php" method="post" id="formrevisar">
			<label for="Codigo"><?php echo $idioma['IngresarCodigoBarra']?></label>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-barcode"></i></span>
					<input type="text" name="Codigo" id="Codigo" autofocus placeholder="<?php echo $idioma['CodigoBarra']?>" value=""  class="span12"/>
				</div>
			</div>
			<input type="submit" value="<?php echo $idioma['Revisar']?>" class="btn btn-success"/>
		</form>
	</div>
</div>  
<?php include_once($folder."pie.php");?>