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
	$('#notascualitativa').click(function(e) {
        e.preventDefault();
		mostrasNotasCualitativas();
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
function mostrasNotasCualitativas(){
	cargando()
	$.post("../cualitativadocente/listacasilleros.php",{'CodCurso':CodCurso,'CodMateria':CodMateria,'CodPeriodo':CodPeriodo},alumnosnotas);	
}
function cargando(){
	$("#alumnos").html('<img src="'+folder+'imagenes/cargador/cargador.gif"/>');	
}
function alumnosnotas(data){
	$("html,body").animate({scrollTop:$("#alumnos").position().top-40},750);
	$("#alumnos").html(data)
	$(".nota").numeric();
	//Para Mantener Seleccionado
	$(".nota").mousedown(function(e){$(this).select();}).mouseup(function(e){e.preventDefault();});
	
	$(".nota").change(enviarNota);
	
	$(".final").change(enviarNota)//.keyup(enviarNota);
	
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
	
	//Notas Cualitativa
	cortar();
	function cortar(){
		$(".mayusculas").each(function(index, element) {
           var maximo=parseInt($(this).attr("rel"));
		   var contenido=$(this).val();
		   $(this).val(contenido.substr(0,maximo));
			var longitud=parseInt($(this).val().length);
			var nombre=$(this).attr("name");
			var resto=maximo-longitud;
			$("#cantidad"+nombre).html(resto); 
        });
	}
	
	$(".mayusculas").on("keyup paste keypress",function(e) {
		var contenido=$(this).val();
        var longitud=parseInt($(this).val().length);
		var nombre=$(this).attr("name");
		var maximo=parseInt($(this).attr("rel"));
		var resto=maximo-longitud;
		if(resto<=0){
			$(this).attr("maxlength", maximo);
		}
		$(this).val(contenido.substr(0,maximo));
		$("#cantidad"+nombre).html(resto);
    });
	$("#guardarNotasCualitativa").click(function(e) {
        var CodNotasCualitativa=$("#CodNotasCualitativa").val();
		var rango1=$("#rango1").val();
		var rango2=$("#rango2").val();
		var rango3=$("#rango3").val();
		var rango4=$("#rango4").val();
		$.post("../cualitativadocente/guardarnota.php",{'CodNotasCualitativa':CodNotasCualitativa,Rango1:rango1,Rango2:rango2,Rango3:rango3,Rango4:rango4},function(data){alert(data);});
    });
	/*Fin de Notas Cualitativa */
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
	var Minimo=parseInt($('#t'+Col).attr("rel-min"));
	if(Nota<Minimo){
		alert(NotaExcedidaMinimo+": "+Minimo)	;
		$(this).focus().select();
	}else{
		if(Nota<=Tope){
			$.post('guardarnota.php',{'CodAlumno':CodAlumno,'NumeroNota':Col,'CodCasilleros':CodCasilleros,'Nota':Nota,'Rand':Math.random()},evaluarNota,"json");
		}else{
			alert(NotaExcedidaLimite+": "+Tope)	;
			$(this).focus().select();
		}
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