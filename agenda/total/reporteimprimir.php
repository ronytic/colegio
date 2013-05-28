<?php
include_once("../../login/check.php");
if(isset($_POST)){
	$CodAlumno=$_SESSION['CodAl'];
	if(isset($_POST['CodMateria'])){
		$CodMateria=$_POST['CodMateria'];	
		$url="../../impresion/agenda/reporteindependiente.php?CodMateria=$CodMateria&lock=".md5("lock");
	}else{
		$url="../../impresion/agenda/reporteindependiente.php?lock=".md5("lock");
	}
	?>
    <a href="<?php echo $url;?>" class="btn btn-danger" target="_blank"><?php echo $idioma['AbrirOtraVentana']?></a>
    <a href="#" class="btn btn-success" id="registrarimpresion" data-archivo="Reporte Agenda" data-alumno="<?php echo $CodAlumno;?>"><?php echo $idioma['RegistrarImpresion']?></a>
    <hr />
    <strong><?php echo $idioma['ReporteImpresion'];?></strong>
    <iframe src="<?php echo $url?>" height="700" width="100%" name="pdf"></iframe>
    <a href="#" class="btn" id="mostrarimpresion"><?php echo $idioma['MostrarImpresion']?></a>
    <div id="respuestaimpresion"></div>
	<?php
}
?>