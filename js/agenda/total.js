var file="#";
$(document).on("ready",inicia);
function inicia(){
	$('#respuesta').html('<img src="'+folder+'imagenes/cargador/cargador.gif"/>');
	$('#selectcurso').change(function(){
		$('#respuesta').html('<img src="'+folder+'imagenes/cargador/cargador.gif"/>');
		$.post("estadistica.php",{'CodCurso':CodCurso},respuesta);
	});
	$.post("estadistica.php",{'CodCurso':CodCurso},respuesta);
	$(document).on("click","#reportegeneral", function(e) {
        e.preventDefault();
		$('#respuesta').html('<img src="'+folder+'imagenes/cargador/cargador.gif"/>');
		$.post("estadistica.php",{'CodCurso':CodCurso},respuesta);
    });
	$(document).on("click","#reporteimprimir", function(e) {
        e.preventDefault();
		$('#respuesta1').html('<img src="'+folder+'imagenes/cargador/cargador.gif"/>');
		$.post("vergeneralimprimir.php",{'CodCurso':CodCurso},respuesta1);
		
    });
	
}
function respuesta1(data){
	$('#respuesta1').html(data);
}
function respuesta(data){
	$('#respuesta').html(data);
}

function lanzador(CodAlumno){
	location.href="agenda.php?CodAl="+CodAlumno;
}