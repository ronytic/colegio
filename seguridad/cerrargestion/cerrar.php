<?php
include_once("../../login/check.php");
include_once("../../class/tmp_alumno.php");
$tmp_alumno=new tmp_alumno;
include_once("../../class/tmp_documento.php");
$tmp_documento=new tmp_documento;
include_once("../../class/tmp_rude.php");
$tmp_rude=new tmp_rude;

$tmp_alumno->vaciar();
$tmp_alumno->queryE("INSERT INTO tmp_alumno( SELECT * FROM  `alumno` )","lock");
$tmp_alumno->iniciar();

$tmp_rude->vaciar();
$tmp_rude->queryE("INSERT INTO tmp_rude( SELECT * FROM  `rude` )","lock");

$tmp_documento->vaciar();
$tmp_documento->queryE("INSERT INTO tmp_documento( SELECT * FROM  `documento` )","lock");

?>
<h1><?php echo $idioma['GestionCerradaCorrectamente']?></h1>