$(document).on("ready",function(){
	$(".calendario").datepicker({altField: "#FechaActividad",dateFormat: 'dd-mm-yy',numberOfMonths: 2,showButtonPanel: true});	
	if(!DispositivoMovil){
		$("#ParaQuien").data("placeholder","Seleccione...").chosen({width: "100%",});
	}

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
	/*$("#ParaQuien>option").toggle(function(e) {
        $(this,":selected").attr("selected","selected").css("backgroundColor","red");
    },function(e) {
        $(this,":selected").attr("selected","").css("backgroundColor","");
    });*/
	$(document).on("click","#modificar",function(e){
		e.preventDefault();
		id=$(this).attr("rel");
		$.post("sacardatos.php",{"CodAgendaActividades":id},function(data){
				$("form.formulario").attr("action","actualizaractividad.php");
				$("#CodAgendaActividades").val(id);
				$("#FechaActividad").val(data.FechaActividad);
				$("#HoraInicio").val(data.HoraInicio)//.attr("min",data.HoraInicio);
				$("#HoraFin").val(data.HoraFin).attr("min",'00:00');
				$("#Estado").val(data.Estado);
				$("#Prioridad").val(data.Prioridad);
				$("#Detalle").val(data.Detalle);
				$("#ParaQuien").val('');
				usuarios=(data.Usuarios).split(",");
				for(i=0;i<(usuarios.length);i++){
					$("#ParaQuien>option[value="+usuarios[i]+"]").attr("selected","selected");
				}
				if(!DispositivoMovil){
					$("#ParaQuien").trigger("liszt:updated")
				}
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
function vaciar(){
	//alert("asd");
	//$(".formulario").reset();
	
	$("#Detalle").val('');
	$("#HoraInicio").val($("#HoraInicio").val())//.attr("min",data.HoraInicio);
	$("#HoraFin").val($("#HoraFin").val());
	$("#Prioridad").val(0);
	$("#ParaQuien").val('0');
	if(!DispositivoMovil){
		$("#ParaQuien").trigger("liszt:updated")
	}
	//window.location.href="./#mostraractividades";
	//$("#vaciarFormulario").click();	
}