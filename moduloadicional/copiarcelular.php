<?php
include_once("../login/check.php");
include_once("../class/alumno.php");
include_once("../class/curso.php");
$alumno=new alumno;
$curso=new curso;
foreach($curso->mostrar() as $cur){//echo $cur['CodCurso']."<br>";
	foreach($alumno->mostrarAlumnosCurso($cur['CodCurso']) as $al){	
		if($al['CelularSMS']==""){
				if($al['Celular']==""){
					if($al['CelularP']==""){
						$valores=array("CelularSMS"=>"'".$al['CelularM']."'","ActivarSMS"=>"'1'");
					}else{
						$valores=array("CelularSMS"=>"'".$al['CelularP']."'","ActivarSMS"=>"'1'");	
					}
				}else{
					$valores=array("CelularSMS"=>"'".$al['Celular']."'","ActivarSMS"=>"'1'");
				}
				$alumno->actualizarDatosAlumno($valores,$al['CodAlumno']);
		}
	}
}

?>