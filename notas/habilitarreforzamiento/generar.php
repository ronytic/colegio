<?php
include_once("../../login/check.php");
include_once("../../class/casilleros.php");
$casilleros=new casilleros;
if(count($casilleros->mostrarTodo("Trimestre=4 and FormulaCalificaciones!='n1 n2 + n3 + n4 +'"))==0){
 echo "Valido";
}else{
	echo "Existen Registros";	
}
?>