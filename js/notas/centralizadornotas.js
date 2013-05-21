function lanzadorC(CodCurso){
	//$.post('formulario.php',{'CodCurso':CodCurso},respuesta1);
};
function respuesta1(data){
	$("#configuracion").html(data);
	buscadorLista($("input[name=tPeriodo]"),$("select[name=Periodo]"));
	$("#generar").click(function(e) {
		var Periodo=$("select[name=Periodo]").val();
		$.post("generar.php",{'CodCurso':CodCurso,'Periodo':Periodo},generar)
    });
	
	function generar(data){
		$("#respuesta").html(data);
	}
}