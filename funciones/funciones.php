<?php
function campo($nombre,$tipo="text",$valores="",$clase="",$required=0,$placeholder="",$autofocus=0,$adicional=array(),$valorseleccion=NULL){
	global $idioma;
	if($tipo=="" && empty($tipo)){$tipo="text";}
	if(empty($adicional) && $adicional==""){$adicional=array();}
	
	switch($tipo){
		case "textarea":{?>
        	<textarea id="<?php echo $nombre;?>" name="<?php echo $nombre;?>" class="<?php echo $clase;?>" <?php echo $autofocus==1?'autofocus':'';?><?php foreach($adicional as $k=>$v){echo ' '.$k.'="'.$v.'"';}?> placeholder="<?php echo $placeholder;?>" <?php echo $required==1?'required="required"':'';?>><?php echo $valores?></textarea>
			<?php }break;
			
		case "select":{
			?>
        	<select id="<?php echo $nombre;?>" name="<?php echo $nombre;?>" <?php echo $autofocus==1?'autofocus':'';?><?php foreach($adicional as $k=>$v){echo ' '.$k.'="'.$v.'"';}?> class="<?php echo $clase;?>" <?php echo $required==1?'required="required"':'';?>><?php  if(empty($valorseleccion) && $required==0){?><option value="" selected="selected"><?php echo $idioma['Seleccionar']?></option><?php }?>
            	<?php foreach($valores as $k=>$v){?><option value="<?php echo $k;?>" <?php echo (string)$valorseleccion==(string)$k?'selected':'';?>><?php echo $v;?></option><?php	}?>
            </select>
			<?php }break;	
		
		case "hidden":{
            ?><input type="<?php echo $tipo;?>" id="<?php echo $nombre;?>" name="<?php echo $nombre;?>"<?php foreach($adicional as $k=>$v){echo ' '.$k.'="'.$v.'"';}?> value="<?php echo $valores;?>" class="<?php echo $clase;?>" <?php echo $required==1?'required="required"':'';?>/><?php
			}break;
			
		case "submit":{
            ?><input type="<?php echo $tipo;?>" id="<?php echo $nombre;?>" name="<?php echo $nombre;?>"<?php foreach($adicional as $k=>$v){echo ' '.$k.'="'.$v.'"';}?> value="<?php echo $valores;?>" class="<?php echo $clase;?>" <?php echo $required==1?'required="required"':'';?>/><?php
			}break;
			
		case "checkbox":{
            ?><input type="<?php echo $tipo;?>" id="<?php echo $nombre;?>" name="<?php echo $nombre;?>"<?php foreach($adicional as $k=>$v){echo ' '.$k.'="'.$v.'"';}?> value="<?php echo $valores;?>" <?php echo $valorseleccion==$valores?'checked="checked"':''?>class="<?php echo $clase;?>" <?php echo $required==1?'required="required"':'';?>/><?php
			}break;
			
		default:{
			if(!is_array($valores))
		?><input type="<?php echo $tipo;?>" id="<?php echo $nombre;?>" name="<?php echo $nombre;?>" <?php echo $autofocus==1?'autofocus':'';?><?php foreach($adicional as $k=>$v){echo ' '.$k.'="'.$v.'"';}?> placeholder="<?php echo $placeholder;?>" value="<?php echo $valores?>" class="<?php echo $clase;?>" <?php echo $required==1?'required="required"':'';?>/><?php
		}break;		
	}
}
function campos($texto,$nombre,$tipo="text",$valores="",$orientacion=0,$clase="",$required=0,$autofocus=0,$adicional=array(),$valorseleccion=""){
	if($tipo=="" && empty($tipo)){$tipo="text";}
	if(empty($adicional) && $adicional==""){$adicional=array();}
	if($orientacion==1){?><div class="control-group"><?php }
	
	if($tipo!="submit"){
		switch($tipo){
			case "radio":{ if($orientacion==1){?><div class="controls"><?php }?><label class="radio"><?php }break;
			case "checkbox":{if($orientacion==1){?><div class="controls"><?php }?><label class="checkbox <?php echo $orientacion==0?'inline':'';?>"><?php }break;
			default:{
				?><label for="<?php echo $nombre;?>" <?php echo $orientacion==1?'class="control-label"':'';?>><?php echo $texto;?></label><?php				
			}break;
		}
	}
	if($orientacion==1 && $tipo!="radio" && $tipo!="checkbox"){?><div class="controls"><?php }
	switch($tipo){
		case "textarea":{?>
        	<textarea id="<?php echo $nombre;?>" name="<?php echo $nombre;?>" class="<?php echo $clase;?>" <?php echo $autofocus==1?'autofocus':'';?><?php foreach($adicional as $k=>$v){echo ' '.$k.'="'.$v.'"';}?> placeholder="Ingrese su <?php echo $texto;?>" <?php echo $required==1?'required="required"':'';?>><?php echo $valores?></textarea>
			<?php }break;
			
		case "select":{?>
        	<select id="<?php echo $nombre;?>" name="<?php echo $nombre;?>" <?php echo $autofocus==1?'autofocus':'';?><?php foreach($adicional as $k=>$v){echo ' '.$k.'="'.$v.'"';}?> class="<?php echo $clase;?>" <?php echo $required==1?'required="required"':'';?>><option value="">Seleccionar</option>
            	<?php foreach($valores as $k=>$v){?><option value="<?php echo $k;?>" <?php echo $valorseleccion==$k?'selected':'';?>><?php echo $v;?></option><?php	}?>
            </select>
			<?php }break;	
		
		case "hidden":{
            ?><input type="<?php echo $tipo;?>" id="<?php echo $nombre;?>" name="<?php echo $nombre;?>"<?php foreach($adicional as $k=>$v){echo ' '.$k.'="'.$v.'"';}?> value="<?php echo $valores;?>" class="<?php echo $clase;?>" <?php echo $required==1?'required="required"':'';?>/><?php
			}break;
			
		case "submit":{
            ?><input type="<?php echo $tipo;?>" id="<?php echo $nombre;?>" name="<?php echo $nombre;?>"<?php foreach($adicional as $k=>$v){echo ' '.$k.'="'.$v.'"';}?> value="<?php echo $texto;?>" class="<?php echo $clase;?>" <?php echo $required==1?'required="required"':'';?>/><?php
			}break;
			
		default:{
			if(!is_array($valores))
		?><input type="<?php echo $tipo;?>" id="<?php echo $nombre;?>" name="<?php echo $nombre;?>" <?php echo $autofocus==1?'autofocus':'';?><?php foreach($adicional as $k=>$v){echo ' '.$k.'="'.$v.'"';}?> placeholder="Ingrese su <?php echo $texto;?>" value="<?php echo $valores?>" class="<?php echo $clase;?>" <?php echo $required==1?'required="required"':'';?>/><?php
		}break;		
	}
	switch($tipo){
			case "radio":{ echo $texto;?></label><?php if($orientacion==1){?></div><?php }}break;
			case "checkbox":{echo $texto;?></label><?php if($orientacion==1){?></div><?php }}break;
	}
	if($orientacion==1 && $tipo!="radio" && $tipo!="checkbox"){?></div><?php }
	if($orientacion==1){?></div><?php }
}
function campoMI($texto=""){
	?><div class="control-group"><label for="<?php echo $nombre;?>" class="control-label"><?php echo $texto;?></label><?
}
function campoMF(){
	?></div><?
}
function campoM($texto,$nombre,$tipo="text",$valores="",$orientacion=0,$clase="",$required=0,$autofocus=0,$adicional=array(),$valorseleccion=""){
	if($tipo=="" && empty($tipo)){$tipo="text";}
	if(empty($adicional) && $adicional==""){$adicional=array();}
	
	if($tipo!="submit"){
		switch($tipo){
			case "radio":{ if($orientacion==1){?><div class="controls"><?php }?><label class="radio"><?php }break;
			case "checkbox":{if($orientacion==1){?><div class="controls"><?php }?><label class="checkbox <?php echo $orientacion==0?'inline':'';?>"><?php }break;
			default:{
		/*		?><label for="<?php echo $nombre;?>" <?php echo $orientacion==1?'class="control-label"':'';?>><?php echo $texto;?></label><?php	*/			
			}break;
		}
	}
	if($orientacion==1 && $tipo!="radio" && $tipo!="checkbox"){?><div class="controls"><?php }
	switch($tipo){
		case "textarea":{?>
        	<textarea id="<?php echo $nombre;?>" name="<?php echo $nombre;?>" class="<?php echo $clase;?>" <?php echo $autofocus==1?'autofocus':'';?><?php foreach($adicional as $k=>$v){echo ' '.$k.'="'.$v.'"';}?> placeholder="Ingrese su <?php echo $texto;?>" <?php echo $required==1?'required="required"':'';?>><?php echo $valores?></textarea>
			<?php }break;
			
		case "select":{?>
        	<select id="<?php echo $nombre;?>" name="<?php echo $nombre;?>" <?php echo $autofocus==1?'autofocus':'';?><?php foreach($adicional as $k=>$v){echo ' '.$k.'="'.$v.'"';}?> class="<?php echo $clase;?>" <?php echo $required==1?'required="required"':'';?>><option value="">Seleccionar</option>
            	<?php foreach($valores as $k=>$v){?><option value="<?php echo $k;?>" <?php echo $valorseleccion==$k?'selected':'';?>><?php echo $v;?></option><?php	}?>
            </select>
			<?php }break;	
		
		case "hidden":{
            ?><input type="<?php echo $tipo;?>" id="<?php echo $nombre;?>" name="<?php echo $nombre;?>"<?php foreach($adicional as $k=>$v){echo ' '.$k.'="'.$v.'"';}?> value="<?php echo $valores;?>" class="<?php echo $clase;?>" <?php echo $required==1?'required="required"':'';?>/><?php
			}break;
			
		case "submit":{
            ?><input type="<?php echo $tipo;?>" id="<?php echo $nombre;?>" name="<?php echo $nombre;?>"<?php foreach($adicional as $k=>$v){echo ' '.$k.'="'.$v.'"';}?> value="<?php echo $texto;?>" class="<?php echo $clase;?>" <?php echo $required==1?'required="required"':'';?>/><?php
			}break;
			
		default:{
			if(!is_array($valores))
		?><input type="<?php echo $tipo;?>" id="<?php echo $nombre;?>" name="<?php echo $nombre;?>" <?php echo $autofocus==1?'autofocus':'';?><?php foreach($adicional as $k=>$v){echo ' '.$k.'="'.$v.'"';}?> placeholder="Ingrese su <?php echo $texto;?>" value="<?php echo $valores?>" class="<?php echo $clase;?>" <?php echo $required==1?'required="required"':'';?>/><?php
		}break;		
	}
	switch($tipo){
			case "radio":{ echo $texto;?></label><?php if($orientacion==1){?></div><?php }}break;
			case "checkbox":{echo $texto;?></label><?php if($orientacion==1){?></div><?php }}break;
	}
	if($orientacion==1 && $tipo!="radio" && $tipo!="checkbox"){?></div><?php }
}
function capitalizar($texto){
	return ucwords($texto);
}
function mayuscula($texto){
	return mb_strtoupper($texto,"utf8");
}
function minuscula($texto){
	return mb_strtolower($texto,"utf8");
}
function fecha2Str($fecha="",$t=1){
	$fecha=$fecha==""?date("Y-m-d"):$fecha;
	if(date("d-m-Y",strtotime($fecha))=='31-12-1969'||date("Y-m-d",strtotime($fecha))=='1969-12-31'){
	return $fecha;}
	if(!empty($fecha) && $fecha!="0000-00-00"){
		if($t==1){
			return date("d-m-Y",strtotime($fecha));	
		}else{
			return date("Y-m-d",strtotime($fecha));	
		}
	}else{
		if($t=1 && $fecha=="0000-00-00")
		return "00-00-0000";
		else
		return $fecha;
	}
}
function acortarPalabra($texto,$cantidad=1,$separador=" "){
	$cantidad--;
	$datos=array();
	$separado=explode($separador,$texto);
	for($i=0;$i<=$cantidad;$i++){
		array_push($datos,$separado[$i]);
	}
	return implode($separador,$datos);
}
function hora2Str($fecha,$t=1){
	if(!empty($fecha) && $fecha!="00:00"){
		if($t==1){
			return date("H:i",strtotime($fecha));	
		}else{
			return date("H:i:s",strtotime($fecha));	
		}
	}else{
		return $fecha;	
	}
}
function sacarIniciales($texto,$Todo=0){
	$iniciales="";
	$datos=explode(" ",$texto);
	for($i=0;$i<count($datos);$i++){
		$iniciales.=$datos[$i][0];
	}
	return mb_strtoupper($iniciales,"utf8");		
}
function sacarToolTip($Texto,$Etiqueta="",$Tipo="I",$Cantidad=3){
	$Tipo=(string)$Tipo;
	$T=$Etiqueta!=""?$Etiqueta:$Texto;
	?><span title="<?php echo $Texto?>"><?php echo $Tipo=="0"?$T:($Tipo=="I"?sacarIniciales($T):recortarTexto($T,$Cantidad,""));?></span><?php
}
function recortarTexto($texto, $limite=100,$terminador="..."){   
    $texto = trim($texto);
    $texto = strip_tags($texto);
    $tamano = strlen($texto);
    $resultado = '';
    if($tamano <= $limite){
        return $texto;
    }else{
        $texto = substr($texto, 0, $limite);
        $palabras = explode(' ', $texto);
        $resultado = implode(' ', $palabras);
        $resultado .= $terminador;
    }   
    return $resultado;
}
function subirArchivo($archivo,$directorio="imagenes/",$tipo=array(),$adicionar=""){
	global $folder;
	$directorio=$folder.$directorio;
	//Sacar nombre
	$cortado=explode(".",$archivo['name']);
	$tipoarchivo=array_pop($cortado);
	$nombre=implode(".",$cortado);
	if($adicionar!="" && !empty($adicionar)){
		$adicionar="_".$adicionar;
	}
	//echo $nombre.".".$tipoarchivo;
	//Fin de Sacar Nombre
//	print_r($archivo);
	if(!isset($archivo) || $archivo['size']<=0){
		return false;
	}else{
		if(empty($tipo)){
			copy($archivo['tmp_name'],$directorio.quitarSimbolos($nombre).$adicionar.".".$tipoarchivo);	
		}else{
			if(in_array($archivo['type'],$tipo)){
				copy($archivo['tmp_name'],$directorio.quitarSimbolos($nombre).$adicionar.".".$tipoarchivo);
			}
		}
		return quitarSimbolos($nombre).$adicionar.".".$tipoarchivo;
	}
}
function quitarSimbolos($string,$Espacio=true){
    $string = trim($string);
    $string = str_replace(array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),$string);
    $string = str_replace(array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),$string);
    $string = str_replace(array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),$string);
    $string = str_replace(array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),$string);
    $string = str_replace(array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),$string);
    $string = str_replace(array('ñ', 'Ñ', 'ç', 'Ç'),array('n', 'N', 'c', 'C',),$string);
 //Esta parte se encarga de eliminar cualquier caracter extraño
 	if($Espacio){
    	$string = str_replace(array("\\", "¨", "º", "-", "~","#", "@", "|", "!", "\"","·", "$", "%", "&", "/","(", ")", "?", "'", "¡","¿", "[", "^", "`", "]","+", "}", "{", "¨", "´",">", "< ", ";", ",", ":",".", " "),'',$string);
	}else{
		$string = str_replace(array("\\", "¨", "º", "-", "~","#", "@", "|", "!", "\"","·", "$", "%", "&", "/","(", ")", "?", "'", "¡","¿", "[", "^", "`", "]","+", "}", "{", "¨", "´",">", "< ", ";", ",", ":",".",),'',$string);	
	}
    return $string;
}
function todoLista($datos,$k,$v,$separador=" "){
	$data=array();
	foreach($datos as $d){
		$valor=array();
		foreach(explode(",",$v) as $val){
			array_push($valor,$d[$val]);
		}
		$valor=implode(" ".$separador." ",$valor);
		$data[$d[$k]]=$valor;
	}
	return $data;
}

