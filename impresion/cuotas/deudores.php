<?php 
include_once("../../login/check.php");
if(!empty($_GET) && $_GET['lock']==md5('lock')){
	$titulo=$idioma['AlumnosMora'];
	include_once("../pdf.php");
	class PDF extends PPDF{
		function Cabecera(){
			global $DesdeT,$Desde,$CursoTexto,$Or,$idioma;
			$this->CuadroCabecera(30,$idioma['Curso'].":",30,$CursoTexto['Nombre']);
			$this->CuadroCabecera(35,$idioma['LimiteCuota'].":",40,$Or." ".$DesdeT);			
			$this->Pagina();
			$this->ln();
			$this->TituloCabecera(15,"Nº");
			$this->TituloCabecera(50,$idioma['NombreCompleto']);
			if($Or=="<=")$des=0;else$des=1;
			for($i=1;$i<=$Desde-$des;$i++)
				$this->TituloCabecera(10,$i."º C");
			$this->TituloCabecera(10,$idioma['Total']);
		}
	}
	
	include_once("../../class/cuota.php");
	include_once("../../class/alumno.php");
	include_once("../../class/curso.php");
	$cuota=new cuota;
	$alumno=new alumno;
	$curso=new curso;

	$Desde=$_GET['Cuota'];
	$CodCurso=$_GET['CodCurso'];
	$Or=$_GET['Orden'];
	echo $Orden;
	switch($Desde){
		case 1:{$DesdeT=$idioma["Primera"];}break;
		case 2:{$DesdeT=$idioma["Segunda"];}break;
		case 3:{$DesdeT=$idioma["Tercera"];}break;
		case 4:{$DesdeT=$idioma["Cuarta"];}break;
		case 5:{$DesdeT=$idioma["Quinta"];}break;
		case 6:{$DesdeT=$idioma["Sexta"];}break;
		case 7:{$DesdeT=$idioma["Septima"];}break;
		case 8:{$DesdeT=$idioma["Octava"];}break;
		case 9:{$DesdeT=$idioma["Novena"];}break;
		case 10:{$DesdeT=$idioma["Decima"];}break;
	}
	
	$CursoTexto=array_shift($curso->mostrarCurso($CodCurso));
	
	$pdf=new PDF("P","mm","letter");//612,792
	$pdf->AddPage();
	$i=0;
	$MontoTotal=0;
	
	$alumnos=$alumno->mostrarDatosAlumnos($CodCurso);
	foreach($alumnos as $al){
		$i++;
		$cuotas=$cuota->mostrarCuotasWhere("","*","CodAlumno=".$al['CodAlumno']." and Numero$Or$Desde","Numero");

		if(count($cuotas)<=$Desde){
			if($i%2==0){
				$relleno=1;
			}else{
				$relleno=0;
			}
				$pdf->CuadroCuerpo(15,$i,$relleno,"L");
				$pdf->CuadroNombre(50,$al['Paterno'],$al['Materno'],$al['Nombres'],0,$relleno);
				$cantidad=0;
				foreach($cuotas as $cuo){
					if($cuo['Cancelado']){
						$cantidad++;	
						$pdf->CuadroCuerpo(10,$idioma["Si"],$relleno,"C");
					}else{
						$pdf->CuadroCuerpo(10,"",$relleno,"C");
					}
				}
				$pdf->CuadroCuerpo(10,$cantidad,$relleno,"R");
			$pdf->ln();
		}
	}
	$pdf->Output($titulo,"I");
}
?>