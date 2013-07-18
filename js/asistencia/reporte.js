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
	$(document).on('submit','form.formulario', function(e) {
		e.preventDefault(); // prevent native submit
		var percent=$("#respuestaformulario")
    	$(this).ajaxSubmit({
        	target: '#respuestaformulario',
			beforeSend: function() {
				//status.empty();
				var percentVal = '0%';
				//bar.width(percentVal)
				percent.html(percentVal+'<div class="progress"><div class="bar" style="width: '+percentVal+';"></div></div>');
			},
			uploadProgress: function(event, position, total, percentComplete) {
				var percentVal = percentComplete + '%';
				//bar.width(percentVal)
				percent.html(percentVal+'<div class="progress"><div class="bar" style="width: '+percentVal+';"></div></div>');
			},
			complete: function(xhr) {
				$("#reporte").click();
				$("#respuestaformulario").html(xhr.responseText);
			}
    	});
	});
	$(document).on("click",".enlace",function(e){
		e.preventDefault();
		var v=$(this).attr("href");
		$.get(v,function(data){
			$("#respuesta").html(data);	
		});
	});
});