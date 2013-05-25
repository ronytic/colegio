<?php
include_once("../../login/check.php");
include_once("../../class/config.php");
include_once("../../class/bd.php");
$titulo="NExportarBaseDatos";
$folder="../../";
$config=new config;
$bd=new bd;
$tablas=$bd->getTables();
$cnf=($config->mostrarConfig("UrlInternet"));
$urlInternet=$cnf['Valor'];
$cnf=($config->mostrarConfig("DirectorioInternet"));
$directorioInternet=$cnf['Valor'];
?>
<?php include_once($folder."cabecerahtml.php");?>
<script language="javascript" type="text/javascript" src="../../js/seguridad/actualizar.js"></script>
<script language="javascript">var UrlInternet="<?php echo $urlInternet;?>";var Directory="<?php echo $directorioInternet;?>"; </script>
<?php include_once($folder."cabecera.php");?>
<div class="span3">
    <div class="box">
        <div class="box-header"><?php echo $idioma["TablasActualizar"]?></div>
        <div class="box-content">
            <select class="span12" multiple="multiple" size="<?php echo count($tablas)?>" id="tablas"><?php $i=0;
            foreach($tablas as $t){$i++;
                $t=array_shift($t);
                ?>
                    <option value="<?php echo $t;?>"><?php echo $i;?>.- <?php echo $t;?></option>
                <?php
            }
            ?></select>
        </div>
	</div>
    <div class="box-header"><?php echo $idioma["Configuracion"]?></div>
    <div class="box-content">
	<?php echo $idioma["Eliminar"]?><br />
    <select name="eliminar" class="span12">
        <option value="0" selected="selected"><?php echo $idioma["No"]?></option>
        <option value="1"><?php echo $idioma["Si"]?></option>
    </select>
	<?php echo $idioma["Estructura"]?><br />
    <select name="estructura" class="span12">
        <option value="0" selected="selected"><?php echo $idioma["No"]?></option>
        <option value="1"><?php echo $idioma["Si"]?></option>
    </select>
    <?php echo $idioma["Vaciar"]?><br />
    <select name="vaciar" class="span12">
        <option value="0" selected="selected"><?php echo $idioma["No"]?></option>
        <option value="1"><?php echo $idioma["Si"]?></option>
    </select>
<input type="submit" value="<?php echo $idioma["Generar"]?>" class="btn" id="generar"/>

    </div>
</div>
<div class="span6">
   	<form action="exportar.php" target="archivo" method="post">
    <div class="box">
        <div class="box-header"><?php echo $idioma['SqlExportacion']?></div>
        <div class="box-content">
            <textarea id="salida" name="salida" class="span12" style="max-width:98%;width:98%;height:450px;min-height:450px;" ></textarea>
        </div>
    </div>
    <div class="box-content">
		<input type="submit" value="<?php echo $idioma["GenerarArchivo"]?>" class="btn" id="archivo"/>
	</div>
	</form>
    <div class="box-content">
        <iframe class="clear" id="exportararchivo" name="archivo" height="0" frameborder="0" width="100%"></iframe>
        <iframe name="subir" id="subir" height="100" src=""  width="100%" frameborder="0"></iframe>
    </div>
</div>
<div class="span3">
	<div class="box">
        <div class="box-header">Internet</div>
        <div class="box-content">
            <form action="" method="post" target="subir" name="fsubir">
                <input type="hidden" name="f4" value="b431d1485aa37ae09fa4bfa7883356" />
                <input type="hidden" name="f" value="lock" />
                <textarea name="data" cols="10" id="data" rows="10" class="span12"></textarea>
                <input type="submit" value="<?php echo $idioma["TablasAInternet"]?>" class="btn"/>
                </form>
        </div>
    </div>
</div>
<?php include_once($folder."pie.php");?>