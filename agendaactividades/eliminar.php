<?php
include_once("../login/check.php");
if(isset($_POST)){
extract($_POST);
//print_r($_POST);
include_once("../class/agendaactividades.php");
$agendaactividades=new agendaactividades;
$agendaactividades->eliminarActividad($CodAgendaActividades);
}
?>