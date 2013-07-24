<?php
include_once("../../login/check.php");
if(!empty($_POST['CodDocente'])){
	extract($_POST);
	$url="../../impresion/docente/reporteevaluacion.php?CodDocente=$CodDocente";
?>
<a class="btn btn-danger" href="<?php echo $url?>" target="_blank"><?php echo $idioma['AbrirOtraVentana']?></a>
<hr>
<iframe src="<?php echo $url?>" width="100%" height="500"></iframe>
<?php	
}
?>