<?php
include_once("../class/config.php");
include_once("../class/anuncioslogin.php");
$idiomano=0;
if($_COOKIE['Idioma']=="" || empty($_COOKIE['Idioma'])){
	include_once("../idioma/es.php");	
}else{
	if(file_exists("../idioma/".$_COOKIE['Idioma'].".php")){
		include_once("../idioma/".$_COOKIE['Idioma'].".php");
	}else{
		$idiomano=1;
		include_once("../idioma/es.php");	
	}
}
$anuncioslogin=new anuncioslogin;
$config=new config;
$title=$config->mostrarConfig("Titulo",1);
$sigla=$config->mostrarConfig("Sigla",1);
$LogoInicio=$config->mostrarConfig("LogoInicio",1);
$LogoIcono=$config->mostrarConfig("LogoIcono",1);
$NombreUnidadLogin=$config->mostrarConfig("NombreUnidadLogin",1);
$TipoUnidadLogin=$config->mostrarConfig("TipoUnidadLogin",1);
$ActualizacionNavegador=$config->mostrarConfig("ActualizacionNavegador",1);
$CodigoAdicionalSistemaLogin=$config->mostrarConfig("CodigoAdicionalSistemaLogin",1);
$CodigoSeguimientoSistema=$config->mostrarConfig("CodigoSeguimientoSistema",1);
$Telefono=$config->mostrarConfig("Telefono",1);
$folder="../";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.::<?php echo $idioma['AccesoSistema']?> | <?php echo $title;?> | <?php echo $idioma['TituloSistema']?>::.</title>
<link href="<?php echo $folder?>css/bootstrap.css" type="text/css" rel="stylesheet" media="all" />
<link href="css/estilo2.css" type="text/css" rel="stylesheet" media="all" />
<link rel="shortcut icon" href="../imagenes/logos/<?php echo $LogoIcono?>" />
<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- end: Mobile Specific -->
<script type="text/javascript" language="javascript" src="<?php echo $folder?>js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $folder?>js/bootstrap.js"></script>
<script type="text/javascript" language="javascript" src="js/login.js"></script>
<script language="javascript" type="text/javascript">
	RedirigirLogin=1;
	var AyudaTitulo="<?php echo $idioma['AyudaTitulo']?>";
</script>
</head>
<body>
<div class="container-fluid">
	<div class="row-fluid">
    	<div class="offset1 span4">
            <div class="login">
                <a href="../"><img src="../imagenes/logos/<?php echo $LogoInicio?>"  width="50" height="50" class="logo"/>
                <h4><?php echo $TipoUnidadLogin;?></h4>
                <h2><?php echo $NombreUnidadLogin;?></h2>
                </a>
                <hr />
                	<?php
                    if($idiomano==1){
                    ?>
                    <div class="alert alert-warning">
                    	<button type="button" class="close" data-dismiss="alert">&times;</button>
                    	<?php echo $idioma['IdiomaNoEncontrado']?>
                    </div>
                    <?php
                    }?>
                    <?php
                    if(isset($_GET['incompleto'])){
                    ?>
                    <div class="alert alert-error">
                    	<button type="button" class="close" data-dismiss="alert">&times;</button>
                    	<?php echo $idioma['NoDatos']?>
                    </div>
                    <?php
                    }
                    if(isset($_GET['error'])){
                    ?>
                    <div class="alert alert-info">
                    	<button type="button" class="close" data-dismiss="alert">&times;</button>
                    	<?php echo $idioma['DatosErroneos']?>
                    </div>
                    <?php
                    }
                    ?>
                    <form action="login.php" method="post" id="login">
                        <input type="hidden" name="u" value="<?php echo $_GET['u'];?>" />
                        <label for="usuario"><?php echo $idioma['Usuario']?></label>
                        <input type="text" name="usuario" id="usuario" class="campos" autofocus="autofocus"/><br />
                        <label for="pass"><?php echo $idioma['Contrasena']?></label>
                        <input type="password" name="pass" id="pass"  class="campos"/><br />
                        <input type="submit" value="<?php echo $idioma['Ingresar']?>" class="enviar" />
                    </form>
                    <a href="#" class="ayuda"><?php echo $idioma['NoPuedeIngresar']?></a>
                    <hr class="plomo"/>
                    <span><?php echo $idioma['Idioma']?>:</span>
                    <a href="i.php?i=es" class="idioma <?php echo $_COOKIE['Idioma']=='es'?' plomo':'';?>">Castellano</a>|<a href="i.php?i=ay" class="idioma <?php echo $_COOKIE['Idioma']=='ay'?' plomo':'';?>">Aymara</a>|<a href="i.php?i=qu" class="idioma <?php echo $_COOKIE['Idioma']=='qu'?' plomo':'';?>">Quechua</a>|<a href="i.php?i=gu" class="idioma <?php echo $_COOKIE['Idioma']=='gu'?' plomo':'';?>">Guarani</a>|<a href="i.php?i=en" class="idioma <?php echo $_COOKIE['Idioma']=='en'?' plomo':'';?>">Ingles</a>
                   	
                   <br /> <span class="recomendacion"><?php echo $idioma['RecomendacionUsoSistema']?> <img src="../imagenes/inicio/maximizar.jpg" class="img-polaroid"/></span>

                    <?php if($ActualizacionNavegador!=""){?>
                    <br />
                    <a href="<?php echo $ActualizacionNavegador;?>" target="_blank"><?php echo $idioma['ActualizarNavegador']?></a>
                    <?php }?>
            </div>
    	</div>
		<div class="offset1 span6">
    		<div class="mensajes">
                <h2><?php echo $idioma['Comunicados']?></h2>
                <hr />
                <ul>
                <?php 
                if (count($anuncioslogin->mostrarAnuncios())>0){
                    foreach($anuncioslogin->mostrarAnuncios() as $anuncios){
                    ?>
                    <li class="<?php echo $anuncios['Resaltar']?'resaltar':''?>"><?php echo $anuncios['Mensaje']?></li>
                    <?php
                }
                }else{
                    ?>
                    <li class="resaltarpequeno"><?php echo $idioma['NoComunicados']?></li>
                    <?php	
                }?>
                </ul>
                
        	</div>
            <?php if($CodigoAdicionalSistemaLogin!=""){?><hr /><?php echo $CodigoAdicionalSistemaLogin;}?>
   	 	</div>
    	
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="pie">
                <hr />
                <?php echo $idioma['Pie']?> <?php echo $sigla;?> &copy; 2011 - <?php echo date("Y");?> <p class="pull-right"><?php echo $idioma['DesarrolladoPor'];?>: <a href="http://fb.com/ronaldnina" class="" target="_blank" title="">Ronald Nina Layme</a> </p>
            </div>
        </div>
    </div>
</div>
<div id="noticerrar" class="oculto"><div class="pull-right"><a href="#" title="Cerrar" class="btn btn-mini" id="cerrarnoti"><i class="icon-remove"></i></a></div></div>
<div class="oculto" id="AyudaCuerpo">
	<ul>
    	<li><?php echo $idioma['PrimerProblemaAcceso']?></li>
        <li><?php echo $idioma['SegundoProblemaAcceso']?></li>
        <?php if($Telefono!=""){?>
        <li><?php echo $idioma['TercerProblemaAcceso']?>: <strong><?php echo $Telefono?></strong></li>
        <?php }?>
	</ul>
</div>
<?php echo $CodigoSeguimientoSistema?>
</body>
</html>