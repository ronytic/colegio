<?php
include_once("../../login/check.php");
if(isset($_POST)){
	extract($_POST);
	$url="../../impresion/reporte/reportePersonalizado.php?CodCurso=".$CodCurso."&Campo1=".$Campo1."&Campo2=".$Campo2."&Borde=".$Borde."&Blanco=".$Blanco."&Cantidad=".$Cantidad."&Sombreado=".$Sombreado;
	?>
    <a  class="btn btn-danger"  target="_blank" href="<?php echo $url;?>"><?php echo $idioma['AbrirOtraVentana']?></a><hr/>
    <iframe src="<?php echo $url;?>" width="100%" height="750"></iframe>	
    <?php
}
?>