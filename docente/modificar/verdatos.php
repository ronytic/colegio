<?php 
include_once '../../login/check.php';
include_once '../../class/docente.php';
if(isset($_POST)){
$folder="../../";
$CodDocente=$_POST['CodDocente'];
$docente=new docente;
$doc=array_shift($docente->mostrarRegistro($CodDocente));
$ima=$folder."imagenes/docentes/".$doc['Foto'];
if(!file_exists($ima) || empty($doc['Foto'])){
	 $ima=$folder."imagenes/docentes/0.jpg";	
}
?>
    <div class="box-header"><h2><?php echo $idioma['DatosPersonales']?></h2></div>
    <div class="box-content">
    
    <table class="table table-bordered table-hover">
    	<tr>
        	<td colspan="2">
            	<div class="thumbnail pull-right span3">
    				<img src="<?php echo $ima?>"/>
    			</div>
    		</td>
        </tr>
        <tr>
            <td><?php echo $idioma['Paterno']?></td>
            <td><?php echo $doc['Paterno'] ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Materno']?></td>
            <td><?php echo $doc['Materno'] ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Nombre']?></td>
            <td><?php echo $doc['Nombres'] ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Sexo']?></td>
            <td><?php echo $doc['Sexo']?$idioma['Masculino']:$idioma['Femenino']?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Ci']?></td>
            <td><?php echo $doc['Ci']?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['FechaNacimiento']?></td>
            <td><?php echo fecha2Str($doc['FechaNac']) ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Departamento']?></td>
            <td><?php echo $doc['Departamento'] ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Provincia']?></td>
            <td><?php echo $doc['Provincia'] ?></td>
        </tr>
        
        <tr>
            <td><?php echo $idioma['Direccion']?></td>
            <td><?php echo $doc['Direccion'] ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Telefono']?></td>
            <td><?php echo $doc['Telefono'] ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Celular']?></td>
            <td><?php echo $doc['Celular'] ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['EstadoCivil']?></td>
            <td><?php echo $doc['EstadoCivil'] ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Email']?></td>
            <td><?php echo $doc['Email'] ?></td>
        </tr>
        <tr class="resaltar">
            <td><?php echo $idioma['Usuario']?></td>
            <td class="resaltar"><?php echo $doc['Usuario'] ?></td>
        </tr>
        <tr class="resaltar">
            <td><?php echo $idioma['Contraseña']?></td>
            <td class="resaltar"><?php echo $doc['Password'] ?></td>
        </tr>
    </table>
    </div>
<div class="box box-header"><h2><?php echo $idioma['DatosFormacionProfesional']?></h2></div>
<div class="box-content">
	<table class="table table-bordered table-hover">
    	<tr>
            <td><?php echo $idioma['Departamento']?></td>
            <td><?php echo $doc['DPDepartamento'] ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Universidad']?></td>
            <td><?php echo $doc['DPUniversidad'] ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['AñoIngreso']?></td>
            <td><?php echo $doc['DPAnoIngreso'] ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['AñoEgreso']?></td>
            <td><?php echo $doc['DPAnoEgreso'] ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['AñoTitulacion']?></td>
            <td><?php echo $doc['DPAnoTitulacion'] ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Titulo']?></td>
            <td><?php echo $doc['DPTitulo'] ?></td>
        </tr>
    </table>
</div>
<div class="box box-header"><h2><?php echo $idioma['DatosTrabajo']?></h2></div>
<div class="box-content">
	<table class="table table-bordered table-hover">
    	<tr>
            <td><?php echo $idioma['Cargo']?></td>
            <td><?php echo $doc['DTCargo'] ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['CargaHoraria']?></td>
            <td><?php echo $doc['DTCargaHoraria'] ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Antiguedad']?></td>
            <td><?php echo $doc['DTAntiguedad'] ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Categoria']?></td>
            <td><?php echo $doc['DTCategoria'] ?></td>
        </tr>
        <tr>
            <td><?php echo $idioma['Observacion']?></td>
            <td><?php echo $doc['Observacion'] ?></td>
        </tr>
    </table>
</div>
<?php }?>