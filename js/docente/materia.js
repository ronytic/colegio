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
		var CodMateria=$("select[name=Materia]").val();
		var Alumnos=$("select[name=Alumnos]").val();
		if(!CodMateria){alert(SeleccioneMateria+", "+Porfavor);return false;}
		if(confirm(SeguroAsignar)){
			$.post("guardar.php",{'CodDocente':CodDocente,'CodMateria':CodMateria,'CodCurso':CodCurso,'SexoAlumno':Alumnos},function(data){
				if(data!=""){
					alert(data);
				}
			});
			mostrar();
		}
    });
	$('#actualizar').click(function(e) {
		CodCurso=$("select[name=Curso]").val();
		var CodMateria=$("select[name=Materia]").val();
		var Alumnos=$("select[name=Alumnos]").val();
		if(!CodMateria){alert(SeleccioneMateria+", "+Porfavor);return false;}
		if(confirm(SeguroAsignarModificar)){
			$.post("actualizar.php",{'CodModificar':CodModificar,'CodDocente':CodDocente,'CodMateria':CodMateria,'CodCurso':CodCurso,'SexoAlumno':Alumnos},function(data){
				if(data!=""){
					alert(data);
				}
			});
			mostrar();
		}
		
        $('.guardarE').show(0);
		$(".actualizarE").hide(0);
    });
	$('#cancelar').click(function(e) {
        $('.guardarE').show(0);
		$(".actualizarE").hide(0);
    });
	$(document).on("click",'.eliminar',function(e){
		e.preventDefault();
		if(confirm(MensajeEliminar)){
			var Cod=$(this).attr("rel");
			$.post("eliminar.php",{'Cod':Cod},mostrar());
			mostrar();
		}
	});
	$(document).on("click",'.modificar',function(e){
		e.preventDefault();
		if(confirm(ModificarAsignacion)){
			$('.guardarE').hide(0);
			$(".actualizarE").show(0);
			CodModificar=$(this).attr("rel");
			$("select[name=Curso]").val($(this).attr('data-curso'))
			$("select[name=Alumnos]").val($(this).attr('data-alumnos'))
			var CodMateria=$(this).attr('data-materia');
			$.post("materias.php",{'CodCurso':$("select[name=Curso]").val()},function(data){
				$("select[name=Materia]").html(data);	
				$("select[name=Materia]").val(CodMateria)	
			});
			
			
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