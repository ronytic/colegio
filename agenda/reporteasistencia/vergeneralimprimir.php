<?php
include_once("../../login/check.php");
if(isset($_POST)){
	$CodCurso=$_POST['CodCurso'];
	$url="../../impresion/agenda/reporteasistencia.php?CodCurso=".$CodCurso;
	?>
    <a href="<?php echo $url;?>" class="btn btn-danger" target="_blank"><?php echo $idioma['AbrirOtraVentana']?></a>
    <hr />
    <strong><?php echo $idioma['ReporteImpresion'];?></strong>
    <iframe src="<?php echo $url?>" height="500" width="100%" name="pdf"></iframe>
	<?php
}
?>