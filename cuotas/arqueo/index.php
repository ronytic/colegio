<?php
include_once("../../login/check.php");
$titulo="Arqueo de Caja";
$folder="../../";
?>
<?php include_once($folder."cabecerahtml.php");?>
<script language="javascript" type="text/javascript" src="../../js/cuotas/arqueo.js"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function(e) {
    
});
</script>
</head>
<body>
<?php include_once($folder."cabecera.php");?>

<div class="box span3">
	<div class="box-header"><h2><i class="icon-cog"></i><span class="break"></span><?php echo $idioma['Configuracion']?></h2></div>
    <div class="box-content">
    	<table class="table table-bordered table-hover table-condensed">
        	<tr class="contenido"><td><?php echo $idioma['Por']?></td><td><select name="Tipo" class="input-small"><option value="Fecha"><?php echo $idioma['Fecha']?></option><option value="Factura"><?php echo $idioma['Factura']?></option></select></td></tr>
        	<tr class="fecha"><td><?php echo $idioma['Desde']?></td><td><input type="text" size="15" name="DesdeFecha" id="DesdeFecha" class="der input-small" value="<?php echo date("d-m-Y")?>"/></td></tr>
            <tr class="fecha"><td><?php echo $idioma['Hasta']?></td><td><input type="text" size="15" name="HastaFecha" id="HastaFecha" value="<?php echo date("d-m-Y")?>" class="der input-small"/></td></tr>
            <tr class="factura oculto"><td><?php echo $idioma['Desde']?></td><td><input type="text" size="15" name="DesdeFactura" id="DesdeFactura" class="der input-small"/></td></tr>
            <tr class="factura oculto"><td><?php echo $idioma['Hasta']?></td><td><input type="text" size="15" name="HastaFactura" id="HastaFactura" value="" class="der input-small"/></td></tr>
            <tr><td></td><td><input type="submit" value="<?php echo $idioma['VerReporte']?>" class="btn btn-success" id="guardar"/></td></tr>
        </table>
    </div>
</div>
<div class="span9 box">
	<div class="box-header"><h2><i class="icon-print"></i><span class="break"></span><?php echo $idioma['Reporte']?></h2></div>
    <div id="resultado" class="box-content"></div>
</div>


<?php include_once($folder."pie.php");?>