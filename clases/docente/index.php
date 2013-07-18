<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NMisClases";
include_once("../../cabecerahtml.php");
?>
<link href="../../css/clases/estio.css" type="text/css" rel="stylesheet">
<script language="javascript" type="application/javascript" src="../../js/clases/docente.js"></script>
<?php include_once("../../cabecera.php");?>
<div class="span12 box">
	<div class="box-header"><h2><?php echo $idioma['Archivos']?></h2></div>
    <div class="box-content">
    	<div class="row-fluid">
        	<div class="span2">asd</div>
            <div class="span2">asd</div>
            <div class="span2">asd</div>
            <div class="span6">
            <form action="subir.php" enctype="multipart/form-data">
        	<label for="files">Suelte Archivos</label>
            <div style="position:relative">
                <input type="file" id="files" name="files[]" multiple/>
	            <div id="drop_zone">Arrastre los Archivos aquí</div>
            	<div id="list"></div>
            </div>
            <input type="submit" value="Subir" class="btn btn-success">
        </form>
            </div>
        </div>
        
    </div>
</div>
<?php include_once("../../pie.php");?>