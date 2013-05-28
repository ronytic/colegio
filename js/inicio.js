$(document).on("ready",function(){
	$("#FechaActividad").datepicker({altField: "#FechaActividad",dateFormat: 'dd-mm-yy',numberOfMonths: 2,showButtonPanel: true}).change(function(){
		mostrarActividades();		
	});	
	$("#FechaCuotas").datepicker({altField: "#FechaCuotas",dateFormat: 'dd-mm-yy',numberOfMonths: 1,showButtonPanel: true, maxDate:"0 D"}).change(function(){
		mostrarCuotas();		
	});	
	$("#FechaAgenda").datepicker({altField: "#FechaCuotas",dateFormat: 'dd-mm-yy',numberOfMonths: 1,showButtonPanel: true, maxDate:"0 D"}).change(function(){
		mostrarAgenda();		
	});
	mostrarActividades();
	mostrarCuotas();
	mostrarAgenda();
	$(document).on("click","#actualizarcuotas",function(e){
		e.preventDefault();
		mostrarCuotas();
	}).on("click","#actualizaractividades",function(e){
		e.preventDefault();
		mostrarActividades();
	}).on("click","#actualizaragenda",function(e){
		e.preventDefault();
		mostrarAgenda();
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
function mostrarAgenda(){
	var Fecha=$("#FechaAgenda").val();
	$.post("agenda/inicio/mostraragenda.php",{"Fecha":Fecha,'Botones':"0"},function(data){
		$("#listadoagenda").html(data).stickyTableHeaders()
		$(window).trigger('resize.stickyTableHeaders');
		$("table").stickyTableHeaders()
	});
}