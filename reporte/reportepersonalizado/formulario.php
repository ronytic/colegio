<?php
include_once("../../login/check.php");
if(isset($_POST)){
	?>
    <form action="" id="formulario">
    <table class="table table-hover">
        <!--<tr><td>Sexo</td><td><select name="sexo">
        						<option value="2">Ambos Sexos</option>
                                <option value="1">Hombres</option>
                                <option value="0">Mujeres</option>
                            </select></td></tr>-->
        <tr><td><?php echo $idioma['Campo1']?></td><td><select name="campo1" class="input-medium span10">
        						<option value=""><?php echo $idioma['Ninguno']?></option>
        						<option value="FechaNac"><?php echo $idioma['FechaNac']?></option>
                                <option value="Ci"><?php echo $idioma['Ci']?></option>
                                <option value="TelefonoCasa"><?php echo $idioma['TelefonoCasa']?></option>
                                <option value="Rude"><?php echo $idioma['Rude']?></option>
                                <option value="CelularP"><?php echo $idioma['CelularP']?></option>
								<option value="CelularM"><?php echo $idioma['CelularM']?></option>
								</select></td></tr>
         <tr><td><?php echo $idioma['Campo2']?></td><td><select name="campo2" class="input-medium span10">
        						<option value=""><?php echo $idioma['Ninguno']?></option>
        						<option value="FechaNac"><?php echo $idioma['FechaNac']?></option>
                                <option value="Ci"><?php echo $idioma['Ci']?></option>
                                <option value="TelefonoCasa"><?php echo $idioma['TelefonoCasa']?></option>
                                <option value="Rude"><?php echo $idioma['Rude']?></option>
                                <option value="CelularP"><?php echo $idioma['CelularP']?></option>
								<option value="CelularM"><?php echo $idioma['CelularM']?></option>
								</select></td></tr>
          <tr><td><?php echo $idioma['DibujarBorde']?></td><td><input type="checkbox" name="borde"/></td></tr>
          <tr><td><?php echo $idioma['DibujarSombreado']?></td><td><input type="checkbox" name="sombreado" checked="checked"/></td></tr>
          <tr><td><?php echo $idioma['SoloCasillasBlanco']?></td><td><input type="checkbox" name="blanco"/>
          					<select name="cantidad" class="input-mini">
        						<option value="1">1</option>
        						<option value="2">2</option>
                                <option value="3">3</option>
								</select></td></tr>     
          
        <tr><td></td><td><input type="submit" value="<?php echo $idioma['VerReporte']?>" class="btn btn-success"/> </td></tr>
    </table>
    </form>
    <?php
}
?>