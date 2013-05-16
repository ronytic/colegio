<?php
include_once("../../login/check.php");
if(isset($_POST)){
	include_once("../pdf.php");
	include_once("../../class/docente.php");
	$docente=new docente;
	$listado=$_GET['listado'];
	$titulo=$idioma['DatosDocente']." - ".$idioma[$listado];
	class PDF extends PPDF{
		function Cabecera(){
			global $idioma,$listado;
			$this->TituloCabecera(10,"N");
		 	$this->TituloCabecera(25,$idioma["Paterno"]);
			$this->TituloCabecera(25,$idioma["Materno"]);
			$this->TituloCabecera(35,$idioma["Nombres"]);
			if($listado=="DatosPersonales"){
				$this->TituloCabecera(10,$idioma['Sexo']);
            	$this->TituloCabecera(25,$idioma['Ci']);
                $this->TituloCabecera(20,$idioma['FechaNac']);
                $this->TituloCabecera(35,$idioma['Telefono']);
                $this->TituloCabecera(35,$idioma['Celular']);
			}elseif($listado=="DatosFormacionProfesional"){
				$this->TituloCabecera(60,$idioma['Universidad']);
                $this->TituloCabecera(15,$idioma['AñoI']);
                $this->TituloCabecera(15,$idioma['AñoE']);
                $this->TituloCabecera(15,$idioma['AñoT']);
                $this->TituloCabecera(45,$idioma['Titulo']);
			}elseif($listado=="DatosTrabajo"){
            	$this->TituloCabecera(50,$idioma['Cargo']);
                $this->TituloCabecera(30,$idioma['CargaHoraria']);
                $this->TituloCabecera(30,$idioma['Antiguedad']);
                $this->TituloCabecera(40,$idioma['Categoria']);
			}
		}	
	}
	$pdf=new PDF("L","mm","letter");
	$pdf->AddPage();
	$i=0;
	foreach($docente->mostrarTodoRegistro() as $doc){$i++;	
		if($i%2==0){$relleno=1;}else{$relleno=0;}
		$pdf->CuadroCuerpo(10,$i,$relleno,"R");
		$pdf->CuadroNombreSeparado(25,$doc['Paterno'],25,$doc['Materno'],35,$doc['Nombres'],1,$relleno);
		if($listado=="DatosPersonales"){
			$pdf->CuadroCuerpo(10,$doc['Sexo']=='0'?'F':'M',$relleno,"C");
			$pdf->CuadroCuerpo(25,$doc['Ci'],$relleno);
			$pdf->CuadroCuerpo(20,fecha2Str($doc['FechaNac']),$relleno);
			$pdf->CuadroCuerpo(35,$doc['Telefono'],$relleno,"L");
			$pdf->CuadroCuerpo(35,$doc['Celular'],$relleno,"L");
		}elseif($listado=="DatosFormacionProfesional"){
			$pdf->CuadroCuerpo(60,$doc['DPUniversidad'],$relleno,"L");
			$pdf->CuadroCuerpo(15,$doc['DPAnoIngreso'],$relleno,"C");
			$pdf->CuadroCuerpo(15,$doc['DPAnoEgreso'],$relleno,"C");
			$pdf->CuadroCuerpo(15,$doc['DPAnoTitulacion'],$relleno,"C");
			$pdf->CuadroCuerpo(45,$doc['DPTitulo'],$relleno,"L");
		}elseif($listado=="DatosTrabajo"){
			$pdf->CuadroCuerpo(50,$doc['DTCargo'],$relleno,"L");
			$pdf->CuadroCuerpo(30,$doc['DTCargaHoraria'],$relleno,"C");
			$pdf->CuadroCuerpo(30,$doc['DTAntiguedad'],$relleno,"C");
			$pdf->CuadroCuerpo(40,$doc['DTCategoria'],$relleno,"L");
		}
		$pdf->ln();
	}
	$pdf->Output();
}
?>