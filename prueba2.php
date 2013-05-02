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
<!--<script language="javascript" src="js/core/plugins/jquery.chosen.min.js" type="text/javascript"></script>-->
<script language="javascript" src="a.js" type="text/javascript"></script>
<script language="javascript">
$(document).ready(function(e) {
    $("#listaalumno").ASD();
});
	
</script>
<link href="css/chosen.css" type="text/css" rel="stylesheet"/>
<style type="text/css">
	select{
		width:100%;	
	}
</style>
</head>
<body>
<select id="listaalumno">
<?php foreach($alumno->mostrarDatosAlumnos(1) as $al){?>
<option value="<?php echo $al['CodAlumno'];?>"><?php echo $al['Paterno'];?> <?php echo $al['Materno'];?> <?php echo $al['Nombres'];?></option>
<?php }?>
</select>
</body>
</html>
