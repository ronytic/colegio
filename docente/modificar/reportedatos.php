<?php 
include_once '../../login/check.php';
if(isset($_POST)){
$folder="../../";
$CodDocente=$_POST['CodDocente'];
$url="../../impresion/docente/verdatos.php?CodDocente=$CodDocente&lock=".md5("lock");
?>
	<a  class="btn btn-danger" target="_blank" href="<?php echo $url;?>"><?php echo $idioma['AbrirOtraVentana']?></a>
    <hr />
    <iframe src="<?php echo $url?>" width="100%" height="600" ></iframe>
<?php }?>