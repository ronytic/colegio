$(document).on("ready",function(){
	$(".calendario").datepicker({altField: "#FechaActividad",dateFormat: 'dd-mm-yy',numberOfMonths: 2,showButtonPanel: true});	
	$(document).on("change","#HoraInicio",function(){
		var valor=$(this).val();
		$("#HoraFin").val(valor).attr("min",valor);
	});
	$(".calendario").on("click","table.ui-datepicker-calendar",function() {
        mostrarActividades();
    });
	mostrarActividades();
	$(document).on("click","#eliminar",function(e){
		e.preventDefault();
		id=$(this).attr("rel");
		if(confirm(mensajeg['EliminarRegistro'])){
			$.post("eliminar.php",{"CodAgendaActividades":id},function(data){
				mostrarActividades();
			});	
		}
	});
	$(document).on("click","#modificar",function(e){
		e.preventDefault();
		id=$(this).attr("rel");
		$.post("sacardatos.php",{"CodAgendaActividades":id},function(data){
				$("form.formulario").attr("action","actualizaractividad.php");
				$("#CodAgendaActividades").val(id);
				$("#FechaActividad").val(data.FechaActividad);
				$("#HoraInicio").val(data.HoraInicio)//.attr("min",data.HoraInicio);
				$("#HoraFin").val(data.HoraFin)//.attr("min",data.HoraFin);
				$("#Estado").val(data.Estado);
				$("#Prioridad").val(data.Prioridad);
				$("#Detalle").val(data.Detalle);
				$("#Guardar").val(data.Boton);
				$('html, body').animate({scrollTop:$("form.formulario").position().top-200},300);
			},"json");
	});
});
function mostrarActividades(){
	var Fecha=$("#FechaActividad").val();
	$.post("mostraractividades.php",{"Fecha":Fecha},function(data){
		$("#listadoactividades").html(data)
	});
}