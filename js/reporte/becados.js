function lanzadorC(CodCurso){
	
}
function respuesta1(data){
	$("#configuracion").html(data);
	$("#reporte").click(function(e) {
		$.post("resumen.php",{'CodCurso':CodCurso,"Rand":Math.random()},respuesta2);
    });
}
function respuesta2(data){
	$("#respuesta").html(data);
}
