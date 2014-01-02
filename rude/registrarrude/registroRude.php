<?php
include_once("../../login/check.php");
include_once("../../class/alumno.php");
include_once("../../class/rude.php");
include_once("../../class/documento.php");
include_once("../../class/curso.php");
if(!empty($_POST)){
	$CodAlumno=$_POST['CodAlumno'];
	$al=new alumno;
	$cur=new curso;
	$rude=new rude;
	$documento=new documento;
	$doc=$documento->mostrarDocumento($CodAlumno);
	$doc=array_shift($doc);
	$alu=$al->mostrarTodoDatos($CodAlumno);
	$alu=$alu[0];
	$rud=$rude->mostrarTodoDatos($CodAlumno);
	if(count($rud)>=1){
		echo $idioma['RudeYaRegistrado']
		?>: <span class="resaltar"><strong><?php echo mb_strtoupper($alu['Paterno']." ".$alu['Materno']." ".$alu['Nombres'],"utf8");?></strong></span>. <hr />	<?php echo $idioma['QuiereModificarlo'];?>
		<a href="../editarrude/?CodAlumno=<?php echo $CodAlumno?>" class="btn btn-success">Click</a>
		<?php
		exit();	
	}
	$direccion=explode(",",$alu['Direccion']);
	$zona=trim($direccion[0]);
	$calle=trim($direccion[1]);
	?>	
    <form action="guardarRude.php" method="post" onsubmit="javascript:return false;if(confirm('¿Esta seguro de Guardar los Datos?'))">
		<input type="hidden" name="CodAlumno" value="<?php echo $CodAlumno;?>" />
         <?php echo $idioma['TodoEnMayusculas'];?>
    	<div class="box-header"><?php echo $idioma['DatosDelEstudiante'];?></div>
        <div class="box-content">
	    	<table class="tablaSB">
            	<tr><td>Apellido Paterno</td><td>::</td><td><input type="text" name="paterno" value="<?php echo mb_strtoupper($alu['Paterno'],"utf8");?>" /></td></tr>
                <tr><td>Apellido Materno</td><td>::</td><td><input type="text" name="materno" value="<?php echo mb_strtoupper($alu['Materno'],"utf8");?>" /></td></tr>
                <tr><td>Nombres</td><td>::</td><td><input type="text" name="nombres" value="<?php echo mb_strtoupper($alu['Nombres'],"utf8");?>" /></td></tr>
                <tr><td>RUDE</td><td>::</td><td><input type="text" name="rude" value="<?php echo mb_strtoupper($alu['Rude'],"utf8");?>" /></td></tr>
                <tr><td>Cedula de Identidad</td><td>::</td><td><input name="numeroDoc" type="text" id="numeroDoc" value="<?php echo mb_strtoupper($alu['Ci'],"utf8");?>" /></td></tr>
                <tr><td>Fecha de Nacimiento</td><td>::</td><td><input name="fechaNac" type="text" id="fechaNac" value="<?php echo mb_strtoupper($alu['FechaNac'],"utf8");?>" /></td></tr>
                <tr><td>SEXO</td><td>::</td><td><select name="sexo"><option value="0" <?php echo !$alu['Sexo']?'selected="selected"':'';?>>Femenino</option><option value="1"<?php echo $alu['Sexo']?'selected="selected"':'';?>>Masculino</option></select></td></tr>
                <tr><td class="resaltar">Certificado de Nacimiento</td><td></td><td></td></tr>
    	    	<tr><td>Pais</td><td>::</td><td><input type="text" name="paisNacA" value="BOLIVIA" /></td></tr>
                <tr><td>Departamento</td><td>::</td><td><input type="text" name="departamentoNacA" value="LA PAZ" /></td></tr>
                <tr><td>Provincia</td><td>::</td><td><input type="text" name="provinciaNacA" value="MURILLO" /></td></tr>
                <tr><td>Localidad</td><td>::</td><td><input type="text" name="localidadNacA" value="NUESTRA SEÑORA DE LA PAZ" /></td></tr>
                <tr><td>Oficialia Nº</td><td>::</td><td><input type="text" name="oficialiaA"/></td></tr>
                <tr><td>Libro Nº</td><td>::</td><td><input type="text" name="libroA"/></td></tr>
                <tr><td>Partida Nº</td><td>::</td><td><input type="text" name="partidaA"/></td></tr>
                <tr><td>Folio Nº</td><td>::</td><td><input type="text" name="folioA"/></td></tr>
        	</table>
        </div>
         <div class="box-header"><?php echo $idioma['DatosInscripcionActual'];?></div>
        <div class="box-content">
	    	<table class="tablaSB">
            	<tr><td>Curso</td><td>::</td><td><select name="curso">
								<?php foreach($cur->listar() as $curso){?><option value="<?php echo $curso['CodCurso'];?>" <?php if($alu['CodCurso']==$curso['CodCurso']){echo 'selected="selected"';}?></option><?php echo mb_strtoupper($curso['Nombre'],"utf8");?></option><?php }?></select></td></tr>
    	    	<tr><td>Codigo SIE, Colegio Anterior</td><td>::</td><td><input type="text" name="codigoSIEA" value="" /></td></tr>
                <tr><td>Nombre Colegio Anterior</td><td>::</td><td><input type="text" name="unidadEducativaA" value="" /></td></tr>
        	</table>
        </div>
        <div class="box-header"><?php echo $idioma['DireccionActualEstudiante'];?></div>
        <div class="box-content">
	    	<table class="tablaSB">
    	    	<tr><td>Provincia</td><td>::</td><td><input type="text" name="provinciaA" value="MURILLO" /></td></tr>
                <tr><td>Sección</td><td>::</td><td><input type="text" name="seccionA" value="CUARTA SECCIÓN"/></td></tr>
                <tr><td>Localidad</td><td>::</td><td><input type="text" name="localidadA" value="EL ALTO"/></td></tr>
                <tr><td>Zona</td><td>::</td><td><input type="text" name="zonaA" value="<?php echo mb_strtoupper($alu['Zona'],"utf8");?>"/></td></tr>
                <tr><td>Calle</td><td>::</td><td><input type="text" name="calleA" value="<?php echo mb_strtoupper($alu['Calle'],"utf8");?>"/></td></tr>
                <tr><td>Numero</td><td>::</td><td><input type="text" name="numeroViviendaA" value="<?php echo mb_strtoupper($alu['Numero'],"utf8");?>"/></td></tr>
                <tr><td>Teléfono</td><td>::</td><td><input type="text" name="telefonoA" value="<?php echo mb_strtoupper($alu['TelefonoCasa'],"utf8");?>"/></td></tr>
                <tr><td>Celular</td><td>::</td><td><input type="text" name="celularA" value="<?php echo mb_strtoupper($alu['Celular'],"utf8");?>"/></td></tr>
        	</table>
        </div>
        <div class="box-header"><?php echo $idioma['AspectosSociales'];?></div>
        <div class="box-content">
	    	<table class="tablaSB">
    	    	<tr><td colspan="3">Idiomas</td></tr>
                <tr><td>Lengua Materna</td><td>::</td><td><select name="lenguaMaterna"><option value="CASTELLANO" selected="selected">CASTELLANO</option><option value="AYMARA">AYMARA</option><option value="INGLES">INGLES</option></select></td></tr>
                <tr class="contenido"><td>Lenguas del Estudiantes</td><td>::</td><td>
                	Castellano<select name="lenguaCastellano"><option value="1" selected="selected">SI</option><option value="0">NO</option></select> 
                	Ingles<select name="lenguaIngles"><option value="1">SI</option><option value="0" selected="selected">NO</option></select><br />
                    Aymara<select name="lenguaAymara"><option value="1">SI</option><option value="0" selected="selected">NO</option></select>
                    </td></tr>
                <tr><td>Se Identifica</td><td>::</td><td><select name="identificaA"><option value="MESTIZO" selected="selected">MESTIZO</option><option value="AYMARA">AYMARA</option><option value="QUECHUA">QUECHUA</option></select></td></tr>
                <tr><td colspan="3">Salud</td></tr>
                <tr><td>¿Tiene un Centro de Salud a su Alrededor?</td><td>::</td><td><select name="centroSalud"><option value="1" selected="selected">SI</option><option value="0">NO</option></select></td></tr>
                <tr><td>¿Cuantas veces acudió el año pasado?</td><td>::</td><td><select name="vecesSalud"><option value="1a2">1 a 2 veces</option><option value="3a5">3 a 5 veces</option><option value="6a+">6 o más veces</option><option value="ninguna">Ninguna</option></select></td></tr>
                <tr><td>Discapacidad o Deficiencia Mental</td><td>::</td><td><select name="deficiencia"><option value="1">SI</option><option value="0" selected="selected">NO</option></select></td></tr>
                <tr><td colspan="3">Acceso de Servicios Basicos</td></tr>
                <tr><td>Agua Potable a Domicilio</td><td>::</td><td><select name="aguaPotable"><option value="1" selected="selected">SI</option><option value="0">NO</option></select></td></tr>
                <tr><td>Electricidad Red Publica</td><td>::</td><td><select name="electricidad"><option value="1" selected="selected">SI</option><option value="0">NO</option></select></td></tr>
                <tr><td>Alcantarillado</td><td>::</td><td><select name="alcantarillado"><option value="1" selected="selected">SI</option><option value="0">NO</option></select></td></tr>
                <tr><td>¿El estudiante trabaja?</td><td>::</td><td><select name="trabaja" ><option value="NOTRABAJA" selected="selected">NO TRABAJA</option><option value="EMPLEADO">EMPLEADO</option><option value="INDEPENDIENTE" >INDEPENDIENTE</option><option value="DOMESTICOCASA" >TRABAJO DOMESTICO EN CASA</option></select></td></tr>
                <tr><td>¿El estudiante tiene acceso a?</td><td>::</td><td>
                    ¿Internet en casa?<select name="internet" id="internet"><option value="1">SI</option><option value="0">NO</option></select>
                    </td></tr>
                <tr><td>¿El estudiante se traslada en?</td><td>::</td><td><select name="traslado"><option value="APIE" selected="selected">A PIE</option><option value="MINIBUS">MINIBUS</option></select></td></tr>
                <tr><td>Tiempo que tarda el Estudiante</td><td>::</td><td><input type="text" name="tiempo" value="Menos de media Hora" readonly/></td></tr>
        	</table>
        </div>
        <div class="box-header"><?php echo $idioma['DatosDelPadreTutor'];?></div>
        <div class="box-content">
        	<table class="tablaSB">
           	 	<tr><td>Cedula de Identidad</td><td>::</td><td><input type="text" name="CedulaPadre" value="<?php echo mb_strtoupper($alu['CiPadre'],"utf8");?>"/></td></tr>
            	<tr><td>Apellidos</td><td>::</td><td><input type="text" name="ApellidosP" value="<?php echo mb_strtoupper($alu['ApellidosPadre'],"utf8");?>"/></td></tr>
                <tr><td>Nombres</td><td>::</td><td><input type="text" name="nombresP" value="<?php echo mb_strtoupper($alu['NombrePadre'],"utf8");?>"/></td></tr>
                <tr><td>Ocupación Laboral</td><td>::</td><td><input type="text" name="ocupacionP" value="<?php echo mb_strtoupper($alu['OcupPadre'],"utf8");?>"/></td></tr>
                <tr><td>Mayor Grado de Instrucción </td><td>::</td><td><select name="instruccionP">
                	<option value="NINGUNA">NINGUNA</option>
                    <option value="PRIMARIA">PRIMARIA</option>
                    <option value="SECUNDARIA">SECUNDARIA</option>
                    <option value="TECNICO MEDIO">TECNICO MEDIO</option>
                    <option value="TECNICO SUPERIOR">TECNICO SUPERIOR</option>
                    <option value="NORMALISTA">NORMALISTA</option>
                    <option value="LICENCIATURA">LICENCIATURA</option>
                    <option value="CARRERA MILITAR">CARRERA MILITAR</option>
                    <option value="POSTGRADO">POSTGRADO</option>
                    <option value="BACHILLER">BACHILLER</option>
                    <option value="UNIVERSITARIO">UNIVERSITARIO</option>
                    <option value="NO SABE/NO RESPONDE">NO SABE/ NO RESPONDE</option>
                    </select></td></tr>
                <tr><td>Idioma que habla con frecuencia</td><td>::</td><td><input type="text" name="idiomaP" value="CASTELLANO"/></td></tr>
                <tr><td>Telefono del Padre</td><td>::</td><td><input type="text" name="telefonoP" value="<?php echo mb_strtoupper($alu['CelularP'],"utf8");?>"/></td></tr>
                <tr><td>Grado de Parentesco </td><td>::</td><td><select name="parentescoP">
                	<option value="---">---</option>
                    <option value="PADRE">PADRE</option>
                    <option value="ABUELO">ABUELO</option>
                    <option value="ABUELA">ABUELA</option>
                    <option value="TIO">TIO</option>
                    <option value="TIA">TIA</option>
                    <option value="HERMANO">HERMANO</option>
                    <option value="TUTOR">TUTOR</option>
                    </select></td></tr>
            </table>
        </div>
        <div class="box-header"><?php echo $idioma['DatosMadre']?></div>
        <div class="box-content">
        	<table class="tablaSB">
            	<tr><td>Cedula de Identidad</td><td>::</td><td><input name="CedulaMadre" type="text" id="CedulaMadre" value="<?php echo mb_strtoupper($alu['CiMadre'],"utf8");?>"/></td></tr>
            	<tr><td>Apellidos</td><td>::</td><td><input type="text" name="paternoM" value="<?php echo mb_strtoupper($alu['ApellidosMadre'],"utf8");?>"/></td></tr>
                <tr><td>Nombres</td><td>::</td><td><input type="text" name="nombresM" value="<?php echo mb_strtoupper($alu['NombreMadre'],"utf8");?>"/></td></tr>
                <tr><td>Ocupación Laboral</td><td>::</td><td><input type="text" name="ocupacionM" value="<?php echo mb_strtoupper($alu['OcupMadre'],"utf8");?>"/></td></tr>
                <tr><td>Mayor Grado de Instrucción </td><td>::</td><td><select name="instruccionM">
                	<option value="NINGUNA">NINGUNA</option>
                    <option value="PRIMARIA">PRIMARIA</option>
                    <option value="SECUNDARIA">SECUNDARIA</option>
                    <option value="TECNICO MEDIO">TECNICO MEDIO</option>
                    <option value="TECNICO SUPERIOR">TECNICO SUPERIOR</option>
                    <option value="NORMALISTA">NORMALISTA</option>
                    <option value="LICENCIATURA">LICENCIATURA</option>
                    <option value="CARRERA MILITAR">CARRERA MILITAR</option>
                    <option value="POSTGRADO">POSTGRADO</option>
                    <option value="BACHILLER">BACHILLER</option>
                    <option value="UNIVERSITARIO">UNIVERSITARIO</option>
                    <option value="NO SABE/NO RESPONDE">NO SABE/ NO RESPONDE</option>
                    </select></td></tr>
                <tr><td>Idioma que habla con frecuencia</td><td>::</td><td><input type="text" name="idiomaM" value="CASTELLANO"/></td></tr>
                <tr><td>Telefono del Madre</td><td>::</td><td><input type="text" name="telefonoM" value="<?php echo mb_strtoupper($alu['CelularM'],"utf8");?>"/></td></tr>
                
            </table>
            
        </div>
        <div class="box-header"><?php echo $idioma['Documentos'];?></div>
        <div class="box-content">
        	<table>
            	<tr><td class="der"><label for="cn">Certificado de Nacimiento</label></td><td>::</td><td><input type="checkbox" name="CertificadoNac" id="cn" <?php echo $doc['CertificadoNac']?'checked="checked"':'';?>/></td></tr>
                <tr><td class="der"><label for="le">Libreta Escolar</label></td><td>::</td><td><input type="checkbox" name="LibretaEsc" id="le" <?php echo $doc['LibretaEsc']?'checked="checked"':'';?>/></td></tr>
                 <tr><td class="der"><label for="lv">Libreta de Vacunas</label></td><td>::</td><td><input type="checkbox" name="LibretaVac" id="lv" <?php echo $doc['LibretaVac']?'checked="checked"':'';?>/></td></tr>
                <tr><td class="der"><label for="CedulaId">C.I. del Alumno</label></td><td>::</td><td><input type="checkbox" name="CedulaId" id="CedulaId" <?php echo $doc['CedulaId']?'checked="checked"':'';?>/></td></tr>
                <tr><td class="der"><label for="CedulaIdP">C.I. del Padre</label></td><td>::</td><td><input type="checkbox" name="CedulaIdP" id="CedulaIdP" <?php echo $doc['CedulaIdP']?'checked="checked"':'';?>/></td></tr>
                <tr><td class="der"><label for="CedulaIdM">C.I. de la Madre</label></td><td>::</td><td><input type="checkbox" name="CedulaIdM" id="CedulaIdM" <?php echo $doc['CedulaIdM']?'checked="checked"':'';?>/></td></tr>
                <tr><td colspan="3">Observaciones Documentos<textarea name="ObservacionesDoc" rows="5" cols="30"><?php echo $doc['Observaciones'];?></textarea></td></tr>
                <tr><td><input type="submit" value="Guardar Datos Rude" class="btn"/></td><td></td><td></td></tr>
            </table>
        </div>
    </form>
    <?php
}

?>