<?php
include_once("../../login/check.php");
include_once("../../class/config.php");
include_once("../../class/bd.php");
$titulo="Actualizar Base de Datos INTERNET";
$folder="../../";
$bd=new bd;
$config=new config;
$tablas=$tables_export;
$cnf=($config->mostrarConfig("UrlInternet"));
$urlInternet=$cnf['Valor'];
$cnf=($config->mostrarConfig("DirectorioInternet"));
$directorioInternet=$cnf['Valor'];
?>
<?php include_once($folder."cabecerahtml.php");?>
<script type="text/javascript">
	var correcto="<?php echo $idioma['DatosSubidoCorrectamente']?>";
	var incorrecto="<?php echo $idioma['DatosSubidoIncorrectamente']?>";
</script>
<script language="javascript" type="text/javascript" src="../../js/seguridad/externo.js"></script>
<?php include_once($folder."cabecera.php");?>
<div class="span3">
    <div class="box-header"><?php echo $idioma["TablasActualizar"]?></div>
    <div class="box-content">
        <a href="#" class="btn" id="subir"><?php echo $idioma['SubirDatosInternet']?></a>
    </div>
</div>
<div class="span9">
    <div class="box-header"><?php echo $idioma["Internet"]?></div>
    <div class="box-content" id="respuesta">
        <div id="imagencargador" class="oculto">
            <img src="../../imagenes/cargador/cargador.gif" />
            <h1><?php echo $idioma["Cargando"]?>..., <?php echo $idioma["TengaPaciencia"]?></h1>
        </div>
        <div id="resultadosubida">
        
        </div>
    </div>
</div>
<?php include_once($folder."pie.php");?>