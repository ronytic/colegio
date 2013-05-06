<?php
function campo($nombre,$tipo="text",$valores="",$clase="",$required=0,$placeholder="",$autofocus=0,$adicional=array(),$valorseleccion=""){
	if($tipo=="" && empty($tipo)){$tipo="text";}
	if(empty($adicional) && $adicional==""){$adicional=array();}
	
	switch($tipo){
		case "textarea":{?>
        	<textarea id="<?php echo $nombre;?>" name="<?php echo $nombre;?>" class="<?php echo $clase;?>" <?php echo $autofocus==1?'autofocus':'';?><?php foreach($adicional as $k=>$v){echo ' '.$k.'="'.$v.'"';}?> placeholder="<?php echo $placeholder;?>" <?php echo $required==1?'required="required"':'';?>><?php echo $valores?></textarea>
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
?>