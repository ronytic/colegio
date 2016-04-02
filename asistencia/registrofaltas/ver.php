<?php
include_once("../../login/check.php");

$CodCurso=$_POST['CodCurso'];
$FechaFalta=fecha2Str($_POST['FechaFalta'],0);

include_once("../../class/alumno.php");
$alumno=new alumno;
$al=$alumno->mostrarAlumnosCurso($CodCurso,2);
include_once("../../class/asistencia.php");
$asistencia=new asistencia;
include_once("../../class/curso.php");
$curso=new curso;
include_once("../../class/cursoarea.php");
$cursoarea=new cursoarea;

$Dia=date("N",strtotime($FechaFalta));
$cur=$curso->mostrarCurso($CodCurso);
$cur=array_shift($cur);
$cArea=$cursoarea->mostrarArea($cur['CodCursoArea']);
$cArea=array_shift($cArea);
switch($Dia){
    case 1:{$HoraInicio=$cArea['HoraInicioL'];$HoraAtraso=$cArea['HoraEsperaL'];$Dia="Lunes";$DiaC="L";}break;
    case 2:{$HoraInicio=$cArea['HoraInicioM'];$HoraAtraso=$cArea['HoraEsperaM'];$Dia="Martes";$DiaC="M";}break;
    case 3:{$HoraInicio=$cArea['HoraInicioMi'];$HoraAtraso=$cArea['HoraEsperaMi'];$Dia="Lunes";$DiaC="Mi";}break;
    case 4:{$HoraInicio=$cArea['HoraInicioJ'];$HoraAtraso=$cArea['HoraEsperaJ'];$Dia="Lunes";$DiaC="J";}break;
    case 5:{$HoraInicio=$cArea['HoraInicioV'];$HoraAtraso=$cArea['HoraEsperaV'];$Dia="Viernes";$DiaC="V";}break;
    case 6:{$HoraInicio=$cArea['HoraInicioS'];$HoraAtraso=$cArea['HoraEsperaS'];$Dia="Lunes";$DiaC="S";}break;
    case 7:{$HoraInicio=$cArea['HoraInicioD'];$HoraAtraso=$cArea['HoraEsperaD'];$Dia="Lunes";$DiaC="D";}break;
}
?>
<form action="guardar.php" method="post" class="formulariofaltas">
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th colspan="2"><?php echo $idioma['Curso']?>:</th>
            <th><?php echo $cur['Nombre']?></th>
            <th colspan="2"><?php echo $idioma['HoraEntrada'.$Dia]?></th>
            <th colspan="2"><?php echo $cArea['HoraInicio'.$DiaC]?></th>
        </tr>
        <tr>
            <th colspan="2"><?php echo $idioma['FechaRevisar']?>:</th>
            <th><?php echo $_POST['FechaFalta']?></th>
            <th colspan="2"><?php echo $idioma['HoraLimiteEspera'.$Dia]?></th>
            <th colspan="2"><?php echo $cArea['HoraEspera'.$DiaC]?></th>
        </tr>
        <tr>
            <th>N</th>
            <th><?php echo $idioma['ApellidoPaterno']?></th>
            <th><?php echo $idioma['ApellidoMaterno']?></th>
            <th><?php echo $idioma['Nombres']?></th>
            <th><?php echo $idioma['Tipo']?></th>
            <th width="40"><?php echo $idioma['HoraIngreso']?></th>
            <th width="40"><?php echo $idioma['ConfirmarFalta']?></th>
        </tr>
    </thead>
    <?php
    foreach($al as $a){$i++;
        $asis=$asistencia->mostrarCodAlumnoFecha($a['CodAlumno'],$FechaFalta);
        $asis=array_shift($asis);
        switch($asis['Tipo']){
            case 'A':{$Tipo=$idioma["Atraso"];}break;  
            case 'F':{$Tipo=$idioma["Falta"];}break; 
            case 'C':{$Tipo=$idioma["Asistencia"];}break;    
            default:{$Tipo="";}break;
        }
        ?>
        <tr class="<?php echo ($asis['Tipo']=="" || $asis['Tipo']=="F")?'error':''?> <?php echo $asis['Tipo']=="A"?'warning':''?> <?php echo $asis['Tipo']=="C"?'':''?>">
            <td class="der"><?php echo $i;?></td>
            <td><?php echo capitalizar($a['Paterno'])?></td>
            <td><?php echo capitalizar($a['Materno'])?></td>
            <td><?php echo capitalizar($a['Nombres'])?></td>
            <td><?php echo $Tipo?></td>
            <td><?php echo $asis['Hora']?></td>
            <td class="centrar">
            <?php if($asis['Tipo']==""){?>
            <input type="checkbox" name="f[<?php echo $a['CodAlumno']?>]">
            <?php }?>
            </td>
        </tr>
        <?php    
    }
    ?>
</table>
<input type="hidden" name="FechaFalta" value="<?php echo $FechaFalta?>">
<input type="hidden" name="HoraInicio" value="<?php echo $HoraInicio?>">
<input type="hidden" name="HoraAtraso" value="<?php echo $HoraAtraso?>">
<input type="hidden" name="CodCurso" value="<?php echo $CodCurso?>">
<input type="hidden" name="Dia" value="<?php echo date("N",strtotime($FechaFalta))?>">
<input type="submit" value="<?php echo $idioma['RegistrarFaltas']?>" class="btn btn-success">
</form>