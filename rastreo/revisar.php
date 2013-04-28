<?php
$Archivo=$_SERVER['SCRIPT_NAME'];
$Get="";
$Post="";
$Session="";
$Ip=$_SERVER['REMOTE_ADDR'];
@$Referencia=$_SERVER['HTTP_REFERER'];
foreach($_GET as $k =>$v)
	$Get.="$k=$v|";
foreach($_POST as $k =>$v)
	$Post.="$k=$v|";
foreach($_SESSION as $k =>$v)
	$Session.="$k=$v|";
//$Ip=ip2long($Ip);
include_once(RAIZ."class/lograstreo.php");
$lograstreo=new lograstreo;
$valores=array(
				"Archivo"=>"'$Archivo'",
				"Post"=>"'$Post'",
				"Get"=>"'$Get'",
				"Session"=>"'$Session'",
				"Ip"=>"'$Ip'",
				"Referencia"=>"'$Referencia'"
			);
$lograstreo->insertarRegistro($valores);
?>