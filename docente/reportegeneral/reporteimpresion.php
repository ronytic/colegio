<?php
include_once("../../login/check.php");
if(isset($_POST)){
		$listado=$_POST['listado'];
		$url="../../impresion/docente/datosgenerales.php?listado=$listado";
		?>
        <a  class="btn btn-danger" target="_blank" href="<?php echo $url;?>"><?php echo $idioma['AbrirOtraVentana']?></a>
        <hr>
        <iframe src="<?php echo $url;?>"  width="100%" height="600"></iframe>
        <?php
}
?>