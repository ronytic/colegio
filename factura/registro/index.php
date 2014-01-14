<?php
include_once("../../login/check.php");
$titulo="RegistrarFactura";
$folder="../../";
include_once("../../class/config.php");
include_once("../../class/factura.php");
$factura=new factura;
$config=new config;
$FechaLimiteEmision=$config->mostrarConfig("FechaLimiteEmision",1);
$estado=$factura->statusTable();
$NReferencia=$estado['Auto_increment'];
$f=$factura->mostrarNumeroFactura("");
$f=array_shift($f);
$NFactura=$f['NFactura']+1;
$CodAlumno=$_GET['CodAlumno'];
$dividido=explode("/",$CodAlumno);
$contardividido=count($dividido);
$codigosalumnos=array();
if($contardividido>1){
	$CodAlumno=$dividido[0];
	
	for($i=1;$i<$contardividido;$i++){
		if($dividido[$i]!=""){
			array_push($codigosalumnos,'"'.$dividido[$i].'"');
		}
	}
}

include_once($folder."cabecerahtml.php");
?>
<script language="javascript" type="text/javascript" src="../../js/factura/registro.js"></script>
<script language="javascript" type="text/javascript" src="../../js/core/plugins/jquery.alphanumeric.pack.js"></script>
<script language="javascript" type="text/javascript">
var MensajeEliminarRegistro="<?php echo $idioma['MensajeEliminarRegistro']?>";
var EstaSeguroRegistrarFactura="<?php echo $idioma['EstaSeguroRegistrarFactura']?>";
var NFacturaDuplicado="<?php echo $idioma['NFacturaDuplicado']?>";
var CodAlumno="<?php echo $CodAlumno?>";
var CodigosAlumnos=new Array(<?php echo implode(",",$codigosalumnos)?>);
var ContarAlumnos=<?php echo $contardividido-1?>;
</script>
<style type="text/css">
	th{vertical-align:top !important;}
	.derecha{
		text-align:right;	
	}
</style>
<?php include_once($folder."cabecera.php");?>
<div class="span12 box">
	<div class="box-header"><h2><?php echo $idioma['RegistrarFactura']?> </h2></div>
    <div class="box-content">
    <?php if($_GET['f']==1){?>
    <div class="alert alert-error"><?php echo $idioma['NFacturaDuplicado']?></div>
    <?php }?>
    <form action="guardar.php" method="post" id="formulario">
    	<table class="table table-bordered inicio">
        	<thead>
        		<tr>
                	<th><?php echo $idioma['Fecha']?>:<br><input type="text" class="fecha" name="FechaFactura" value="<?php echo fecha2Str()?>" required></th>
                	<th><?php echo $idioma['NFactura']?>: <br><input type="text" class="derecha NFactura" name="NFactura" value="<?php echo $_GET['f']==1?$_GET['NFactura']:$NFactura?>" required></th>
                    <th><?php echo $idioma['NReferencia']?>: <br><input type="text" class="derecha" name="NReferencia" readonly value="<?php echo $NReferencia?>" required></th>
                </tr>
                <tr>
                	<th><?php echo $idioma['Alumno']?>:<br>
                    <input type="hidden" id="" readonly name="CodAlumno">
                    <input type="text" id="" readonly name="FacturaAlumno">
                    <br><a class="btn btn-info btn-mini buscar" rel="BusquedaNit"><i class="icon-search icon-white"></i> <?php echo $idioma['Buscar']?></a></th>
                	<th><?php echo $idioma['Nit']?>: <br><input type="text" class="" name="Nit" required></th>
                    <th><?php echo $idioma['Senores']?>: <br><input type="text" class="" name="NombreFactura" required value=""></th>
                    
                </tr>
            </thead>

        </table>
    	<table class="table table-bordered table-hover table-condensed inicio">
        	<thead>
            	<tr><th>N</th><th><?php echo $idioma['Alumno']?></th><th><?php echo $idioma['Cuota']?></th><th><?php echo $idioma['MontoCuota']?></th><th><?php echo $idioma['ImporteCobrado']?></th><th><?php echo $idioma['Interes']?></th><th><?php echo $idioma['Descuento']?></th><th><?php echo $idioma['Total']?></th><th></th></tr>
            </thead>
            <tr id="senal"><td><a class="btn btn-mini add-on aumentar" title="<?php echo $idioma['Aumentar']?>"><i class="icon-plus"></i></a></td>
            	<td class="resaltar der" colspan="6"><?php echo $idioma['TotalDescuento']?>: </td><td><input type="text" name="TotalDescuento" readonly class="input-small der TotalDescuento" value="0.00"></td><td></td>
            </tr>
            <tr>
            	<td colspan="4" class="resaltar" rowspan="4"><br><?php echo $idioma['Observacion']?>:<br><textarea name="Observacion" class="span12" rows="5"></textarea>
                <?php echo $idioma['FechaLimiteEmision']?>: <?php echo fecha2Str($FechaLimiteEmision)?>
                <?php if($FechaLimiteEmision<=date("Y-m-d")){?><div class="alert alert-error"><?php echo $idioma['FechaLimiteEmisionVencida']?></div><?php }?>
                </td><td class="resaltar der" colspan="3"><?php echo $idioma['TotalInteres']?>: </td><td><input type="text" name="TotalInteres" readonly class="input-small der TotalInteres" value="0.00"></td><td></td>
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
            <tr><td class="centrar" colspan="8"> <a href="./" class="btn btn-mini"><?php echo $idioma['Cancelar']?></a>  <input type="submit" class="btn btn-success" id="Guardar" value="<?php echo $idioma['Guardar']?>" disabled></td></tr>
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