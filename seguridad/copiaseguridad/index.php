<?php
date_default_timezone_set("America/La_Paz");
set_time_limit(0);

include_once("../../basededatos.php");

/* Usuario para la conexion a Mysql. */
//$usuario = "root";
/* Password para la conexion a Mysql. */
//$passwd = "";
 /* Host para la conexion a Mysql. */
//$host = "localhost";
/* Base de Datos que se seleccionará. */
//$bd = "csb2012";
/* Nombre del fichero que se descargará. */
$fechahora=date("Y_m_d_H_i_s");
$nombre = "backup_{$database}_".$fechahora.".dat";
/* Determina si la tabla será vaciada (si existe) cuando  restauremos la tabla. */            
$drop = true;
/* 
* Array que contiene las tablas de la base de datos que seran resguardadas.
* Puede especificarse un valor false para resguardar todas las tablas
* de la base de datos especificada en  $bd.
* 
* Ejs.:
* $tablas = false;
*    o
* $tablas = array("tabla1", "tabla2", "tablaetc");
* 
*/
$ln=mysql_connect($host,$user,$pass);
mysql_select_db($database);
$tablas = false;
/* 
* Tipo de compresion.
* Puede ser "gz", "bz2", o false (sin comprimir)
*/
$compresion = false;

/* Conexion y eso*/
//$conexion = mysql_connect($host, $usuario, $passwd)
//or die("No se puede conectar con el servidor MySQL: ".mysql_error());
//mysql_select_db($bd, $conexion)
//or die("No se pudo seleccionar la Base de Datos: ". mysql_error());


/* Se busca las tablas en la base de datos */
if ( empty($tablas) ) {
    $consulta = "SHOW TABLES FROM $database;";
    $respuesta = mysql_query($consulta, $ln)
    or die("No se pudo ejecutar la consulta: ".mysql_error());
    while ($fila = mysql_fetch_array($respuesta, MYSQL_NUM)) {
        $tablas[] = $fila[0];
    }
}


/* Se crea la cabecera del archivo */
$info['dumpversion'] = "1.1b";
$info['fecha'] = date("d-m-Y");
$info['hora'] = date("h:i:s A");
$info['mysqlver'] = mysql_get_server_info();
$info['phpver'] = phpversion();
ob_start();
print_r($tablas);
$representacion = ob_get_contents();
ob_end_clean ();
preg_match_all('/(\[\d+\] => .*)\n/', $representacion, $matches);
$info['tablas'] = implode(";  ", $matches[1]);
$dump = <<<EOT
# +===================================================================
# |
# | Generado el {$info['fecha']} a las {$info['hora']} 
# | Servidor: {$_SERVER['HTTP_HOST']}
# | MySQL Version: {$info['mysqlver']}
# | PHP Version: {$info['phpver']}
# | Base de datos: '$bd'
# | Tablas: {$info['tablas']}
# |
# +-------------------------------------------------------------------

EOT;
foreach ($tablas as $tabla) {
    
    $drop_table_query = "";
    $create_table_query = "";
    $insert_into_query = "";
    
    /* Se halla el query que será capaz vaciar la tabla. */
    if ($drop) {
        $drop_table_query = "DROP TABLE IF EXISTS `$tabla`;";
    } else {
        $drop_table_query = "# No especificado.";
    }

    /* Se halla el query que será capaz de recrear la estructura de la tabla. */
    $create_table_query = "";
    $consulta = "SHOW CREATE TABLE $tabla;";
    $respuesta = mysql_query($consulta, $ln)
    or die("No se pudo ejecutar la consulta: ".mysql_error());
    while ($fila = mysql_fetch_array($respuesta, MYSQL_NUM)) {
            $create_table_query = $fila[1].";";
    }
    
    /* Se halla el query que será capaz de insertar los datos. */
    $insert_into_query = "";
    $consulta = "SELECT * FROM $tabla;";
    $respuesta = mysql_query($consulta, $ln)
    or die("No se pudo ejecutar la consulta: ".mysql_error());
    while ($fila = mysql_fetch_array($respuesta, MYSQL_ASSOC)) {
            $columnas = array_keys($fila);
            foreach ($columnas as $columna) {
                if ( gettype($fila[$columna]) == "NULL" ) {
                    $values[] = "NULL";
                } else {
                    $values[] = "'".mysql_real_escape_string($fila[$columna])."'";
                }
            }
            $insert_into_query .= "INSERT INTO `$tabla` VALUES (".implode(", ", $values).");\n";
            unset($values);
    }
    
$dump .= <<<EOT

# | Vaciado de tabla '$tabla'
# +------------------------------------->
$drop_table_query


# | Estructura de la tabla '$tabla'
# +------------------------------------->
$create_table_query


# | Carga de datos de la tabla '$tabla'
# +------------------------------------->
$insert_into_query

EOT;
}
mysql_free_result($respuesta);
mysql_close($ln);
/* Envio *//*
if ( !headers_sent() ) {
    header("Pragma: no-cache");
    header("Expires: 0");
    header("Content-Transfer-Encoding: binary");
    switch ($compresion) {
    case "gz":
        header("Content-Disposition: attachment; filename=$nombre.gz");
        header("Content-type: application/x-gzip");
        echo gzencode($dump, 9);
        break;
    case "bz2": 
        header("Content-Disposition: attachment; filename=$nombre.bz2");
        header("Content-type: application/x-bzip2");
        echo bzcompress($dump, 9);
        break;
    default:
        header("Content-Disposition: attachment; filename=$nombre");
        header("Content-type: application/force-download");
        echo $dump;
    }
} else {
    echo "<b>ATENCION: Probablemente ha ocurrido un error</b><br />\n<pre>\n$dump\n</pre>";
}*/

header("Content-disposition: attachment; filename=$nombre");
//header("Content-Type: application/force-download");
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".strlen($dump));
header("Pragma: no-cache");
header("Expires: 0");
print $dump;
//$f=fopen($nombre,"w+");
//fwrite($f,$dump);
//fclose($f);
?> 

