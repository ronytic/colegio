<?php
include_once("../../login/check.php");
include_once("../../class/config.php");
$config=new config;
$TotalPeriodo=($config->mostrarConfig("TotalPeriodo",1));
$PeriodoActual=($config->mostrarConfig("PeriodoActual",1));

?>
<?php /*echo $idioma['Periodo']?>
<select name="Periodo" class="span12">
	<?php for($i=1;$i<=$TotalPeriodo;$i++){?>
    <option <?php echo $i==$PeriodoActual?'selected':'';?> value="<?php echo $i;?>"><?php echo $i;?></option>
    <?php }?>
</select>
<?php */?>
<?php echo $idioma['Materias']?>
<select name="CodMateria" class="span12">
</select>
<input type="submit" value="<?php echo $idioma['VerTareas']?>" class="btn btn-success" id="ver">    
