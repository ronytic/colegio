<?php
include_once("../../login/check.php");
if(isset($_POST)){
	$CodAlumno= $_POST['CodAlumno'];
	$CodCurso=$_POST['CodCurso'];
	include_once("../../class/curso.php");
	$curso=new curso;
	$cur=array_shift($curso->mostrarCurso($CodCurso));
	if($cur['Bimestre']==1){
		$nombrearchivo="boletinbimestre.php";
	}else{
		$nombrearchivo="boletintrimestre.php";	
	}
	$url="../../impresion/notas/$nombrearchivo?CodAlumno=$CodAlumno&CodCurso=$CodCurso&mf=". md5("lock");
	?>
    <a href="<?php echo $url;?>" class="btn btn-danger" target="_blank"><?php echo $idioma['AbrirOtraVentana']?></a>
    <a href="#" class="btn btn-success" id="registrarimpresion" data-archivo="Boletin" data-alumno="<?php echo $CodAlumno;?>"><?php echo $idioma['RegistrarImpresion']?></a>
    <hr />
    <strong><?php echo $idioma['ReporteImpresion'];?></strong>
    <iframe width="100%" height="800" src="<?php echo $url;?>"></iframe>
    <a href="#" class="btn" id="mostrarimpresion" data-archivo="boletin"><?php echo $idioma['MostrarImpresion']?></a>
    <div id="respuestaimpresion"></div>
	<?php
}
?>