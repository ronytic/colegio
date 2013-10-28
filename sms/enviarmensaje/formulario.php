<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/config.php");
	$config=new config;
	$ComunicadoSMS=$config->mostrarConfig("ComunicadoSMS",1);
	$CitacionSMS=$config->mostrarConfig("CitacionSMS",1);
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
$msg="";
	?>
    <div id="respuestaformulario"></div>
    <?php echo $idioma['Alumno']?>:<strong><?php echo capitalizar($al['Paterno'])?> <?php echo capitalizar($al['Materno'])?> <?php echo capitalizar($al['Nombres'])?></strong>
    <form action="enviar.php" method="post" class="formulario">
    	<table class="table table-bordered">
        	<tr>
            	<td>
            	<?php echo $idioma['NumeroCelularEnviar']?>:<br><input type="text" name="NumeroCelular" value="<?php echo trim($al['CelularSMS'])?>" required>
            	</td>
            </tr>
            <tr>
            	<td>
                <?php echo $idioma['Mensaje']?>:<br><textarea name="Mensaje" rows="9" required><?php echo $msg?></textarea>
                <br>
                <a href="#" class="btn btn-mini completar" rel="<?php echo $ComunicadoSMS?>"><?php echo $idioma['ComunicadoSMS']?></a>
                <a href="#" class="btn btn-mini completar" rel="<?php echo $CitacionSMS?>"><?php echo $idioma['CitacionSMS']?></a>
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