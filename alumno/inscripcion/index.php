<?php
include_once("../../login/check.php");
$titulo="Inscripción Alumno Nuevo";
$folder="../../";
include_once("../../class/alumno.php");
include_once("../../class/curso.php");
include_once("../../class/config.php");
$al=new alumno;
$curso=new curso;
$conf=new config;
$ma=$al->estadoTabla();
$confgKinder=array_shift($conf->mostrarConfig("MontoKinder"));
$confgGeneral=array_shift($conf->mostrarConfig("MontoGeneral"));
?>
<?php include_once($folder."cabecerahtml.php");?>
<script language="javascript" type="text/javascript" src="../../js/alumno/inscripcion.js"></script>
<script language="javascript" type="text/javascript">
var MontoKinder=<?php echo $confgKinder['Valor']?>;
var MontoGeneral=<?php echo $confgGeneral['Valor']?>;
</script>
<?php include_once($folder."cabecera.php");?>

<form action="../guardarAlumno.php" method="post" onSubmit="if(this.Curso.value==0){alert('Selecciona el Curso');return false;}" class="form-horizontal">
<div class="box span6">
	<div class="box-header">
		<h2><i class="icon-user"></i><span class="break"></span>Datos del Alumno</h2>
	</div>
	<div class="box-content">
			<?php
            campos("Nombre","nombre1","","",1,"span12");
			campos("Nombre","nombre2","","",1,"input-medium");
			campos("Nombrse","nombrse","radio","",1,"");
			campos("Nombre","nombrse","radio","",1);
			campos("Nombre","nombre","checkbox","",1);
			campos("Nombre","nombre","checkbox","",1);
			campos("Nombre","nombre","file","",1,"span12");
			campos("Nombre","nombre","select",array("1"=>"num1"),1,"span6");
			?>
            <div class="controls">
  <input class="span5" type="text" placeholder=".span5">
</div>
<div class="controls controls-row"> 	
  <input class="span4" type="text" placeholder=".span4">
  <input class="span1" type="text" placeholder=".span1">
