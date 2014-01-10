<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NRegistrosEnEspera";
include_once($folder."cabecerahtml.php");
?>
<script language="javascript" type="text/javascript" src="../../js/rude/espera.js"></script>
<?php include_once($folder."cabecera.php");?>
    <div class="span12 box">
        <div class="box-header"><h2><?php echo $idioma['Configuracion']?></h2></div>
        <div class="box-content">
        	<form action="ver.php" method="post" class="formulario">
        	<table class="table table-bordered">
            	<tr>
                    <td><?php echo $idioma['Fecha']?>:
                    	<input type="text" name="Fecha" value="<?php echo fecha2Str()?>">
                    </td>
                    <td><?php echo $idioma['Estado'];?>
                    	<select name="Estado">
                        	<option value=""><?php echo $idioma['Seleccionar']?></option>
                        	<option value="Espera"><?php echo $idioma['Espera']?></option>
                            <option value="Proceso"><?php echo $idioma['Proceso']?></option>
                        </select>
                    </td>
            		<td><input type="submit" class="btn" value="<?php echo $idioma['Ver']?>" id="ver"></td>
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