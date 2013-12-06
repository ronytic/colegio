<?php
include_once("../../login/check.php");
include_once("../../class/casilleros.php");
include_once("../../class/registronotas.php");
$casilleros=new casilleros;
$registronotas=new registronotas;
if(count($casilleros->mostrarTodo("Trimestre=4 and FormulaCalificaciones!='n1 n2 + n3 + n4 +'"))==0){
	//echo "Valido";
}else{
	$casilleros->eliminarCasillerosDefinitivo("Trimestre=4 and FormulaCalificaciones!='n1 n2 + n3 + n4 +'");
	//echo "Existen Registros";	
}
$i=0;
foreach($casilleros->mostrarTodo("Trimestre=3 and FormulaCalificaciones!='n1 n2 + n3 + n4 +'") as $cas){$i++;
	
	
	
	$casilla=$casilleros->estadoTabla();
	$CodCasilleros=$casilla['Auto_increment'];
	
	$valores=array("CodCasilleros"=>"$CodCasilleros",
					"CodDocenteMateriaCurso"=>$cas['CodDocenteMateriaCurso'],
					"Casilleros"=>2,
					"Trimestre"=>4,
					"FormulaCalificaciones"=>"'n1 n2 + 2 /'",
					"Dps"=>0,
					"NombreCasilla1"=>"'Nota Promedio Final'",
					"LimiteCasilla1"=>$cas['LimiteCasilla1'],
					"LimiteMinCasilla1"=>0,
					"NombreCasilla2"=>"'Nota Reforzamiento'",
					"LimiteCasilla2"=>$cas['LimiteCasilla2'],
					"LimiteMinCasilla2"=>0,

				);	
				
	/*echo "<pre>";
	print_r($valores);
	echo "</pre><br>";*/
	$casilleros->insertarRegistro($valores);
	$cCasilleros=array();
	foreach($casilleros->mostrarTodo("CodDocenteMateriaCurso=".$cas['CodDocenteMateriaCurso']) as $c){
		$cCasilleros[]=$c['CodCasilleros'];
	}
	$CodigosCasilleros=implode(",",$cCasilleros);
	foreach($registronotas->MostrarTodo("CodCasilleros=".$cas["CodCasilleros"]) as $regnotas){
		$rnotas=$registronotas->PromedioAnual($CodigosCasilleros,$regnotas['CodAlumno']);
		$rnotas=array_shift($rnotas);
			
		$NotaAnual=round($rnotas['Promedio']);
		
		$valoresNotas=array("CodCasilleros"=>$CodCasilleros,
					"Trimestre"=>4,
					"CodAlumno"=>$regnotas['CodAlumno'],
					"Nota1"=>$NotaAnual,
					"Nota2"=>0,
					"Resultado"=>$NotaAnual,
					"NotaFinal"=>$NotaAnual
				);	
		/*echo $i;	
		print_r($valoresNotas);
		echo "<br />";*/
		
		if($registronotas->insertarRegistro($valoresNotas)){
		//echo "Si";	
		}
	}
	
}
echo $idioma["RegistradoCorrectamente"];
?>