function lanzadorC(CodDocente){
	$.post('formulario.php',{'CodDocente':CodDocente},respuesta1);
}
function respuesta1(data){
	$('#contenido1').html(data);
	var valorcurso=parseInt($("select[name=curso]").val());
	$('#formula').click(function(e) {
        var Casillas=$("select[name=casillas]").val();
		Texto='n1 n2 +';
		for(i=3;i<=Casillas;i++){
			Texto+=' n'+i+' +';
		}
		Texto+=' '+Casillas+' /'
		$("textarea[name=formula]").val(Texto);
    });
	cambiarDps();
	$("select[name=curso]").change(cambiarDps);
	function cambiarDps(e) {
		

		var valordps=parseInt($("select[name=curso]>option:selected").attr("rel"));
		var notatope=parseInt($("select[name=curso]>option:selected").attr("data-tope"));
		var notaaprobacion=parseInt($("select[name=curso]>option:selected").attr("data-aprobacion"));
		var not=0;

		switch(valordps){
			case 1:{not=notatope;notaaprob=notaaprobacion;$("select[name=dps]").val("1")}break;
			case 0:{not=notatope;notaaprob=notaaprobacion;$("select[name=dps]").val("0")}break;
		}
		$("input[name=tope]").val(not)
		$("input[name=aprobacion]").val(notaaprob);
				var CodCurso=$("select[name=curso]").val();
				$.post("materias.php",{'CodDocente':CodDocente,'CodCurso':CodCurso},function(data){$("select[name=materia]").html(data)});
    }
	$('#formula').click(); 
	$("select[name=casillas]").change(function(e) {
       $('#formula').click(); 
    });
	$(".guardar").click(function(e) {
		
		var CodMateria=$("select[name=materia]").val();
		var CodCurso=$("select[name=curso]").val();
		var SexoAlumno=$("select[name=alumno]").val();
		var Casillas=$("select[name=casillas]").val();
		var Formula=$("textarea[name=formula]").val();
		var Tope=$("input[name=tope]").val();
		var Dps=$("select[name=dps]").val();
		if(confirm("¿Esta seguro de guardar esta configuración del Docente, Curso, Materia y el Tipo del Alumno?\n NO SE PODRA CAMBIAR ESTA CONFIGURACIÓN POSTERIORMENTE")){
			$.post('guardar.php',{'CodDocente':CodDocente,'CodMateria':CodMateria,'CodCurso':CodCurso,'SexoAlumno':SexoAlumno,'Casillas':Casillas,'Formula':Formula,'Dps':Dps,'Tope':Tope},respuesta2);
		}
		//
		
    });
}
function respuesta2(data){
	$('#contenido2').html(data);
}