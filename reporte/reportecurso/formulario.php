<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	?>
    
    <form action="" id="formulario">
    <table class="table table-condensed table-hovered">
        <tr><td>Sexo</td><td><select name="sexo" class="input-medium">
        						<option value="2"><?php echo $idioma['AmbosSexos']?></option>
                                <option value="1"><?php echo $idioma['Hombres']?></option>
                                <option value="0"><?php echo $idioma['Mujeres']?></option>
                            </select></td></tr>
        <tr><td colspan="2"><input type="submit" value="<?php echo $idioma['VerReporte']?>" class="btn btn-success"/> </td></tr>
    </table>
    </form>
    <?php
}
?>