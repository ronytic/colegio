<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$CodCurso=$_POST['CodCurso'];
	$Periodo=$_POST['Periodo'];
	$url="../../impresion/notas/centralizadorpromediofinal.php?CodCurso=".$CodCurso."&Periodo=".$Periodo."&mf=".md5("lock");
	?>
    <a href="<?php echo $url;?>" class="btn btn-danger" target="_blank"><?php echo $idioma['AbrirOtraVentana']?></a>
    <hr />
    <iframe width="100%" height="600" src="../../impresion/notas/centralizadorpromediofinal.php?CodCurso=<?php echo $CodCurso;?>&Trimestre=<?php echo $Trimestre;?>&mf=<?php echo md5("lock")?>"></iframe>
    <?php
}
?>