<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	extract($_POST);
	include_once("../../class/cursoarea.php");
	$cursoarea=new cursoarea;
	$valores=array("Nombre"=>"'$Nombre'",
				"Abreviado"=>"'$Abreviado'",
				"Area"=>"'$Area'",
				"Posicion"=>"'$Posicion'",
				"HoraInicioL"=>"'$HoraInicioL'",
				"HoraEsperaL"=>"'$HoraEsperaL'",
				"HoraInicioM"=>"'$HoraInicioM'",
				"HoraEsperaM"=>"'$HoraEsperaM'",
				"HoraInicioMi"=>"'$HoraInicioMi'",
				"HoraEsperaMi"=>"'$HoraEsperaMi'",
				"HoraInicioJ"=>"'$HoraInicioJ'",
				"HoraEsperaJ"=>"'$HoraEsperaJ'",
				"HoraInicioV"=>"'$HoraInicioV'",
				"HoraEsperaV"=>"'$HoraEsperaV'",
				"HoraInicioS"=>"'$HoraInicioS'",
				"HoraEsperaS"=>"'$HoraEsperaS'",
				"HoraInicioD"=>"'$HoraInicioD'",
				"HoraEsperaD"=>"'$HoraEsperaD'",
	);
	if($cursoarea->insertarRegistro($valores)){
		?><div class="alert alert-success"><?php echo $idioma['DatosGuardadosCorrectamente']?></div>
        <?php	
	}else{
		?><div class="alert alert-error"><?php echo $idioma['DatosGuardadosError']?></div>
        <?php
	}
}
?>

<script language="javascript">mostrar();</script>