<?php
include_once("../../login/check.php");
$titulo="NListadoFacturas";
$folder="../../";
include_once("../../class/factura.php");
$factura=new factura;
include_once($folder."cabecerahtml.php");
?>
<script language="javascript" type="text/javascript" src="../../js/factura/listado.js"></script>
<script language="javascript">
var SeguroCambiarEstado="<?php echo $idioma['SeguroCambiarEstado']?>";
</script>
<?php include_once($folder."cabecera.php");?>
<div class="span12 box">
	<div class="box-header"><h2><?php echo $idioma['Configuracion']?></h2></div>
    <div class="box-content">
    	<form class="formulario" action="listado.php" method="post">
        <table class="table table-bordered">
            <thead>
            	<tr>
                	<th><?php echo $idioma['FechaFactura']?></th>
                    <th><?php echo $idioma['NFactura']?></th>
                    <th><?php echo $idioma['Nit']?></th>
                    <th><?php echo $idioma['Factura']?></th>
                    <th><?php echo $idioma['Estado']?></th>
                    <th><?php echo $idioma['Tipo']?></th>
                </tr>
            </thead>
        	<tr>
            	<td><?php echo $idioma['Inicio']?>: 
                <input type="text" name="FechaFacturaInicio" value="<?php echo fecha2Str();?>" class="fecha input-small"><br>
				<?php echo $idioma['Final']?>: 
                <input type="text" name="FechaFacturaFin" value="<?php echo fecha2Str();?>" class="fecha input-small"></td>
                <td><input type="text" name="NFactura" id="fecha" value="" placeholder=""  class="span12"></td>
                <td><input type="text" name="Nit" id="fecha" value="" placeholder="" class="span12"></td>
                <td><input type="text" name="Factura" id="fecha" value="" placeholder="" class="span12"></td>
                <td>
                	<select name="Estado" class="span12">
                    	<option value=""><?php echo $idioma['Seleccionar']?></option>
                        <option value="Valido"><?php echo $idioma['Valido']?></option>
                        <option value="Anulado"><?php echo $idioma['Anulado']?></option>
                    </select>
                	<?php ?>
                </td>
                <td>
                	<select name="Tipo" class="span12">
                    	<option value=""><?php echo $idioma['Seleccionar']?></option>
                        <option value="General"><?php echo $idioma['General']?></option>
                        <option value="Personalizado"><?php echo $idioma['Personalizado']?></option>
                    </select>
                	<?php ?>
                </td>
            </tr>
            <tr>
            	<td colspan="6"><input type="submit" value="<?php echo $idioma['VerReporte']?>" class="btn btn-success">
                </td>
            </tr>
        </table>
    	
        </form>
    </div>
	<div class="box-header"><h2><?php echo $idioma['ListadoFacturas']?></h2></div>
    <div class="box-content" id="respuestaformulario">
    	
    </div>
</div>
<?php include_once($folder."pie.php");?>