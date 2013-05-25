$(document).on("ready",function(){
	$("#FechaActividad").datepicker({altField: "#FechaActividad",dateFormat: 'dd-mm-yy',numberOfMonths: 2,showButtonPanel: true}).change(function(){
		mostrarActividades();		
	});	
	$("#FechaCuotas").datepicker({altField: "#FechaCuotas",dateFormat: 'dd-mm-yy',numberOfMonths: 1,showButtonPanel: true, maxDate:"0 D"}).change(function(){
		mostrarCuotas();		
	});	
	mostrarActividades();
	mostrarCuotas();
	
	$(document).on("click","#actualizarcuotas",function(e){
		e.preventDefault();
		mostrarCuotas();
	}).on("click","#actualizaractividades",function(e){
		e.preventDefault();
		mostrarActividades();
	});
});
function mostrarActividades(){
	var Fecha=$("#FechaActividad").val();
	$.post("agendaactividades/mostraractividades.php",{"Fecha":Fecha,'Botones':"0"},function(data){
		$("#listadoactividades").html(data)
	});
}
function mostrarCuotas(){
	var Fecha=$("#FechaCuotas").val();
	$.post("cuotas/inicio/mostrarcuotas.php",{"Fecha":Fecha,'Botones':"0"},function(data){
		$("#listadocuotas").html(data)
	});
}