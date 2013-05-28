<?php
include_once("../login/check.php");
if(isset($_POST)){
extract($_POST);
//print_r($_POST);
include_once("../class/agendaactividades.php");
$agendaactividades=new agendaactividades;
$Nivel=$_SESSION['Nivel'];

if(in_array("0",$ParaQuien)){
	$UsuariosAgenda="0";
}else{
	$UsuariosAgenda=implode(",",$ParaQuien);
}
$valores=array("FechaActividad"=>"'".fecha2Str($FechaActividad,0)."'",
				"HoraInicio"=>"'$HoraInicio'",
				"HoraFin"=>"'$HoraFin'",
				"Prioridad"=>"'$Prioridad'",
				"Estado"=>"'$Estado'",
				"Usuarios"=>"'$UsuariosAgenda'",
				"Detalle"=>"'$Detalle'",
	);
	if($agendaactividades->insertarActividad($valores)){?>
		<div class="alert alert-success">
    	<button type="button" class="close" data-dismiss="alert">&times;</button>
    	<?php echo $idioma['DatosGuardadosCorrectamente']?>
		</div>
		<script language="javascript">mostrarActividades();vaciar();</script>
	<?php }else{?>
		<div class="alert alert-error">
	    <button type="button" class="close" data-dismiss="alert">&times;</button>
    	<?php echo $idioma['DatosGuardadosError']?>
		</div>
		<script language="javascript">mostrarActividades();</script>
	<?php
    }
}
?>