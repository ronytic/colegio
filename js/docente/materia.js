function lanzadorC(CodDocente){
	mostrar();
}
function respuestaInicial(data){
	$("#contenido1").html(data);
	var CodModificar=0;
	var CodCurso=$("select[name=Curso]").val();
    $.post("materias.php",{'CodCurso':CodCurso},respuesta);    
	$("select[name=Curso]").change(function(e) {
		CodCurso=$(this).val();
    	$.post("materias.php",{'CodCurso':CodCurso},respuesta);    
    });
	$('#asignar').click(function(e) {
		CodCurso=$("select[name=Curso]").val();
    });
	$('#actualizar').click(function(e) {
        alert("Actualizar");
		$('#asignar').show(0);
		$("#actualizar").hide(0);
    });
	$(document).on("click",'.eliminar',function(e){
		e.preventDefault();
		if(confirm(MensajeEliminar)){
			var Cod=$(this).attr("rel");
			$.post("eliminar.php",{'Cod':Cod},function(){mostrar()})
		}
	});
	$(document).on("click",'.modificar',function(e){
		e.preventDefault();
		if(confirm(MensajeEliminar)){
			$('#asignar').hide(0);
			$("#actualizar").show(0);
			$("#cancelar").show(0);
			CodModificar=$(this).attr("rel");
			$("select[name=Curso]").val($(this).attr('data-curso'))
			//$.post("eliminar.php",{'Cod':Cod},function(){mostrar()})
		}
	});
}
function respuesta(data){
	$("select[name=Materia]").html(data);	
}
function mostrar(){
	$.post('mostrar.php',{'CodDocente':CodDocente},repuestamostrar);	
}
function repuestamostrar(data){
	$("#contenido2").html(data)
	
}