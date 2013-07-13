<?php
include_once("../../login/check.php");
include_once("../../class/alumno.php");
include_once("../../class/curso.php");
include_once("../../class/asistencia.php");
include_once("../../class/cursoarea.php");
$alumno=new alumno;
$curso=new curso;
$cursoarea=new cursoarea;
$asistencia=new asistencia;
$Codigo=$_POST['Codigo'];
$folder="../../";
$al=$alumno->mostrarDatosCodBarra("CodBarra='$Codigo'");
if(count($al)<=0){
	?>
    <div class="alert alert-error grande"><?php echo $idioma['CodigoNoAsignado']?></div>
    <script language="javascript">$("#Codigo").val('').focus()</script>
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
$Dia=date("N",$FechaActual);
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

if(strtotime($HoraActual)<=strtotime($HoraAtraso)){//Correctamente
	$valores=array("CodAlumno"=>$al['CodAlumno'],
					"Tipo"=>"'C'",
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
					"Dia"=>$Dia
					);
	if($asistencia->insertarRegistro($valores)){ 
	?>
    <div class="alert alert-danger grande"><?php echo $idioma['AtrasoAlumno']?></div>
    <?php
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