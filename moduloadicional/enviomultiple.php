<?php
include_once("../sms/funciones.php");

$Mensaje="Envio de Mensaje Mutiple desde PHP  - ";
for($i=1;$i<=3;$i++){
$Mensajes=$Mensaje.$i;
echo $Mensajes;
//$res=enviarSms("COM5","73230568",$Mensajes);
$res=true;
if($res){
echo "Bien<br>";	
}else{
echo "Mal<br>";	
}
}
?>