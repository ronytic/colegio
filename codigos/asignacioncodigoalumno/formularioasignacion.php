<?php
include_once("../../login/check.php");
if(!empty($_POST)){
?>
<form action="enviar" id="formuCodigo">
    <label for="Codigo"><?php echo $idioma['IngresarCodigoBarra']?></label>
    <div class="controls">
        <div class="input-prepend">
            <span class="add-on"><i class="icon-barcode"></i></span>
            <input type="text" name="Codigo" id="Codigo" autofocus placeholder="<?php echo $idioma['CodigoBarra']?>" value=""  class="span12" autocomplete="off"/>
        </div>
    </div>
    <input type="submit" value="<?php echo $idioma['Guardar']?>" class="btn btn-success">
</form>
<?php }?>