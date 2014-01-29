<?php
include_once("../../login/check.php");
if(empty($_GET)){
	exit();
}
$titulo=$idioma["ListadoFacturas"];
include_once("../pdf.php");	
class PDF extends PPDF{
	function Cabecera(){
		global $idioma,$FechaFacturaInicio,$FechaFacturaFin;
		$this->CuadroCabecera(30,$idioma['RangoFecha'].":",30,fecha2Str($FechaFacturaInicio)." / ".fecha2Str($FechaFacturaFin));
		$this->ln();
		$this->TituloCabecera(10,"N");
		$this->TituloCabecera(25,$idioma['Fecha']);
		$this->TituloCabecera(20,"Nº ".$idioma['Factura']);
		$this->TituloCabecera(25,$idioma['Nit']);
		$this->TituloCabecera(50,$idioma['FacturaA']);
		$this->TituloCabecera(20,$idioma['TotalBs']);
		$this->TituloCabecera(20,$idioma['Cancelado']);
		$this->TituloCabecera(20,$idioma['Cambio']);
		$this->TituloCabecera(20,$idioma['Estado']);
		$this->TituloCabecera(35,$idioma['CodigoControl']);
	}
}
extract($_GET);
$condi=array();
if($FechaFacturaInicio!="" && $FechaFacturaFin!=""){
	$FechaFacturaInicio=fecha2Str($FechaFacturaInicio,0);
	$FechaFacturaFin=fecha2Str($FechaFacturaFin,0);
	array_push($condi,"FechaFactura BETWEEN '$FechaFacturaInicio' and '$FechaFacturaFin'");
}
if($NFactura!=""){
	array_push($condi,"NFactura='$NFactura'");
}
if($Nit!=""){
	array_push($condi,"Nit='$Nit'");
}

if($Factura!=""){
	array_push($condi,"Factura LIKE '%$Factura%'");
}
if($Estado!=""){
	array_push($condi,"Estado LIKE '%$Estado%'");
}
if($Tipo!=""){
	array_push($condi,"Tipo LIKE '%$Tipo%'");
}
$where=implode(" and ",$condi);
include_once("../../class/factura.php");
$factura=new factura;
$fac=$factura->mostrarFacturas($where);
$pdf=new PDF("L","mm","letter");
$pdf->AddPage();
if(count($fac)){
	foreach($fac as $f){$i++;
		if($i%2==0){$na=1;}else{$na=0;}
		$tot+=$f['TotalBs'];
		$can+=$f['Cancelado'];
		$cambio+=$f['MontoDevuelto'];
		$pdf->CuadroCuerpo(10,$i,$na,"R");
		$pdf->CuadroCuerpo(25,fecha2Str($f['FechaFactura']),$na,"C",0);
		$pdf->CuadroCuerpo(20,$f['NFactura'],$na,"R",0);
		$pdf->CuadroCuerpo(25,$f['Nit'],$na,"R",0);
		$pdf->CuadroCuerpo(50,capitalizar($f['Factura']),$na,"",0);
		$pdf->CuadroCuerpo(20,number_format($f['TotalBs'],2),$na,"R",1);
		$pdf->CuadroCuerpo(20,number_format($f['Cancelado'],2),$na,"R",1);
		$pdf->CuadroCuerpo(20,number_format($f['MontoDevuelto'],2),$na,"R",1);
		$pdf->CuadroCuerpo(20,$f['Estado'],$na,"",0);
		$pdf->CuadroCuerpo(35,$f['CodigoControl'],$na,"",0);
		$pdf->Ln();
	}
	$pdf->Linea();
	$pdf->CuadroCuerpo(130,$idioma['Totales'],0,"R",0);
	$pdf->CuadroCuerpo(20,number_format($tot,2),1,"R",1);
	$pdf->CuadroCuerpo(20,number_format($can,2),1,"R",1);
	$pdf->CuadroCuerpo(20,number_format($cambio,2),1,"R",1);
}else{
	$pdf->CuadroCuerpo(120,$idioma['NoExistenFacturasRegistradas'],0,"R",0);
}
$pdf->Output($titulo,"I");

?>