<?php
include_once("../../login/check.php");
include_once("../../class/config.php");
$config=new config;
$cnf=($config->mostrarConfig("UrlInternet"));
$urlInternet=$cnf['Valor'];
$cnf=($config->mostrarConfig("DirectorioInternet"));
$directorioInternet=$cnf['Valor'];
header("Location:".$urlInternet.$directorioInternet."notas/vernotaspromediodocente/");
?>