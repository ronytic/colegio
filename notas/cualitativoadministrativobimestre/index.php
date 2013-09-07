<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NAsignacionNotasCualitativasBimestre";
include_once("../../class/config.php");
$config=new config;
$cnf=$config->mostrarConfig("TotalPeriodo");
$TotalPeriodo=$cnf['Valor'];
include_once($folder."cabecerahtml.php");
?>
<script language="javascript" type="text/javascript" src="../../js/notas/cualitativoadministrativo.js"></script>
<script language="javascript">
	var SeguroQueDeseaGenerar="<?php echo $idioma['SeguroQueDeseaGenerar']?>";
</script>
<?php include_once($folder."cabecera.php");?>
<div class="span3 box">
   	<div class="box-header"><h2><i class="icon-cog"></i><span class="break"></span><?php echo $idioma['Configuracion']?></h2></div>
    <div class="box-content">
    	<?php echo $idioma['Periodo']?>:
        <br>
        <select name="Periodo" class="span12">
        <?php for($i=1;$i<=$TotalPeriodo;$i++){
			?><option value="<?php echo $i?>"><?php echo $i;?></option><?php
		}?>
        </select>
        <div class="alert alert-error">

        <strong><?php echo $idioma['Nota']?>:</strong>
        
        <?php echo $idioma['CursosYaAsignados']?><br />
        <strong><?php //echo $idioma['AfectaTrimestreYBimestre']?></strong><br />
        
		</div>
        
        <input type="submit" class="btn btn-success" value="<?php echo $idioma['Generar']?>" id="generar">
    </div>
</div>
<div class="span9 box">
	<div class="box-header"><h2><i class="icon-cog"></i><span class="break"></span><?php echo $idioma['Configuracion']?></h2></div>
    <div class="box-content" id="respuesta">
    </div>
</div>
<?php include_once($folder."pie.php");?>