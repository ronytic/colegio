<?php
include_once("../../login/check.php");
if(!empty($_POST)){
include_once("../../class/alumno.php");
	$alumno=new alumno;
	extract($_POST);
	$valores=array("CelularSMS"=>"'$CelularSMS'",
					"Celular"=>"'$Celular'",
					"TelefonoCasa"=>"'$TelefonoCasa'",
					"CelularM"=>"'$CelularM'",
					"CelularP"=>"'$CelularP'",
					"ActivarSMS"=>"'$ActivarSMS'"
		);
	if($alumno->actualizarDatosAlumno($valores,$CodAlumno)){
		?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php echo $idioma['DatosGuardadosCorrectamente']?>
		</div>
		<?php
	}else{
		?>
		<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php echo $idioma['DatosGuardadosError']?>
		</div>
		<?php	
	}
}
?>