<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	?>
    <label for="reserva"><?php echo $idioma['MontoReserva']?>:</label>
    <input type="number" name="cantidad" value="0" id="montoreserva" class="der">
    <br>
    <input type="submit" class="btn" value="<?php echo $idioma['Guardar']?>" id="guardar">
    <hr>
    <div id="listado"></div>
    <?php
}
?>