<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/reserva.php");
	$reserva=new reserva;
	$CodAlumno=$_POST['CodAlumno'];
	?>
	<table class="table table-striped table-hover table-bordered">
    <thead>
    <tr><th>N</th><th><?php echo $idioma['MontoReserva']?></th><th><?php echo $idioma['FechaReserva']?></th></tr>
    </thead>
	<?php
	foreach($reserva->mostrarTodoRegistro("CodAlumno=$CodAlumno") as $r){$i++;
		?>
		    <tr><td><?php echo $i;?></td><td><?php echo $r['MontoReserva'];?></td><td><?php echo fecha2Str($r['FechaRegistro']);?></td><td><a href="#" class="btn btn-mini eliminar" rel="<?php echo $r['CodReserva']?>">X</a></td></tr>
		<?php
	}
	?>
	</table>
	<?php
}
?>