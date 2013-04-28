<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$CodCurso=$_POST['CodCurso'];	
	$Cuota=$_POST['Cuota'];
	$Orden=$_POST['Orden'];
	?>
    <iframe src="../../impresion/cuotas/deudores.php?CodCurso=<?php echo $CodCurso?>&Cuota=<?php echo $Cuota;?>&Orden=<?php echo $Orden;?>&lock=<?php echo md5("lock")?>" width="100%" height="600"></iframe>
    <?php
}
?>