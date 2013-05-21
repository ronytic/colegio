function lanzadorC(CodDocente){
	
}
function respuestaInicial(data){
	$("#contenido1").html(data);
	$("#ver").click(function(e) {
    	location.href="docente.php?CodDocente="+CodDocente+"&lock=dce7c4174ce9323904a934a486c41288";
    });
}

