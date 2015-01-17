<?php
//include_once("../login/check.php");
//enviar sms por MODEM
function enviarSms($puerto,$cel, $text){
	$TextoSeparado=str_split($text,160);
	//print_r($TextoSeparado);
	$valor=false;
	foreach($TextoSeparado as $text){
		//echo "HOLA";
		$valor=enviarSms1($puerto,$cel,$text);
	}
	return $valor;
}
function enviarSms1($puerto,$cel, $text){

		$text1 = substr($text,0,10);
		$port = $puerto;
		//$port = "COM5";
		//webLog("PARAM: $cel: $text1...");
		//webLog("PORT: $port");
		$modem = null;
		try{
		  $config = "mode $port: baud=9600 data=8 stop=1 parity=n xon=on"; 
		  //webLog($config);
		  exec($config);
		  //==============================
		  //webLog("OPEN $port");
		  $modem = dio_open("$port:", O_RDWR);
		  $c = 0;
		  $res = 'NOK';
		  while($c < 20 && $res != 'OK'){
			$c++;
			$res = callAT("at", $modem, false);
		  }
		  if($res == 'OK'){
			  $res = callAT("at", $modem);
			  $res = callAT("at+cmgf=1", $modem);
			  $res = callAT("at+cmgs=\"$cel\"", $modem);
			  $res = callAT("$text", $modem, false, 0x1A);
			  return true;
		  } else {
			  return false;
			//webLog("NO SINCRONIZADO....","MODEM");
		  }
		  //==============================
		  //webLog("CLOSE $port");
		  dio_close($modem);
		}catch( Exception  $error ){
			return false;
		  //webLog($error, "ERROR");
		}
		//webLog("FIN del proceso..");
		
	
}
function comprobarConexion($Puerto){
	$port = $Puerto;
    //$port = "COM5";
    //webLog("PORT: $port");
	try{
	  $config = "mode $port: baud=9600 data=8 stop=1 parity=n xon=on"; 
	  //webLog($config);
      exec($config);
	  //==============================
	  //webLog("OPEN $port");
	  @$modem = dio_open("$port:", O_RDWR);
	  $c = 0;
	  $res = 'NOK';
	  while($c < 20 && $res != 'OK'){
	    $c++;
		$res = callAT("AT", $modem, false);
	  }
	  if($res == 'OK'){
		  $res = callAT("AT", $modem);
		  $res = callAT("AT+CMGF=1", $modem);
		  $res = callAT("AT+CMGL=\"ALL\"", $modem);
		  $res =  explode("+CMGL", $res);
		  return true;
		  /*foreach( $res as $k => $v){
		    $v = str_replace( chr(0x0A), ',',$v);
		    $res [ $k ] = mb_split('(,)(?=(?:[^"]|"[^"]*")*$)', $v);
		  }*/
	  } else {
		  return false;
	    //webLog("NO SINCRONIZADO....","MODEM");
	  }
	  //==============================
	  //webLog("CLOSE $port");
	  @dio_close($modem);
	  return $res;
	}catch( Exception  $error ){
		return false;
	  //webLog($error, "ERROR");
	}
	//webLog("FIN del proceso..");
	return array();
}
//listar sms del MODEM
function listarSms(){
	$port = $puerto;
    //$port = "COM5";
    webLog("PORT: $port");
	try{
	  $config = "mode $port: baud=9600 data=8 stop=1 parity=n xon=on"; 
	  webLog($config);
      exec($config);
	  //==============================
	  webLog("OPEN $port");
	  $modem = dio_open("$port:", O_RDWR);
	  $c = 0;
	  $res = 'NOK';
	  while($c < 20 && $res != 'OK'){
	    $c++;
		$res = callAT("AT", $modem, false);
	  }
	  if($res == 'OK'){
		  $res = callAT("AT", $modem);
		  $res = callAT("AT+CMGF=1", $modem);
		  $res = callAT("AT+CMGL=\"ALL\"", $modem);
		  
		  ?>
          <pre><h1><?php print_r($res);?></h1>
          </pre>
          <?php
		  $res =  explode("+CMGL", $res);
		  foreach( $res as $k => $v){
		    $v = str_replace( chr(0x0A), ',',$v);
		    $res [ $k ] = mb_split('(,)(?=(?:[^"]|"[^"]*")*$)', $v);
		  }
	  } else {
	    webLog("NO SINCRONIZADO....","MODEM");
	  }
	  //==============================
	  webLog("CLOSE $port");
	  dio_close($modem);
	  return $res;
	}catch( Exception  $error ){
	  webLog($error, "ERROR");
	}
	webLog("FIN del proceso..");
	return array();
}
//ejecutar commando AT + Respuesta
function callAT($cmd, $modem, $log = false, $end = 0x0D ){
      $cmd = trim($cmd);
	  $cmd = $cmd.chr($end);
	  if($log){webLog($cmd,"&gt;",true);}
      dio_write ($modem, $cmd);
	  //sleep(1);
	  usleep(500000);
      $cmd = dio_read ($modem);
	  $cmd = trim($cmd);
	  if($log){webLog($cmd,"&lt;");}
	  return $cmd;
}
//COUNT LOG..
$COUNT = 0;
//escribir log <li>.....</li>
function webLog($text,$group=-666, $hex=false){
	if($group == -666){
	    global $COUNT;
		$group = (++$COUNT);
	}
	$time = microtime(true) ;
	$time = date("h.i.s.u");
	if($hex){
	    $hex='<p>';
		for ($i=0; $i < strlen($text); $i++){
			$hex = $hex.' 0x'.dechex(ord($text[$i]));
		}
	    $hex.='</p>';
	} else {
	  $hex = '';
	}
	echo "<li>$time: <i>$group</i>: $text $hex</li>";
}
//convertir string to HEX
function strToHex($string){
    $hex='';
    for ($i=0; $i < strlen($string); $i++){
        $hex = $hex.' 0x'.dechex(ord($string[$i]));
    }
    return $hex;
}
?>