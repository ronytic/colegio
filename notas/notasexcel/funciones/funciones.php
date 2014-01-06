<?php
function adicionar($letra,$cantidad){
	for($i=1;$i<=$cantidad;$i=$i+1){
		$letra++;	
	}
	return $letra;
}
function an($ancho){
	return $ancho+0.71;
}
function estilo($tamano=11,$color='000000',$estilo='',$fondo='FFFFFF',$alineacionH='left',$alineacionV='center',$borde='thin',$colorBorde='000000',$tipo="Calibri"){
	$valor=array('font' => array(
							'name' => 'Calibri',
							'color' => array(
                					'rgb' => $color
            					),
							'size'=>$tamano,
							'bold' => preg_match("{B}",$estilo)?true:false,
							'italic'=>preg_match("{I}",$estilo)?true:false,
							'underline'=>preg_match("{U}",$estilo)?true:false,
							),
				'alignment' => array(
							'horizontal' => $alineacionH,
							'vertical' => $alineacionV,
							),
				'borders' => array(
							'outline' => array(
									'style' => $borde,
									'color' => array('rgb' => $colorBorde),
									),
							),
				'fill' => array(
							'type' => 'solid',
							'rotation' => 90,
							'startcolor' => array(
											'rgb' => $fondo,
											),
							'endcolor' => array(
											'argb' => 'FFFFFFFF',
											),
				),
	);
	return $valor;	
}
function convertir($formula,$columna='',$fila){
	$d=explode(" ",$formula);
	$formu="";
	$a=conv($d[0],$columna,$fila);
	$b=conv($d[1],$columna,$fila);
	$o=$d[2];
	$formu=$a.$o.$b;
	$cantidad=count($d)-1;
	for($i=3;$i<=$cantidad;$i=$i+2){
		$a=$formu;
		$b=conv($d[$i],$columna,$fila);
		$o=$d[$i+1];
		if($o=="/" or $o=="*"){
			$formu="(".$a.")".$o.$b;
		}else{
			$formu=$a.$o.$b;
		}
	}
	return $formu;
}
function conv($nota,$columna,$fila){
	$d=explode("n",$nota);
	if($d[0]==''){
		return adicionar($columna,$d[1]-1).$fila;
	}else{
		return $d[0];
	}
}
?>