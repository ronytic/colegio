<?php
include_once("../../login/check.php");
if(isset($_POST['CodCurso'])){
	?>
    <input type="button" class="btn btn-success" value="<?php echo $idioma['VerReporte']?>" id="verreporte">
    <?php	
}
?>