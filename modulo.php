<?php
include_once("../login/check.php");
$NoRevisar=0;
$folder="../";
include_once("../cabecerahtml.php");
$rm=$menu->mostrarMenuUrl($rmenu);
$rm=array_shift($rm);
$Nivel=$_SESSION['Nivel'];
$subme=$submenu->mostrar($Nivel,$rm['CodMenu']);
$titulo=$idioma['Modulo']." ".$idioma['De']." ".$idioma[$rm['Nombre']];
?>
<?php include_once("../cabecera.php");?> 
<div class="row-fluid">
<?php $i=0;
	foreach($subme as $s){$i++;
    ?>
    <div class="span3 box">
    	<div class="box-header centrar"><?php echo $idioma[$s['Nombre']];?></div>
        <div class="box-content centrar">
        <a class="box-small-link" href="<?php echo $s['Url']?>" title="<?php echo $idioma['IrA']?> <?php echo $idioma[$s['Nombre']];?>">
        <img src="../imagenes/submenu/<?php echo $s['Imagen']?>">
        </a>
        </div>
    </div>
    <?php
	if($i==4){
		$i=0;
	?>
    </div>
    <div class="row-fluid">
    <?php	
	}
}?>
<?php include_once("../pie.php");?>