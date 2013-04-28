function lanzadorC(CodCurso){
	
}
function respuesta1(data){
	$("#configuracion").html(data)	
	$("#revisar").click(function(e) {
        var Cuota=$("select[name=Cuota]").val();
		var Orden=$("select[name=Orden]").val();
		$.post("resumen.php",{'CodCurso':CodCurso,'Cuota':Cuota,'Orden':Orden,'Rand':Math.random()},respuesta2);		
    });
}
function respuesta2(data){
	$("#respuesta").html(data);
}