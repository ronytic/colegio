<?php
include_once("../../login/check.php");
$titulo=$idioma['HojaSolicitudCasilleros'];

include_once("../../class/config.php");
$config=new config;
$Gestion=$config->mostrarConfig("Gestion",1);



include_once("../pdf.php");
class PDF extends PPDF{
	
}
include_once("../../class/curso.php");
$curso=new curso;
$pdf=new PDF();
$pdf->AddPage();
$pdf->Ln(4);
$pdf->CuadroCuerpoPersonalizado(35,$idioma['NombreCompleto'].": ",0,"L","0","B");
$pdf->CuadroCuerpoPersonalizado(140,"",0,"L","B","B");
$pdf->Ln(8);
$pdf->CuadroCuerpoPersonalizado(20,$idioma['Periodo'].":",0,"L",0,"B");
$pdf->CuadroCuerpoPersonalizado(60,"",0,"L","B","");
$pdf->CuadroCuerpoPersonalizado(20,$idioma['Celular'].":",0,"L","","B");
$pdf->CuadroCuerpoPersonalizado(75,"",0,"L","B","B");
$pdf->Ln(8);
$pdf->CuadroCuerpoPersonalizado(175,$idioma['CursoDicta'].":",1,"L",0,"B");
$pdf->Ln(8);

$pdf->CuadroCuerpoPersonalizado(50,$idioma['Cursos']."",1,"C",1,"B");
$pdf->CuadroCuerpo(25,$idioma['MarqueeX']."",1,"C",1,"7","B");
$pdf->CuadroCuerpoPersonalizado(100,$idioma['MateriasDicta']."",1,"C",1,"B");
$pdf->ln();	
foreach($curso->mostrar() as $cur){
	$pdf->CuadroCuerpoPersonalizado(50,$cur['Nombre']."",0,"L",1,"");
	$pdf->CuadroCuerpo(25,"",0,"C",1,"7","");
	$pdf->CuadroCuerpoPersonalizado(100,"                                  /                                  /",0,"L",1,"");
	$pdf->ln();	
}
$pdf->Ln(8);
$pdf->CuadroCuerpoPersonalizado(175,$idioma['CantidadCasilleros'].":",1,"L",0,"B");
$pdf->Ln(8);

$pdf->CuadroCuerpoPersonalizado(5,"N",1,"C",1,"B");
$pdf->CuadroCuerpo(40,$idioma['Materia']."",1,"C",1,"","B");
$pdf->CuadroCuerpoPersonalizado(40,$idioma['NumeroCasilleros']."",1,"R","TBL","B");
$pdf->CuadroCuerpoPersonalizado(90,$idioma['NumeroCasillerosNota']."",1,"L","TBR","",7);
$pdf->ln();
for($i=1;$i<=15;$i++){
	if($i%2==0){$relleno=0;}else{$relleno=0;}
	$pdf->CuadroCuerpo(5,$i,$relleno,"R",1);
	$pdf->CuadroCuerpo(40,"",$relleno,"R",1);
	$pdf->CuadroCuerpo(130,"",$relleno,"R",1);
	$pdf->ln();	
}

$pdf->Output($titulo,"I");
?>