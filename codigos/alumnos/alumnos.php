<?php
include_once("../../login/check.php");
if(!empty($_GET)){
$CodAlumno=$_GET['CodAlumno'];
include_once("../../class/alumno.php");
$alumno=new alumno;
$folder="../../";
//include_once("../../cabecerahtml.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
</head>
<body>
<div style="text-align:center"><h1><?php echo $idioma['CodigoBarra']?></h1></div>
<input type="button" value="<?php echo $idioma['Imprimir']?>" onClick="javascript:window.print();" class="btn btn-info"><hr>
<?php
$al=$alumno->mostrarTodoDatos($CodAlumno);
$al=array_shift($al);
//foreach($alumno->mostrarDatosAlumnosWhere("CodCurso=".$CodCurso) as $al){
	?>
    <div style="display:inline-block;border:#CCC 1px solid;padding:10px; width:250px; text-align:center">
    <div class="centrar"><?php echo capitalizar($al['Paterno']);?> <?php echo capitalizar($al['Materno']);?> <?php echo capitalizar($al['Nombres']);?></div>
    <img src="../../code/barcode.php?code=<?php echo $al['CodBarra']?>&encoding=ANY" class="span2"  height="100">
    
    </div>
    <?php
//}
}
?>
</body>
</html>