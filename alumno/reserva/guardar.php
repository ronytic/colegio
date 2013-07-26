<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	include_once("../../class/reserva.php");
	$reserva=new reserva;
	$CodAlumno=$_POST['CodAlumno'];
	$MontoReserva=$_POST['MontoReserva'];
	$valores=array("CodAlumno"=>"$CodAlumno",
					"MontoReserva"=>"'$MontoReserva'"
				);
	$reserva->insertarRegistro($valores);
}
?>