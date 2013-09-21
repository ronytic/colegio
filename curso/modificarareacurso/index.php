<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NModificarAreaCurso";

include_once($folder."cabecerahtml.php");
?>
<script language="javascript" type="text/javascript" src="../../js/curso/modificarcursoarea.js"></script>
<script language="javascript">
var MensajeEliminar="<?php echo htmlspecialchars($idioma['MensajeEliminarCursoArea'])?>";
var MensajeModificar="<?php echo htmlspecialchars($idioma['MensajeModificarCursoArea'])?>";
</script>
<?php include_once($folder."cabecera.php");?>
<div class="span8 box">
	<div class="box-header"><h2><?php echo $idioma['ListadoAreaCursos']?></h2></div>
    <div class="box-content" id="listadocursos">
    
    </div>
</div>
<div class="span4 box">
	<div class="box-header"><h2><?php echo $idioma['Configuracion']?></h2></div>
    <div class="box-content">
    	<a href="#" class="btn btn-info" id="nuevo"><?php echo $idioma['NuevaAreaCurso']?></a><hr>
    	<div id="respuestaformulario" class="configuracion">
        
        </div>
    </div>
</div>
<?php include_once($folder."pie.php");?>