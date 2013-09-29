<?php
include_once("../../login/check.php");
if(!empty($_POST['CodUsuario'])){
	include_once("../../class/usuario.php");
	$usuario=new usuario;
	$CodUsuario=$_POST['CodUsuario'];
	$usuario->eliminarRegistro("CodUsuario=$CodUsuario");
}
?>