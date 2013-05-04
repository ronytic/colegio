<?php
include_once("../../login/check.php");
if(isset($_POST)){
?>
<label for="Orden">Pagos que sean:</label>
<select name="Orden" id="Orden" class="span6">
<option value="<" selected="selected"><?php echo $idioma['Menor']?></option>
<option value="<="><?php echo $idioma['Igual']?></option>
</select>
<label for="Cuota"><?php echo $idioma['ALa']?>:</label> 
<select name="Cuota" id="Cuota" class="span6">
<option value="1" selected="selected"><?php echo $idioma['Primera']?></option>
<option value="2"><?php echo $idioma['Segunda']?></option>
<option value="3"><?php echo $idioma['Tercera']?></option>
<option value="4"><?php echo $idioma['Cuarta']?></option>
<option value="5"><?php echo $idioma['Quinta']?></option>
<option value="6"><?php echo $idioma['Sexta']?></option>
<option value="7"><?php echo $idioma['Septima']?></option>
<option value="8"><?php echo $idioma['Octava']?></option>
<option value="9"><?php echo $idioma['Novena']?></option>
<option value="10"><?php echo $idioma['Decima']?></option>
</select>
<?php echo $idioma['Cuota']?>.
<br />
<input type="submit" value="<?php echo $idioma['Revisar']?>" class="btn btn-success" id="revisar">
<?php	
}
?>