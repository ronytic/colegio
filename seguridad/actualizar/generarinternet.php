<?php
include_once("../../login/check.php");
if(!empty($_POST) && is_array($_POST['Tablas'])){
	include_once("../../class/bd.php");
	$bd=new bd;
	$tablas=$_POST['Tablas'];
	$estructura=$_POST['Estructura'];
	$truncate=$_POST['Vaciar'];
	$drop=$_POST['Eliminar'];
	/* Se crea la cabecera del archivo */
	//$tablas = array("tabla1", "tabla2", "tablaetc");
	$info['dumpversion'] = "1.1b";
	$info['fecha'] = date("d-m-Y");
	$info['hora'] = date("h:i:s A");
	$info['mysqlver'] = mysql_get_server_info();
	$info['phpver'] = phpversion();
	//ob_start();
	//print_r($tablas);
	//$representacion = ob_get_contents();
	//ob_end_clean ();
//	preg_match_all('/(\[\d+\] => .*)\n/', $representacion, $matches);
//	$info['tablas'] = implode(";  ", $matches[1]);
	$tabla=implode(",",$tablas);
/*$dump = <<<EOT
# +===================================================================
# |
# | Generado el {$info['fecha']} a las {$info['hora']} 
# | Servidor: {$_SERVER['HTTP_HOST']}
# | MySQL Version: {$info['mysqlver']}
# | PHP Version: {$info['phpver']}
# | Base de datos: '$basededatos'
# | Tablas: {$tabla}
# |
# +-------------------------------------------------------------------

EOT;*/
foreach ($tablas as $tabla) {
    
    $drop_table_query = "";
	$truncate_table_query = "";
    $create_table_query = "";
    $insert_into_query = "";
    
    /* Se halla el query que será capaz vaciar la tabla. */
    if ($drop) {
        $drop_table_query = "DROP TABLE IF EXISTS `$tabla`;";
    } else {
        //$drop_table_query = "# No especificado.";
    }
	
	 if ($truncate) {
        $truncate_table_query = "TRUNCATE TABLE `$tabla`;";
    } else {
        //$truncate_table_query = "# No especificado.";
    }
    /* Se halla el query que será capaz de recrear la estructura de la tabla. */
	if($estructura){
		$create_table_query = "";
		$consulta = "SHOW CREATE TABLE $tabla;";
		$respuesta = mysql_query($consulta)
		or die("No se pudo ejecutar la consultaaa: ".mysql_error());
		while ($fila = mysql_fetch_array($respuesta, MYSQL_NUM)) {
				$create_table_query = $fila[1]."";
		}
	}else{
		//$create_table_query = "# No especificado.";
	}
    /* Se halla el query que será capaz de insertar los datos. */
    $insert_into_query = "";
    $consulta = "SELECT * FROM $tabla;";
    $respuesta = mysql_query($consulta)
    or die("No se pudo ejecutar la consulta: ".mysql_error());
	$i=0;
    while ($fila = mysql_fetch_array($respuesta, MYSQL_ASSOC)) {$i++;
            $columnas = array_keys($fila);
            foreach ($columnas as $columna) {
                if ( gettype($fila[$columna]) == "NULL" ) {
                    $values[] = "NULL";
                } else {
                    $values[] = "'".mysql_real_escape_string($fila[$columna])."'";
                }
            }
			if($i==400){$i=0;}
			if($i==1){
            	$insert_into_query .= ";INSERT INTO `$tabla` VALUES (".implode(", ", $values).")";
			}else{
				$insert_into_query .= ",(".implode(", ", $values).")";
			}
            unset($values);
    }
    
$dump .= <<<EOT
$drop_table_query$create_table_query$truncate_table_query$insert_into_query
EOT;
}
	print($dump);
}else{
	echo "No selecciono ninguna tabla";
}
?>