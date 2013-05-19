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
        	<select id="<?php echo $nombre;?>" name="<?php echo $nombre;?>" <?php echo $autofocus==1?'autofocus':'';?><?php foreach($adicional as $k=>$v){echo ' '.$k.'="'.$v.'"';}?> class="<?php echo $clase;?>" <?php echo $required==1?'required="required"':'';?>><?php  if(empty($valorseleccion)){?><option value="" selected="selected"><?php echo $idioma['Seleccionar']?></option><?php }?>
            	<?php foreach($valores as $k=>$v){?><option value="<?php echo $k;?>" <?php echo (string)$valorseleccion==(string)$k?'selected':'';?>><?php echo $v;?></option><?php	}?>
            </select>
			<?php }break;	
		
		case "hidden":{
            ?><input type="<?php echo $tipo;?>" id="<?php echo $nombre;?>" name="<?php echo $nombre;?>"<?php foreach($adicional as $k=>$v){echo ' '.$k.'="'.$v.'"';}?> value="<?php echo $valores;?>" class="<?php echo $clase;?>" <?php echo $required==1?'required="required"':'';?>/><?php
			}break;
			
		case "submit":{
            ?><input type="<?php echo $tipo;?>" id="<?php echo $nombre;?>" name="<?php echo $nombre;?>"<?php foreach($adicional as $k=>$v){echo ' '.$k.'="'.$v.'"';}?> value="<?php echo $valores;?>" class="<?php echo $clase;?>" <?php echo $required==1?'required="required"':'';?>/><?php
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
function fecha2Str($fecha,$t=1){
	if(!empty($fecha)){
		if($t==1){
			return date("d-m-Y",strtotime($fecha));	
		}else{
			return date("Y-m-d",strtotime($fecha));	
		}
	}else{
		return $fecha;	
	}
}
function sacarIniciales($texto){
	$iniciales="";
	$datos=explode(" ",$texto);
	for($i=0;$i<count($datos);$i++){
		$iniciales.=$datos[$i][0];
	}
	return mb_strtoupper($iniciales,"utf8");		
}
function subirArchivo($archivo,$directorio="imagenes/",$tipo=array()){
	global $folder;
	$directorio=$folder.$directorio;
	
//	print_r($archivo);
	if(!isset($archivo)){
		return false;
	}else{
		if(empty($tipo)){
			copy($archivo['tmp_name'],$directorio.$archivo['name']);	
		}else{
			if(in_array($archivo['type'],$tipo)){
				copy($archivo['tmp_name'],$directorio.$archivo['name']);
			}
		}
		return $archivo['name'];
	}
}
function quitarSimbolos($string){
    $string = trim($string);
    $string = str_replace(array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),$string);
    $string = str_replace(array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),$string);
    $string = str_replace(array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),$string);
    $string = str_replace(array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),$string);
    $string = str_replace(array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),$string);
    $string = str_replace(array('ñ', 'Ñ', 'ç', 'Ç'),array('n', 'N', 'c', 'C',),$string);
 //Esta parte se encarga de eliminar cualquier caracter extraño
    $string = str_replace(array("\\", "¨", "º", "-", "~","#", "@", "|", "!", "\"","·", "$", "%", "&", "/","(", ")", "?", "'", "¡","¿", "[", "^", "`", "]","+", "}", "{", "¨", "´",">", "< ", ";", ",", ":",".", " "),'',$string);
    return $string;
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
?>