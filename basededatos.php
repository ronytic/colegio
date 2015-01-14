<?php
$host="localhost";
$user="root";
$pass="admina";
$database="csb2014";

/*$user="redcampu_csb";
$pass="83034888";
$database="redcampu_csb1";*/

/*Configuración de Idioma del Sistema*/
date_default_timezone_set('America/La_Paz');
setlocale(LC_CTYPE, "es_ES");
setlocale(LC_ALL, 'sp'); 
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

/*Configuración de las Tablas a Exportar*/
$tables_export=array("agenda","alumno","docente","cuota","anuncioslogin","agendaactividades","config","notificaciones","factura","facturadetalle","menu","submenu");
$tablas_optimizar=array("lograstreo","logusuario","factura","facturadetalle","agenda");
?>