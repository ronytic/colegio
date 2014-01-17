<?php
include_once("../../login/check.php");
if(isset($_POST)){
	$l=$_POST['l'];
	?>
    <tr>
    	<td class="der"><?php echo $l?></td>
        <td>
            <input type="text"	class="span12"  name="a[<?php echo $l?>][Nombre]" rel="<?php echo $l?>">
        </td>
        <td>
        	<input type="text"  class="input-small der ImporteCobrado" value="0.00"  name="a[<?php echo $l?>][ImporteCobrado]" rel="<?php echo $l?>">
        </td>
        <td>
        	<input type="text"  class="input-small der Interes" value="0.00" name="a[<?php echo $l?>][Interes]" rel="<?php echo $l?>">
        </td>
        <td>
        	<input type="text"  class="input-small der Descuento" value="0.00" name="a[<?php echo $l?>][Descuento]" rel="<?php echo $l?>">
        </td>
        <td>
        	<input type="text" readonly class="input-small der Total" value="0.00" name="a[<?php echo $l?>][Total]" rel="<?php echo $l?>">
        </td>
        <td>
        	<a class="btn btn-mini eliminar" title="<?php echo $idioma['Eliminar']?>"><i class="icon-remove"></i></a>
        </td>
    </tr>
    <?php	
}
?>