<?php
include_once("../../login/check.php");
include_once("../pdf.php");
$titulo=$idioma["ListadoAlumnosPorPagar"];
include_once("../../class/cuota.php");
$cuota=new cuota;
class pdf extends PPDF{
	function Cabecera(){
		global $idioma;
		$this->TituloCabecera(10,"N");
		$this->TituloCabecera(30,$idioma['Paterno']);
		$this->TituloCabecera(30,$idioma['Materno']);
		$this->TituloCabecera(40,$idioma['Nombres']);
		$this->TituloCabecera(20,$idioma['Curso']);
		$this->TituloCabecera(20,$idioma['Cuota']);
		$this->TituloCabecera(25,$idioma['MontoPagar']);
	}
}
$pdf=new pdf("P","mm","letter");
$pdf->AddPage();
$total=0;
$i=0;
foreach($cuota->porPagar() as $cuo){$i++;
	if($i%2==0){$nf=1;}else{$nf=0;}
	
	$total+=$cuo['MontoPagar'];
	$pdf->CuadroCuerpo(10,$i,$nf,"R");	
	$pdf->CuadroNombreSeparado(30,$cuo['Paterno'],30,$cuo['Materno'],40,$cuo['Nombres'],1,$nf);	
	$pdf->CuadroCuerpo(20,$cuo['Curso'],$nf,"");
	$pdf->CuadroCuerpo(20,$cuo['Cuota'],$nf,"C");
	$pdf->CuadroCuerpo(25,number_format($cuo['MontoPagar'],2),$nf,"R");
	$pdf->Ln();
}
$pdf->Linea();
$pdf->CuadroCuerpo(150,$idioma['Total'],$nf,"R");
$pdf->CuadroCuerpo(25,number_format($total,2),$nf,"R");
$pdf->Output($titulo,"I");
?>