<?php
include_once("../../login/check.php");
include_once("../../basedatos.php");
include_once("../../class/config.php");
set_time_limit(5*60);
//ini_set('max_execution_time',3000);
$config=new config;
$cnf=($config->mostrarConfig("IpInternet"));
$IpInternet=$cnf['Valor'];
$cnf=($config->mostrarConfig("PuertoInternet"));
$PuertoInternet=$cnf['Valor'];
$cnf=($config->mostrarConfig("UsuarioInternet"));
$UsuarioInternet=$cnf['Valor'];
$cnf=($config->mostrarConfig("ContrasenaInternet"));
$ContrasenaInternet=$cnf['Valor'];
$cnf=($config->mostrarConfig("BaseDatosInternet"));
$BaseDatosInternet=$cnf['Valor'];

$local=mysql_connect($host,$user,$pass);
mysql_select_db($database,$local);
mysql_query("SET NAMES utf8",$local);
$inter=mysql_connect($IpInternet.":".$PuertoInternet,$UsuarioInternet,$ContrasenaInternet);
mysql_select_db($BaseDatosInternet,$inter);
mysql_query("SET NAMES utf8",$inter);
foreach($tables_export as $tabla){
	$consulta = "SELECT * FROM $tabla;";
	mysql_query("TRUNCATE TABLE $tabla",$inter);
    $respuesta = mysql_query($consulta,$local)
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
			
			if($i==1){
            	$insert_into_query .= "INSERT INTO `$tabla` VALUES (".implode(", ", $values).")";

			}else{
				$insert_into_query .= ",(".implode(", ", $values).")";
			}
            unset($values);
			if($i==400){$i=0;
				$insert_into_query.=";";
				mysql_query($insert_into_query,$inter);
				//echo $insert_into_query."<br><br><br>";
				$insert_into_query="";
			}
    }
	$insert_into_query.=";";
	mysql_query($insert_into_query,$inter);
}
?>