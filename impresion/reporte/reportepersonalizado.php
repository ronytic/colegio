<?php
include_once '../../login/check.php';
include_once("../pdf.php");
include_once("../../class/alumno.php");
include_once("../../class/curso.php");
$cur=new curso;
$alumno=new alumno;
$titulo=$idioma['NominaAlumnos'];
$CodCurso=$_GET['CodCurso'];
$Campo1=$_GET['Campo1'];
$Campo2=$_GET['Campo2'];
$Borde=$_GET['Borde'];
$Blanco=$_GET['Blanco'];
$Cantidad=$_GET['Cantidad'];
$Sombreado=$_GET['Sombreado'];
$Sexo=2;
if($Borde=="checked"){$Borde=1;}else{$Borde=0;}
if($Blanco=="checked"){$Blanco=true;}else{$Blanco=false;}
if($Sombreado=="checked"){$Sombreado=true;}else{$Sombreado=false;}
$curso=array_shift($cur->mostrarCurso($CodCurso));
class PDF extends PPDF
{
	function Cabecera(){
		global $curso,$Campo1,$Campo2,$Cantidad,$Borde,$Blanco,$idioma;
		$this->CuadroCabecera(15,"Curso:",30,$curso['Nombre']);
		$this->Pagina();
		$this->ln();
		$this->TituloCabecera(5,"Nº");
		$this->TituloCabecera(30,$idioma["Paterno"]);
		$this->TituloCabecera(30,$idioma["Materno"]);
		$this->TituloCabecera(47,$idioma["Nombres"]);
		if(!$Blanco){
			$this->TituloCabecera(33,$idioma[$Campo1],"10",$Borde);
			$this->TituloCabecera(33,$idioma[$Campo2],"10",$Borde);
		}else{
			switch($Cantidad)
					{
						case "1":{$this->TituloCabecera(64,"","10",$Borde);}break;
						case "2":{$this->TituloCabecera(32,"","10",$Borde);
								  $this->TituloCabecera(32,"","10",$Borde);}break;
						case "3":{$this->TituloCabecera(21,"","10",$Borde);
								  $this->TituloCabecera(21,"","10",$Borde);
								  $this->TituloCabecera(22,"","10",$Borde);}break;	
					}
		}
	}	
}
$pdf=new PDF("P","mm","letter");//612,792
$pdf->AddPage();


/*Fin de Cabeceras*/
/*Datos*///,"","","",true
$i=0;
$Somb=0;
foreach($alumno->mostrarAlumnosCurso($CodCurso,$Sexo) as $al)
{	
	$i++;
	if($Sombreado==true){
		if($i%2==0){$Somb=1;}else{$Somb=0;}
	}
		$pdf->CuadroCuerpo(5,$i,$Somb,"",$Borde);
		$pdf->CuadroCuerpo(30,mb_strtoupper($al['Paterno'],"utf8"),$Somb,"",$Borde);
		$pdf->CuadroCuerpo(30,mb_strtoupper($al['Materno'],"utf8"),$Somb,"",$Borde);
		$pdf->CuadroCuerpo(47,mb_strtoupper($al['Nombres'],"utf8"),$Somb,"",$Borde);
		if(!$Blanco){
			if($Campo1!=""){
				if($Campo1=="FechaNac"){
					$pdf->CuadroCuerpo(33,date("d-m-Y",strtotime($al[$Campo1])),$Somb,"R",$Borde);
				}else{
					$pdf->CuadroCuerpo(33,mb_strtoupper($al[$Campo1]),$Somb,"",$Borde,9);
				}
			}else{
				$pdf->CuadroCuerpo(33,"",$Somb,"",$Borde);
			}
			if($Campo2!=""){
				if($Campo2=="FechaNac"){
					$pdf->CuadroCuerpo(33,date("d-m-Y",strtotime($al[$Campo2])),$Somb,"R",$Borde);
				}else{
					$pdf->CuadroCuerpo(33,mb_strtoupper($al[$Campo2]),$Somb,"",$Borde,9);
				}
			}else{
				$pdf->CuadroCuerpo(33,"",$Somb,"",$Borde);
			}
		}else{
			switch($Cantidad)
			{
				case "1":{$pdf->CuadroCuerpo(64,"",$Somb,"",1);}break;
				case "2":{$pdf->CuadroCuerpo(32,"",$Somb,"",1);
						$pdf->CuadroCuerpo(32,"",$Somb,"",1);}break;
				case "3":{$pdf->CuadroCuerpo(21,"",$Somb,"",1);
						$pdf->CuadroCuerpo(21,"",$Somb,"",1);
						$pdf->CuadroCuerpo(22,"",$Somb,"",1);}break;	
			}
			
		}
	$pdf->ln();

}

$pdf->Output();
?>