<?php
include_once("../../login/check.php");
if(isset($_POST)){
	include_once("../pdf.php");
	class PDF extends PPDF{
		function Cabecera(){
			 
		}	
	}
	$pdf=new PDF("L","mm","letter");
	$pdf->Output();
}
?>