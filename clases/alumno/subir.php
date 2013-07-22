<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	$folder="../../";
	include_once("../../class/clases.php");
	include_once("../../class/clasesarchivos.php");
	extract($_POST);
	$clases=new clases;
	$clasesarchivos=new clasesarchivos;
	$CodClases=$clases->estadoTabla();
	$CodClases=$CodClases['Auto_increment'];
	//echo $CodClases;
	$CodAlumno=$_SESSION['CodUsuarioLog'];
	$valoresClases=array(
			"CodClases"=>$CodClases,
			"CodCurso"=>$CodCurso,
			"CodMateria"=>$CodMateria,
			"CodAlumno"=>$CodAlumno,
			"Comentario"=>"'$comentario'"
	);
	//print_r($valoresClases);
	//echo "<br>";
	if($clases->insertarRegistro($valoresClases)){
		?>
        <div class="alert alert-success">
        	<?php echo $idioma['DatosGuardadosCorrectamente']?>
        </div>
        <?php	
	}else{
		?>
        <div class="alert alert-success">
        	<?php echo $idioma['DatosGuardadosError']?>
        </div>
        <?php	
	}
	if(empty($_FILES)){
	exit();	
	}
	$files=(rearrange($_FILES['files']));
	foreach($files as $f){
		$CodClasesArchivos=$clasesarchivos->estadoTabla();
		$CodClasesArchivos=$CodClasesArchivos['Auto_increment'];
		if($nombreArchivo=subirArchivo($f,"documentos/clases/","",$CodClasesArchivos)){
			$valoresArchivo=array(
				"CodClases"=>$CodClases,
				"NombreArchivo"=>"'$nombreArchivo'",
				"Tipo"=>"'".$f['type']."'",
			);
			//print_r($valoresArchivo);
			//echo "<br>";
			$clasesarchivos->insertarRegistro($valoresArchivo);
		}

	}
	
	//print_r($archivos);
	
}
function rearrange( $arr ){
    foreach( $arr as $key => $all ){
        foreach( $all as $i => $val ){
            $new[$i][$key] = $val;    
        }    
    }
    return $new;
}
?>