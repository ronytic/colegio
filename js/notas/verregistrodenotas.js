var CodCurso;
var CodMateria;
var Periodo;
$(document).on("ready",function(){
	buscadorLista($("#tCurso"),$("select[name=Curso]"));
	buscadorLista($("#tMateria"),$("select[name=Materia]"));
	buscadorLista($("#tPeriodo"),$("select[name=Periodo]"));
	CodCurso=$("select[name=Curso]").val();
	CodMateria=$("select[name=Materia]").val();
	CodPeriodo=$("select[name=Periodo]").val();
	$.post("listaalumno.php",{'CodCurso':CodCurso,'CodMateria':CodMateria,'Periodo':CodPeriodo},alumnos);
//	alert(CodCurso);
//	alert(CodMateria);
	$().datepicker();
	$('select[name=Curso]').change(function(e){
		CodCurso=$(this).val();
		$.post("listaalumno.php",{'CodCurso':CodCurso,'CodMateria':CodMateria,'Periodo':CodPeriodo},alumnos);
	});
	$('select[name=Materia]').change(function(e){
		CodMateria=$(this).val();
		$.post("listaalumno.php",{'CodCurso':CodCurso,'CodMateria':CodMateria,'Periodo':CodPeriodo},alumnos);
	});
	$('select[name=Periodo]').change(function(e){
		CodPeriodo=$(this).val();
		$.post("listaalumno.php",{'CodCurso':CodCurso,'CodMateria':CodMateria,'Periodo':CodPeriodo},alumnos);
	});
});
function alumnos(data){
	$("#alumnos").html(data)
	
}