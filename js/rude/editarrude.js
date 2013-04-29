file="registro.php";
fileP="../../";
function respuesta(data){
	$("#respuesta").html(data);
	$("#fechaNac").datepicker({changeMonth: true,changeYear: true,yearRange:"c-100:c+10"});
}