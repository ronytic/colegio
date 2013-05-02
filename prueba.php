<?php
include_once("class/alumno.php");
$alumno=new alumno;
//print_r($alumno->mostrarDatosAlumnos(1));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>



<script language="javascript" src="js/jquery.js" type="text/javascript"></script>
<script language="javascript" src="js/jquery.listado.js" type="text/javascript"></script>
<script language="javascript">
$(document).ready(function(e) {
	buscadorLista($("#buscadoralumno"), $("#listaalumno"));
	$("#listaalumno").change(function(e) {
		//alert($(this).val());
	});
});
</script>
<style type="text/css">
.r-listado{
	background-color:#FFF;
	margin:0px;
	padding:0px;	
}
.r-listado li{
	background-color:#F2F2F2;
	margin:1px;
	font-size:1em;
	list-style:none;
}
.r-listado li a{
	padding:3px;
	cursor:pointer;
	display:block;
	text-decoration:none !important;
	color: #646464;
}
.r-listado li a.r-seleccionado,.r-listado li a:hover{
	background-color: #3875d7;
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3875d7', endColorstr='#2a62bc', GradientType=0 );  
  background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, color-stop(20%, #3875d7), color-stop(90%, #2a62bc));
  background-image: -webkit-linear-gradient(top, #3875d7 20%, #2a62bc 90%);
  background-image: -moz-linear-gradient(top, #3875d7 20%, #2a62bc 90%);
  background-image: -o-linear-gradient(top, #3875d7 20%, #2a62bc 90%);
  background-image: -ms-linear-gradient(top, #3875d7 20%, #2a62bc 90%);
  background-image: linear-gradient(top, #3875d7 20%, #2a62bc 90%);
  color: #fff;
}
.r-contenedor{
	height:auto;
	overflow:auto;	
	-webkit-box-shadow: 0 4px 5px rgba(0,0,0,.15);
	-moz-box-shadow   : 0 4px 5px rgba(0,0,0,.15);
	-o-box-shadow     : 0 4px 5px rgba(0,0,0,.15);
	box-shadow        : 0 4px 5px rgba(0,0,0,.15);
}
</style>
</head>
<body>
<input type="search" id="buscadoralumno"/>
<select id="listaalumno">
<?php foreach($alumno->mostrarDatosAlumnos(10) as $al){?>
<option value="<?php echo $al['CodAlumno'];?>" <?php echo $al['CodAlumno']=="203"?'selected="selected"':'';?>><?php echo ucwords($al['Paterno']);?> <?php echo ucwords($al['Materno']);?> <?php echo ucwords($al['Nombres']);?></option>
<?php }?>
</select>
</ul>
</body>
</html>