</div>
        	<div class="control-group">
            <label class="control-label" for="inputPassword">Password</label>
    <div class="controls">
    
      <label class="checkbox inline">
        <input type="checkbox">me asda 
      </label>
       </div>
       <div class="controls">
     <label class="checkbox inline">
        <input type="checkbox"> Remember me
      </label>
       </div>
       <div class="controls">
      <label class="checkbox">
        <input type="checkbox" required="required"> Remember me
      </label>
    </div>
    </div>
    <div class="control-group">
            <label class="control-label" for="inputPassword">Password</label>
    <div class="controls">
    
      <label class="checkbox inline">
        <input type="radio" name="n1"> Remember 
      </label>
      </div>
      <div class="controls">
     <label class="checkbox inline">
        <input type="radio" name="n1" required="required"> Remember me
      </label>
      </div>
      <div class="controls">
      <label class="checkbox inline">
        <input type="radio" name="n1" required="required"> Remember me
      </label>
    </div>
    </div>
    <?php campoMI("ROnald");?>
    <?php campoM("nina","nina","radio","",1);?>
    <?php campoM("layme","layme","radio","",1);?>
    <?php campoM("laymes","laymes","text","",1);?>
    <?php campoMF();?>
        	<table border="0">
            	<tr><td class="der">Matricula</td><td>::</td><td><input name="Matricula" type="text" id="matricula" value="<?php echo $ma['Auto_increment']?>" size="30" readonly/></td></tr>
                <tr><td class="der">Curso</td><td>::</td><td><select name="Curso" id="curso" autofocus required><option value="">Selecciona el Curso</option><?php foreach($curso->listar() as $cur){
														?><option value="<?php echo $cur['CodCurso']?>"><?php echo $cur['Nombre']?></option><?php	
													}?></select></td></tr>
                <tr><td class="der">Apellido Paterno</td><td>::</td><td><input name="Paterno" type="text" size="30" required/></td></tr>
                <tr><td class="der">Apellido Materno</td><td>::</td><td><input name="Materno" type="text" size="30" required/></td></tr>
                <tr><td class="der">Nombres</td><td>::</td><td><input name="Nombres" type="text" size="30" required /></td></tr>
                <tr><td class="der">Sexo</td><td>::</td><td><input type="radio" name="Sexo" id="h" value="1" required/><label for="h">Hombre</label> <input type="radio" name="Sexo" id="m" value="0" required /><label for="m">Mujer</label></td></tr>
                <tr><td class="der">Lugar de Nacimiento</td><td>::</td><td><input type="text" name="LugarNac" placeholder="La Paz" value="La Paz"></td></tr>
                <tr><td class="der">Fecha de Nacimiento</td><td>::</td><td><input type="text" name="FechaNac" id="FechaNac" size="10" required autocomplete="off"/> (Ej:23-07-1990)</td></tr>
                <tr><td class="der">Cedula de Identidad</td><td>::</td><td><input name="Ci" type="text" id="Ci" required/><select name="CiExt"><option value="LP">LP</option><option value="CH">CH</option><option value="SC">SC</option><option value="PA">PA</option><option value="BN">BN</option><option value="OR">OR</option><option value="PT">PT</option><option value="CQ">CQ</option><option value="TR">TR</option></select></td></tr>
                <tr><td class="der">Zona</td><td>::</td><td><input name="Zona" type="text"  id="Zona" size="30" class="oculto"/></td></tr>
                <tr><td class="der">Calle</td><td>::</td><td><input name="Calle" type="text"  id="Zona" size="30" class="oculto"/></td></tr>
                <tr><td class="der">Número</td><td>::</td><td><input name="Numero" type="text"  id="Zona" size="30" class="oculto"/></td></tr>
                <tr><td class="der">Teléfono Casa</td><td>::</td><td><input name="TelefonoCasa" type="text" id="FechaNac" size="30" class="oculto"/></td></tr>
                <tr><td class="der">Celular</td><td>::</td><td><input name="Celular" type="text" size="30" class="oculto"/></td></tr>
            </table>
	</div>
    <div class="box-content">
        	<table border="0">
            	<tr><td class="der">Procedencia</td><td>::</td><td><input type="text" name="Procedencia" size="30"/></td></tr>
                <tr><td class="der">Repitente</td><td>::</td><td><input type="radio" name="Repitente" value="0" id="rn" checked="checked" class="inline"/><label for="rn">No</label><input type="radio" name="Repitente" value="1" id="rs" class="inline"/><label for="rs">Si</label></td></tr>
                <tr><td class="der">Traspaso</td><td>::</td><td><input type="radio" name="Traspaso" value="0" id="tn" checked="checked"/><label for="tn">No</label><input type="radio" name="Traspaso" value="1" id="ts"/><label for="ts">Si</label></td></tr>
                <tr><td class="der">Becado</td><td>::</td><td><input type="radio" name="Becado" value="0" id="bn" checked="checked"/><label for="bn">No</label><input type="radio" name="Becado" value="1" id="bs"/><label for="bs">Si</label></td></tr>
                <tr><td class="der">Monto de Beca</td><td>::</td><td><input type="text" name="MontoBeca" id="MontoBeca" value="0" size="7" maxlength="7" />Bs - <input type="text" name="PorcentajeBeca" id="PorcentajeBeca" value="0" size="6" maxlength="6" />%</td></tr>
                <tr><td class="der">Monto a Pagar</td><td>::</td><td><input name="MontoPagar" id="MontoPagar" readonly type="text"/> Bs</td></tr>
                <tr><td class="der">Retirado</td><td>::</td><td><input type="radio" name="Retirado" value="0" id="n" checked="checked"/><label for="n">No</label><input type="radio" name="Retirado" value="1" id="s"/><label for="s">Si</label></td></tr>
                 <tr><td class="der">Fecha de Retiro</td><td>::</td><td><input type="text" name="FechaRetiro" id="FechaRetiro" size="10"/>(Ej:23-07-1990)</td></tr>
                 <tr><td class="der">Rude</td><td>::</td><td><input type="text" name="Rude" /></td></tr>
                 <!--<tr><td class="der">Foto</td><td>::</td><td><input type="file" name="Foto" disabled="disabled"/></td></tr>-->
                 <tr><td class="der">Observaciones</td><td>::</td><td><textarea name="Observaciones" cols="30" rows="5"></textarea></td></tr>
             </table>
 </div>
 </div>
 <div class="box span6">
 	<div class="box-header">
    	Datos del Padre de Familia
    </div>
    <div class="box-content">
        <div class="cuerpo oculto">
        	<table border="0">
            	<tr><td class="der">Apellidos del Padre</td><td>::</td><td><input type="text" name="ApellidosPadre" size="50" value="" /></td></tr>
            	<tr><td class="der">Nombre del Padre</td><td>::</td><td><input type="text" name="NombrePadre" size="50" /></td></tr>
                <tr><td class="der">C.I. Padre</td><td>::</td><td><input type="text" name="CiPadre" id="CiPadre"  /><select name="CiExtP"><option value="LP">LP</option><option value="CH">CH</option><option value="SC">SC</option><option value="PA">PA</option><option value="BN">BN</option><option value="OR">OR</option><option value="PT">PT</option><option value="CQ">CQ</option><option value="TR">TR</option></select></td></tr>
                <tr><td class="der">Ocupación del Padre</td><td>::</td><td><input type="text" name="OcupPadre" size="30" /></td></tr>
                <tr><td class="der">Celular Padre</td><td>::</td><td><input type="text" name="CelularP" size="30" /></td></tr>
                <tr><td class="der">Apellidos de la Madre</td><td>::</td><td><input type="text" name="ApellidosMadre" size="50" value="" /></td></tr>
               	<tr><td class="der">Nombre de la Madre</td><td>::</td><td><input type="text" name="NombreMadre" size="50" /></td></tr>
                <tr><td class="der">C.I.Madre</td><td>::</td><td><input type="text" name="CiMadre" id="CiMadre" /><select name="CiExtM"><option value="LP">LP</option><option value="CH">CH</option><option value="SC">SC</option><option value="PA">PA</option><option value="BN">BN</option><option value="OR">OR</option><option value="PT">PT</option><option value="CQ">CQ</option><option value="TR">TR</option></select></td></tr>
                 <tr><td class="der">Ocupación de la Madre</td><td>::</td><td><input type="text" name="OcupMadre" size="30" /></td></tr>
                 <tr><td class="der">Celular Madre</td><td>::</td><td><input name="CelularM" type="text" id="CelularM" size="30"/></td></tr>
                 <tr><td class="der">Email</td><td>::</td><td><input type="text" name="Email" size="30"/></td></tr>
            </table>
       </div>
        	<table border="0">
            	<tr><td class="der">NIT</td><td>::</td><td><input name="Nit" type="text" id="Nit" size="30" required/></td></tr>
                <tr><td class="der">Nombre a Facturar</td><td>::</td><td><input name="FacturaA" type="text" size="30" required/></td></tr>
          		
            </table>
            <hr />
            <table border="0">
            	<tr><td class="der"><label for="cn">Certificado de Nacimiento</label></td><td>::</td><td><input type="checkbox" name="CertificadoNac" id="cn"/></td></tr>
                <tr><td class="der"><label for="le">Libreta Escolar</label></td><td>::</td><td><input type="checkbox" name="LibretaEsc" id="le"/></td></tr>
                 <tr><td class="der"><label for="lv">Libreta de Vacunas</label></td><td>::</td><td><input type="checkbox" name="LibretaVac" id="lv"/></td></tr>
                <tr><td class="der"><label for="CedulaId">C.I. del Alumno</label></td><td>::</td><td><input type="checkbox" name="CedulaId" id="CedulaId"/></td></tr>
                <tr><td class="der"><label for="CedulaIdP">C.I. del Padre</label></td><td>::</td><td><input type="checkbox" name="CedulaIdP" id="CedulaIdP"/></td></tr>
                <tr><td class="der"><label for="CedulaIdM">C.I. de la Madre</label></td><td>::</td><td><input type="checkbox" name="CedulaIdM" id="CedulaIdM"/></td></tr>
                <tr><td class="der">Observaciones Documentos</td><td>::</td><td><textarea name="ObservacionesDoc" rows="5" cols="30"><?php echo $alumno['Obs1']."\n"?><?php echo $alumno['Obs2']?></textarea></td></tr>
                <tr><td></td><td></td><td><input type="submit" value="Registrar Alumno" class="corner-all"/><input type="reset" class="corner-all" value="Vaciar"></td></tr>
            </table>
           </div> 
        </div>
    </form>

<?php include_once($folder."pie.php");?>
