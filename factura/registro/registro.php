<?php
include_once("../../login/check.php");
if(isset($_POST)){
	$l=$_POST['l'];
	?>
    <tr>
    	<td><?php echo $l?></td>
        <td>
        	<div class="input-append">
            	<input type="text"	class="input-medium" readonly>
                <a class="btn"><i class="icon-search"></i></a>
            </div>
         </td>
        <td><select class="input-mini">
        	<option>1</option>
        </select></td>
        <td>
        	<input type="text" readonly class="input-small der">
        </td>
        <td>
        	<input type="text" readonly class="input-small der">
        </td>
        <td>
        	<input type="text" readonly class="input-small der">
        </td>
        <td>
        	<input type="text" readonly class="input-small der">
        </td>
        <td>
        	<input type="text" readonly class="input-small der">
        </td>
    </tr>
    <?php	
}
?>