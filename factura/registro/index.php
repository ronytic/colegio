<?php
include_once("../../login/check.php");
$titulo="RegistrarFactura";
$folder="../../";
include_once($folder."cabecerahtml.php");
?>
<script language="javascript" type="text/javascript">
	$(document).ready(function(e) {
		var l=1;
		$.post("registro.php",{"l":l},function(data){
			$("#senal").before(data);
		});
    });
</script>
<style type="text/css">
	th{vertical-align:top !important;}
</style>
<?php include_once($folder."cabecera.php");?>
<div class="span12 box">
	<div class="box-header"><h2><?php echo $idioma['RegistrarFactura']?></h2></div>
    <div class="box-content">
    	<table class="table table-bordered">
        	<thead>
        		<tr>
                	<th><?php echo $idioma['Fecha']?>:<br><input type="text" class="fecha"></th>
                	<th><?php echo $idioma['NFactura']?>: <br><input type="text" class=""></th>
                    <th><?php echo $idioma['NReferencia']?>: <br><input type="text" class="" readonly></th>
                </tr>
                <tr>
                	<th><?php echo $idioma['Alumno']?>:<br>
                    <input type="text" id="" readonly>
                    <br><a class="btn btn-info btn-mini buscar"><i class="icon-search icon-white"></i> <?php echo $idioma['Buscar']?></a></th>
                	<th><?php echo $idioma['Nit']?>: <br><input type="text" class=""></th>
                    <th><?php echo $idioma['Senores']?>: <br><input type="text" class="" readonly></th>
                    
                </tr>
            </thead>

        </table>
    	<table class="table table-bordered table-hover table-condensed">
        	<thead>
            	<tr><th>N</th><th><?php echo $idioma['Alumno']?></th><th><?php echo $idioma['Cuota']?></th><th><?php echo $idioma['MontoCuota']?></th><th><?php echo $idioma['ImporteCobrado']?></th><th><?php echo $idioma['Interes']?></th><th><?php echo $idioma['Descuento']?></th><th><?php echo $idioma['Total']?></th></tr>
            </thead>
            <tr id="senal">
            	<td class="resaltar der" colspan="7"><?php echo $idioma['Total']?>: </td><td><input type="text" name="total" readonly size="8" class="input-small"></td>
            </tr>
            <tr>
            	<td class="resaltar der" colspan="7"><?php echo $idioma['TotalDescuento']?>: </td><td><input type="text" name="total" readonly class="input-small"></td>
            </tr>
            <tr>
            	<td class="resaltar der" colspan="7"><?php echo $idioma['TotalInteres']?>: </td><td><input type="text" name="total" readonly class="input-small"></td>
            </tr>
            <tr>
            	<td class="resaltar der" colspan="7"><?php echo $idioma['TotalBs']?>: </td><td><input type="text" name="total" readonly class="input-small"></td>
            </tr>
        </table>
        
    </div>
</div>
<?php include_once($folder."pie.php");?>