<?php 
include_once("../../login/check.php");
if(!empty($_GET) && $_GET['lock']==md5('lock')){
	include_once("../pdf.php");
	$titulo=$idioma['DatosDocente'];
	class PDF extends PPDF{
		function Cabecera(){
			$this->Pagina();
			$this->ln();
		}
	}
	
	include_once("../../class/docente.php");
	$docente=new docente;
	extract($_GET);
	$doc=array_shift($docente->mostrarRegistro($CodDocente));
	$ima="../../imagenes/docentes/".$doc['Foto'];
	if(!file_exists($ima) || empty($doc['Foto'])){
		 $ima="../../imagenes/docentes/0.jpg";	
	}
	$pdf=new PDF("P","mm","letter");//612,792
	$pdf->AddPage();
	$borde=0;
	$pdf->Image($ima,164,60,30,30);
	$pdf->CuadroCuerpoPersonalizado(176,$idioma["DatosPersonales"],1,"",0,"B");
	$pdf->Ln();$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Nombre"].": ",0,"L",$borde,"B");
	$pdf->CuadroNombre(100,$doc['Paterno'],$doc['Materno'],$doc['Nombres'],1,$relleno);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Sexo"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['Sexo']?$idioma['Masculino']:$idioma['Femenino'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Ci"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['Ci'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["EstadoCivil"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['EstadoCivil'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["FechaNac"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,fecha2Str($doc['FechaNac']),0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Departamento"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['Departamento'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Provincia"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['Provincia'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Direccion"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['Direccion'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Telefono"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['Telefono'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Celular"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['Celular'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Email"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['Email'],0,"",$borde);
	
	$pdf->Ln();$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(176,$idioma["DatosFormacionProfesional"],1,"",0,"B");
	$pdf->ln();$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Departamento"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['DPDepartamento'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Universidad"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['DPUniversidad'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["AñoIngreso"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['DPAnoIngreso'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["AñoEgreso"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['DPAnoEgreso'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["AñoTitulacion"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['DPAnoTitulacion'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Titulo"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['DPTitulo'],0,"",$borde);
	
	$pdf->Ln();$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(176,$idioma["DatosTrabajo"],1,"",0,"B");
	$pdf->ln();$pdf->Ln();

	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Cargo"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['DTCargo'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["CargaHoraria"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['DTCargaHoraria'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Antiguedad"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['DTAntiguedad'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Categoria"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['DTCategoria'],0,"",$borde);
	$pdf->ln();
	$pdf->CuadroCuerpoPersonalizado(40,$idioma["Observacion"].": ",0,"L",$borde,"B");
	$pdf->CuadroCuerpo(100,$doc['Observacion'],0,"",$borde);
	$pdf->Output();
}
?>