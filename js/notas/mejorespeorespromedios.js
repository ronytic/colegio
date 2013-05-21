$(document).ready(function(e) {
	buscadorLista($("input[name=tPeriodo]"),$("select[name=Periodo]"));
	buscadorLista($("input[name=tOrden]"),$("select[name=Orden]"));
	$("#revisar").click(function(e) {
        var Cantidad=$("input[name=Cantidad]").val();
		var Periodo=$("select[name=Periodo]").val();
		var Orden=$("select[name=Orden]").val();
		$.post("documento.php",{'Cantidad':Cantidad,'Periodo':Periodo,'Orden':Orden},respuesta);
		function respuesta(data){
			$("#contenido").html(data);
		}
    });
	
});