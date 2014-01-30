<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NEstadisticasAccesos";
include_once($folder."cabecerahtml.php");
?>
<script language="javascript" type="text/javascript" src="../../js/core/plugins/highcharts.js"></script>
<script language="javascript" type="text/javascript" src="../../js/core/plugins/exporting.js"></script>
<script language="javascript" type="text/javascript" src="../../js/seguridad/estadisticasaccesos.js"></script>
<?php include_once($folder."cabecera.php");?>
    <div class="span12 box">
        <div class="box-header"><h2><?php echo $idioma['Configuracion']?></h2></div>
        <div class="box-content">
        	<form action="ver.php" method="post" class="formulario">
        	<table class="table table-bordered">
            	<thead>
                	<tr>
                    	<th><?php echo $idioma['NivelUsuario']?></th>
                        <th><?php echo $idioma['Fecha']?> <?php echo $idioma['Desde']?></th>
                        <th><?php echo $idioma['Fecha']?> <?php echo $idioma['Hasta']?></th>
                        <th></th>
                    </tr>
                </thead>
            	<tr>
                    <td>
                    <select class="span6" name="Nivel">
                    <option value="Todos"><?php echo $idioma['Todos']?></option>
                    <?php if($_SESSION['Nivel']==1){?><option value="1"><?php echo $idioma['Administradores']?></option><?php }?>
                    <option value="2"><?php echo $idioma['Directores']?></option>
                    <option value="3"><?php echo $idioma['Docentes']?></option>
                    <option value="4"><?php echo $idioma['Secretaria']?></option>
                    <option value="5"><?php echo $idioma['Regentes']?></option>
                    <option value="6"><?php echo $idioma['PadresFamilia']?></option>
                    <option value="7"><?php echo $idioma['Alumnos']?></option>
                    </select>
                	</td>
                    <td>
                    	<input type="text" name="FechaInicio" value="<?php echo fecha2Str()?>" class="fecha">
                    </td>
                    <td>
                    	<input type="text" name="FechaFin" value="<?php echo fecha2Str()?>" class="fecha">
                    </td>
            		<td><input type="submit" class="btn btn-success" value="<?php echo $idioma['VerReporte']?>" id="ver"></td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<div class="row-fluid">
	<div class="span12 box">
        <div class="box-header"><h2><?php echo $idioma['Datos']?></h2></div>
        <div class="box-content" id="respuestaformulario"></div>
    </div>
<?php include_once($folder."pie.php");?>