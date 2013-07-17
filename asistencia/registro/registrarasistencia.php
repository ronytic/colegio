<?php
include_once("../../login/check.php");
include_once("../../class/alumno.php");
include_once("../../class/curso.php");
include_once("../../class/asistencia.php");
include_once("../../class/cursoarea.php");
include_once("../../class/config.php");
include_once("../../class/agenda.php");
$alumno=new alumno;
$curso=new curso;
$cursoarea=new cursoarea;
$asistencia=new asistencia;
$config=new config;
$agenda=new agenda;
$Codigo=$_POST['Codigo'];
$folder="../../";
$cnf=$config->mostrarConfig("AtrasoAgenda");
$AtrasoAgenda=$cnf['Valor'];
$al=$alumno->mostrarDatosCodBarra("CodBarra='$Codigo'");
if(count($al)<=0){
	?>
    <div class="alert alert-error grande"><?php echo $idioma['CodigoNoAsignado']?></div>
    <script language="javascript">$("#Codigo").val('').focus();mostrar();</script>
    <?php
	exit();
}
$al=array_shift($al);
$cur=$curso->mostrarCurso($al['CodCurso']);
$cur=array_shift($cur);
$cArea=$cursoarea->mostrarArea($cur['CodCursoArea']);
$cArea=array_shift($cArea);
$FechaActual=date("Y-m-d");
$HoraActual=date("H:i:s");
$Dia=date("N",strtotime($FechaActual));
$asis=$asistencia->mostrarCodAlumnoFecha($al['CodAlumno'],$FechaActual);
if(count($asis)>0){
	?><div class="alert alert-error grande"><?php echo $idioma['YaMarcoAsistencia']?></div><?php	
}else{
switch($Dia){
	case 1:{$HoraInicio=$cArea['HoraInicioL'];$HoraAtraso=$cArea['HoraEsperaL'];}break;
	case 2:{$HoraInicio=$cArea['HoraInicioM'];$HoraAtraso=$cArea['HoraEsperaM'];}break;
	case 3:{$HoraInicio=$cArea['HoraInicioMi'];$HoraAtraso=$cArea['HoraEsperaMi'];}break;
	case 4:{$HoraInicio=$cArea['HoraInicioJ'];$HoraAtraso=$cArea['HoraEsperaJ'];}break;
	case 5:{$HoraInicio=$cArea['HoraInicioV'];$HoraAtraso=$cArea['HoraEsperaV'];}break;
	case 6:{$HoraInicio=$cArea['HoraInicioS'];$HoraAtraso=$cArea['HoraEsperaS'];}break;
	case 7:{$HoraInicio=$cArea['HoraInicioD'];$HoraAtraso=$cArea['HoraEsperaD'];}break;
}
if($HoraInicio=='00:00:00' || $HoraAtraso=="00:00:00"){
	?><div class="alert alert-error grande"><?php echo $idioma['HoyNoTieneClases']?></div>
	<script language="javascript">$("#Codigo").val('').focus();mostrar();</script>
	<?php	
	exit();
}

if(strtotime($HoraActual)<=strtotime($HoraAtraso)){//Correctamente Asistencia
	$valores=array("CodAlumno"=>$al['CodAlumno'],
					"Tipo"=>"'C'",
					"Fecha"=>"'".$FechaActual."'",
					"Hora"=>"'".$HoraActual."'",
					"Dia"=>$Dia
					);
	if($asistencia->insertarRegistro($valores)){ 
	?>
    <div class="alert alert-success grande"><?php echo $idioma['AsistenciaAlumno']?></div>
    <?php
	}else{
	?>
	<div class="alert alert-success grande"><?php echo $idioma['ErrorAsistencia']?></div>
	<?php }
	//echo "Asistencia";
}else{//Atraso
	$valores=array("CodAlumno"=>$al['CodAlumno'],
					"Tipo"=>"'A'",
					"Fecha"=>"'".$FechaActual."'",
					"Hora"=>"'".$HoraActual."'",
					"Dia"=>$Dia
					);
	if($asistencia->insertarRegistro($valores)){ 
	?>
    <div class="alert alert-danger grande"><?php echo $idioma['AtrasoAlumno']?></div>
    <?php if($AtrasoAgenda){
			$agendaValues=array(
				'CodCurso'=>$al['CodCurso'],
				'CodAlumno'=>$al['CodAlumno'],
				'CodMateria'=>20,//Secretaria
				'CodObservacion'=>8,//Atraso
				'Fecha'=>"'$FechaActual'",
				'FechaRegistro'=>"'$FechaActual'",
				'HoraRegistro'=>"'$HoraActual'",
				'Activo'=>1,
				'Detalle'=>"''",
				'CodUsuario'=>$_SESSION['CodUsuarioLog'],
				'Nivel'=>$_SESSION['Nivel'],
				'Resaltar'=>0,
			);
			$agenda->insertarRegistro($agendaValues);
			}
	}else{
	?>
	<div class="alert alert-success grande"><?php echo $idioma['ErrorAsistencia']?></div>
	<?php }
	//echo "atraso";
}
/*echo "<br>";
echo strtotime($HoraActual)." - ".$HoraActual;
echo "<br>";
echo strtotime($HoraInicio)." - ".$HoraInicio;
echo "<br>";
echo strtotime($HoraAtraso)." - ".$HoraAtraso;
//print_r($cArea);*/
}
?>
<?php $ima=$folder."imagenes/alumnos/".$al['Foto'];if(!file_exists($ima) || empty($al['Foto'])){$ima=$folder."imagenes/alumnos/0.jpg";}?>
<table class="tabla">
    <tr>
        <td rowspan="4"><img src="<?php echo $ima?>" class="img-polaroid" width="100"/></td>
        <td colspan="3" class="text-info x2 espacio"><?php echo capitalizar($al['Paterno']." ".$al['Materno']." ".$al['Nombres'])?></span></td></tr>
    <tr><td class="text-info x2 espacio"><?php echo $cur['Nombre']?></span></td></tr>
</table>
<script language="javascript">$("#Codigo").val('').focus();mostrar();</script>