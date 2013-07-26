<?php
function archivocsv($nombrearchivo,$datos,$separador=",",$terminador="\n"){
	$nombre = $nombrearchivo;
	 
	$f = fopen($nombre,"w");
	$sep = $separador; //separador
	$i=0;
	foreach($datos as $d){$i++;
		
		if($terminador=="AUTO"){
			if(count($datos)!=$i){
				//$linea = implode($separador,$d)."\r\n";
				$linea = implode($separador,$d).chr(13).chr(10);
			}else{
				$linea = implode($separador,$d);
			}
		}
		else{
			$linea = implode($separador,$d)."{$terminador}";
		}
		fwrite($f,$linea);
	}
	fclose($f);
	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	header("Content-Disposition: attachment; filename=$nombre");
	header("Content-Type: application/csv");
	header("Content-Transfer-Encoding: binary");
	readfile($nombre);
	
}
?>