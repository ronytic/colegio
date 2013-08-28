<?php
include_once("../../login/check.php");
if(isset($_POST)){
	?>
    <form action="" id="formulario">
    <table class="table table-hover">
        <!--<tr><td>Sexo</td><td><select name="sexo">
        						<option value="2">Ambos Sexos</option>
                                <option value="1">Hombres</option>
                                <option value="0">Mujeres</option>
                            </select></td></tr>-->
        <tr><td><?php echo $idioma['Columna1']?></td><td><select name="campo1" class="input-medium span10">
        						<option value=""><?php echo $idioma['Ninguno']?></option>
        						<option value="FechaNac"><?php echo $idioma['FechaNac']?></option>
                                <option value="Ci"><?php echo $idioma['Ci']?></option>
                                <option value="Zona"><?php echo $idioma['Zona']?></option>
                                <option value="Calle"><?php echo $idioma['Calle']?></option>
                                <option value="Numero"><?php echo $idioma['Numero']?></option>
                                <option value="TelefonoCasa"><?php echo $idioma['TelefonoCasa']?></option>
                                <option value="Celular"><?php echo $idioma['Celular']?></option>
                                <option value="Rude"><?php echo $idioma['Rude']?></option>
                                <option value="Procedencia"><?php echo $idioma['Procedencia']?></option>
                                <option value="Observaciones"><?php echo $idioma['Observaciones']?></option>
                                <option value="ApellidosPadre"><?php echo $idioma['ApellidosPadre']?></option>
                                <option value="NombrePadre"><?php echo $idioma['NombrePadre']?></option>
                                <option value="CiPadre"><?php echo $idioma['CiPadre']?></option>
                                <option value="OcupPadre"><?php echo $idioma['OcupacionPadre']?></option>
                                <option value="CelularP"><?php echo $idioma['CelularP']?></option>
                                <option value="ApellidosMadre"><?php echo $idioma['ApellidosMadre']?></option>
                                <option value="NombreMadre"><?php echo $idioma['NombreMadre']?></option>
                                <option value="CiMadre"><?php echo $idioma['CiMadre']?></option>
                                <option value="OcupMadre"><?php echo $idioma['OcupacionMadre']?></option>
                                <option value="CelularM"><?php echo $idioma['CelularM']?></option>
                                <option value="Email"><?php echo $idioma['Email']?></option>
                                <option value="Nit"><?php echo $idioma['Nit']?></option>
                                <option value="FacturaA"><?php echo $idioma['NombreFacturar']?></option>
                                <option value="UsuarioAlumno"><?php echo $idioma['UsuarioAlumno']?></option>
                                <option value="Password"><?php echo $idioma['Contrasena']?></option>
                                <option value="UsuarioPadre"><?php echo $idioma['UsuarioPadre']?></option>
                                <option value="PasswordP"><?php echo $idioma['ContrasenaPadre']?></option>
                                <option value="CodBarra"><?php echo $idioma['CodigoBarra']?></option>
                                <option value="FechaIns"><?php echo $idioma['FechaInscripcion']?></option>
                                <option value="HoraIns"><?php echo $idioma['HoraInscripcion']?></option>
								</select></td></tr>
         <tr><td><?php echo $idioma['Columna2']?></td><td><select name="campo2" class="input-medium span10">
        						<option value=""><?php echo $idioma['Ninguno']?></option>
        						<option value="FechaNac"><?php echo $idioma['FechaNac']?></option>
                                <option value="Ci"><?php echo $idioma['Ci']?></option>
                                <option value="Zona"><?php echo $idioma['Zona']?></option>
                                <option value="Calle"><?php echo $idioma['Calle']?></option>
                                <option value="Numero"><?php echo $idioma['Numero']?></option>
                                <option value="TelefonoCasa"><?php echo $idioma['TelefonoCasa']?></option>
                                <option value="Celular"><?php echo $idioma['Celular']?></option>
                                <option value="Rude"><?php echo $idioma['Rude']?></option>
                                <option value="Procedencia"><?php echo $idioma['Procedencia']?></option>
                                <option value="Observaciones"><?php echo $idioma['Observaciones']?></option>
                                <option value="ApellidosPadre"><?php echo $idioma['ApellidosPadre']?></option>
                                <option value="NombrePadre"><?php echo $idioma['NombrePadre']?></option>
                                <option value="CiPadre"><?php echo $idioma['CiPadre']?></option>
                                <option value="OcupPadre"><?php echo $idioma['OcupacionPadre']?></option>
                                <option value="CelularP"><?php echo $idioma['CelularP']?></option>
                                <option value="ApellidosMadre"><?php echo $idioma['ApellidosMadre']?></option>
                                <option value="NombreMadre"><?php echo $idioma['NombreMadre']?></option>
                                <option value="CiMadre"><?php echo $idioma['CiMadre']?></option>
                                <option value="OcupMadre"><?php echo $idioma['OcupacionMadre']?></option>
                                <option value="CelularM"><?php echo $idioma['CelularM']?></option>
                                <option value="Email"><?php echo $idioma['Email']?></option>
                                <option value="Nit"><?php echo $idioma['Nit']?></option>
                                <option value="FacturaA"><?php echo $idioma['NombreFacturar']?></option>
                                <option value="UsuarioAlumno"><?php echo $idioma['UsuarioAlumno']?></option>
                                <option value="Password"><?php echo $idioma['Contrasena']?></option>
                                <option value="UsuarioPadre"><?php echo $idioma['UsuarioPadre']?></option>
                                <option value="PasswordP"><?php echo $idioma['ContrasenaPadre']?></option>
                                <option value="CodBarra"><?php echo $idioma['CodigoBarra']?></option>
                                <option value="FechaIns"><?php echo $idioma['FechaInscripcion']?></option>
                                <option value="HoraIns"><?php echo $idioma['HoraInscripcion']?></option>
								</select></td></tr>
		<tr><td><?php echo $idioma['Columna3']?></td><td><select name="campo3" class="input-medium span10">
        						<option value=""><?php echo $idioma['Ninguno']?></option>
        						<option value="FechaNac"><?php echo $idioma['FechaNac']?></option>
                                <option value="Ci"><?php echo $idioma['Ci']?></option>
                                <option value="Zona"><?php echo $idioma['Zona']?></option>
                                <option value="Calle"><?php echo $idioma['Calle']?></option>
                                <option value="Numero"><?php echo $idioma['Numero']?></option>
                                <option value="TelefonoCasa"><?php echo $idioma['TelefonoCasa']?></option>
                                <option value="Celular"><?php echo $idioma['Celular']?></option>
                                <option value="Rude"><?php echo $idioma['Rude']?></option>
                                <option value="Procedencia"><?php echo $idioma['Procedencia']?></option>
                                <option value="Observaciones"><?php echo $idioma['Observaciones']?></option>
                                <option value="ApellidosPadre"><?php echo $idioma['ApellidosPadre']?></option>
                                <option value="NombrePadre"><?php echo $idioma['NombrePadre']?></option>
                                <option value="CiPadre"><?php echo $idioma['CiPadre']?></option>
                                <option value="OcupPadre"><?php echo $idioma['OcupacionPadre']?></option>
                                <option value="CelularP"><?php echo $idioma['CelularP']?></option>
                                <option value="ApellidosMadre"><?php echo $idioma['ApellidosMadre']?></option>
                                <option value="NombreMadre"><?php echo $idioma['NombreMadre']?></option>
                                <option value="CiMadre"><?php echo $idioma['CiMadre']?></option>
                                <option value="OcupMadre"><?php echo $idioma['OcupacionMadre']?></option>
                                <option value="CelularM"><?php echo $idioma['CelularM']?></option>
                                <option value="Email"><?php echo $idioma['Email']?></option>
                                <option value="Nit"><?php echo $idioma['Nit']?></option>
                                <option value="FacturaA"><?php echo $idioma['NombreFacturar']?></option>
                                <option value="UsuarioAlumno"><?php echo $idioma['UsuarioAlumno']?></option>
                                <option value="Password"><?php echo $idioma['Contrasena']?></option>
                                <option value="UsuarioPadre"><?php echo $idioma['UsuarioPadre']?></option>
                                <option value="PasswordP"><?php echo $idioma['ContrasenaPadre']?></option>
                                <option value="CodBarra"><?php echo $idioma['CodigoBarra']?></option>
                                <option value="FechaIns"><?php echo $idioma['FechaInscripcion']?></option>
                                <option value="HoraIns"><?php echo $idioma['HoraInscripcion']?></option>
								</select></td></tr>
		  <tr><td><?php echo $idioma['Columna4']?></td><td><select name="campo4" class="input-medium span10">
        						<option value=""><?php echo $idioma['Ninguno']?></option>
        						<option value="FechaNac"><?php echo $idioma['FechaNac']?></option>
                                <option value="Ci"><?php echo $idioma['Ci']?></option>
                                <option value="Zona"><?php echo $idioma['Zona']?></option>
                                <option value="Calle"><?php echo $idioma['Calle']?></option>
                                <option value="Numero"><?php echo $idioma['Numero']?></option>
                                <option value="TelefonoCasa"><?php echo $idioma['TelefonoCasa']?></option>
                                <option value="Celular"><?php echo $idioma['Celular']?></option>
                                <option value="Rude"><?php echo $idioma['Rude']?></option>
                                <option value="Procedencia"><?php echo $idioma['Procedencia']?></option>
                                <option value="Observaciones"><?php echo $idioma['Observaciones']?></option>
                                <option value="ApellidosPadre"><?php echo $idioma['ApellidosPadre']?></option>
                                <option value="NombrePadre"><?php echo $idioma['NombrePadre']?></option>
                                <option value="CiPadre"><?php echo $idioma['CiPadre']?></option>
                                <option value="OcupPadre"><?php echo $idioma['OcupacionPadre']?></option>
                                <option value="CelularP"><?php echo $idioma['CelularP']?></option>
                                <option value="ApellidosMadre"><?php echo $idioma['ApellidosMadre']?></option>
                                <option value="NombreMadre"><?php echo $idioma['NombreMadre']?></option>
                                <option value="CiMadre"><?php echo $idioma['CiMadre']?></option>
                                <option value="OcupMadre"><?php echo $idioma['OcupacionMadre']?></option>
                                <option value="CelularM"><?php echo $idioma['CelularM']?></option>
                                <option value="Email"><?php echo $idioma['Email']?></option>
                                <option value="Nit"><?php echo $idioma['Nit']?></option>
                                <option value="FacturaA"><?php echo $idioma['NombreFacturar']?></option>
                                <option value="UsuarioAlumno"><?php echo $idioma['UsuarioAlumno']?></option>
                                <option value="Password"><?php echo $idioma['Contrasena']?></option>
                                <option value="UsuarioPadre"><?php echo $idioma['UsuarioPadre']?></option>
                                <option value="PasswordP"><?php echo $idioma['ContrasenaPadre']?></option>
                                <option value="CodBarra"><?php echo $idioma['CodigoBarra']?></option>
                                <option value="FechaIns"><?php echo $idioma['FechaInscripcion']?></option>
                                <option value="HoraIns"><?php echo $idioma['HoraInscripcion']?></option>
								</select></td></tr>
          <tr><td><?php echo $idioma['DibujarBorde']?></td><td><input type="checkbox" name="borde"/></td></tr>
          <tr><td><?php echo $idioma['DibujarSombreado']?></td><td><input type="checkbox" name="sombreado" checked="checked"/></td></tr>
          <tr><td><?php echo $idioma['SoloCasillasBlanco']?></td><td><input type="checkbox" name="blanco"/>
          					<select name="cantidad" class="input-mini">
        						<option value="1">1</option>
        						<option value="2">2</option>
                                <option value="3">3</option>
								</select></td></tr>     
          
        <tr><td></td><td><input type="submit" value="<?php echo $idioma['VerReporte']?>" class="btn btn-success"/> </td></tr>
    </table>
    </form>
    <?php
}
?>