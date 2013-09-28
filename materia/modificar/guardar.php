<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	extract($_POST);
	include_once("../../class/notificaciones.php");
	$notificaciones=new notificaciones;
	$Usuarios=implode(",",$Usuarios);
	$valores=array("Mensaje"=>"'$Mensaje'",
				"Tipo"=>"'$Tipo'",
				"Usuarios"=>"'$Usuarios'",
	);
	if($notificaciones->insertarRegistro($valores)){
		?><div class="alert alert-success"><?php echo $idioma['DatosGuardadosCorrectamente']?></div>
        <?php	
	}else{
		?><div class="alert alert-error"><?php echo $idioma['DatosGuardadosError']?></div>
        <?php
	}
}
?>

<script language="javascript">mostrar();</script>