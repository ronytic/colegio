<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="NConfiguracionUsuario";

include_once("../../class/usuario.php");
$usuarioconf=new usuario;
$usuconf=$usuarioconf->mostrarDatos($_SESSION['CodUsuarioLog']);
$usuconf=array_shift($usuconf);
$valoridioma=array("es"=>"Castellano","ay"=>'Aymara',"qu"=>"Quechua","gu"=>'Guarani',"en"=>'Ingles');

$ima=$folder."imagenes/usuario/".$usuconf['Foto'];
if(!file_exists($ima) || empty($usuconf['Foto'])){
	 $ima=$folder."imagenes/usuario/0.jpg";	
}
$NoRevisar=1;
include_once($folder."cabecerahtml.php");
?>
<script language="javascript" type="text/javascript" src="../../js/core/plugins/jquery.alphanumeric.pack.js"></script>
<script language="javascript" type="text/javascript" src="../../js/usuario/configuracion.js"></script>
<script language="javascript">
	var ContrasenaNoIgual="<?php echo $idioma['ContrasenaNoIgual']?>";
</script>
<?php include_once($folder."cabecera.php");?>
<span class="span12 box">
	<div class="box-header"><h2><i class="icon-cog"></i><span class="break"></span><?php echo $idioma['DatosUsuario']?></h2></div>
    <div class="box-content">
    <?php if(isset($_GET['s'])):?>
    <div class="alert alert-success"><?php echo $idioma['DatosGuardadosCorrectamente']?>
    	<button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php endif;?>
    <form action="guardaradmin.php" method="post" enctype="multipart/form-data" id="datos" autocomplete="off">
    	<table class="table table-hover table-striped table-bordered">
        	<tr><td><?php echo $idioma['Nombres']?>:</td><td><?php campo("Nombres","text",$usuconf['Nombres'],"span6",1)?></td></tr>
            <tr><td><?php echo $idioma['Paterno']?>:</td><td><?php campo("Paterno","text",$usuconf['Paterno'],"span6",1)?></td></tr>
            <tr><td><?php echo $idioma['Materno']?>:</td><td><?php campo("Materno","text",$usuconf['Materno'],"span6")?></td></tr>
            <tr><td><?php echo $idioma['SobreNombre']?>:</td><td><?php campo("Nick","text",$usuconf['Nick'],"span6",1)?></td></tr>
            <tr><td><?php echo $idioma['Usuario']?>:</td><td><?php campo("Usuario","text",$usuconf['Usuario'],"span6",1)?></td></tr>
            <tr><td><?php echo $idioma['Contrasena']?>:</td><td><?php campo("Pass","password","","span6",0,$idioma['Contrasena'])?></td></tr>
            <tr><td><?php echo $idioma['RepetirContrasena']?>:</td><td><?php campo("PassRepetir","password","","span6",0,$idioma['RepetirContrasena'])?></td></tr>
            
            <tr><td><?php echo $idioma['Idioma']?>:</td><td><?php campo("Idioma","select",$valoridioma,"span6",1,"",0,"",$usuconf['Idioma'])?></td></tr>
            <tr><td><?php echo $idioma['Foto']?>:
            	<br /><small><?php echo $idioma['ImagenRecomendada']?> 
                <br /><?php echo $idioma['TipoArchivo']?> "jpg" 
                <br /><?php echo $idioma['TamanoArchivo']?> 200x200</small>
            </td><td><?php campo("Foto","file","","span12",0,"",0,array("accept"=>"image/*"))?>
            		<br /><img src="<?php echo $ima?>" class="img-polaroid" width="100"/>
            </td></tr>
        </table>
        <input type="submit" class="btn btn-success" value="<?php echo $idioma['GuardarConfiguracion']?>"/>
	</form>
    </div>
</span>
<?php include_once($folder."pie.php");?>