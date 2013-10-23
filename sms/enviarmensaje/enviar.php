<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/config.php");
	$config=new config;
	$PuertoUsb=$config->mostrarConfig("PuertoUsb",1);
	include_once("../funciones.php");
	include_once("../../class/alumno.php");
	$alumno=new alumno;
	extract($_POST);
	$res=enviarSms("COM".$PuertoUsb,$NumeroCelular,$Mensaje);
	
	if($res){
		?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php echo $idioma['MensajeEnviadoCorrectamente']?>
		</div>
		<?php
	}else{
		?>
		<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php echo $idioma['MensajeEnviadoError']?>
		</div>
		<?php	
	}
}
?>