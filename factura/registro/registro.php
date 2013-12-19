<?php
include_once("../../login/check.php");
if(isset($_POST)){
	$l=$_POST['l'];
	?>
    <tr>
    	<td class="der"><?php echo $l?></td>
        <td>
        	<div class="input-append">
            	<input type="hidden"  name="a[<?php echo $l?>][CodAlumno]" rel="<?php echo $l?>" class="CodigoAlumno">
            	<input type="text"	class="input-medium" readonly name="a[<?php echo $l?>][Nombre]" rel="<?php echo $l?>">
                <a class="btn buscar" rel="Registro" rel-id="<?php echo $l?>"><i class="icon-search"></i></a>
                
            </div>
         </td>
        <td><input type="hidden"  name="a[<?php echo $l?>][CodCuota]" rel="<?php echo $l?>">
        <select class="input-mini MostrarCuota" name="a[<?php echo $l?>][Cuota]" rel="<?php echo $l?>">
        </select></td>
        <td>
        	<input type="text" readonly class="input-small der MontoCuota" value="0.00" name="a[<?php echo $l?>][MontoCuota]" rel="<?php echo $l?>">
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