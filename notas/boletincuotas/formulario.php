<?php
include_once("../../login/check.php");
include_once("../../class/config.php");
$config=new config;
$NumeroCuotas=($config->mostrarConfig("NumeroCuotas",1));

?>
<?php echo $idioma['CuotaCancelada']?>
<select name="NumeroCuotas" class="span12">
	<?php for($i=1;$i<=$NumeroCuotas;$i++){?>
    <option value="<?php echo $i;?>"><?php echo $i;?></option>
    <?php }?>
</select>

<input type="submit" value="<?php echo $idioma['VerListado']?>" class="btn btn-success" id="ver">    

