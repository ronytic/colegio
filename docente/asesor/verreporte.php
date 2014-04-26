<?php
include_once("../../login/check.php");

if(isset($_POST)){
	//print_r($_POST);
	$TipoReporte=$_POST['TipoReporte'];
	$CodCurso=$_POST['CodCurso'];
	$Periodo=$_POST['Periodo'];
	switch($TipoReporte){
		case 'CentralizadorNotas':{$url="../../impresion/notas/centralizadorperiodo.php?CodCurso=$CodCurso&Periodo=$Periodo&mf=dce7c4174ce9323904a934a486c41288";}break;	
		case 'Agenda':{$url="../../impresion/agenda/reportegeneral.php?CodCurso=".$CodCurso;}break;	
	}
	
	?>
    <a href="<?php echo $url;?>" class="btn btn-danger" target="_blank"><?php echo $idioma['AbrirOtraVentana']?></a>
    <hr />
    <strong><?php echo $idioma['ReporteImpresion'];?></strong>
    <iframe src="<?php echo $url?>" height="600" width="100%" name="pdf"></iframe>
	<?php
}
?>