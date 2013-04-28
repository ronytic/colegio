<?php
include_once("../../login/check.php");
if(isset($_POST)){
	extract($_POST);
	$url="../../impresion/reporte/reportecurso.php?CodCurso=".$CodCurso."&Sexo=".$Sexo;
	?>
	<a  class="btn btn-danger"  target="_blank" href="<?php echo $url;?>"><?php echo $idioma['AbrirOtraVentana']?></a><hr/>
    <iframe src="<?php echo $url;?>" width="100%" height="700"></iframe>	
    <?php
}
?>
