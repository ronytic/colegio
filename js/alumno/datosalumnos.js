file="formulario.php";
function respuesta(data){
	$("#respuesta").html(data);
	$.post("reportedatos.php",{'CodAlumno':CodAlumno},function(data){$("#reporte").html(data)});
}
$(document).on("ready",function(){
	$(document).on("click","#reportedatos",function(){
		$.post("reportedatos.php",{'CodAlumno':CodAlumno},function(data){$("#reporte").html(data)});
	});
	$(document).on("click","#reporteimpresion",function(){
		$.post("reporteimpresion.php",{'CodAlumno':CodAlumno},function(data){$("#reporte").html(data)});	
	});	
});