<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$Desde=$_POST['Desde'];
	$Hasta=$_POST['Hasta'];
	$Tipo=$_POST['Tipo'];
	?>
    	<iframe src="../../impresion/cuotas/arqueo.php?wsd=new&Desde=<?php echo $Desde?>&Hasta=<?php echo $Hasta?>&Tipo=<?php echo $Tipo?>" width="100%" height="800"></iframe>
    <?php	
}
?>