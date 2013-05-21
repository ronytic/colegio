<?php
session_start();
include_once("../../login/check.php");
if(!empty($_POST)){
	$CodCurso=$_POST['CodCurso'];
	$CodMateria=$_POST['CodMateria'];
	$CodDocente=$_SESSION['CodDocente'];
	$Trimestre=$_POST['Trimestre'];
	?>
    
	<iframe src="../../impresion/notas/reportedocentepromedioanual.php?CodCurso=<?php echo $CodCurso;?>&CodMateria=<?php echo $CodMateria;?>&CodDocente=<?php echo $CodDocente;?>&Trimestre=<?php echo $Trimestre;?>&lock=<?php echo md5("lock");?>" width="850" height="800"></iframe>
    <?php
}
?>