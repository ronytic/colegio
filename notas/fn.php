<?php
include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."../login/check.php");
class funciones{
	function polaco($formula,$valoresNotas){
		$patron=" ".$formula;
		$dato=explode(" ",$patron);
		$values=$valoresNotas;
		//print_r($values);
		//print_r($dato);
		$ope[1]=$values['casilla'.$dato[1][1]];
		$ope[2]=$values['casilla'.$dato[2][1]];
		$ope[3]=$dato[3];
		$resul=$this->operacion($ope[1],$ope[2],$ope[3]);
		$ope[1]=$resul;
		//echo count($dato)."dato";
		for($i=4;$i<count($dato);$i++){	
			//echo $i;
			if($this->dosNotas($dato[$i],$dato[$i-1])){
				$ope[4]=$ope[1];
				$ope[1]=$ope[2];
				$numcasillas=explode("n",$dato[$i]);
				$ope[2]=$dato['casilla'.$numcasillas[1]];
			}else{
				if($this->dosOperaciones($dato[$i],$dato[$i-1])){
					$ope[2]=$ope[4];
					$ope[3]=$dato[$i];
					$resul=$this->operacion($ope[1],$ope[2],$ope[3]);
					$ope[1]=$resul;
				}else{
					if($this->nota($dato[$i])){
						$numcasillas=explode("n",$dato[$i]);
						$ope[2]=$values['casilla'.$numcasillas[1]];	
					}else{
						if($this->numero($dato[$i])){
							$ope[2]=$dato[$i];
						}else{
							$ope[3]=$dato[$i];
							$resul=$this->operacion($ope[1],$ope[2],$ope[3]);
							$ope[1]=$resul;
						}
					}
				}
			}
		
		}
		
		return round($ope[1]);	
	}
	function dosNotas($dato1,$dato2){
		//echo "Dosnotas:".$dato1[1]."-"-$dato2[1]."<br>";
		if($dato1[1]=='n' && $dato2[1]=='n')
			return true;
		else
			return false;
	}
	function dosOperaciones($ope1,$ope2){
		//echo "Oper:".$ope1."-".$ope2."<br>";
		if(($ope1=='+' || $ope1=='-' || $ope1=='*' || $ope1=='/') && ($ope2=='+' || $ope2=='-' || $ope2=='*' || $ope2=='/'))	
			return true;
		else
			return false;
	}
	function nota($dato){
		//echo "Nota:".$dato."<br>";
		if($dato[0]=='n')
			return true;
		else
			return false;	
	}
	function numero($dato){
		//echo "Numero:".$dato."<br>";
		if(ereg("^[0-9]{1,2}",$dato))
			return true;
		else
			return false;
	}
	function operacion($ope1,$ope2,$ope3){
		switch($ope3){
			case '+':{$resul=$ope1+$ope2;/*echo "$ope1+$ope2;|";*/}break;
			case '-':{$resul=$ope1-$ope2;/*echo "$ope1-$ope2;|";*/}break;
			case '*':{$resul=$ope1*$ope2;/*echo "$ope1*$ope2;|";*/}break;
			case '/':{$resul=$ope1/$ope2;/*echo "$ope1/$ope2;|";*/}break;
		}
		return $resul;
	}
	function dpsnota($nota){
		include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."../class/config.php");
		$config=new config;
		$RangoNotaDps1=$config->mostrarConfig("RangoNotaDps1",1);
		$RangoNotaDps2=$config->mostrarConfig("RangoNotaDps2",1);
		$RangoNotaDps3=$config->mostrarConfig("RangoNotaDps3",1);
		$RangoNotaDps4=$config->mostrarConfig("RangoNotaDps4",1);
		$RangoNotaDps5=$config->mostrarConfig("RangoNotaDps5",1);
		$RangoNotaDps6=$config->mostrarConfig("RangoNotaDps6",1);
		if($nota<=$RangoNotaDps1){
			$dps=5;
		}elseif($nota<=$RangoNotaDps2){
			$dps=6;
		}elseif($nota<=$RangoNotaDps3){
			$dps=7;
		}elseif($nota<=$RangoNotaDps4){
			$dps=8;
		}elseif($nota<=$RangoNotaDps5){
			$dps=9;
		}elseif($nota<=$RangoNotaDps6){
			$dps=10;
		}
		return $dps;
	}
}
?>