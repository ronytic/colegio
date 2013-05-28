<?php
include_once("../class/config.php");
include_once("../class/anuncioslogin.php");
if($_COOKIE['Idioma']=="" || empty($_COOKIE['Idioma'])){
	include_once("../idioma/es.php");	
}else{
	include_once("../idioma/".$_COOKIE['Idioma'].".php");	
}
$anuncioslogin=new anuncioslogin;
$config=new config;
$cnf=$config->mostrarConfig("Titulo");
$title=$cnf["Valor"];

$cnf=$config->mostrarConfig("Sigla");
$sigla=$cnf['Valor'];

$cnf=$config->mostrarConfig("LogoInicio");
$LogoInicio=$cnf['Valor'];

$cnf=$config->mostrarConfig("LogoIcono");
$LogoIcono=$cnf['Valor'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.::Acceso al Sistema | <?php echo $title;?> | <?php echo $idioma['TituloSistema']?>::.</title>
<link href="../css/bootstrap.css" type="text/css" rel="stylesheet" media="all" />
<link href="css/estilo2.css" type="text/css" rel="stylesheet" media="all" />
<link rel="shortcut icon" href="../imagenes/logos/<?php echo $LogoIcono?>" />
<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- end: Mobile Specific -->
<script type="text/javascript" language="javascript" src="../js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../js/bootstrap.js"></script>
<script type="text/javascript" language="javascript" src="js/login.js"></script>
<script language="javascript" type="text/javascript">
	RedirigirLogin=1;
</script>
</head>
<body>
<div class="container-fluid">
	<div class="row-fluid">
    	<div class="offset1 span4">
            <div class="login">
                <img src="../imagenes/logos/<?php echo $LogoInicio?>"  width="50" height="50"/>
                <h4>Unidad Educativa Privada</h4>
                <h2>"SANTA BÁRBARA"</h2>
                <hr />
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
                    <span><?php echo $idioma['Idioma']?>:</span><a href="i.php?i=es" class="idioma <?php echo $_COOKIE['Idioma']=='es'?' plomo':'';?>">Castellano</a> | <a href="i.php?i=ay" class="idioma <?php echo $_COOKIE['Idioma']=='ay'?' plomo':'';?>">Aymara</a>
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
                    <li><?php echo $anuncios['Mensaje']?></li>
                    <?php
                }
                }else{
                    ?>
                    <li class="resaltarpequeno"><?php echo $idioma['NoComunicados']?></li>
                    <?php	
                }?>
                </ul>
        	</div>
   	 	</div>
    	
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="pie">
                <hr />
                <?php echo $idioma['Pie']?> <?php echo $sigla;?> &copy; 2011 - <?php echo date("Y");?>
            </div>
        </div>
    </div>
</div>
</body>
</html>