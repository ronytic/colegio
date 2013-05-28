<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$CodCurso=$_POST['CodCurso'];
	$CodMateria=$_POST['CodMateria'];
	$CodDocente=$_SESSION['CodDocente'];
	$CodPeriodo=$_POST['CodPeriodo'];
	$url="../../impresion/notas/reportedocente.php?CodCurso=$CodCurso&CodMateria=$CodMateria&CodDocente=$CodDocente&CodPeriodo=$CodPeriodo&lock=".md5("lock");
	?>
    <a class="btn btn-danger" href="<?php echo $url?>" target="_blank"><?php echo $idioma['AbrirOtraVentana']?></a>
    <hr />
    <?php echo $idioma['ReporteImpresion']?>, <?php echo $idioma['TamanoCarta']?>
	<iframe src="<?php echo $url;?>" width="100%" height="800"></iframe>
    <?php
}
?>