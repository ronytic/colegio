<?php 
include_once '../../login/check.php';
include_once '../../class/docente.php';
$folder="../../";
$CodDocente=$_POST['CodDocente'];
$titulo="Editar Datos del docente";
$docente=new docente;
$doc=array_shift($docente->mostrar($CodDocente));
include_once '../../cabecerahtml.php';
 ?>
 <?php include_once '../../cabecera.php'; ?>
 <div class="container_12" id="cuerpo">
 	<div class="grid_6">
 		<div class="titulo corner-top">Datos del Docente</div>
 		<div class="cuerpo">
 			<table class="tabla">
 				<tr class="contenido">
 					<td>Paterno</td>
 					<td><?php echo $doc['Paterno'] ?></td>
 				</tr>
 				<tr class="contenido">
 					<td>Materno</td>
 					<td><?php echo $doc['Materno'] ?></td>
 				</tr>
 				<tr class="contenido">
 					<td>Nombre</td>
 					<td><?php echo $doc['Nombres'] ?></td>
 				</tr>
 			</table>
 		</div>
 		<div class="cuerpo">
 			<table class="tabla">
 				<tr class="contenido">
 					<td>Usuario:</td>
 					<td><?php echo $doc['Usuario'] ?></td>
 				</tr>
 				<tr class="contenido">
 					<td>Contraseña:</td>
 					<td><?php echo $doc['Password'] ?></td>
 				</tr>
 			</table>
 		</div>
 	</div>
 	<div class="clear"></div>
 </div>
 <?php include_once '../../footer.php'; ?>