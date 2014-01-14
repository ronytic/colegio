<?php
echo cambiopalabra("2a10");
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
		default:{$texto=cambiopalabra($numero[0])." a ".cambiopalabra($numero[2]);}break;
	}	
	return $texto;
}
?>