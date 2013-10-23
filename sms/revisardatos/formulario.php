<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$CodAlumno=$_POST['CodAlumno'];
	include_once("../../class/alumno.php");
	$alumno=new alumno;
	$al=$alumno->mostrarTodoDatos($CodAlumno);
	$al=array_shift($al);
	?>
    <div id="respuestaformulario"></div>
    <form action="guardar.php" method="post" class="formulario">
    	<input type="hidden" value="<?php echo $CodAlumno?>" name="CodAlumno">
    	<table class="table table-bordered">
        	<tr class="success">
            	<td>
            	<?php echo $idioma['NumeroCelularEnviar']?>:<br><input type="text" name="CelularSMS" value="<?php echo $al['CelularSMS']?>" maxlength="8"><br><small><?php echo $idioma['RecomendacionNumeroCelular']?></small>
            	</td>
            </tr>
            <tr class="info">
            	<td>
            	<?php echo $idioma['Celular']?>:<br><input type="text" name="Celular" value="<?php echo $al['Celular']?>">
            	</td>
            </tr>
        	<tr class="info">
            	<td>
            	<?php echo $idioma['TelefonoCasa']?>:<br><input type="text" name="TelefonoCasa" value="<?php echo $al['TelefonoCasa']?>">
            	</td>
            </tr>
            <tr class="info">
            	<td>
            	<?php echo $idioma['CelularMadre']?>:<br><input type="text" name="CelularM" value="<?php echo $al['CelularM']?>">
            	</td>
            </tr>
            <tr class="info">
            	<td>
            	<?php echo $idioma['CelularPadre']?>:<br><input type="text" name="CelularP" value="<?php echo $al['CelularP']?>">
            	</td>
            </tr>
            <tr class="info">
            	<td>
            	<?php echo $idioma['ActivarEnvioSms']?>:<br><select name="ActivarSMS">
                	<option value="0" <?php echo $al['ActivarSMS']==0?'selected="selected"':''?>><?php echo $idioma['No']?></option>
                    <option value="1" <?php echo $al['ActivarSMS']==1?'selected="selected"':''?>><?php echo $idioma['Si']?></option>
                </select>
            	</td>
            </tr>
            <tr>
            	<td>
                	<input type="submit" value="<?php echo $idioma['Guardar']?>" class="btn btn-success">
                </td>
            </tr>
        </table>
    </form>
    <?php
}
?>