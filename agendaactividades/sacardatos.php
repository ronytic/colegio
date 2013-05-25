<?php
include_once("../login/check.php");
if(isset($_POST)){
extract($_POST);
//print_r($_POST);
include_once("../class/agendaactividades.php");
$agendaactividades=new agendaactividades;
$ag=$agendaactividades->mostrarActividades("CodAgendaActividades=".$CodAgendaActividades);
$ag=array_shift($ag);
$ag['FechaActividad']=fecha2Str($ag['FechaActividad'],1);
$ag=array_merge(array("Boton"=>$idioma['ActualizarActividad']),$ag);
echo json_encode($ag);
}
?>