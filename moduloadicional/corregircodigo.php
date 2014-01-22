<?php
include_once("../login/check.php");
include_once("../class/factura.php");
$factura=new factura;
$CodFactura=$_GET['CodFactura'];
$CodigoControl=$_GET['CodigoControl'];
/*echo $CodFactura;
echo "<br>";
echo $CodigoControl;*/
$factura->actualizarRegistro(array("CodigoControl"=>"'$CodigoControl'"),"CodFactura=$CodFactura");
header("Location:../factura/listado/ver.php?f=".$CodFactura);
?>