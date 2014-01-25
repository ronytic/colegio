<?php
include_once("../../login/check.php");
if(!empty($_POST)){
	extract($_POST);
	$FechaUsuario=date("Y-m-d");
	$HoraUsuario=date("H:i:s");
	$CodigoUsuario=$_SESSION['CodUsuarioLog'];
	$NivelUsuario=$_SESSION['Nivel'];
	include_once("../../class/usuario.php");
	$usuario=new usuario;
	$valores=array("Paterno"=>"'$Paterno'",
				"Materno"=>"'$Materno'",
				"Nombres"=>"'$Nombres'",
				"Nivel"=>"'$Nivel'",
				"Usuario"=>"'$Usuario'",
				"Nick"=>"'$Nick'",
				"Ci"=>"'$Ci'",
				"Direccion"=>"'$Direccion'",
				"Telefono"=>"'$Telefono'",
				"Celular"=>"'$Celular'",
				"Observacion"=>"'$Observacion'",
				"Idioma"=>"'$Idioma'",
				"Activo"=>"'$Activo'",
				"Pass"=>"'$Pass'",
				"Pass2"=>"MD5('$Pass')",
				"CodUsuarioRegistro"=>"'$CodigoUsuario'",
				"NivelRegistro"=>"'$NivelUsuario'",
				"FechaRegistro"=>"'$FechaUsuario'",
				"HoraRegistro"=>"'$HoraUsuario'",
	);
	if($usuario->insertarRegistro($valores,0)){
		?><div class="alert alert-success"><?php echo $idioma['DatosGuardadosCorrectamente']?></div>
        <?php	
	}else{
		?><div class="alert alert-error"><?php echo $idioma['DatosGuardadosError']?></div>
        <?php
	}
}
?>

<script language="javascript">mostrar();</script>