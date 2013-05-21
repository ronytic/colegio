<?php
include_once("../../login/check.php");
if(isset($_POST)){
	include_once("../../class/config.php");
	$config=new config;
	$cnf=$config->mostrarConfig("TotalPeriodo");
	$TotalPeriodo=$cnf['Valor'];
	$totalperiodo=array();
	
?>
<?php echo $idioma['Periodo']?>:
	<input type="search" class="span12" placeholder="<?php echo $idioma['BuscarPeriodoPor']?>" name="tPeriodo"/>
	<select name="Periodo" class="span12">
<?php for($i=1;$i<=$TotalPeriodo;$i++){?>
	<option value="<?php echo $i?>"><?php echo $i?></option>
<?php }?></select>
<?php echo $idioma['OrdenPromedio']?>:
<input type="search" class="span12" placeholder="<?php echo $idioma['BuscarOrdenPor']?>" name="tOrden"/>
<select name="Orden" class="span12">
<option value="1"><?php echo $idioma['Mejores']?></option>
<option value="0"><?php echo $idioma['Peores']?></option>
</select>
<input type="submit" value="<?php echo $idioma['Revisar']?>" class="btn btn-success" id="revisar">
<?php }?>