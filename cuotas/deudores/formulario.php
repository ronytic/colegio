<?php
include_once("../../login/check.php");
if(isset($_POST)){
?>
<label for="Orden">Pagos que sean:</label>
<select name="Orden" id="Orden">
<option value="<" selected="selected">Menor</option>
<option value="<=">Igual</option>
</select>
<label for="Cuota">a la:</label> 
<select name="Cuota" id="Cuota" class="span6">
<option value="1" selected="selected">Primera</option>
<option value="2">Segunda</option>
<option value="3">Tercera</option>
<option value="4">Cuarta</option>
<option value="5">Quinta</option>
<option value="6">Sexta</option>
<option value="7">Septima</option>
<option value="8">Octava</option>
<option value="9">Novena</option>
<option value="10">Decima</option>
</select>
Cuota.
<hr />
<input type="submit" value="Revisar" class="btn btn-success" id="revisar">
<?php	
}
?>