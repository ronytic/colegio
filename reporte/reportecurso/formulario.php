<?php
if(!empty($_POST)){
	?>
    
    <form action="" id="formulario">
    <table class="table table-condensed table-hovered">
        <tr><td>Sexo</td><td><select name="sexo" class="input-medium">
        						<option value="2">Ambos Sexos</option>
                                <option value="1">Hombres</option>
                                <option value="0">Mujeres</option>
                            </select></td></tr>
        <tr><td></td><td><input type="submit" value="Ver Reporte" class="btn btn-success"/> </td></tr>
    </table>
    </form>
    <?php
}
?>