<?php
include_once("../../login/check.php");
if(!empty($_POST)){
include_once("../../class/notascualitativabimestre.php");
$notascualitativabimestre=new notascualitativabimestre;
$CodNotasCualitativaBimestre=$_POST['CodNotasCualitativa'];
$rango1=$_POST['Rango1'];
$rango2=$_POST['Rango2'];
$rango3=$_POST['Rango3'];
$rango4=$_POST['Rango4'];
$valores=array("PrimerRango"=>"'".mayuscula($rango1)."'",
				"SegundoRango"=>"'".mayuscula($rango2)."'",
				"TercerRango"=>"'".mayuscula($rango3)."'",
				"CuartoRango"=>"'".mayuscula($rango4)."'",
			);
$notascualitativabimestre->actualizarRegistro($valores,"CodNotasCualitativaBimestre=".$CodNotasCualitativaBimestre);
echo $idioma['NotasGuardadoCorrectamente'];
}
?>