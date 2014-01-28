<?php 
include_once("../../login/check.php");
if(!empty($_GET) && $_GET['wsd']=='new'){
	include_once("../pdf.php");
	$titulo=$idioma['ArqueoCaja'];
	class PDF extends PPDF{
		function Cabecera(){
			global $Desde,$Hasta,$Tipo,$idioma;
			$this->CuadroCabecera(30,$Tipo." ".$idioma['Desde'].": ",30,date("d-m-Y",strtotime($Desde)));
			$this->CuadroCabecera(25,$Tipo." ".$idioma['Hasta'].": ",40,date("d-m-Y",strtotime($Hasta)));
			$this->Pagina();	
			$this->ln();
			$this->TituloCabecera(15,"Nº");		
			$this->TituloCabecera(55,$idioma["NombreCompleto"]);
			$this->TituloCabecera(15,$idioma["Curso"]);
			$this->TituloCabecera(30,$idioma["FechaPago"]);
			$this->TituloCabecera(10,"N/C");
			$this->TituloCabecera(20,$idioma["Factura"]);
			$this->TituloCabecera(15,$idioma["Monto"]);
		}
	}
	
	
	include_once("../../class/cuota.php");
	include_once("../../class/alumno.php");
	include_once("../../class/curso.php");
	$cuota=new cuota;
	$alumno=new alumno;
	$curso=new curso;
	
	$Desde=$_GET['Desde'];
	$Hasta=$_GET['Hasta'];
	$Tipo=$_GET['Tipo'];
	$pdf=new PDF("P","mm","letter");//612,792
	$pdf->AddPage();
	
	if($Tipo=="Fecha"){
		$Desde=date("Y-m-d",strtotime($Desde));
		$Hasta=date("Y-m-d",strtotime($Hasta));
		if($Desde==$Hasta){
			$cuotas=$cuota->mostrarCuotasWhere("cuota c,alumno a","a.Paterno,a.Materno,a.Nombres,a.CodCurso,c.*","c.CodAlumno=a.CodALumno and DATE(c.$Tipo) = '$Desde' and c.Cancelado=1 ","a.CodCurso,c.Factura,c.Numero");
		}else{
			$cuotas=$cuota->mostrarCuotasWhere("cuota c,alumno a","a.Paterno,a.Materno,a.Nombres,a.CodCurso,c.*","c.CodAlumno=a.CodALumno and DATE(c.$Tipo) BETWEEN '$Desde' and '$Hasta' and c.Cancelado=1 ","a.CodCurso,c.Factura,c.Numero");	
		}
	}else{
		$cuotas=$cuota->mostrarCuotasWhere("cuota c,alumno a","a.Paterno,a.Materno,a.Nombres,a.CodCurso,c.*","c.CodAlumno=a.CodALumno and c.$Tipo BETWEEN $Desde and $Hasta and c.Cancelado=1 ","a.CodCurso,c.Factura,c.Numero");
	}
	
	$i=0;
	$MontoTotal=0;

	foreach($cuotas as $cuo){
		$i++;
		$al=$alumno->mostrarTodoDatos($cuo['CodAlumno']);
		$al=array_shift($al);
		$nombre=explode(" ",$al['Nombres']);
		$nombre=array_shift($nombre);
		$cur=$curso->mostrarCurso($al['CodCurso']);
		$cur=array_shift($cur);
		$fechaPago=date("d-m-Y",strtotime($cuo['Fecha']));
		$MontoTotal+=$cuo['MontoPagar'];
		
		if($i%2==0){
			$relleno=1;
		}else{
			$relleno=0;
		}
			$pdf->CuadroCuerpo(15,$i,$relleno,"R");
			$pdf->CuadroNombre(55,$al['Paterno'],$al['Materno'],$al['Nombres'],0,$relleno);
			$pdf->CuadroCuerpo(15,$cur['Abreviado'],$relleno);
			$pdf->CuadroCuerpo(30,$fechaPago,$relleno,"C");
			$pdf->CuadroCuerpo(10,$cuo['Numero'],$relleno);
			$pdf->CuadroCuerpo(20,$cuo['Factura'],$relleno);
			$pdf->CuadroCuerpo(15,number_format(round($cuo['MontoPagar'],1),2),$relleno,"R");
		$pdf->ln();
	}
	$pdf->Fuente("B");
	$pdf->CuadroCuerpo(135,$idioma["Total"],0,"R",1);
	$pdf->CuadroCuerpo(25,number_format($MontoTotal,2),0,"R",1);
	$pdf->Output($titulo,"I");
}
?>