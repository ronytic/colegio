<?php
include_once("../../login/check.php");
include_once("../../class/asistencia.php");
include_once("../../class/alumno.php");
include_once("../../class/cursoarea.php");
include_once("../../class/curso.php");
$folder="../../";
$titulo="NCerrarMarcarAsistencia";
$asistencia=new asistencia;
$alumno=new alumno;
$curso=new curso;
$cursoarea=new cursoarea;
$FechaActual=date("Y-m-d");
$Dia=date("N",strtotime($FechaActual));
$asis=$asistencia->listadoFaltasHoy($FechaActual);
$Cantidad=count($asis);
include_once($folder."cabecerahtml.php");
?>
<script language="javascript" type="text/javascript" src="../../js/asistencia/registrarfalta.js"></script>
<script language="javascript" type="text/javascript">
	var Mensaje="<?php echo $idioma['SeguroRegistrarFaltas']?>";
</script>
<?php include_once($folder."cabecera.php");?>
<div class="span12">
    <div class="box">
    <div class="box-header"><h2><?php echo $idioma['AlumnosFaltas']?></h2></div>
    <div class="box-content">
    <?php
    if($Cantidad){
        ?>
        <table class="table table-hover table-striped table-bordered">
        	<thead>
            	<tr><th>N</th><th><?php echo $idioma['Nombres']?></th><th><?php echo $idioma['Curso']?></th></tr>
            </thead>
        <?php $i=0; foreach($asis as $a){
			$al=$alumno->mostrarTodoDatos($a['CodAlumno']);
			$al=array_shift($al);
			$cur=$curso->mostrarCurso($al['CodCurso']);
			$cur=array_shift($cur);
			$cArea=$cursoarea->mostrarArea($cur['CodCursoArea']);
			$cArea=array_shift($cArea);
			switch($Dia){
			case 1:{$HoraInicio=$cArea['HoraInicioL'];$HoraAtraso=$cArea['HoraEsperaL'];}break;
			case 2:{$HoraInicio=$cArea['HoraInicioM'];$HoraAtraso=$cArea['HoraEsperaM'];}break;
			case 3:{$HoraInicio=$cArea['HoraInicioMi'];$HoraAtraso=$cArea['HoraEsperaMi'];}break;
			case 4:{$HoraInicio=$cArea['HoraInicioJ'];$HoraAtraso=$cArea['HoraEsperaJ'];}break;
			case 5:{$HoraInicio=$cArea['HoraInicioV'];$HoraAtraso=$cArea['HoraEsperaV'];}break;
			case 6:{$HoraInicio=$cArea['HoraInicioS'];$HoraAtraso=$cArea['HoraEsperaS'];}break;
			case 7:{$HoraInicio=$cArea['HoraInicioD'];$HoraAtraso=$cArea['HoraEsperaD'];}break;
			}
			if($HoraInicio!='00:00:00' || $HoraAtraso!="00:00:00"){
				$sw=1;
				$i++;
            ?><tr>
                <td><?php echo $i;?></td>
                <td><?php echo capitalizar($al['Paterno']." ".$al['Materno']." ".$al['Nombres']);?></td>
                <td><?php echo $cur['Nombre']?></td>
            </tr>
        <?php }
		
			}?>
            <tfoot>
            <tr><th colspan="2"><?php echo $idioma['Total']?> <?php  echo $idioma['De']?> <?php echo $idioma['AlumnosFaltas']?>: <?php echo $i?></th>
                	<th><?php echo $idioma['Fecha']?>: <?php echo fecha2Str($FechaActual)?></th>
                </tr>
            </tfoot>
        </table>
        <?php if($sw){?>
        <div class="alert alert-error"><strong><?php echo $idioma['CerrarAsistencias']?> <?php echo fecha2Str($FechaActual)?><br> <?php echo $idioma['TodosAlumnosFaltas']?></strong>
        <hr>
        	<a href="registrarfaltas.php?Fecha=<?php echo $FechaActual?>"  id="registrarfalta" class="btn btn-danger"><?php echo $idioma['TerminarControlAsistencia']?></a>
        </div>
        <?php }?>
        <?php	
    }else{
        ?>
        <div class="alert alert-error"><?php echo $idioma['NoExistenFaltasHoy']?></div>
        <?php
    }
    ?>
    </div>
    </div>
</div>
<?php include_once($folder."pie.php");?>