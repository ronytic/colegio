<?php
include_once("../../login/check.php");
$FechaInicio=$_GET['FechaInicio'];
$FechaFinal=$_GET['FechaFinal'];
include_once("../../class/factura.php");
include_once("../../class/alumno.php");
include_once("../../class/curso.php");
include_once("../../factura/codigocontrol.class.php");
$factura=new factura;
$fac=$factura->mostrarFacturas("(FechaFactura BETWEEN '$FechaInicio' and '$FechaFinal') and Estado='Valido'");
$alumno=new alumno;
$curso=new curso;
$titulo="NVerificarCodigosControl";
$folder="../../";
include_once($folder."cabecerahtml.php");
?>
<script language="javascript" src="../../js/factura/revisarcodigo.js"></script>
<?php include_once($folder."cabecera.php");?>
<div class="span12 box">
    <div class="box-header"><h2><?php echo $idioma['Configuracion']?></h2></div>
    <div class="box-content">
    	<form action="mostrar.php" method="post" class="formulario">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><?php echo $idioma['FechaFactura']?></th>
                    <th><?php echo $idioma['Estado']?></th>
                </tr>
            </thead>
            <tr>
                <td><?php echo $idioma['Desde']?>: 
                    <input type="text" name="FechaFacturaInicio" value="<?php echo fecha2Str();?>" class="fecha input-small"><br>
                    <?php echo $idioma['Hasta']?>: 
                    <input type="text" name="FechaFacturaFin" value="<?php echo fecha2Str();?>" class="fecha input-small">
                </td>
                <td>
                    <select name="Tipo" class="span12">
                        <option value=""><?php echo $idioma['Seleccionar']?></option>
                        <option value="Correctos"><?php echo $idioma['Correctos']?></option>
                        <option value="Incorrectos"><?php echo $idioma['Incorrectos']?></option>
                    </select>
                </td>
            </tr>
            <tr>
            	<td colspan="2"><input type="submit" value="<?php echo $idioma['VerReporte']?>" class="btn btn-success"></td>
            </tr>
        </table>
        </form>
    </div>
	<div class="box-header"><h2><?php echo $idioma['ListadoFacturas']?></h2></div>
    <div class="box-content" id="respuestaformulario">
    	
    </div>
</div>
<?php include_once($folder."pie.php");?>