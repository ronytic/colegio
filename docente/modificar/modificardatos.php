<?php 
include_once '../../login/check.php';
include_once '../../class/docente.php';
if(isset($_POST)){
$folder="../../";
$CodDocente=$_POST['CodDocente'];
$docente=new docente;
$doc=array_shift($docente->mostrarRegistro($CodDocente));
$ima=$folder."imagenes/docentes/".$doc['Foto'];
if(!file_exists($ima)  || empty($doc['Foto'])){
	 $ima=$folder."imagenes/docentes/0.jpg";	
}
?>
<form action="actualizar.php" method="post" class="formulario" enctype="multipart/form-data">
	<input type="hidden" name="CodDocente" value="<?php echo $CodDocente?>">
    <div id="respuestaformulario"></div>
    <div class="box-header"><h2><?php echo $idioma['DatosPersonales']?></h2></div>
    <div class="box-content">
    
    <table class="table table-bordered table-hover">
    	<tr>
        	<td colspan="2">
            	<div class="thumbnail pull-right span3">
    				<img src="<?php echo $ima?>"/>
    			</div>
                <?php echo $idioma['Foto']?>:<br />
                <br /><small><?php echo $idioma['ImagenRecomendada']?> <br /><?php echo $idioma['TipoArchivo']?> "jpg" <br /><?php echo $idioma['TamanoArchivo']?> 200x200</small>
                <div class="custom-input-file">
                <input type="file" name="Foto" accept="image/*" class="span12">
                </div>
    		</td>
        </tr>
        <tr>
            <td><?php echo $idioma['Paterno']?></td>
            <td><?php campo("Paterno","text",$doc['Paterno'],"span12",1,$idioma['IngreseSu'].$idioma['Apellido'],1)?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Materno']?></td>
            <td><?php campo("Materno","text",$doc['Materno'],"span12",1,$idioma['IngreseSu'].$idioma['Apellido'])?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Nombre']?></td>
            <td><?php campo("Nombres","text",$doc['Nombres'],"span12",1,$idioma['IngreseSu'].$idioma['Nombre'])?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Sexo']?></td>
            <td><?php campo("Sexo","select",array(1=>$idioma['Masculino'],0=>$idioma['Femenino']),"span12",1,"",0,"",$doc['Sexo'])?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Ci']?></td>
            <td><?php campo("Ci","text",$doc['Ci'],"span12",1,$idioma['IngreseSu'].$idioma['Ci'],0,"")?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['FechaNacimiento']?></td>
            <td><?php campo("FechaNac","text",fecha2Str($doc['FechaNac']),"span12 fecha",1); ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Departamento']?></td>
            <td><?php campo("Departamento","text",$doc['Departamento'],"span12",0,$idioma['IngreseSu'].$idioma['Departamento']); ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Provincia']?></td>
            <td><?php campo("Provincia","text",$doc['Provincia'],"span12",0,$idioma['IngreseSu'].$idioma['Provincia']); ?></td>
        </tr>
        
        <tr>
            <td><?php echo $idioma['Direccion']?></td>
            <td><?php campo("Direccion","text",$doc['Direccion'],"span12",1,$idioma['IngreseSu'].$idioma['Direccion']); ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Telefono']?></td>
            <td><?php campo("Telefono","text",$doc['Telefono'],"span12",1,$idioma['IngreseSu'].$idioma['Telefono']);  ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Celular']?></td>
            <td><?php campo("Celular","text",$doc['Celular'],"span12",1,$idioma['IngreseSu'].$idioma['Celular']);  ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['EstadoCivil']?></td>
            <td><?php campo("EstadoCivil","text",$doc['EstadoCivil'],"span12",1,$idioma['IngreseSu'].$idioma['EstadoCivil']);  ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Email']?></td>
            <td><?php campo("Email","email",$doc['Email'],"span12",0,$idioma['IngreseSu'].$idioma['Email']);  ?></td>
        </tr>
        <tr class="resaltar">
            <td><?php echo $idioma['Contraseña']?></td>
            <td class="resaltar"><span id="pass"><?php echo $doc['Password'] ?></span> <a href="cambiarcontrasena.php" class="btn btn-danger btn-mini enlacepost" data-campos="CodDocente=<?php echo $CodDocente?>" data-respuesta="#pass" data-mensaje="<?php echo $idioma['SeguroCambiarContraseña']?>	"><?php echo $idioma['CambiarContraseña']?></a></td>
        </tr>
    </table>
    </div>
<div class="box box-header"><h2><?php echo $idioma['DatosFormacionProfesional']?></h2></div>
<div class="box-content">
	<table class="table table-bordered table-hover">
    	<tr>
            <td><?php echo $idioma['RDA']?></td>
            <td><?php campo("RDA","text",$doc['RDA'],"span12",0,$idioma['IngreseSu'].$idioma['RDA']); ?></td>
        </tr>
    	<tr>
            <td><?php echo $idioma['Departamento']?></td>
            <td><?php campo("DPDepartamento","text",$doc['DPDepartamento'],"span12",0,$idioma['IngreseSu'].$idioma['Departamento']); ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Universidad']?></td>
            <td><?php campo("DPUniversidad","text",$doc['DPUniversidad'],"span12",0,$idioma['IngreseSu'].$idioma['Universidad']); ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['AñoIngreso']?></td>
            <td><?php campo("DPAnoIngreso","text",$doc['DPAnoIngreso'],"span12",0,$idioma['IngreseSu'].$idioma['AñoIngreso']); ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['AñoEgreso']?></td>
            <td><?php campo("DPAnoEgreso","text",$doc['DPAnoEgreso'],"span12",0,$idioma['IngreseSu'].$idioma['AñoEgreso']); ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['AñoTitulacion']?></td>
            <td><?php campo("DPAnoTitulacion","text",$doc['DPAnoTitulacion'],"span12",1,$idioma['IngreseSu'].$idioma['AñoTitulacion']); ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Titulo']?></td>
            <td><?php campo("DPTitulo","text",$doc['DPTitulo'],"span12",1,$idioma['IngreseSu'].$idioma['Titulo']); ?></td>
        </tr>
    </table>
</div>
<div class="box box-header"><h2><?php echo $idioma['DatosTrabajo']?></h2></div>
<div class="box-content">
	<table class="table table-bordered table-hover">
    	<tr>
            <td><?php echo $idioma['Cargo']?></td>
            <td><?php campo("DTCargo","text",$doc['DTCargo'],"span12",1,$idioma['IngreseSu'].$idioma['Cargo']); ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['CargaHoraria']?></td>
            <td><?php campo("DTCargaHoraria","text",$doc['DTCargaHoraria'],"span12",1,$idioma['IngreseSu'].$idioma['CargaHoraria']); ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Antiguedad']?></td>
            <td><?php campo("DTAntiguedad","text",$doc['DTAntiguedad'],"span12",1,$idioma['IngreseSu'].$idioma['Antiguedad']); ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Categoria']?></td>
            <td><?php campo("DTCategoria","text",$doc['DTCategoria'],"span12",1,$idioma['IngreseSu'].$idioma['Categoria']); ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Observacion']?></td>
            <td><?php campo("Observacion","text",$doc['Observacion'],"span12",1,$idioma['IngreseSu'].$idioma['Observacion']); ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Docente']?> <?php echo $idioma['Activo']?></td>
            <td><?php campo("Activo","select",array("1"=>$idioma["Activo"],"0"=>$idioma["Desactivar"]),"span12",1,"",0,"",$doc['Activo']); ?></td>
        </tr>
    </table>
    <input type="submit" value="<?php echo $idioma['Guardar']?>" class="btn">
</div>
</form>

<?php }?>