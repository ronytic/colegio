$(document).on("ready",function(){
	$("input[name=Fecha]").datepicker({maxDate:"0 D",changeMonth: true,changeYear: true,dateFormat: 'dd-mm-yy'});
	$(".enviar").submit(function(e) {
        e.preventDefault();
		mostrar();
    });	
	//mostrar();
});
function mostrar(){
	var Tiempo=parseInt($("input[name=Tiempo]").val())*1000;
	var Nivel=$("select[name=Nivel]").val();
	var Fecha=$("input[name=Fecha]").val();
	$.post("mostrar.php",{'Tiempo':Tiempo,'Nivel':Nivel,'Fecha':Fecha},function(data){
		$("#respuesta").html(data);	
	});	
	//setTimeout("mostrar()",Tiempo);
}