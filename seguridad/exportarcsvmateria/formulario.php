<?php
include_once("../../login/check.php");
include_once("../../class/config.php");
if(!empty($_POST)){
	$config=new config;
	$cnf=($config->mostrarConfig("TotalPeriodo"));
	$TotalPeriodo=$cnf['Valor'];
	?>
    <label for="cabeceralista"><?php echo $idioma['Cabecera']?></label>
    <select id="cabeceralista" name="cabeceralista" class="span12">
    	<option value="no" selected="selected"><?php echo $idioma['No']?></option>
        <option value="si"><?php echo $idioma['Si']?></option>
	</select>
    <label for="separador"><?php echo $idioma['SeparadorColumna']?></label>
    <input type="text" name="separador" id="separador" value="," size="2" autofocus class="span12"/>
    <label for="separadorfila"><?php echo $idioma['SeparadorFila']?></label><input type="text" name="separadorfila" id="separadorfila" value="AUTO" class="span12"/>"AUTO" <?php echo $idioma['SaltoLinea']?>
    <hr />
    <label for="numeracion"><?php echo $idioma['Numeracion']?></label>
    <select name="numeracion" id="numeracion" class="span12">
    	<option value="si"><?php echo $idioma['Si']?></option>
        <option value="no"><?php echo $idioma['No']?></option>
    </select>
    <label for="materias"><?php echo $idioma['Materias']?></label>
    <select name="materias" id="materias" class="span12"></select>
    <label for="trimestre"><?php echo $idioma['Periodo']?>:</label>
    <select name="Trimestre" id="trimestre" class="span12">
    	<?php
		for($i=1;$i<=$TotalPeriodo;$i++){
			?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php
		}
		?>
        <option value="todo" selected><?php echo $idioma['TodosPeriodos']?></option>
    </select>
    <input type="submit" class="btn btn-success" value="<?php echo $idioma['Generar']?>" id="generar">
    <?php
}
?>
<script type="text/javascript" language="javascript">
	var DescargarArchivo="<?php echo $idioma['DescargarArchivo']?>";
</script>