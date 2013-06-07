var CodCurso;
var CodMateria;
var CodPeriodo;
$(document).ready(function(){
	buscadorLista($("#tcurso"),$("select[name=Curso]"));
	buscadorLista($("#tmateria"),$("select[name=Materia]"));
	buscadorLista($("#tperiodo"),$("select[name=Periodo]"));

	CodCurso=$("select[name=Curso]").val();
	CodMateria=$("select[name=Materia]").val();
	CodPeriodo=$("select[name=Periodo]").val();
	
	mostrarAlumnosNotas()
	$('select[name=Curso]').change(function(e){
		CodCurso=$(this).val();
		mostrarAlumnosNotas()
	});
	$('select[name=Materia]').change(function(e){
		CodMateria=$(this).val();
		mostrarAlumnosNotas()
	});
	$('select[name=Periodo]').change(function(e){
		CodPeriodo=$(this).val();
		mostrarAlumnosNotas()
	});
	
	$('#registronotas').click(function(e) {
        e.preventDefault();
		mostrarAlumnosNotas();
    });
	$('#registroimprimir').click(function(e) {
        e.preventDefault();
		mostrarAlumnosImprimir();
    });
	$('#cambiarnombres').click(function(e) {
        e.preventDefault();
		mostrarCambioNombres();
    });
	
});
function mostrarAlumnosNotas(){
	cargando()
	$.post("listaalumno.php",{'CodCurso':CodCurso,'CodMateria':CodMateria,'CodPeriodo':CodPeriodo},alumnosnotas);	
}
function mostrarAlumnosImprimir(){
	cargando()
	$.post("../reportedocente/listaalumno.php",{'CodCurso':CodCurso,'CodMateria':CodMateria,'CodPeriodo':CodPeriodo},alumnosnotas);	
}
function mostrarCambioNombres(){
	cargando()
	$.post("../cambiarnombre/listanombres.php",{'CodCurso':CodCurso,'CodMateria':CodMateria,'CodPeriodo':CodPeriodo},alumnosnotas);	
}
function cargando(){
	$("#alumnos").html('<img src="'+folder+'imagenes/cargador/cargador.gif"/>');	
}
function alumnosnotas(data){
	$("html,body").animate({scrollTop:$("#alumnos").position().top-40},750);
	$("#alumnos").html(data)
	//Para Mantener Seleccionado
	$(".nota").mousedown(function(e){$(this).select();}).mouseup(function(e){e.preventDefault();});
	
	$(".nota").change(enviarNota);
	
	$(".final").blur(enviarNota).keyup(enviarNota);
	
	$("#guardarNotas").click(function(e) {
		mostrarAlumnosNotas();
		alert(NotasGuardadoCorrectamente); 
	});
	
	//Para Cambiar Nombre a las 
	$("#guardarNombre").click(function(e) {
		mostrarCambioNombres()
       alert(NombresGuardadoCorrectamente); 
    });
	$(".nombre").change(function(e) {
        var valor=$(this).val();
		var nombre=$(this).attr("name");
		var CodCasilleros=$("input[name=CodCasilleros]").val();
		$.post("../cambiarnombre/guardarnombre.php",{'CodCasilleros':CodCasilleros,'Nombre':nombre,'Valor':valor})
    });
}
function enviarNota(e){
	
	var Nota=parseInt($(this).val());
	if(isNaN(Nota)){
		//$(this).val('0');
		Nota=0;
	}
	var CodAlumno=$(this).attr('data-row');
	var Col=$(this).attr('data-col');
	var CodCasilleros=$(this).attr('data-cod');
	var Tope=parseInt($('#t'+Col).attr("rel"));
	if(Nota<=Tope && Nota>=0){
		$.post('guardarnota.php',{'CodAlumno':CodAlumno,'NumeroNota':Col,'CodCasilleros':CodCasilleros,'Nota':Nota,'Rand':Math.random()},evaluarNota,"json");
	}else{
		alert(NotaExcedidaLimite+": "+Tope)	;
		$(this).focus().select();
	}
}
function evaluarNota(data){
	var NotaAprobacion=parseInt($("input[name=NotaAprobacion]").val());
	$('#resultado'+data.CodAlumno).val(data.Resultado);
	if(data.Dps!=0){$('#dps'+data.CodAlumno).val(data.Dps);}
	$('#notaf'+data.CodAlumno).val(data.NotaFinal);
	if(data.NotaFinal<NotaAprobacion){
		$('#notaf'+data.CodAlumno).addClass("crojo reprobado");
	}else{
		$('#notaf'+data.CodAlumno).removeClass("crojo reprobado");
	}
}