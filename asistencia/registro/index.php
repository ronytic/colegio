<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NMarcarAsistencia";
include_once($folder."cabecerahtml.php");
?>
<script type="text/javascript" src="../../js/asistencia/registrarasistencia.js" language="javascript"></script>
<script type="text/javascript">
var HoraTotal='<?php echo date("d M Y G:i:s"); ?>'
var fecha=new Date(HoraTotal);
</script>
<?php include_once($folder."cabecera.php");?>
<div class="span6">
	<div class="box">
        <div class="box-header"><h2><i class="icon-barcode"></i><span class="break"></span><?php echo $idioma['IngresarCodigoBarra']?></h2></div>
        <div class="box-content">
            <form action="registrarasistencia.php" method="post" class="formulario">
                <label for="Codigo"><?php echo $idioma['IngresarCodigoBarra']?></label>
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-barcode"></i></span>
                        <input type="text" name="Codigo" id="Codigo" autofocus placeholder="<?php echo $idioma['CodigoBarra']?>" value=""  class="span12"/>
                    </div>
                </div>
                <input type="submit" value="<?php echo $idioma['RegistrarAsistencia']?>" class="btn btn-success"/>
            </form>
        </div>
    </div>
    <div class="box">
        <div class="box-header"><h2><?php echo $idioma['DatosAlumno']?></h2></div>
        <div class="box-content" id="respuestaformulario"></div>
	</div>
</div>
<div class="span6">
	<div class="box">
        <div class="box-header"><h2><?php echo $idioma['Hora']?></h2></div>
        <div class="box-content">
            <div id="fecha"><?php echo utf8_encode(strftime("%A, %d de %B del %Y"));?></div>
            <div id="hora">00:00:00</div>
        </div>
	</div>
    <div class="box">
        <div class="box-header"><h2><?php echo $idioma['UltimasAsistencias']?></h2></div>
        <div class="box-content" id="respuestamostrar" style="max-height:400px;overflow:auto;"></div>
	</div>
</div>
<?php include_once($folder."pie.php");?>