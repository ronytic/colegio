<?php
include_once("../../login/check.php");
if(isset($_POST)){
	extract($_POST);
	$folder="../../";
	include_once("../../class/docente.php");
	$docente=new docente;
	$Usuario=$CodDocente.mb_strtolower(quitarSimbolos($Paterno),"utf8");
	$valores=array(
				"Paterno"=>"'$Paterno'",
				"Materno"=>"'$Materno'",
				"Nombres"=>"'$Nombres'",
				"Sexo"=>"'$Sexo'",
				"Ci"=>"'$Ci'",
				"FechaNac"=>"'$FechaNac'",
				"Departamento"=>"'$Departamento'",
				"Provincia"=>"'$Provincia'",
				"Direccion"=>"'$Direccion'",
				"Telefono"=>"'$Telefono'",
				"Celular"=>"'$Celular'",
				"EstadoCivil"=>"'$EstadoCivil'",
				"Email"=>"'$Email'",
				"RDA"=>"'$RDA'",
				"DPDepartamento"=>"'$DPDepartamento'",
				"DPUniversidad"=>"'$DPUniversidad'",
				"DPAnoIngreso"=>"'$DPAnoIngreso'",
				"DPAnoEgreso"=>"'$DPAnoEgreso'",
				"DPAnoTitulacion"=>"'$DPAnoTitulacion'",
				"DPTitulo"=>"'$DPTitulo'",
				"DTCargo"=>"'$DTCargo'",
				"DTCargaHoraria"=>"'$DTCargaHoraria'",
				"DTAntiguedad"=>"'$DTAntiguedad'",
				"DTCategoria"=>"'$DTCategoria'",
				"Observacion"=>"'$Observacion'",
				"Usuario"=>"'$Usuario'",
				"Activo"=>"'$Activo'"
	);
	if($NombreFoto=subirArchivo($_FILES['Foto'],"imagenes/docentes/")){
		$valores=array_merge(array("Foto"=>"'$NombreFoto'"),$valores);	
	}
	if($docente->actualizarDocente($valores,"CodDocente=".$CodDocente))
	{
	?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo $idioma['DatosGuardadosCorrectamente']?>	
		<a href="" id="actualizarventana" class="btn"><?php echo $idioma['ActualizarVentana']?></a>
	</div>
	<?php
	}else{
	?>
	<div class="alert alert-error">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo $idioma['DatosGuardadosError']?>
	</div>
	<?php	
	}
}
?>
