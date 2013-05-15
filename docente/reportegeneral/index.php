<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="ReporteGeneral";
include_once("../../cabecerahtml.php");
?>
<script language="javascript" src="../../js/docente/reporte.js"></script>
<?php include_once("../../cabecera.php");?>
<div class="span12">
	<div class="span3 box">
    	<div class="box-header"><h2><i class="icon-cog"></i><span class="break"></span><?php echo $idioma['Configuracion']?></h2></div>
        <div class="box-content">
        	
        	<select class="span12" id="listado" name="listado">
	            <option value="DatosPersonales"><?php echo $idioma['DatosPersonales']?></option>
            	<option value="DatosFormacionProfesional"><?php echo $idioma['DatosFormacionProfesional']?></option>
            	<option value="DatosTrabajo"><?php echo $idioma['DatosTrabajo']?></option>
            </select>
        	<input type="button" class="btn btn-success span12" value="<?php echo $idioma['ReporteGeneral']?>" id="reporte"><br><br>
            <input type="button" class="btn span12" value="<?php echo $idioma['ReporteGeneralImpresion']?>" id="reporteimpresion">
        </div>
    </div>
    <div class="span9 box">
    	<div class="box-header"><h2><i class="icon-file"></i><span class="break"></span><?php echo $idioma['Reporte']?></h2></div>
        <div class="box-content" id="respuesta"></div>
    </div>
</div>
<?php include_once("../../pie.php");?>
