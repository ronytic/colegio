var CodAlumno
var CodCurso
var CodMateria
var Busqueda
$(document).ready(function(){
	$("#FechaInicio,#FechaFinal").datepicker({dateFormat: 'dd-mm-yy',numberOfMonths: 1,showButtonPanel: true, maxDate:"0 D"});
	//buscadorLista($("#tcurso"),$("select[name=Curso]"));
	//buscadorLista($("#tmateria"),$("select[name=Materia]"));
	//buscadorLista($("#tobservacion"),$("select[name=Observacion]"));
	CodCurso=$("select[name=Curso]").val();
	CodMateria=$("select[name=Materia]").val();
	$('select[name=Curso]').change(function(){
		CodCurso=$(this).val();
		$.post("listaalumno.php",{'CodCurso':CodCurso},alumnos);
		$.post("materias.php",{'CodCurso':CodCurso},materias);
		//mostrarAgenda();
	});
	$('select[name=Materia]').change(function(){
		//mostrarAgenda();
		CodMateria=$(this).val();
	});
	$('select[name=Alumnos]').change(function(){
		//mostrarAgenda();
		CodAlumno=$(this).val();
	});
	$("#Busqueda").change(function(e) {
		mostrarAgenda();
    });
	
	$("#registrar").click(function(e) {
		FechaInicio=$("#FechaInicio").val();
		FechaFinal=$("#FechaFinal").val();
		Curso=$("#Curso").val();
		Materia=$("#Materia").val();
		Alumnos=$("#Alumnos").val();
		Observacion=$("#Observacion").val();
		
		$.post("reporte.php",{'FechaInicio':FechaInicio,'FechaFinal':FechaFinal,'Curso':Curso,'Materia':Materia,'Alumnos':Alumnos,'Observacion':Observacion},function (data){
			$("#respuestareporte").html(data);

		});
		
    });
		
});
function alumnos(data){
	$("#Alumnos").html(data);
	//buscadorLista($("#talumnos"),$("select[name=Alumnos]"));
}function materias(data){
	$("#Materia").html(data);
	//buscadorLista($("#talumnos"),$("select[name=Alumnos]"));
}

function reporteAgenda(data){
	$("#Agenda").html(data)
}