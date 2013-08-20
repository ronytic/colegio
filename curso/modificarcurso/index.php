<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NModificarCurso";

include_once($folder."cabecerahtml.php");
?>
<script language="javascript" type="text/javascript" src="../../js/curso/modificar.js"></script>
<script language="javascript">
var MensajeEliminar="<?php echo htmlspecialchars($idioma['MensajeEliminar'])?>";
var NotaEliminar="<?php echo htmlspecialchars($idioma['NotaEliminar'])?>";
var MensajeModificar="<?php echo htmlspecialchars($idioma['MensajeModificar'])?>";
var NotaModificar="<?php echo htmlspecialchars($idioma['NotaModificar'])?>";
</script>
<?php include_once($folder."cabecera.php");?>
<div class="span8 box">
	<div class="box-header"><h2><?php echo $idioma['ListadoCursos']?></h2></div>
    <div class="box-content" id="listadocursos">
    
    </div>
</div>
<div class="span4 box">
	<div class="box-header"><h2><?php echo $idioma['Configuracion']?></h2></div>
    <div class="box-content">
    	<a href="#" class="btn btn-info" id="nuevo"><?php echo $idioma['NuevoCurso']?></a><hr>
    	<div id="respuestaformulario" class="configuracion">
        
        </div>
    </div>
</div>
<?php include_once($folder."pie.php");?>