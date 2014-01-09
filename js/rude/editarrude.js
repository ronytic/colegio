file="registro.php";
fileP="../../";
function respuesta(data){
	$("#respuesta").html(data);
	$("#fechaNac").datepicker({dateFormat:'dd-mm-yy',changeMonth: true,changeYear: true,yearRange:"c-100:c+10"});
}