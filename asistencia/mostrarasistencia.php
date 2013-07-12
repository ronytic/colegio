<?php
include_once("../login/check.php");
include_once("../class/asistencia.php");
$FechaActual=date("Y-m-d");
$asistencia=new asistencia;
$asis=$asistencia->mostrarFecha($FechaActual);
if(count($asis)){
	?>
    
    <?php	
}else{
	?><div class="alert alert-danger"><?php echo $idioma['NoExisteAsistentes']?></div>
    <?php	
}
?>