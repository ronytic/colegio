<?php  
include_once '../../login/check.php';
if(!empty($_POST)):
?>
<form action="datos.php" method="post">
	<input type="hidden" name="CodDocente" value="<?php echo $_POST['CodDocente']; ?>">
	<input type="submit" value="Ver datos del docente" class="corner-all">
</form>
<?php 
endif
?>