<?php
include_once("../../login/check.php");
if(isset($_POST)){
	$folder="../../";
	$CodAlumno=$_POST['CodAlumno'];
	include_once("../../class/alumno.php");
	include_once("../../class/curso.php");
	include_once("../../class/documento.php");
	$curso=new curso;
	$alumno=new alumno;
	$documento=new documento;
	$al=$alumno->mostrarTodoDatos($CodAlumno);	
	$al=array_shift($al);
	$cur=$curso->mostrarCurso($al['CodCurso']);
	$cur=array_shift($cur);
	$doc=$documento->mostrarDocumento($al['CodAlumno']);
	$doc=array_shift($doc);
	
	$ima=$folder."imagenes/alumnos/".$al['Foto'];
	if(!file_exists($ima) || empty($al['Foto'])){
		 $ima=$folder."imagenes/alumnos/0.jpg";	
	}
	
	?>
    <div class="box-header"><h2><i class="icon-user"></i><span class="break"></span><?php echo $idioma['DatosAlumno']?></h2></div>
    <div class="box-content">
    	<div class="thumbnail pull-right span2">
    				<img src="<?php echo $ima?>"/>
    	</div><br />
    	<a href="#" class="btn btn-success btn-mini" id="exportarexcel"><?php echo $idioma['ExportarExcel']?></a>
    	<table class="table table-bordered table-hover table-striped">
        	<tr><td class="resaltar" colspan="2"><?php echo $idioma['DatosAlumno']?></td></tr>
            <tr>
                <td><?php echo $idioma['Curso']?></td>
                <td><?php echo $cur['Nombre']?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['Paterno']?></td>
                <td><?php echo capitalizar($al['Paterno'])?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['Materno']?></td>
                <td><?php echo capitalizar($al['Materno'])?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['Nombres']?></td>
                <td><?php echo capitalizar($al['Nombres'])?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['Sexo']?></td>
                <td><?php echo capitalizar($al['Sexo']?$idioma['Masculino']:$idioma['Femenino'])?></td></tr>
            <tr>
                <td><?php echo $idioma['LugarNacimiento']?></td>
                <td><?php echo capitalizar($al['LugarNac'])?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['FechaNacimiento']?></td>
                <td><?php echo capitalizar(fecha2Str($al['FechaNac']))?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['CedulaIdentidad']?></td>
                <td><?php echo capitalizar($al['Ci'])?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['Zona']?></td>
                <td><?php echo capitalizar($al['Zona'])?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['Calle']?></td>
                <td><?php echo capitalizar($al['Calle'])?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['Numero']?></td>
                <td><?php echo capitalizar($al['Numero'])?></td></tr>
            <tr>
                <td><?php echo $idioma['TelefonoCasa']?></td>
                <td><?php echo capitalizar($al['TelefonoCasa'])?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['Celular']?></td>
                <td><?php echo capitalizar($al['Celular'])?></td>
            </tr>
            <tr>
            	<td class="resaltar" colspan="2"><hr /></td>
            </tr>
            <tr><td class="resaltar" colspan="2"><?php echo $idioma['DatosAcademicos']?></td></tr>
            <tr>
                <td><?php echo $idioma['Procedencia']?></td>
                <td><?php echo capitalizar($al['Procedencia'])?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['Repitente']?></td>
                <td><?php echo capitalizar($al['Repitente']?$idioma['Si']:$idioma['No'])?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['Traspaso']?></td>
                <td><?php echo capitalizar($al['Traspaso']?$idioma['Si']:$idioma['No'])?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['Becado']?></td>
                <td><?php echo capitalizar($al['Becado']?$idioma['Si']:$idioma['No'])?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['MontoBeca']?></td>
                <td><?php echo capitalizar($al['MontoBeca'])?>%</td>
            </tr>
            <tr>
                <td><?php echo $idioma['Retirado']?></td>
                <td><?php echo capitalizar($al['Retirado']?$idioma['Si']:$idioma['No'])?></td>
             </tr>
             <tr>
                <td><?php echo $idioma['FechaRetiro']?></td>
                <td><?php echo capitalizar(fecha2Str($al['FechaRetiro']))?></td>
             </tr>
             <tr>
                <td><?php echo $idioma['Rude']?></td>
                <td><?php echo capitalizar($al['Rude'])?></td>
             </tr>
             <tr>
                <td><?php echo $idioma['Observaciones']?></td>
                <td><?php echo capitalizar($al['Observaciones'])?></td>
             </tr>
             <tr>
            	<td class="resaltar" colspan="2"><hr /></td>
            </tr>
            <tr><td class="resaltar" colspan="2"><?php echo $idioma['DatosPadreFamilia']?></td></tr>
            <tr>
                <td><?php echo $idioma['ApellidosPadre']?></td>
                <td><?php echo capitalizar($al['ApellidosPadre'])?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['NombrePadre']?></td>
                <td><?php echo capitalizar($al['NombrePadre'])?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['CiPadre']?></td>
                <td><?php echo capitalizar($al['CiPadre'])?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['OcupacionPadre']?></td>
                <td><?php echo capitalizar($al['OcupPadre'])?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['CelularPadre']?></td>
                <td><?php echo capitalizar($al['CelularP'])?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['ApellidosMadre']?></td>
                <td><?php echo capitalizar($al['ApellidosMadre'])?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['NombreMadre']?></td>
                <td><?php echo capitalizar($al['NombreMadre'])?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['CiMadre']?></td>
                <td><?php echo capitalizar($al['CiMadre'])?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['OcupacionMadre']?></td>
                <td><?php echo capitalizar($al['OcupMadre'])?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['CelularMadre']?></td>
                <td><?php echo capitalizar($al['CelularM'])?></td>
            </tr>
            <tr>
                <td><?php echo $idioma['Email']?></td>
                <td><?php echo capitalizar($al['Email'])?></td>
            </tr>
            <tr>
            	<td class="resaltar" colspan="2"><hr /></td>
            </tr>
            <tr><td class="resaltar" colspan="2"><?php echo $idioma['DatosFactura']?></td></tr>
            <tr>
            	<td><?php echo $idioma['Nit']?></td>
                <td><?php echo capitalizar($al['Nit'])?></td>
			</tr>
            <tr>
            	<td><?php echo $idioma['NombreFacturar']?></td>
                <td><?php echo capitalizar($al['FacturaA'])?></td>
			</tr>
            <tr>
            	<td class="resaltar" colspan="2"><hr /></td>
            </tr>
            <tr><td class="resaltar" colspan="2"><?php echo $idioma['Documentos']?></td></tr>
            <tr>
            	<td><?php echo $idioma['CertificadoNacimiento']?></td>
                <td><?php echo capitalizar($doc['CertificadoNac']?$idioma['Si']:$idioma['No'])?></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['LibretaEscolar']?></td>
                <td><?php echo capitalizar($doc['LibretaEsc']?$idioma['Si']:$idioma['No'])?></td>
            </tr>
            <tr>
             	<td><?php echo $idioma['LibretaVacunas']?></td>
                <td><?php echo capitalizar($doc['LibretaVac']?$idioma['Si']:$idioma['No'])?></td>
            </tr>
            <tr>
             	<td><?php echo $idioma['CiAlumno']?></td>
                <td><?php echo capitalizar($doc['CedulaId']?$idioma['Si']:$idioma['No'])?></td>
            </tr>
			<tr>
            	<td><?php echo $idioma['CiPadre']?></td>
                <td><?php echo capitalizar($doc['CedulaIdP']?$idioma['Si']:$idioma['No'])?></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['CiMadre']?></td>
                <td><?php echo capitalizar($doc['CedulaIdM']?$idioma['Si']:$idioma['No'])?></td>
            </tr>
            <tr>
            	<td><?php echo $idioma['ObservacionesDocumentos']?></td>
                <td><?php echo capitalizar($doc['Observaciones'])?></td>
            </tr>
        </table>
    </div>
    <?php
}
?>