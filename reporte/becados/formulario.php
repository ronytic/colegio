<?php
include_once("../../login/check.php");
if(isset($_POST)){
	?>
    <input type="submit" class="btn btn-success" value="<?php echo $idioma["VerReporte"]?>" id="reporte"/>
    <?php
}
?>