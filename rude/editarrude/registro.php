<?php
include_once("../../login/check.php");
include_once("../../class/rude.php");
include_once("../../class/alumno.php");
include_once("../../class/documento.php");
include_once("../../class/curso.php");
if(!empty($_POST)){
	$CodAlumno=$_POST['CodAlumno'];
	
	$rude=new rude;
	$alumno=new alumno;
	$cur=new curso;
	$documento=new documento;
	$alu=$rude->mostrarTodoDatos($CodAlumno);
	$al=$alumno->mostrarTodoDatos($CodAlumno);
	$alu=array_shift($alu);
	$al=array_shift($al);
	
	if(count($alu)>=1){//Si ya hay algun registro
		$archivo="actualizarRude.php";
		$titulo=$idioma['ModificarRude'];
	}else{
		$archivo="guardarRude.php";	
		$titulo=$idioma['RegistrarRude'];
	}
	
	$doc=$documento->mostrarDocumento($CodAlumno);
	$doc=array_shift($doc);
	
	?>
    <div class="alert alert-info centrar"><strong><?php echo mayuscula($titulo)?></strong></div>	
    <form action="<?php echo $archivo;?>" method="post" onsubmit="javascript:return false;if(confirm('¿Esta seguro de Guardar los Datos?'))" target="_blank">
		<input type="hidden" name="CodAlumno" value="<?php echo $CodAlumno;?>" />
        <strong><?php echo $idioma['TodoEnMayusculas'];?></strong>
    	<div class="box-header"><?php echo $idioma['DatosDelEstudiante'];?></div>
        <div class="box-content">
	    	<table class="table table-hover table-striped">
            	<tr><td><?php echo $idioma['ApellidoPaterno']?></td><td>::</td><td><input type="text" name="paterno" value="<?php echo mayuscula($al['Paterno']);?>" /></td></tr>
                <tr><td><?php echo $idioma['ApellidoMaterno']?></td><td>::</td><td><input type="text" name="materno" value="<?php echo mayuscula($al['Materno']);?>" /></td></tr>
                <tr><td><?php echo $idioma['Nombres']?></td><td>::</td><td><input type="text" name="nombres" value="<?php echo mayuscula($al['Nombres']);?>" /></td></tr>
                <tr><td><?php echo $idioma['Rude']?></td><td>::</td><td><input type="text" name="rude" value="<?php echo mayuscula($al['Rude']);?>" /></td></tr>
                <tr><td><?php echo $idioma['CedulaIdentidad']?></td><td>::</td><td><input name="numeroDoc" type="text" id="numeroDoc" value="<?php echo mayuscula($al['Ci']);?>" /></td></tr>
                <tr><td><?php echo $idioma['FechaNacimiento']?></td><td>::</td><td><input name="fechaNac" type="text" id="fechaNac" value="<?php echo fecha2Str($al['FechaNac']);?>" /></td></tr>
                <tr><td><?php echo $idioma['Sexo']?></td><td>::</td><td><select name="sexo"><option value="0" <?php echo !$al['Sexo']?'selected="selected"':'';?>><?php echo $idioma['Femenino']?></option><option value="1"<?php echo $al['Sexo']?'selected="selected"':'';?>><?php echo $idioma['Masculino']?></option></select></td></tr>
                <tr><td class="resaltar"><?php echo $idioma['CertificadoNacimiento']?></td><td></td><td></td></tr>
    	    	<tr><td><?php echo $idioma['Pais']?></td><td>::</td><td><input type="text" name="paisNacA" value="<?php echo $alu['PaisN']!=""?mayuscula($alu['PaisN']):mayuscula("BOLIVIA");?>" /></td></tr>
                <tr><td><?php echo $idioma['Departamento']?></td><td>::</td><td><input type="text" name="departamentoNacA" value="<?php echo $al['LugarNac']!=""?mayuscula($al['LugarNac']):mayuscula("LA PAZ");?>" /></td></tr>
                <tr><td><?php echo $idioma['Provincia']?></td><td>::</td><td><input type="text" name="provinciaNacA" value="<?php echo $alu['ProvinciaN']!=""?mayuscula($alu['ProvinciaN']):mayuscula("MURILLO");?>" /></td></tr>
                <tr><td><?php echo $idioma['Localidad']?></td><td>::</td><td><input type="text" name="localidadNacA" value="<?php echo $alu['LocalidadN']!=""?mayuscula($alu['LocalidadN']):mayuscula("NUESTRA SEÑORA DE LA PAZ");?>" /></td></tr>
                <tr><td><?php echo $idioma['OficialiaN']?></td><td>::</td><td><input type="text" name="oficialiaA" value="<?php echo mayuscula($alu['CertOfi']);?>"/></td></tr>
                <tr><td><?php echo $idioma['LibroN']?></td><td>::</td><td><input type="text" name="libroA" value="<?php echo mayuscula($alu['CertLibro']);?>"/></td></tr>
                <tr><td><?php echo $idioma['PartidaN']?></td><td>::</td><td><input type="text" name="partidaA" value="<?php echo mayuscula($alu['CertPartida']);?>"/></td></tr>
                <tr><td><?php echo $idioma['FolioN']?></td><td>::</td><td><input type="text" name="folioA" value="<?php echo mayuscula($alu['CertFolio']);?>"/></td></tr>
        	</table>
        </div>
        <div class="box-header"><?php echo $idioma['DatosInscripcionActual'];?></div>
        <div class="box-content">
	    	<table class="table table-hover table-striped">
            	<tr><td><?php echo $idioma['Curso']?></td><td>::</td><td><select name="curso">
								<?php foreach($cur->listar() as $curso){?><option value="<?php echo $curso['CodCurso'];?>" <?php if($al['CodCurso']==$curso['CodCurso']){echo 'selected="selected"';}?></option><?php echo mayuscula($curso['Nombre']);?></option><?php }?></select></td></tr>
    	    	<tr><td><?php echo $idioma['CodigoSieColegioAnterior']?></td><td>::</td><td><input type="text" name="codigoSIEA" value="<?php echo mayuscula($alu['CodigoSie']);?>" /></td></tr>
                <tr><td><?php echo $idioma['NombreColegioAnterior']?></td><td>::</td><td><input type="text" name="unidadEducativaA" value="<?php echo mayuscula($alu['NombreUnidad']);?>" /></td></tr>
        	</table>
        </div>
        <div class="box-header"><?php echo $idioma['DireccionActualEstudiante'];?></div>
        <div class="box-content">
	    	<table class="table table-hover table-striped">
    	    	<tr><td class="span3"><?php echo $idioma['Provincia'];?></td><td>::</td><td><input type="text" name="provinciaA" value="<?php echo $alu['ProvinciaE']!=""?mayuscula($alu['ProvinciaE']):mayuscula("MURILLO");?>" /></td></tr>
                <tr><td><?php echo $idioma['Seccion'];?></td><td>::</td><td><input type="text" name="seccionA" value="<?php echo $alu['MunicipioE']!=""?mayuscula($alu['MunicipioE']):mayuscula("CUARTA SECCIÓN");?>"/></td></tr>
                <tr><td><?php echo $idioma['Localidad'];?></td><td>::</td><td><input type="text" name="localidadA" value="<?php echo $alu['ComunidadE']!=""?mayuscula($alu['ComunidadE']):mayuscula("EL ALTO");?>"/></td></tr>
                <tr><td><?php echo $idioma['Zona'];?></td><td>::</td><td><input type="text" name="zonaA" value="<?php echo mayuscula($al['Zona']);?>"/></td></tr>
                <tr><td><?php echo $idioma['Calle'];?></td><td>::</td><td><input type="text" name="calleA" value="<?php echo mayuscula($al['Calle']);?>"/></td></tr>
                <tr><td><?php echo $idioma['Numero'];?></td><td>::</td><td><input type="text" name="numeroViviendaA" value="<?php echo mayuscula($al['Numero']);?>"/></td></tr>
                <tr><td><?php echo $idioma['Telefono'];?></td><td>::</td><td><input type="text" name="telefonoA" value="<?php echo mayuscula($al['TelefonoCasa']);?>"/></td></tr>
                <tr><td><?php echo $idioma['Celular'];?></td><td>::</td><td><input type="text" name="celularA" value="<?php echo mayuscula($al['Celular']);?>"/></td></tr>
        	</table>
        </div>
        <div class="box-header"><?php echo $idioma['AspectosSociales'];?></div>
        <div class="box-content">
	    	<table class="table table-hover table-striped">
    	    	<tr><td colspan="3"><strong><?php echo $idioma['Idiomas'];?></strong></td></tr>
                <tr><td><?php echo $idioma['LenguaMaterna'];?></td><td>::</td><td><select name="lenguaMaterna" class="span12"><option value="CASTELLANO" <?php $alu['LenguaMater']=="CASTELLANO"? 'selected="selected"':'';?>>CASTELLANO</option><option value="AYMARA" <?php $alu['LenguaMater']=="AYMARA"? 'selected="selected"':'';?>>AYMARA</option><option value="INGLES" <?php $alu['LenguaMater']=="INGLES"? 'selected="selected"':'';?>>INGLES</option></select></td></tr>
                <tr class="contenido"><td><?php echo $idioma['LenguasEstudiante'];?></td><td>::</td><td>
                	<table>
                	<tr><td>Castellano:</td> <td><select name="lenguaCastellano" class="span12"><option value="1" <?php $alu['CastellanoI']=="1"? 'selected="selected"':'';?>><?php echo $idioma['Si'];?></option><option value="0" <?php $alu['CastellanoI']=="0"? 'selected="selected"':'';?>><?php echo $idioma['No'];?></option></select></td></tr>
                    
                	<tr><td>Ingles: </td><td><select name="lenguaIngles" class="span12">
                    <option value="0" <?php $alu['InglesI']=="0"? 'selected="selected"':'';?>><?php echo $idioma['No'];?></option>
                    <option value="1" <?php $alu['InglesI']=="1"? 'selected="selected"':'';?>><?php echo $idioma['Si'];?></option>
                    </select></td></tr>
                    <tr><td>Aymara: </td><td><select name="lenguaAymara" class="span12">
                    <option value="0" <?php $alu['AymaraI']=="0"? 'selected="selected"':'';?>><?php echo $idioma['No'];?></option>
                    <option value="1" <?php $alu['AymaraI']=="1"? 'selected="selected"':'';?>><?php echo $idioma['Si'];?></option>
                    </select></td></tr>
                    </table>
                    </td></tr>
                <tr><td><?php echo $idioma['SeIdentifica'];?></td><td>::</td><td><select name="identificaA" class="span12">
                <option value="MESTIZO" <?php $alu['PerteneceA']=="MESTIZO"? 'selected="selected"':'';?>>MESTIZO</option>
                <option value="AYMARA" <?php $alu['PerteneceA']=="AYMARA"? 'selected="selected"':'';?>>AYMARA</option>
                <option value="QUECHUA" <?php $alu['PerteneceA']=="QUECHUA"? 'selected="selected"':'';?>>QUECHUA</option>
                </select></td></tr>
                <tr><td colspan="3"><?php echo $idioma['Salud'];?></td></tr>
                <tr><td><?php echo $idioma['CentroSaludAlrededor']?></td><td>::</td><td><select name="centroSalud" class="span12">
                <option value="1" <?php $alu['CentroSalud']=="1"? 'selected="selected"':'';?>><?php echo $idioma['Si']?></option>
                <option value="0" <?php $alu['CentroSalud']=="0"? 'selected="selected"':'';?>><?php echo $idioma['No']?></option>
                </select></td></tr>
                <tr><td><?php echo $idioma['CuantasVecesAcudio']?></td><td>::</td><td><select name="vecesSalud" class="span12">
                <option value="1a2" <?php $alu['VecesCentro']=="1a2"? 'selected="selected"':'';?>><?php echo $idioma['1A2Veces']?></option>
                <option value="3a5" <?php $alu['VecesCentro']=="3a5"? 'selected="selected"':'';?>><?php echo $idioma['3A5Veces']?></option>
                <option value="6a+" <?php $alu['VecesCentro']=="6a+"? 'selected="selected"':'';?>><?php echo $idioma['6oMasVeces']?></option>
                <option value="ninguna" <?php $alu['VecesCentro']=="ninguna"? 'selected="selected"':'';?>><?php echo $idioma['Ninguna']?></option>
                </select></td></tr>
                <tr><td><?php echo $idioma['DiscapacidadDeficienciaMental']?></td><td>::</td><td><select name="deficiencia" class="span12">
                <option value="0" <?php $alu['Discapacidad']=="0"? 'selected="selected"':'';?>><?php echo $idioma['No']?></option>
                <option value="1" <?php $alu['Discapacidad']=="1"? 'selected="selected"':'';?>><?php echo $idioma['Si']?></option>
                
                </select></td></tr>
                <tr><td colspan="3"><strong><?php echo $idioma['AccesoServiciosBasicos']?></strong></td></tr>
                <tr><td><?php echo $idioma['AguaPotableDomicilio']?></td><td>::</td><td><select name="aguaPotable" class="span12">
                <option value="1" <?php $alu['AguaDomicilio']=="1"? 'selected="selected"':'';?>><?php echo $idioma['Si']?></option>
                <option value="0" <?php $alu['AguaDomicilio']=="0"? 'selected="selected"':'';?>><?php echo $idioma['No']?></option>
                </select></td></tr>
                <tr><td><?php echo $idioma['ElectricidadRedPublica']?></td><td>::</td><td><select name="electricidad" class="span12">
                <option value="1" <?php $alu['Electricidad']=="1"? 'selected="selected"':'';?>><?php echo $idioma['Si']?></option>
                <option value="0" <?php $alu['Electricidad']=="0"? 'selected="selected"':'';?>><?php echo $idioma['No']?></option>
                </select></td></tr>
                <tr><td><?php echo $idioma['Alcantarillado']?></td><td>::</td><td><select name="alcantarillado" class="span12">
                <option value="1" <?php $alu['Alcantarillado']=="1"? 'selected="selected"':'';?>><?php echo $idioma['Si']?></option>
                <option value="0" <?php $alu['Alcantarillado']=="0"? 'selected="selected"':'';?>><?php echo $idioma['No']?></option>
                </select></td></tr>
                <tr><td><?php echo $idioma['ElEstudianteTrabaja']?></td><td>::</td><td><select name="trabaja" class="span12">
                <option value="NOTRABAJA" <?php $alu['Trabaja']=="NOTRABAJA"? 'selected="selected"':'';?>><?php echo $idioma['NoTrabaja']?></option>
                <option value="EMPLEADO" <?php $alu['Trabaja']=="EMPLEADO"? 'selected="selected"':'';?>><?php echo $idioma['Empleado']?></option>
                <option value="INDEPENDIENTE" <?php $alu['Trabaja']=="INDEPENDIENTE"? 'selected="selected"':'';?>><?php echo $idioma['Independiente']?></option>
                <option value="DOMESTICOCASA" <?php $alu['Trabaja']=="DOMESTICOCASA"? 'selected="selected"':'';?>><?php echo $idioma['TrabajoDomesticoCasa']?></option>
                </select></td></tr>
                <tr><td colspan="2"><strong><?php echo $idioma['ElEstudianteTieneAcceso']?></strong></td></tr>
                <tr><td><?php echo $idioma['InternetCasa']?></td><td>::</td><td><select name="internet" id="internet" class="span12">
                    <option value="1" <?php echo $alu['InternetCasa']?'selected="selected"':'';?>><?php echo $idioma['Si']?></option>
                    <option value="0" <?php echo !$alu['InternetCasa']?'selected="selected"':'';?>><?php echo $idioma['No']?></option>
                    </select>
                    </td></tr>
                <tr><td><?php echo $idioma['EstudianteTraslada']?></td><td>::</td><td><select name="traslado" class="span12">
                <option value="APIE" <?php echo $alu['Transporte']=="APIE"?'selected="selected"':'';?>><?php echo $idioma['APie']?></option>
                <option value="MINIBUS" <?php echo $alu['Transporte']=="MINIBUS"?'selected="selected"':'';?>><?php echo $idioma['Minibus']?></option>
                </select></td></tr>
                <tr><td><?php echo $idioma['TiempoTardaEstudiante']?></td><td>::</td><td><select name="tiempo">
                <option value="MenosMediaHora"><?php echo $idioma['MenosMediaHora']?></option>
                <option value="EntreMediaHoraYHora"><?php echo $idioma['EntreMediaHoraYHora']?></option>
                <option value="EntreDosHoras"><?php echo $idioma['EntreDosHoras']?></option>
                <option value="DosHorasOMas"><?php echo $idioma['DosHorasOMas']?></option>
                </select></td></tr>
        	</table>
        </div>
        <div class="box-header"><?php echo $idioma['DatosDelPadreTutor']?></div>
        <div class="box-content">
        	<table class="table table-hover table-striped">
           	 	<tr><td><?php echo $idioma['CedulaIdentidad']?></td><td>::</td><td><input type="text" name="CedulaPadre" value="<?php echo mayuscula($al['CiPadre']);?>"/></td></tr>
            	<tr><td><?php echo $idioma['Apellidos']?></td><td>::</td><td><input type="text" name="ApellidosP" value="<?php echo mayuscula($al['ApellidosPadre']);?>"/></td></tr>
                <tr><td><?php echo $idioma['Nombres']?></td><td>::</td><td><input type="text" name="nombresP" value="<?php echo mayuscula($al['NombrePadre']);?>"/></td></tr>
                <tr><td><?php echo $idioma['OcupacionLaboral']?></td><td>::</td><td><input type="text" name="ocupacionP" value="<?php echo mayuscula($al['OcupPadre']);?>"/></td></tr>
                <tr><td><?php echo $idioma['MayorGradoInstruccion']?></td><td>::</td><td><select name="instruccionP">
                	<option value="NINGUNA" <?php echo $alu['InstruccionP']=="NINGUNA"?'selected="selected"':'';?>><?php echo $idioma['NINGUNA']?></option>
                    <option value="PRIMARIA" <?php echo $alu['InstruccionP']=="PRIMARIA"?'selected="selected"':'';?>>PRIMARIA</option>
                    <option value="SECUNDARIA" <?php echo $alu['InstruccionP']=="SECUNDARIA"?'selected="selected"':'';?>>SECUNDARIA</option>
                    <option value="BACHILLER" <?php echo $alu['InstruccionP']=="BACHILLER"?'selected="selected"':'';?>>BACHILLER</option>
                    <option value="UNIVERSITARIO" <?php echo $alu['InstruccionP']=="UNIVERSITARIO"?'selected="selected"':'';?>>UNIVERSITARIO</option>
                    <option value="TECNICO MEDIO" <?php echo $alu['InstruccionP']=="TECNICO MEDIO"?'selected="selected"':'';?>>TECNICO MEDIO</option>
                    <option value="TECNICO SUPERIOR" <?php echo $alu['InstruccionP']=="TECNICO SUPERIOR"?'selected="selected"':'';?>>TECNICO SUPERIOR</option>
                    <option value="NORMALISTA" <?php echo $alu['InstruccionP']=="NORMALISTA"?'selected="selected"':'';?>>NORMALISTA</option>
                    <option value="LICENCIATURA" <?php echo $alu['InstruccionP']=="LICENCIATURA"?'selected="selected"':'';?>>LICENCIATURA</option>
                    <option value="CARRERA MILITAR" <?php echo $alu['InstruccionP']=="CARRERA MILITAR"?'selected="selected"':'';?>>CARRERA MILITAR</option>
                    <option value="POSTGRADO" <?php echo $alu['InstruccionP']=="POSTGRADO"?'selected="selected"':'';?>>POSTGRADO</option>
                    <option value="NO SABE/NO RESPONDE" <?php echo $alu['InstruccionP']=="NO SABE/NO RESPONDE"?'selected="selected"':'';?>><?php echo $idioma['NoSabeNoResponde']?></option>
                    </select></td></tr>
                <tr><td><?php echo $idioma['IdiomaHablaFrecuencia']?></td><td>::</td><td><input type="text" name="idiomaP" value="<?php echo mayuscula($alu['IdiomaP']);?>"/></td></tr>
                <tr><td><?php echo $idioma['TelefonoPadre']?></td><td>::</td><td><input type="text" name="telefonoP" value="<?php echo mayuscula($al['CelularP'],"utf8");?>"/></td></tr>
                <tr><td><?php echo $idioma['GradoParentesco']?></td><td>::</td><td><select name="parentescoP" class="span12">
                	<option value="---" <?php echo $alu['ParentescoP']=="---"?'selected="selected"':'';?>>---</option>
                    <option value="PADRE" <?php echo $alu['ParentescoP']=="PADRE"?'selected="selected"':'';?>><?php echo $idioma['Padre']?></option>
                    <option value="ABUELO" <?php echo $alu['ParentescoP']=="ABUELO"?'selected="selected"':'';?>><?php echo $idioma['Abuelo']?></option>
                    <option value="ABUELA" <?php echo $alu['ParentescoP']=="ABUELA"?'selected="selected"':'';?>><?php echo $idioma['Abuela']?></option>
                    <option value="TIO" <?php echo $alu['ParentescoP']=="TIO"?'selected="selected"':'';?>><?php echo $idioma['Tio']?></option>
                    <option value="TIA" <?php echo $alu['ParentescoP']=="TIA"?'selected="selected"':'';?>><?php echo $idioma['Tia']?></option>
                    <option value="HERMANO" <?php echo $alu['ParentescoP']=="HERMANO"?'selected="selected"':'';?>><?php echo $idioma['Hermano']?></option>
                    <option value="TUTOR" <?php echo $alu['ParentescoP']=="TUTOR"?'selected="selected"':'';?>><?php echo $idioma['Tutor']?></option>
                    </select></td></tr>
            </table>
        </div>
        <div class="box-header"><?php echo $idioma['DatosMadre']?></div>
        <div class="box-content">
        	<table class="table table-hover table-striped">
            	<tr><td><?php echo $idioma['CedulaIdentidad']?></td><td>::</td><td><input name="CedulaMadre" type="text" id="CedulaMadre" value="<?php echo mayuscula($al['CiMadre']);?>"/></td></tr>
            	<tr><td><?php echo $idioma['Apellidos']?></td><td>::</td><td><input type="text" name="paternoM" value="<?php echo mayuscula($al['ApellidosMadre']);?>"/></td></tr>
                <tr><td><?php echo $idioma['Nombres']?></td><td>::</td><td><input type="text" name="nombresM" value="<?php echo mayuscula($al['NombreMadre']);?>"/></td></tr>
                <tr><td><?php echo $idioma['OcupacionLaboral']?></td><td>::</td><td><input type="text" name="ocupacionM" value="<?php echo mayuscula($al['OcupMadre']);?>"/></td></tr>
                <tr><td><?php echo $idioma['MayorGradoInstruccion']?></td><td>::</td><td><select name="instruccionM" class="span12">
                	<option value="NINGUNA" <?php echo $alu['InstruccionM']=="NINGUNA"?'selected="selected"':'';?>><?php echo $idioma['Ninguna']?></option>
                    <option value="PRIMARIA" <?php echo $alu['InstruccionM']=="PRIMARIA"?'selected="selected"':'';?>>PRIMARIA</option>
                    <option value="SECUNDARIA" <?php echo $alu['InstruccionM']=="SECUNDARIA"?'selected="selected"':'';?>>SECUNDARIA</option>
                    <option value="TECNICO MEDIO" <?php echo $alu['InstruccionM']=="TECNICO MEDIO"?'selected="selected"':'';?>>TECNICO MEDIO</option>
                    <option value="TECNICO SUPERIOR" <?php echo $alu['InstruccionM']=="TECNICO SUPERIOR"?'selected="selected"':'';?>>TECNICO SUPERIOR</option>
                    <option value="NORMALISTA" <?php echo $alu['InstruccionM']=="NORMALISTA"?'selected="selected"':'';?>>NORMALISTA</option>
                    <option value="LICENCIATURA" <?php echo $alu['InstruccionM']=="LICENCIATURA"?'selected="selected"':'';?>>LICENCIATURA</option>
                    <option value="CARRERA MILITAR" <?php echo $alu['InstruccionM']=="CARRERA MILITAR"?'selected="selected"':'';?>>CARRERA MILITAR</option>
                    <option value="POSTGRADO" <?php echo $alu['InstruccionM']=="POSTGRADO"?'selected="selected"':'';?>>POSTGRADO</option>
                    <option value="BACHILLER" <?php echo $alu['InstruccionM']=="BACHILLER"?'selected="selected"':'';?>>BACHILLER</option>
                    <option value="UNIVERSITARIO" <?php echo $alu['InstruccionM']=="UNIVERSITARIO"?'selected="selected"':'';?>>UNIVERSITARIO</option>
                    <option value="NO SABE/NO RESPONDE" <?php echo $alu['InstruccionM']=="NO SABE/NO RESPONDE"?'selected="selected"':'';?>><?php echo $idioma['NoSabeNoResponde']?></option>
                    </select></td></tr>
                <tr><td><?php echo $idioma['IdiomaHablaFrecuencia']?></td><td>::</td><td><input type="text" name="idiomaM" value="<?php echo mayuscula($alu['IdiomaM']);?>"/></td></tr>
                <tr><td><?php echo $idioma['TelefonoMadre']?></td><td>::</td><td><input type="text" name="telefonoM" value="<?php echo mayuscula($al['CelularM']);?>"/></td></tr>
                
            </table>
            
        </div>
        <div class="box-header"><?php echo $idioma['Documentos'];?></div>
        <div class="box-content">
        	<table class="table table-hover table-striped">
            	<tr><td class="der span4"><label for="cn"><?php echo $idioma['CertificadoNacimiento'];?></label></td><td>::</td><td><input type="checkbox" name="CertificadoNac" id="cn" <?php echo $doc['CertificadoNac']?'checked="checked"':'';?>/></td></tr>
                <tr><td class="der"><label for="le"><?php echo $idioma['LibretaEscolar'];?></label></td><td>::</td><td><input type="checkbox" name="LibretaEsc" id="le" <?php echo $doc['LibretaEsc']?'checked="checked"':'';?>/></td></tr>
                 <tr><td class="der"><label for="lv"><?php echo $idioma['LibretaVacunas'];?></label></td><td>::</td><td><input type="checkbox" name="LibretaVac" id="lv" <?php echo $doc['LibretaVac']?'checked="checked"':'';?>/></td></tr>
                <tr><td class="der"><label for="CedulaId"><?php echo $idioma['CiAlumno'];?></label></td><td>::</td><td><input type="checkbox" name="CedulaId" id="CedulaId" <?php echo $doc['CedulaId']?'checked="checked"':'';?>/></td></tr>
                <tr><td class="der"><label for="CedulaIdP"><?php echo $idioma['CiPadre'];?></label></td><td>::</td><td><input type="checkbox" name="CedulaIdP" id="CedulaIdP" <?php echo $doc['CedulaIdP']?'checked="checked"':'';?>/></td></tr>
                <tr><td class="der"><label for="CedulaIdM"><?php echo $idioma['CiMadre'];?></label></td><td>::</td><td><input type="checkbox" name="CedulaIdM" id="CedulaIdM" <?php echo $doc['CedulaIdM']?'checked="checked"':'';?>/></td></tr>
                <tr><td class="der"><?php echo $idioma['ObservacionesDocumentos'];?></td><td>::</td><td>
                <textarea name="ObservacionesDoc" rows="5" cols="30"><?php echo $doc['Observaciones'];?></textarea></td></tr>
<tr><td><input type="submit" value="<?php echo $idioma['GuardarDatosRude']?>" class="btn btn-success"/></td><td></td><td></td></tr>
            </table>
        </div>
    </form>
    <?php
}

?>