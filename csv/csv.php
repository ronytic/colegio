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
	
	/*header('Content-Encoding: UTF-8');
header('Content-type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename=Customers_Export.csv');
echo "\xEF\xBB\xBF"; // UTF-8 BOM*/
/*
	header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=file.csv'));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
*/
	
	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	header("Content-Disposition: attachment; filename=$nombre");
	header("Content-Type: application/csv;charset=UTF-8");
	header('Content-type: text/csv; charset=UTF-8');
	header('Content-Encoding: UTF-8');
	//header("content-type:application/csv;charset=UTF-8");
	header("Content-Transfer-Encoding: binary");
	readfile($nombre);
	
}
?>