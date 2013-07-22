<?php
include_once("../../login/check.php");
if(isset($_GET['c']) || !empty($_GET['c'])){
	$r="../../documentos/clases/";
	$CodClasesArchivos=$_GET['c'];
	$CodDocente=$_SESSION['CodUsuarioLog'];
	include_once("../../class/clasesarchivos.php");
	$clasesarchivos=new clasesarchivos;
	$clasea=$clasesarchivos->mostrarCodClasesArchivos($CodClasesArchivos);
	
	if(count($clasea)){
		$clasea=array_shift($clasea);
		$NombreArchivo=$clasea['NombreArchivo'];
		$Archivo = $r.$NombreArchivo;
		/*header("Content-disposition: attachment; filename=$NombreArchivo");
		header("Content-type: application/octet-stream");
		readfile($Archivo);	*/
		$root = $r;
		$file = basename($Archivo);
		$path = $root.$file;
		$type = '';
		 
		if (is_file($path)) {
		 $size = filesize($path);
		 if (function_exists('mime_content_type')) {
		 $type = mime_content_type($path);
		 } else if (function_exists('finfo_file')) {
		 $info = finfo_open(FILEINFO_MIME);
		 $type = finfo_file($info, $path);
		 finfo_close($info);
		 }
		 if ($type == '') {
		 $type = "application/force-download";
		 }
		 // Definir headers
		 header("Content-Type: $type");
		 header("Content-Disposition: attachment; filename=$file");
		 header("Content-Transfer-Encoding: binary");
		 header("Content-Length: " . $size);
		 // Descargar archivo
		 ob_end_clean();
		 flush();
		 readfile($path);
		} else {
		 die($idioma['ArchivoNoExiste']);
		}
	}
	//Descarga de Archivo
	
}
?>