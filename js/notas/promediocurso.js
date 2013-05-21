function lanzadorC(CodCurso){
}
function respuesta1(data){
	$("#configuracion").html(data)
	buscadorLista($("input[name=tPeriodo]"),$("select[name=Periodo]"));
	buscadorLista($("input[name=tOrden]"),$("select[name=Orden]"));
	$("#revisar").click(function(e) {
		var Periodo=$("select[name=Periodo]").val();
		var Orden=$("select[name=Orden]").val();
        $.post("documento.php",{'CodCurso':CodCurso,'Periodo':Periodo,'Orden':Orden,"lock":"dce7c4174ce9323904a934a486c41288"},respuesta2);
    });
	function respuesta2(data){
		$("#respuesta").html(data);
	}
}