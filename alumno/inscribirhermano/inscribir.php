<?php
include_once("../../login/check.php");
if(isset($_GET)){
$CodAlumno=$_GET['CodAlumno'];
$titulo="NInscribirHermano";
$folder="../../";
include_once("../../class/alumno.php");
include_once("../../class/curso.php");
include_once("../../class/config.php");
include_once("../../class/documento.php");
$alumno=new alumno;
$curso=new curso;
$conf=new config;
$documento=new documento;
$ma=$alumno->estadoTabla();
$confgKinder=$conf->mostrarConfig("MontoKinder");
$confgGeneral=$conf->mostrarConfig("MontoGeneral");
$doc=$documento->mostrarDocumento($CodAlumno);
$doc=array_shift($doc);
$al=$alumno->mostrarTodoDatos($CodAlumno);
$al=array_shift($al);

$cursovalor=array();
foreach($curso->listar() as $cur){
	$cursovalor[$cur['CodCurso']]=$cur['Nombre'];
}
$sexovalor=array("1"=>$idioma['Masculino'],"0"=>$idioma['Femenino']);

$ciextvalor=array("LP"=>"LP","CH"=>"CH","SC"=>"SC","PA"=>"PA","BN"=>"BN","OR"=>"OR","PT"=>"PT","CQ"=>"CQ","TR"=>"TR");
$sinovalor=array(0=>$idioma["No"],1=>$idioma["Si"]);
?>
<?php include_once($folder."cabecerahtml.php");?>
<script language="javascript" type="text/javascript" src="../../js/alumno/inscripcion.js"></script>
<script language="javascript" type="text/javascript">
var MontoKinder=<?php echo $confgKinder['Valor']?>;
var MontoGeneral=<?php echo $confgGeneral['Valor']?>;
</script>
<?php include_once($folder."cabecera.php");?>
<form action="../guardaralumno.php" method="post" onSubmit="if(this.Curso.value==0){alert('Selecciona el Curso');return false;}" enctype="multipart/form-data">
<div class="box span6">
	<div class="box-header">
		<h2><i class="icon-user"></i><span class="break"></span><?php echo $idioma['DatosPersonales']?></h2>
	</div>
	<div class="box-content">
        <table border="0" class="tabla table-hover">
            <tr>
                <td class="der"><?php echo $idioma['Matricula']?></td>
                <td><?php campo("Matricula","text",$ma['Auto_increment'],"span12",1,"",0,array("readonly"=>"readonly"))?></td>
            </tr>
            <tr>
                <td class="der"><?php echo $idioma['Curso']?></td>
                <td><?php campo("Curso","select",$cursovalor,"span12",1)?></td>
            </tr>
            <tr>
                <td class="der"><?php echo $idioma['Paterno']?></td>
                <td><?php campo("Paterno","text",capitalizar($al["Paterno"]),"span12",1,"",0,array("maxlength"=>25))?></td>
            </tr>
            <tr>
                <td class="der"><?php echo $idioma['Materno']?></td>
                <td><?php campo("Materno","text",capitalizar($al["Materno"]),"span12",1,"",0,array("maxlength"=>25))?></td>
            </tr>
            <tr>
                <td class="der"><?php echo $idioma['Nombres']?></td>
                <td><?php campo("Nombres","text","","span12",1,"",0,array("maxlength"=>40))?></td>
            </tr>
            <tr>
                <td class="der"><?php echo $idioma['Sexo']?></td>
                <td><?php campo("Sexo","select",$sexovalor,"span8",1,"",0)?></td></tr>
            <tr class="ocultar">
                <td class="der"><?php echo $idioma['LugarNacimiento']?></td>
                <td><?php campo("LugarNac","text","La Paz","span12",1,"La Paz",0,array("maxlength"=>30))?></td>
            </tr>
            <tr>
                <td class="der"><?php echo $idioma['FechaNacimiento']?></td>
                <td><?php campo("FechaNac","text","","span6",1,"",0,array("maxlength"=>10))?> (Ej:23-07-1990)</td>
            </tr>
            <tr class="ocultar">
                <td class="der"><?php echo $idioma['CedulaIdentidad']?></td>
                <td><?php campo("Ci","text","","span6",0,"",0,array("maxlength"=>12))?></td>
            </tr>
            <tr class="ocultar">
                <td class="der"><?php echo $idioma['Zona']?></td>
                <td><?php campo("Zona","text",capitalizar($al["Zona"]),"span12",0,"",0,array("maxlength"=>30))?></td>
            </tr>
            <tr class="ocultar">
                <td class="der"><?php echo $idioma['Calle']?></td>
                <td><?php campo("Calle","text",capitalizar($al["Calle"]),"span12",0,"",0,array("maxlength"=>30))?></td>
            </tr>
            <tr class="ocultar">
                <td class="der"><?php echo $idioma['Numero']?></td>
                <td><?php campo("Numero","text",capitalizar($al["Numero"]),"span12",0,"",0,array("maxlength"=>30))?></td></tr>
            <tr class="ocultar">
                <td class="der"><?php echo $idioma['TelefonoCasa']?></td>
                <td><?php campo("TelefonoCasa","text",capitalizar($al["TelefonoCasa"]),"span12",0,"",0,array("maxlength"=>30))?></td>
            </tr>
            <tr class="ocultar">
                <td class="der"><?php echo $idioma['Celular']?></td>
                <td><?php campo("Celular","text","","span12",0,"",0,array("maxlength"=>30))?></td>
            </tr>
            <tr class="">
                <td class="der"><?php echo $idioma['CelularSMS']?></td>
                <td><?php campo("CelularSMS","text",capitalizar($al["CelularSMS"]),"span12",0,"",0,array("maxlength"=>30))?></td>
            </tr>
            <tr class="">
                <td class="der"><?php echo $idioma['ActivarEnvioSms']?></td>
                <td><?php campo("ActivarSMS","select",array("0"=>$idioma['No'],"1"=>$idioma['Si']),"span12",0,"",0,array("maxlength"=>30),1)?></td>
            </tr>
            <tr class="ocultar">
                <td class="der"><?php echo $idioma['Foto']?><br /><small><?php echo $idioma['ImagenRecomendada']?> <br /><?php echo $idioma['TipoArchivo']?> "jpg" <br /><?php echo $idioma['TamanoArchivo']?> 200x200</small></td>
                <td><?php campo("Foto","File","","span12",0,"",0,array("accept"=>"image/*"))?></td>
            </tr>
        </table>
	</div>
    <div class="box-header"><h2><?php echo $idioma['DatosAcademicos']?></h2></div>
    <div class="box-content">
        <table class="tabla table-hover">
            <tr>
                <td class="der"><?php echo $idioma['Procedencia']?></td>
                <td><?php campo("Procedencia","text","","span12",0,"",0,array("maxlength"=>30))?></td>
            </tr>
            <tr>
                <td class="der"><?php echo $idioma['Repitente']?></td>
                <td><?php campo("Repitente","select",$sinovalor,"span12",1,"",0,array("maxlength"=>30),0)?></td>
            </tr>
            <tr>
                <td class="der"><?php echo $idioma['Traspaso']?></td>
                <td><?php campo("Traspaso","select",$sinovalor,"span12",1,"",0,array("maxlength"=>30),0)?></td>
            </tr>
            <tr>
                <td class="der"><?php echo $idioma['Becado']?></td>
                <td><?php campo("Becado","select",$sinovalor,"span12",1,"",0,array("maxlength"=>30),0)?></td>
            </tr>
            <tr>
                <td class="der"><?php echo $idioma['MontoBeca']?></td>
                <td><?php campo("MontoBeca","text","0","span5",0,"",0,array("maxlength"=>7,"readonly"=>"readonly"))?>Bs - <?php campo("PorcentajeBeca","text","0","span5",0,"",0,array("maxlength"=>6))?>%</td>
            </tr>
            <tr>
                <td class="der"><?php echo $idioma['MontoPagar']?></td>
                <td><?php campo("MontoPagar","text","0","span5",0,"",0,array("maxlength"=>30,"readonly"=>"readonly"))?>Bs</td>
            </tr>
            <tr>
                <td class="der"><?php echo $idioma['Retirado']?></td>
                <td><?php campo("Retirado","select",$sinovalor,"span12",0,"",0,array("maxlength"=>30),0)?></td>
             </tr>
             <tr>
                <td class="der"><?php echo $idioma['FechaRetiro']?></td>
                <td><?php campo("FechaRetiro","text","","span12",0,"",0,array("maxlength"=>10))?>(Ej:23-07-1990)</td>
             </tr>
             <tr>
                <td class="der"><?php echo $idioma['Rude']?></td>
                <td><?php campo("Rude","text","","span12",0,"",0,array("maxlength"=>30))?></td>
             </tr>
             <tr>
                <td class="der"><?php echo $idioma['Observaciones']?></td>
                <td><?php campo("Observaciones","textarea","","span12",0,"",0,array("cols"=>30,"rows"=>5))?></td>
             </tr>
         </table>
	</div>
</div>
 <div class="box span6">
 	<div class="box-header ocultar">
    	<?php echo $idioma['DatosPadreFamilia']?>
    </div>
    <div class="box-content ocultar">
        <table class="tabla table-hover">
            <tr>
                <td class="der"><?php echo $idioma['ApellidosPadre']?></td>
                <td><?php campo("ApellidosPadre","text",capitalizar($al["ApellidosPadre"]),"span12",0,"",0,array("maxlength"=>50))?></td>
            </tr>
            <tr>
                <td class="der"><?php echo $idioma['NombrePadre']?></td>
                <td><?php campo("NombrePadre","text",capitalizar($al["NombrePadre"]),"span12",0,"",0,array("maxlength"=>50))?></td>
            </tr>
            <tr>
                <td class="der"><?php echo $idioma['CiPadre']?></td>
                <td><?php campo("CiPadre","text",capitalizar($al["CiPadre"]),"span12",0,"",0,array("maxlength"=>20))?></td>
            </tr>
            <tr>
                <td class="der"><?php echo $idioma['OcupacionPadre']?></td>
                <td><?php campo("OcupPadre","text",capitalizar($al["OcupPadre"]),"span12",0,"",0,array("maxlength"=>30))?></td>
            </tr>
            <tr>
                <td class="der"><?php echo $idioma['CelularPadre']?></td>
                <td><?php campo("CelularP","text",capitalizar($al["CelularP"]),"span12",0,"",0,array("maxlength"=>30))?></td>
            </tr>
            <tr>
            	<td colspan="2"><hr /></td>
            </tr>
            <tr>
                <td class="der"><?php echo $idioma['ApellidosMadre']?></td>
                <td><?php campo("ApellidosMadre","text",capitalizar($al["ApellidosMadre"]),"span12",0,"",0,array("maxlength"=>50))?></td>
            </tr>
            <tr>
                <td class="der"><?php echo $idioma['NombreMadre']?></td>
                <td><?php campo("NombreMadre","text",capitalizar($al["NombreMadre"]),"span12",0,"",0,array("maxlength"=>50))?></td>
            </tr>
            <tr>
                <td class="der"><?php echo $idioma['CiMadre']?></td>
                <td><?php campo("CiMadre","text",capitalizar($al["CiMadre"]),"span12",0,"",0,array("maxlength"=>20))?></td>
            </tr>
            <tr>
                <td class="der"><?php echo $idioma['OcupacionMadre']?></td>
                <td><?php campo("OcupMadre","text",capitalizar($al["OcupMadre"]),"span12",0,"",0,array("maxlength"=>30))?></td>
            </tr>
            <tr>
                <td class="der"><?php echo $idioma['CelularMadre']?></td>
                <td><?php campo("CelularM","text",capitalizar($al["CelularM"]),"span12",0,"",0,array("maxlength"=>30))?></td>
            </tr>
            <tr>
                <td class="der"><?php echo $idioma['Email']?></td>
                <td><?php campo("Email","email","","span12",0,"",0,array("maxlength"=>50))?></td>
            </tr>
        </table>
	</div>
    <div class="box-header"><h2><?php echo $idioma['DatosFactura']?></h2></div>
    <div class="box-content">
        <table class="tabla">
            <tr>
            	<td class="der"><?php echo $idioma['Nit']?></td>
                <td><?php campo("Nit","text",capitalizar($al["Nit"]),"span12",1,"",0,array("maxlength"=>30))?></td>
			</tr>
            <tr>
            	<td class="der"><?php echo $idioma['NombreFacturar']?></td>
                <td><?php campo("FacturaA","text",capitalizar($al["FacturaA"]),"span12",1,"",0,array("maxlength"=>30))?></td>
			</tr>
        </table>
	</div>
    <div class="box-header"><h2><?php echo $idioma['Documentos']?></h2></div>
	<div class="box-content">
		<table class="tabla">
			<tr>
            	<td class="der"><label for="CertificadoNac"><?php echo $idioma['CertificadoNacimiento']?></label></td>
                <td><?php campo("CertificadoNac","checkbox","1","span12",0,"",0,array("maxlength"=>50),0)?></td>
            </tr>
            <tr>
            	<td class="der"><label for="LibretaEsc"><?php echo $idioma['LibretaEscolar']?></label></td>
                <td><?php campo("LibretaEsc","checkbox","1","span12",0,"",0,array("maxlength"=>50),0)?></td>
            </tr>
            <tr>
             	<td class="der"><label for="LibretaVac"><?php echo $idioma['LibretaVacunas']?></label></td>
                <td><?php campo("LibretaVac","checkbox","1","span12",0,"",0,array("maxlength"=>50),0)?></td>
            </tr>
            <tr>
             	<td class="der"><label for="CedulaId"><?php echo $idioma['CiAlumno']?></label></td>
                <td><?php campo("CedulaId","checkbox","1","span12",0,"",0,array("maxlength"=>50),0)?></td>
            </tr>
			<tr>
            	<td class="der"><label for="CedulaIdP"><?php echo $idioma['CiPadre']?></label></td>
                <td><?php campo("CedulaIdP","checkbox","1","span12",0,"",0,array("maxlength"=>50),$doc['CedulaIdP'])?></td>
            </tr>
            <tr>
            	<td class="der"><label for="CedulaIdM"><?php echo $idioma['CiMadre']?></label></td>
                <td><?php campo("CedulaIdM","checkbox","1","span12",0,"",0,array("maxlength"=>50),$doc['CedulaIdM'])?></td>
            </tr>
            <tr>
            	<td class="der"><?php echo $idioma['ObservacionesDocumentos']?></td>
                <td><?php campo("ObservacionesDoc","textarea","","span12",0,"",0,array("cols"=>30,"rows"=>5),0)?></td>
            </tr>
        </table>
	</div> 
    <div class="box-content">
    	<input type="submit" value="<?php echo $idioma['RegistrarAlumno']?>" class="btn btn-success"/>
        <input type="reset" class="btn" value="<?php echo $idioma['Vaciar']?>">
    </div>
</div>
</form>
<?php include_once($folder."pie.php");?>
<?php }?>