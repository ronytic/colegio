<?php
include_once("../login/check.php");
if(isset($_POST)){
include_once("../class/agendaactividades.php");
$agendaactividades=new agendaactividades;

$Nivel=$_SESSION['Nivel'];
$CodUsuario=$_SESSION['CodUsuarioLog'];
$Fecha=fecha2Str($_POST['Fecha'],0);
$FechaManana=date("Y-m-d",strtotime($Fecha."+1day"));
$FechaPasado=date("Y-m-d",strtotime($Fecha."+2day"));
$Botones=$_POST['Botones'];
if(!isset($Botones)){$Botones="1";}
$actividades=$agendaactividades->mostrarActividades("( (Usuarios=0 and CodUsuario=$CodUsuario and Nivel=$Nivel) or Usuarios LIKE '%$Nivel%') and FechaActividad='$Fecha'");

$actividades1=$agendaactividades->mostrarActividades("( (Usuarios=0 and CodUsuario=$CodUsuario and Nivel=$Nivel) or Usuarios LIKE '%$Nivel%') and FechaActividad='$FechaManana'");

$actividades2=$agendaactividades->mostrarActividades("( (Usuarios=0 and CodUsuario=$CodUsuario and Nivel=$Nivel) or Usuarios LIKE '%$Nivel%') and FechaActividad='$FechaPasado'");

$i=0;
?>
<a href="#" id="exportarexcel" class="btn btn-success btn-mini"><?php echo $idioma['ExportarExcel']?></a>
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
        	<th width="20">N</th>
            <th style="width:25px;"><?php echo recortarTexto($idioma["Estado"],3,"")?></th>
            <th width="70" style="max-width:70px;"><?php echo $idioma["Prioridad"]?></th>
            <th style="max-width:75px !important;width:75px"><?php echo $idioma["Fecha"]?></th>
            <th width="80" style="max-width:80px;width:80px"><?php echo $idioma["Hora"]?></th>
            <th><?php echo $idioma["Actividad"]?></th>
			<?php if(($Botones=="1")){?><th width="60"></th><?php }?></tr>
    </thead>
                
	<?php mostrarAgenda($actividades,$Fecha);?>
    
    <?php mostrarAgenda($actividades1,$FechaManana);?>
    
    <?php mostrarAgenda($actividades2,$FechaPasado);?>

</table><?php	

}

function mostrarAgenda($actividades,$Fecha){
	global $idioma,$Botones,$Nivel,$CodUsuario;
if(count($actividades)){	
?>	
<tr><td colspan="7" class="resaltar"><small><span class=" "><?php echo count($actividades)?></span> - <?php echo $idioma["ActividadesDel"]?> <?php echo capitalizar(utf8_encode(strftime("%A, %d de %B de %Y",strtotime($Fecha))))?></small></td></tr>
<?php }else{
?>
<tr><td colspan="7" class="resaltar"><small><?php echo $idioma["NoHayActividadesEl"]?> <?php echo capitalizar(utf8_encode(strftime("%A, %d de %B de %Y",strtotime($Fecha))))?></small></td></tr>
<?php
}?>
<?php // Dia de Hoy?>
<?php 
	foreach($actividades as $ac){$i++;
        $acEstado=0;
        
		if(strtotime(date("Y-m-d H:i"))>=strtotime($ac['FechaActividad']." ".$ac['HoraFin'])){
            $acEstado=1;
        }
        
		switch($ac['Prioridad']){
            case -1:{$msgpri="warning";$textoprioridad=$idioma['Bajo'];}break;
            case 0:{$msgpri="success";$textoprioridad=$idioma['Normal'];}break;
            case 1:{$msgpri="important";$textoprioridad=$idioma['Importante'];}break;
        }	
?>
<tr class="<?php echo $acEstado?'completado':''?>">
    <td class="der"><?php echo $i?></td>
    <td><span class="label label-<?php echo $acEstado?'Inverse':''?>" title="<?php echo $acEstado?$idioma["Completado"]:$idioma["Pendiente"]?>"><?php echo $acEstado?sacarIniciales($idioma["Completado"]):sacarIniciales($idioma["Pendiente"])?></span></td>
    <td><span class="label label-<?php echo $msgpri?>"><?php echo $textoprioridad?></span></td>
    <td><?php echo fecha2Str($ac['FechaActividad'])?></td>
    <td class="der"><?php echo hora2Str($ac['HoraInicio'])."-".hora2Str($ac['HoraFin'])?></td>
    <td><?php echo $ac['Detalle']?><br />
    <?php 
            if(($Botones=="1") && $ac['Nivel']==$Nivel && $ac['CodUsuario']==$CodUsuario){								$usu=explode(",",$ac['Usuarios']);
                mostrarUsuarios($usu);
            }
            ?>
    </td>
    <?php if(($Botones=="1") && $ac['Nivel']==$Nivel && $ac['CodUsuario']==$CodUsuario){
        ?><td>
            <button class="btn btn-mini" id="modificar" rel="<?php echo $ac['CodAgendaActividades']?>" title="<?php echo $idioma['Modificar']?>"><i class="icon-pencil"></i></button>
            <button class="btn btn-mini" id="eliminar" rel="<?php echo $ac['CodAgendaActividades']?>" title="<?php echo $idioma['Eliminar']?>"><i class="icon-remove"></i></button></td><?php }else{?>
    <td></td>
    <?php }?>
</tr>
<?php }?>
<?php
}

function mostrarUsuarios($usu){
	global $idioma;
	if(in_array("1",$usu)){
		?><span class="label label-info" title="<?php echo $idioma['TodoAdministradores']?>"><?php echo recortarTexto($idioma['Administradores'],1,"")?></span><?php	
	}
	if(in_array("2",$usu)){
		?><span class="label label-info" title="<?php echo $idioma['TodoDirectores']?>"><?php echo recortarTexto($idioma['Directores'],1,"")?></span><?php	
	}
	if(in_array("3",$usu)){
		?><span class="label label-info" title="<?php echo $idioma['TodoDocentes']?>"><?php echo recortarTexto($idioma['Docentes'],1,"")?></span><?php	
	}
	if(in_array("4",$usu)){
		?><span class="label label-info" title="<?php echo $idioma['TodosSecretarias']?>"><?php echo recortarTexto($idioma['Secretaria'],1,"")?></span><?php	
	}
	if(in_array("5",$usu)){
		?><span class="label label-info" title="<?php echo $idioma['TodoRegentes']?>"><?php echo recortarTexto($idioma['Regentes'],1,"")?></span><?php	
	}
	if(in_array("6",$usu)){
		?><span class="label label-info" title="<?php echo $idioma['TodoPadresFamilia']?>"><?php echo recortarTexto($idioma['PadreFamilia'],1,"")?></span><?php	
	}
	if(in_array("7",$usu)){
		?><span class="label label-info" title="<?php echo $idioma['TodoAlumnos']?>"><?php echo recortarTexto($idioma['Alumnos'],1,"")?></span><?php	
	}
}
?>