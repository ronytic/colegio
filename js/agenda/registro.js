$(document).ready(function(e) {
	buscadorLista($("input[name=sMateria]"),$("select[name=Materia]"));
	buscadorLista($("input[name=sObservaciones]"),$("select[name=Observaciones]"));
	
    $("#fechac").datepicker({altField: "#fecha", maxDate:"0 D",dateFormat: 'dd-mm-yy'});
	var materia=$('input[name=Materia]:first');
	var CodMateria=materia.val();
	materia.next().addClass("seleccionado");
	$('input[name=Materia]').change(function(){
			materia.next().removeClass("seleccionado");
			$(this).next().addClass("seleccionado");
			materia=$(this);
			CodMateria=$(this).val();
	});
	var observacion=$('input[name=Observaciones]:first');
	var CodObs=materia.val();
	observacion.next().addClass("seleccionado");
	$('input[name=Observaciones]').change(function(){
			observacion.next().removeClass("seleccionado");
			$(this).next().addClass("seleccionado");
			observacion=$(this);
			CodObs=$(this).val();
	});
	$("#registrar").click(function(e) {
		var Fecha=$("#fecha").val();
		var Detalle=$("textarea[name=detalle]").val();
		var Resaltar=$("input[name=importante]").attr("checked");
		Resaltar=Resaltar?1:0;
		$.post("registrarAgenda.php",{'CodCurso':CodCurso,'CodMateria':CodMateria,'CodObs':CodObs,'Fecha':Fecha,'Detalle':Detalle,'Resaltar':Resaltar},resultado);
    });
	$("#terminar").click(function(e) {
		window.location='./';
    });
	$(".completar").click(function(e) {
        var valor=$(this).html();
		$("textarea[name=detalle]").val(valor);
    });
	$.post("mostrarAgenda.php",mostrar);
});
function resultado(data){
	
	if(data=='OK'){
		$.post("mostrarAgenda.php",mostrar);
	}else{
		alert("Falló el Registro. error:"+data)	
	}
	
}
function mostrar(data){
	$("#respuesta").html(data);
	recarga();
}
function recarga(){
	//$(document).ready(function(e) {
    	$(".eliminar").click(function(e) {
    	    e.preventDefault();
			var Cod=$(this).attr("rel");
			if(confirm("¿Seguro que desea eliminar este registro?"))
				$.post("eliminaRegistro.php",{'CodAgenda':Cod},resultado);
	    });    
		$(".resaltar").change(function(e) {
			var CodAgenda=$(this).attr("rel");
			if($(this).attr('checked')){
            	$.post("revisado.php",{'CodAgenda':CodAgenda,'Valor':1},resultado);
			}else{
				$.post("revisado.php",{'CodAgenda':CodAgenda,'Valor':0},resultado);
			}
        });
    //});
}