<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NRevisarAccesos";
include_once($folder."cabecerahtml.php");
?>
<script language="javascript" type="text/javascript" src="../../js/seguridad/rastreo.js"></script>
<?php include_once($folder."cabecera.php");?>
<div class="span12 box">
	<div class="box-header"><h2><i class="icon-hdd"></i><span class="break"></span><?php echo $idioma['Configuracion']?></h2></div>
    <div class="box-content">
    	<form action="mostrar.php" method="post" class="enviar">
    	<table class="table table-bordered">
        	<thead>
            	<tr><th><?php echo $idioma['TiempoActualizacion']?></th><th><?php echo $idioma['NivelUsuario']?></th><th><?php echo $idioma['Fecha']?></th><th></th></tr>
            </thead>
            <td><input type="number" name="Tiempo" class="span6	" value="5000"><?php echo $idioma['Milisegundos']?></td>
            <td>
            	<select class="span12" name="Nivel">
                <option value=""><?php echo $idioma['Todos']?></option>
                <?php echo $_SESSION['Nivel']==1?><option value="1"><?php echo $idioma['Administradores']?></option><?php echo $_SESSION['Nivel']==1?>
                <option value="2"><?php echo $idioma['Directores']?></option>
                <option value="3"><?php echo $idioma['Docentes']?></option>
                <option value="4"><?php echo $idioma['Secretaria']?></option>
                <option value="5"><?php echo $idioma['Regentes']?></option>
                <option value="6"><?php echo $idioma['PadresFamilia']?></option>
                <option value="7"><?php echo $idioma['Alumnos']?></option>
                </select>
            </td>
            <td>
            	<input type="text" class="span12" name="Fecha" value="<?php echo fecha2Str(date("Y-m-d"))?>">
            </td>
            <td><input type="submit" class="btn" value="<?php echo $idioma['Ver']?>"></td>
        </table>
    	</form>
    </div>
</div>
</div>
<div class="row-fluid">
<div class="span12 box">
	<div class="box-header"><h2><?php echo $idioma['Reporte']?></h2></div>
    <div class="box-content" id="respuesta" style="">
    
    </div>
</div>
<?php include_once($folder."pie.php");?>