<?php
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
?>