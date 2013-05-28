<?php
include_once("../../login/check.php");
include_once("../../class/casilleros.php");
if(!empty($_POST)){
	$CodCasilleros=$_POST['CodCasilleros'];
	$nombre=$_POST['Nombre'];
	$valor=$_POST['Valor'];
	$casilleros=new casilleros;
	$values=array($nombre=>"'$valor'");
	$casilleros->actualizarCasilleros($values,$CodCasilleros);
}
?>