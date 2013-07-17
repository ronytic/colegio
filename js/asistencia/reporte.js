$(document).on("ready",function(){
	$("#FechaInicio,#FechaFin").datepicker({maxDate:"0 D",changeMonth: true,changeYear: true,dateFormat: 'dd-mm-yy'});
	$("select[name=CodCurso]").change(function(e) {
        var v=$(this).val();
		if(v!="Todo"){
			$.post("../../listar/alumnos.php",{'CodCurso':v},function(data){
				$("select[name=CodAlumno]").html('<option value="">'+seleccionar+"</option>"+data);
				$(".alumnos").slideDown("normal");
			});	
		}else{
			$(".alumnos").slideUp("normal");
		}
    });
	$(document).on("click",".enlace",function(e){
		e.preventDefault();
		var v=$(this).attr("href");
		$.get(v,function(data){
			$("#respuesta").html(data);	
		});
	});
});