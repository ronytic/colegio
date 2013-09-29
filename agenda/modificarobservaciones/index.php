<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NModificarObservaciones";

include_once($folder."cabecerahtml.php");
?>
<?php /*<script type="text/javascript" src="../../js/core/plugins/jquery.chosen.min.js" language="javascript"></script> */?>
<script language="javascript" type="text/javascript" src="../../js/agenda/modificarobservacion.js"></script>
<script language="javascript">
var MensajeEliminar="<?php echo htmlspecialchars($idioma['MensajeEliminarObservacion'])?>";
var MensajeModificar="<?php echo htmlspecialchars($idioma['MensajeModificarObservacion'])?>";
</script>
<?php include_once($folder."cabecera.php");?>
<div class="span8 box">
	<div class="box-header"><h2><?php echo $idioma['ListadoObservaciones']?></h2></div>
    <div class="box-content" id="listadocursos">
    
    </div>
</div>
<div class="span4 box">
	<div class="box-header"><h2><?php echo $idioma['Configuracion']?></h2></div>
    <div class="box-content">
    	<a href="#" class="btn btn-info" id="nuevo"><?php echo $idioma['NuevaObservacion']?></a><hr>
    	<div id="respuestaformulario" class="configuracion">
        
        </div>
    </div>
</div>
<?php include_once($folder."pie.php");?>