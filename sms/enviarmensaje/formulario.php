<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$CodAlumno=$_POST['CodAlumno'];
	include_once("../../class/alumno.php");
	$alumno=new alumno;
	$al=$alumno->mostrarTodoDatos($CodAlumno);
	$al=array_shift($al);
	?>
    <form action="enviar.php" method="post">
    	<table class="table table-bordered">
        	<tr>
            	<td>
            	<?php echo $idioma['NumeroCelular']?>:<br><input type="text" name="NumeroCelular" value="<?php echo $al['Celular']?>">
            	</td>
            </tr>
            <tr>
            	<td>
                <?php echo $idioma['Mensaje']?>:<br><textarea name="Mensaje"></textarea>
                </td>
            </tr>
            <tr>
            	<td>
                	<input type="submit" value="<?php echo $idioma['EnviarMensaje']?>" class="btn btn-success">
                </td>
            </tr>
        </table>
    	
        
    </form>
    <?php
}
?>