<?php include_once("login/check.php");
include_once("funciones/url.php");
/*Sacar Url*/
$url_separada=(separar_url($directory,url_sub()));
$url_modulo=array_shift($url_separada)."/";
$url_separada=implode("/",$url_separada);
/*Fin Sacar Url*/
include_once("class/menu.php");
include_once("class/submenu.php");
$menu=new menu;
$submenu=new submenu;
$mv=$menu->verificar($url_modulo,$_SESSION['Nivel']);
if($url_modulo!="/" && !isset($NoRevisar)){//Si no es el index revisar si tiene el permiso adecuado para ingresar al Sistema
	if(!count($mv)){
		header("Location:".url_base().$directory."login/?u=".$_SERVER['PHP_SELF']);
	}else{
		$mv=array_shift($mv);
		if($mv['SubMenu']){
			if(!count($submenu->verificar($url_separada,$_SESSION['Nivel']))){
				header("Location:".url_base().$directory."login/?u=".$_SERVER['PHP_SELF']);
			}
		}
	}
}
/*Agenda de Actividades*/
include_once("class/agendaactividades.php");
$agendaac=new agendaactividades;
$cant=$agendaac->cantidadActividades();
$cantagendaactividades=array_shift($cant);
/*Fin de Cantidad de Actividades*/
/*Notitifaciones*/
include_once("class/notificaciones.php");
$notificacionesi=new notificaciones;
$noti1=$notificacionesi->listarmensajes($_SESSION['Nivel'],1);
$noti2=$notificacionesi->listarmensajes($_SESSION['Nivel'],2);
$noti3=$notificacionesi->listarmensajes($_SESSION['Nivel'],3);
/*Fin de Notificaciones*/
?>
<?php
/*Codigo para ver qen que menu nos encontramos*/
$rurl=str_replace("index.php","",$_SERVER['SCRIPT_NAME']);
$rurl=str_replace("/".$directory,"",$rurl);
$rurl=explode("/",$rurl);
$rmenu=array_shift($rurl)."/";

$rsubmenu=implode("/",$rurl);
//echo $rmenu;
$textomenu="";
$textosubmenu="";
$urlSubMenu=explode("/",$rsubmenu);
$urlSubMenu=$urlSubMenu[0]."/";
//echo $urlSubMenu;
/*Fin de Obtenemos para el Menu*/
$Nivel=$_SESSION['Nivel'];
$CodUsuario=$_SESSION['CodUsuarioLog'];
if($Nivel==7||$Nivel==6){
	//header("Location:internet/alumno/");	
}
include_once("class/config.php");

include_once("class/usuario.php");

$config=new config;
$usuario=new usuario;
$Titulo=$config->mostrarConfig("Titulo",1);
$LogoInicio=$config->mostrarConfig("LogoInicio",1);
$LogoIcono=$config->mostrarConfig("LogoIcono",1);
$Sigla=$config->mostrarConfig("Sigla",1);
$Gestion=$config->mostrarConfig("Gestion",1);
$VersionSistema=$config->mostrarConfig("VersionSistema",1);


include_once("funciones/url.php");
$UrlBase=url_todo();
//$UrlBase=url_base().$directory;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Inicio: Meta -->
	<meta charset="utf-8">
	<title><?php echo $idioma['TituloSistema']?></title>
	<meta name="description" content="Sistema de Académico Administrativo para Colegios">
	<meta name="author" content="Ronald Franz Nina Layme">
    <?php /*?><base href="<?php echo $UrlBase?>" /><?php */?>
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
    <link id="bootstrap-style" href="<?php echo $folder;?>css/offline-theme-chrome.css" rel="stylesheet">
    <link id="bootstrap-style" href="<?php echo $folder;?>css/offline-language-spanish.css" rel="stylesheet">
	<!-- Fin: CSS -->

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Inicio: Icono -->
	<link rel="shortcut icon" href="<?php echo $folder;?>imagenes/logos/<?php echo $LogoIcono?>" />
	<!-- Fin: Icono -->
    <script src="<?php echo $folder;?>js/core/plugins/offline/offline.min.js" language="javascript"></script>
	<script src="<?php echo $folder;?>js/core/framework/jquery.js" language="javascript" type="text/javascript"></script>
