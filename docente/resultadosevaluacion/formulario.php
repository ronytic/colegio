<?php
include_once("../../login/check.php");
if(isset($_POST)){
	?>
    <input type="button" value="<?php echo $idioma['VerReporte']?>" class="btn" id="Ver">
    <input type="button" value="<?php echo $idioma['ReporteImprimir']?>" class="btn btn-info" id="VerImprimir">
    <?php
}
?>