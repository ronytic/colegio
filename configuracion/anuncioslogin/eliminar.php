<?php
include_once("../../login/check.php");
if(!empty($_POST['CodAnunciosLogin'])){
	include_once("../../class/anuncioslogin.php");
	$anuncioslogin=new anuncioslogin;
	$CodAnunciosLogin=$_POST['CodAnunciosLogin'];
	$anuncioslogin->eliminarRegistro("CodAnunciosLogin=$CodAnunciosLogin");
}
?>