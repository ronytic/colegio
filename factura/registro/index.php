<?php
include_once("../../login/check.php");
$titulo="RegistrarFactura";
$folder="../../";
include_once($folder."cabecerahtml.php");
?>
<script language="javascript" type="text/javascript" src="../../js/factura/registro.js"></script>
<script language="javascript" type="text/javascript" src="../../js/core/plugins/jquery.alphanumeric.pack.js"></script>
<script language="javascript" type="text/javascript">
var MensajeEliminarRegistro="<?php echo $idioma['MensajeEliminarRegistro']?>";
var EstaSeguroRegistrarFactura="<?php echo $idioma['EstaSeguroRegistrarFactura']?>";
</script>
<style type="text/css">
	th{vertical-align:top !important;}
</style>
<?php include_once($folder."cabecera.php");?>
<div class="span12 box">
	<div class="box-header"><h2><?php echo $idioma['RegistrarFactura']?></h2></div>
    <div class="box-content">
    <form action="guardar.php" method="post" id="formulario">
    	<table class="table table-bordered">
        	<thead>
        		<tr>
                	<th><?php echo $idioma['Fecha']?>:<br><input type="text" class="fecha" name="FechaFactura" value="<?php echo fecha2Str()?>"></th>
                	<th><?php echo $idioma['NFactura']?>: <br><input type="text" class="" name="NFactura"></th>
                    <th><?php echo $idioma['NReferencia']?>: <br><input type="text" class="" name="NReferencia" readonly></th>
                </tr>
                <tr>
                	<th><?php echo $idioma['Alumno']?>:<br>
                    <input type="hidden" id="" readonly name="CodAlumno">
                    <input type="text" id="" readonly name="FacturaAlumno">
                    <br><a class="btn btn-info btn-mini buscar" rel="BusquedaNit"><i class="icon-search icon-white"></i> <?php echo $idioma['Buscar']?></a></th>
                	<th><?php echo $idioma['Nit']?>: <br><input type="text" class="" name="Nit"></th>
                    <th><?php echo $idioma['Senores']?>: <br><input type="text" class="" name="Factura"></th>
                    
                </tr>
            </thead>

        </table>
    	<table class="table table-bordered table-hover table-condensed">
        	<thead>
            	<tr><th>N</th><th><?php echo $idioma['Alumno']?></th><th><?php echo $idioma['Cuota']?></th><th><?php echo $idioma['MontoCuota']?></th><th><?php echo $idioma['ImporteCobrado']?></th><th><?php echo $idioma['Interes']?></th><th><?php echo $idioma['Descuento']?></th><th><?php echo $idioma['Total']?></th><th></th></tr>
            </thead>
            <tr id="senal"><td><a class="btn btn-mini add-on aumentar" title="<?php echo $idioma['Aumentar']?>"><i class="icon-plus"></i></a></td>
            	<td class="resaltar der" colspan="6"><?php echo $idioma['TotalDescuento']?>: </td><td><input type="text" name="TotalDescuento" readonly class="input-small der TotalDescuento" value="0.00"></td><td></td>
            </tr>
            <tr>
            	<td colspan="4" class="resaltar" rowspan="4"><br><?php echo $idioma['Observacion']?>:<br><textarea name="Observacion" class="span12" rows="5"></textarea></td><td class="resaltar der" colspan="3"><?php echo $idioma['TotalInteres']?>: </td><td><input type="text" name="TotalInteres" readonly class="input-small der TotalInteres" value="0.00"></td><td></td>
            </tr>
            <tr class="success">
            	<td class="resaltar der" colspan="3"><?php echo $idioma['TotalBs']?>: </td><td><input type="text" name="TotalBs" readonly class="input-small der TotalBs" value="0.00"></td><td></td>
            </tr>
            <tr class="info">
            	<td class="resaltar der" colspan="3"><?php echo $idioma['Cancelado']?>: </td><td><input type="text" name="Cancelado"  class="input-small der Cancelado" value="0.00"></td><td></td>
            </tr>
            <tr class="warning">
            	<td class="resaltar der" colspan="3"><?php echo $idioma['MontoDevuelto']?>: </td><td><input type="text" name="MontoDevuelto" readonly class="input-small der MontoDevuelto" value="0.00"></td><td></td>
            </tr>
            <tr><td class="centrar" colspan="8"><input type="submit" class="btn btn-success" value="<?php echo $idioma['Guardar']?>"></td></tr>
        </table>
        </form>
    </div>
</div>
<div class="modal hide fade"><!-- hide fade-->
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3><?php echo $idioma['SeleccionarAlumno']?></h3>
  </div>
  <div class="modal-body">
    <?php include_once("../../listar/listadodecurso.php");?>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" id="cerrar"><?php echo $idioma['Cerrar']?></a>
    <a href="#" class="btn btn-primary" id="seleccionar"><?php echo $idioma['SeleccionarAlumno']?></a>
  </div>
</div>
<?php include_once($folder."pie.php");?>