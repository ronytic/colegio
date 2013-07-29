<?php
include_once("../../login/check.php");
include_once("../../class/config.php");
if(!empty($_POST))
{
	/// esto hay que cambiar con la tabla de configuracion
	$config=new config;
	$TotalPeriodo=($config->mostrarConfig("TotalPeriodo",1));

	$PeriodoActual=($config->mostrarConfig("PeriodoActual",1));
	?>
	<?php /* echo $idioma['Periodo']?>:
	<select name="Periodo">
	<?php
		for($i=1;$i<=$TotalPeriodo;$i++){
			?>
			<option <?php echo $i==$PeriodoActual?'checked="checked"':'';?> value="<?php echo $i;?>"><?php echo $i;?></option>
			<?php
		}
	?>
    </select>
	
	
	<?php *//*
		for($i=1;$i<=$totalPeriodoAdicional;$i++){
			?>
			<li><input type="radio" name="Periodo" value="<?php echo $i;?>" id="periodo<?php echo $i;?>" style="width:100px;float:left" class="radio"/><label class="lradio capital" for="periodo<?php echo $i;?>"><?php echo $i;?></label></li>
			<?php
		}*/
	?>
	<input type="submit" id="generar" value="<?php echo $idioma['Generar']?>" class="btn btn-success"/>
<?php	
}
?>