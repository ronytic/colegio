<?php
include_once("../../login/check.php");
include_once("../../basededatos.php");
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

$tablas=array("casilleros","docentemateriacurso","registronotas","tarea");
//$tablas=array("registronotas");
//$tablas=array("docentemateriacurso","casilleros");
foreach($tablas as $tabla){
	 
	mysql_query("TRUNCATE TABLE $tabla",$local);
	$consulta = "SELECT * FROM $tabla;";
	//echo $consulta;
	unset($respuesta);
	$respuesta="";
	//echo "<h1>$consulta</h1>";
	$respuesta = mysql_query($consulta,$inter)
    or die("No se pudo ejecutar la consulta: ".mysql_error());
	//echo "<h1>$consulta".mysql_num_rows($respuesta)."</h1>";
	$i=0;
	/*while($reg=mysql_fetch_array($respuesta)){
		print_r($reg);	
	}*/
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
				mysql_query($insert_into_query,$local);
				//echo $insert_into_query."<br><br><br>";
				$insert_into_query="";
			}
    }
	$insert_into_query.=";";
	//echo $insert_into_query."<br>SEPARO!!!!<hr><br>";
	mysql_query($insert_into_query,$local);
	$insert_into_query="";
}
?>