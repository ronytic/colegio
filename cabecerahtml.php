<?php include_once("login/check.php");
/*Agenda de Actividades*/
include_once("class/agendaactividades.php");
$agendaac=new agendaactividades;
$cant=$agendaac->cantidadActividades();
$cantagendaactividades=array_shift($cant);
/*Fin de Cantidad de Actividades*/
?>
<?php
/*Codigo para ver qen que menu nos encontramos*/
$rurl=str_replace("index.php","",$_SERVER['SCRIPT_NAME']);
$rurl=str_replace("/".$directory,"",$rurl);
$rurl=explode("/",$rurl);
$rmenu=array_shift($rurl)."/";
$rsubmenu=implode("/",$rurl);
/*Fin de Obtenemos para el Menu*/
$Nivel=$_SESSION['Nivel'];
$CodUsuario=$_SESSION['CodUsuarioLog'];
if($Nivel==7||$Nivel==6){
	//header("Location:internet/alumno/");	
}
include_once("class/config.php");
include_once("class/menu.php");
include_once("class/submenu.php");
include_once("class/usuario.php");
$menu=new menu;
$submenu=new submenu;
$config=new config;
$usuario=new usuario;
$v=$config->mostrarConfig("Titulo");
$Titulo=$v['Valor'];
$v=$config->mostrarConfig("LogoInicio");
$LogoInicio=$v['Valor'];
$v=$config->mostrarConfig("LogoIcono");
$LogoIcono=$v['Valor'];
$v=$config->mostrarConfig("Sigla");
$Sigla=$v['Valor'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Inicio: Meta -->
	<meta charset="utf-8">
	<title><?php echo $idioma['TituloSistema']?></title>
	<meta name="description" content="Sistema de Académico Administrativo para Colegios">
	<meta name="author" content="Ronald Nina Layme">
	<!-- Fin: Meta -->
	
	<!-- Inicio: Version Mobile -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Fin: Version Mobile -->

	<!-- Inicio: CSS -->
	<link id="bootstrap-style" href="<?php echo $folder;?>css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo $folder;?>css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="<?php echo $folder;?>css/style.css" rel="stylesheet">
    <link id="bootstrap-style" href="<?php echo $folder;?>css/estilo.css" rel="stylesheet">
	<!--<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">-->
    
    <link id="bootstrap-style" href="<?php echo $folder;?>css/ui/jquery.ui.all.css" rel="stylesheet">
    <link id="bootstrap-style" href="<?php echo $folder;?>css/estilo.css" rel="stylesheet">
	<!-- Fin: CSS -->

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Inicio: Icono -->
	<link rel="shortcut icon" href="<?php echo $folder;?>imagenes/logos/<?php echo $LogoIcono?>" />
	<!-- Fin: Icono -->
	<script src="<?php echo $folder;?>js/core/framework/jquery.js"></script>
