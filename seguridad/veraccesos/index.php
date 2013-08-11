<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NVerTodosLosAccesos";
include_once($folder."cabecerahtml.php");
?>
<script language="javascript" type="text/javascript" src="../../js/seguridad/accesossistema.js"></script>
<?php include_once($folder."cabecera.php");?>
    <div class="span12 box">
        <div class="box-header"><h2><?php echo $idioma['Configuracion']?></h2></div>
        <div class="box-content">
        	<table class="table table-bordered">
            	<tr>
                    <td>
                    <select class="span12" name="Nivel">
                    <option value=""><?php echo $idioma['Todos']?></option>
                    <?php if($_SESSION['Nivel']==1){?><option value="1"><?php echo $idioma['Administradores']?></option><?php }?>
                    <option value="2"><?php echo $idioma['Directores']?></option>
                    <option value="3"><?php echo $idioma['Docentes']?></option>
                    <option value="4"><?php echo $idioma['Secretaria']?></option>
                    <option value="5"><?php echo $idioma['Regentes']?></option>
                    <option value="6"><?php echo $idioma['PadresFamilia']?></option>
                    <option value="7"><?php echo $idioma['Alumnos']?></option>
                    </select>
                	</td>
                    <td><?php echo $idioma['Fecha']?>:
                    	<input type="text" name="Fecha" value="<?php echo fecha2Str()?>">
                    </td>
            		<td><input type="submit" class="btn" value="<?php echo $idioma['Ver']?>" id="ver"></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row-fluid">
	<div class="span12 box">
        <div class="box-header"><h2><?php echo $idioma['Datos']?></h2></div>
        <div class="box-content" id="resultado"></div>
    </div>
<?php include_once($folder."pie.php");?>