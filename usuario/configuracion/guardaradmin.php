<?php
include_once("../../login/check.php");
if(isset($_POST)){
	extract($_POST);
	include_once("../../class/usuario.php");
	$usuario=new usuario;
	$valores=array(
			"Usuario"=>"'$Usuario'",
			"Nombres"=>"'$Nombres'",
			"Paterno"=>"'$Paterno'",
			"Materno"=>"'$Materno'",
			"Nick"=>"'$Nick'",
			"Idioma"=>"'$Idioma'",
		);
	$_SESSION['Idioma']="$Idioma";
	if((!empty($Pass)) || $Pass!=""){
		$valores=array_merge(array("Pass"=>"'$Pass'"),$valores);
	}
	$folder="../../";
	if($Foto=subirArchivo($_FILES['Foto'],"imagenes/usuario/")){
		$valores=array_merge(array("Foto"=>"'$Foto'"),$valores);	
	}
	$usuario->actualizarDatos($valores,$_SESSION['CodUsuarioLog']);
	header("Location:index.php");
}
?>