function porcentaje($cantidad,$total,$decimal=0){
	return @round((($cantidad*100)/$total),$decimal);
}
function generarPalabra($longitud=3){
	$strC = "BCDFGHJKLMNPRSTVYZ";
	$strV = "AEIOU";
	$cad = "";
	for($i=0;$i<$longitud;$i++) {
	$cad .= substr($strC,rand(0,strlen($strC)-1),1).substr($strV,rand(0,strlen($strV)-1),1);
	}
	return $cad;	
}
function eliminarEspaciosDobles($cadena,$caracteres=0){
	$cadena = trim($cadena);//preg_replace('/\s+/', ' ', $texto);
	$cadena = preg_replace('/\s(?=\s)/', '', $cadena);
	$cadena = $caracteres?(preg_replace('/[\n\r\t]/', ' ', $cadena)):$cadena;
	return $cadena;
}
function promedio($NotaTotal,$Cantidad,$Cifras=0){
	return @ round($NotaTotal/$Cantidad,$Cifras);	
}
function usuarioPadre($cipadre,$cimadre){
	if($cipadre!="" && !ereg("---*",$cipadre)){
		$usuarioP=$cipadre;
		$usuarioP=trim($usuarioP);
	}else{
		$usuarioP=$cimadre;
		$usuarioP=trim($usuarioP);
	}
	$usuario=mb_strtolower($usuarioP,"UTF-8");
	$dato='';
	for($j=0;$j<=strlen($usuario);$j++){
		if(ereg("[0-9]",$usuario[$j]))
		$dato.=$usuario[$j];
	}	
	if(strlen($dato)==0){
		$dato=usuarioPadre($dato,$cimadre);	
	}
	return $dato;
}
function num2letras($num, $fem = false, $dec = true) { 
   $matuni[2]  = "dos"; 
   $matuni[3]  = "tres"; 
   $matuni[4]  = "cuatro"; 
   $matuni[5]  = "cinco"; 
   $matuni[6]  = "seis"; 
   $matuni[7]  = "siete"; 
   $matuni[8]  = "ocho"; 
   $matuni[9]  = "nueve"; 
   $matuni[10] = "diez"; 
   $matuni[11] = "once"; 
   $matuni[12] = "doce"; 
   $matuni[13] = "trece"; 
   $matuni[14] = "catorce"; 
   $matuni[15] = "quince"; 
   $matuni[16] = "dieciseis"; 
   $matuni[17] = "diecisiete"; 
   $matuni[18] = "dieciocho"; 
   $matuni[19] = "diecinueve"; 
   $matuni[20] = "veinte"; 
   $matunisub[2] = "dos"; 
   $matunisub[3] = "tres"; 
   $matunisub[4] = "cuatro"; 
   $matunisub[5] = "quin"; 
   $matunisub[6] = "seis"; 
   $matunisub[7] = "sete"; 
   $matunisub[8] = "ocho"; 
   $matunisub[9] = "nove"; 

   $matdec[2] = "veint"; 
   $matdec[3] = "treinta"; 
   $matdec[4] = "cuarenta"; 
   $matdec[5] = "cincuenta"; 
   $matdec[6] = "sesenta"; 
   $matdec[7] = "setenta"; 
   $matdec[8] = "ochenta"; 
   $matdec[9] = "noventa"; 
   $matsub[3]  = 'mill'; 
   $matsub[5]  = 'bill'; 
   $matsub[7]  = 'mill'; 
   $matsub[9]  = 'trill'; 
   $matsub[11] = 'mill'; 
   $matsub[13] = 'bill'; 
   $matsub[15] = 'mill'; 
   $matmil[4]  = 'millones'; 
   $matmil[6]  = 'billones'; 
   $matmil[7]  = 'de billones'; 
   $matmil[8]  = 'millones de billones'; 
   $matmil[10] = 'trillones'; 
   $matmil[11] = 'de trillones'; 
   $matmil[12] = 'millones de trillones'; 
   $matmil[13] = 'de trillones'; 
   $matmil[14] = 'billones de trillones'; 
   $matmil[15] = 'de billones de trillones'; 
   $matmil[16] = 'millones de billones de trillones'; 
   
   //Zi hack
   $float=explode('.',$num);
   $num=$float[0];

   $num = trim((string)@$num); 
   if ($num[0] == '-') { 
      $neg = 'menos '; 
      $num = substr($num, 1); 
   }else 
      $neg = ''; 
   while ($num[0] == '0') $num = substr($num, 1); 
   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num; 
   $zeros = true; 
   $punt = false; 
   $ent = ''; 
   $fra = ''; 
   for ($c = 0; $c < strlen($num); $c++) { 
      $n = $num[$c]; 
      if (! (strpos(".,'''", $n) === false)) { 
         if ($punt) break; 
         else{ 
            $punt = true; 
            continue; 
         } 

      }elseif (! (strpos('0123456789', $n) === false)) { 
         if ($punt) { 
            if ($n != '0') $zeros = false; 
            $fra .= $n; 
         }else 

            $ent .= $n; 
      }else 

         break; 

   } 
   $ent = '     ' . $ent; 
   if ($dec and $fra and ! $zeros) { 
      $fin = ' coma'; 
      for ($n = 0; $n < strlen($fra); $n++) { 
         if (($s = $fra[$n]) == '0') 
            $fin .= ' cero'; 
         elseif ($s == '1') 
            $fin .= $fem ? ' una' : ' un'; 
         else 
            $fin .= ' ' . $matuni[$s]; 
      } 
   }else 
      $fin = ''; 
   if ((int)$ent === 0) return 'Cero ' . $fin; 
   $tex = ''; 
   $sub = 0; 
   $mils = 0; 
   $neutro = false; 
   while ( ($num = substr($ent, -3)) != '   ') { 
      $ent = substr($ent, 0, -3); 
      if (++$sub < 3 and $fem) { 
         $matuni[1] = 'una'; 
         $subcent = 'as'; 
      }else{ 
         $matuni[1] = $neutro ? 'un' : 'uno'; 
         $subcent = 'os'; 
      } 
      $t = ''; 
      $n2 = substr($num, 1); 
      if ($n2 == '00') { 
      }elseif ($n2 < 21) 
         $t = ' ' . $matuni[(int)$n2]; 
      elseif ($n2 < 30) { 
         $n3 = $num[2]; 
         if ($n3 != 0) $t = 'i' . $matuni[$n3]; 
         $n2 = $num[1]; 
         $t = ' ' . $matdec[$n2] . $t; 
      }else{ 
         $n3 = $num[2]; 
         if ($n3 != 0) $t = ' y ' . $matuni[$n3]; 
         $n2 = $num[1]; 
         $t = ' ' . $matdec[$n2] . $t; 
      } 
      $n = $num[0]; 
      if ($n == 1) { 
         $t = ' ciento' . $t; 
      }elseif ($n == 5){ 
         $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t; 
      }elseif ($n != 0){ 
         $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t; 
      } 
      if ($sub == 1) { 
      }elseif (! isset($matsub[$sub])) { 
         if ($num == 1) { 
            $t = ' mil'; 
         }elseif ($num > 1){ 
            $t .= ' mil'; 
         } 
      }elseif ($num == 1) { 
         $t .= ' ' . $matsub[$sub] . '?n'; 
      }elseif ($num > 1){ 
         $t .= ' ' . $matsub[$sub] . 'ones'; 
      }   
      if ($num == '000') $mils ++; 
      elseif ($mils != 0) { 
         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub]; 
         $mils = 0; 
      } 
      $neutro = true; 
      $tex = $t . $tex; 
   } 
   $tex = $neg . substr($tex, 1) . $fin; 
   //Zi hack --> return ucfirst($tex);
   if($float[1]<10){
 	$decimal=$float[1]."0";
	}else{
		$decimal=$float[1];
	}
   $end_num=ucfirst($tex).'  '.$decimal.'/100';
   return $end_num; 
} 
function quitarTilde($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    //$cadena = strtolower($cadena);
    return utf8_encode($cadena);
}
function cambiopalabra($numero){
	switch($numero){
		case "1":{$texto="Primera";}break;
		case "2":{$texto="Segunda";}break;
		case "3":{$texto="Tercera";}break;
		case "4":{$texto="Cuarta";}break;
		case "5":{$texto="Quinta";}break;
		case "6":{$texto="Sexta";}break;
		case "7":{$texto="Septima";}break;
		case "8":{$texto="Octava";}break;
		case "9":{$texto="Novena";}break;
		case "10":{$texto="Decima";}break;
		case "Todo":{$texto="Primera a Decima";}break;
		case "2a10":{$texto=cambiopalabra("2")." a ".cambiopalabra("10");}break;
		//default:{$texto=($numero[0]);}break;
	}	
	return $texto;
}
?>