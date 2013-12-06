<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="HabilitarReforzamiento";
?>
<?php include_once($folder."cabecerahtml.php");?>
<?php include_once($folder."cabecera.php");?>
<div class="span4 box">
    <div class="box-header"><h2><i class="icon-cog"></i><span class="break"></span><?php echo $idioma['Configuracion']?></h2></div>
    <div class="box-content">
    <form class="formulario" action="generar.php">
    	<div class="alert alert-error"><?php echo $idioma['GenerarReforzamiento']?></div>
    	<input type="submit" value="<?php echo $idioma['Generar']?>" class="btn btn-success">
    </form>
    </div>
</div>
<div class="span8 box">
	<div class="box-header"><h2><?php echo $idioma['Resultado']?></h2></div>
    <div class="box-content" id="respuestaformulario">
    	
    </div>
</div>
</div>
<?php include_once($folder."pie.php");?>