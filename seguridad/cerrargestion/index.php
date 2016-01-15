<?php
include_once("../../login/check.php");
include_once("../../class/config.php");
include_once("../../class/bd.php");
$titulo="NCerrarGestion";
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
	var SeguroCerrarGestion="<?php echo $idioma['SeguroCerrarGestion']?>";
</script>
<script language="javascript" type="text/javascript" src="../../js/seguridad/cerrargestion.js"></script>
<?php include_once($folder."cabecera.php");?>
<div class="span3">
    <div class="box-header"><?php echo $idioma["Configuracion"]?></div>
    <div class="box-content">
        <a href="#" class="btn" id="cerrargestion"><?php echo $idioma['CerrarGestion']?></a>
    </div>
</div>
<div class="span9">
    <div class="box-header"><?php echo $idioma["Mensaje"]?></div>
    <div class="box-content" id="respuesta">
        <div id="imagencargador" class="oculto">
            <img src="../../imagenes/cargador/cargador.gif" />
            <h1><?php echo $idioma["CreandoArchivos"]?>..., <?php echo $idioma["TengaPaciencia"]?></h1>
        </div>
        <div id="resultadocierre">
        
        </div>
    </div>
</div>
<?php include_once($folder."pie.php");?>