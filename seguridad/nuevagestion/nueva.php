<?php
include_once("../../login/check.php");
include_once("../../login/check.php");
include_once("../../class/alumno.php");
include_once("../../class/documento.php");
include_once("../../class/rude.php");
include_once("../../class/factura.php");
include_once("../../class/facturadetalle.php");
include_once("../../class/cuota.php");
include_once("../../class/tmpcola.php");
include_once("../../class/tmp_alumno.php");
$alumno=new alumno;
$cuota=new cuota;
$rude=new rude;
$documento=new documento;
$tmp_alumno=new tmp_alumno;
$facturadetalle=new facturadetalle;
$factura=new factura;
$tmpcola=new tmpcola;
$alumno->vaciar();
$cuota->vaciar();
$rude->vaciar();
$documento->vaciar();
$factura->vaciar();
$facturadetalle->vaciar();
$tmpcola->vaciar();
$tmp_alumno->iniciar();
?>
<h1><?php echo $idioma['GestionCreadaCorrectamente']?></h1>