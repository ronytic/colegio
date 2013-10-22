<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$CodAlumno=$_POST['CodAlumno'];
	include_once("../../class/alumno.php");
	$alumno=new alumno;
	$al=$alumno->mostrarTodoDatos($CodAlumno);
	$al=array_shift($al);
	$msg="CSB Estadistica Agenda 22-10
Mat:Actividad
Fis:TrabajoPractico
Comp:Falta
Quim:Carpeta
Bio:Fichero
Len:Practica
Mus:Evaluacion
Sec:Atraso";
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
                <?php echo $idioma['Mensaje']?>:<br><textarea name="Mensaje" rows="9"><?php echo $msg?></textarea>
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