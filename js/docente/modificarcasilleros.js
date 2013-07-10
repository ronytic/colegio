function lanzadorC(CodDocente){
	cargandoG("#contenido1");
	//cargandoG("#contenido2");
	mostrar();
}
var valorbimestre;
function respuestaInicial(data){
	
	$('#contenido2').html(data);
	
	var valorcurso=parseInt($("select[name=curso]").val());
	valorbimestre=parseInt($("select[name=curso]>option:selected").attr("data-bimestre"));
	if(valorbimestre==1){
			$("select[name=casillas]").val(4).attr("disabled","disabled");
		}else{
			$("select[name=casillas]").val($("select[name=casillas]").val()).removeAttr("disabled");
		}
	$('#formula').click(function(e) {
        var Casillas=$("select[name=casillas]").val();
		Texto='n1 n2 +';
		for(i=3;i<=Casillas;i++){
			Texto+=' n'+i+' +';
		}
		if(!valorbimestre){Texto+=' '+Casillas+' /';}
		$("textarea[name=formula]").val(Texto);
    });
	//cambiarDps();
	//$("select[name=curso]").change(cambiarDps);
	/*function cambiarDps(e) {
		var notaaprob=0;
		valorbimestre=parseInt($("select[name=curso]>option:selected").attr("data-bimestre"));
		var valordps=parseInt($("select[name=curso]>option:selected").attr("data-dps"));
		var notatope=parseInt($("select[name=curso]>option:selected").attr("data-tope"));
		var notaaprobacion=parseInt($("select[name=curso]>option:selected").attr("data-aprobacion"));
		var not=0;
		
		switch(valordps){
			case 1:{not=notatope;notaaprob=notaaprobacion;$("select[name=dps]").val("1")}break;
			case 0:{not=notatope;notaaprob=notaaprobacion;$("select[name=dps]").val("0")}break;
		}//alert(notatope);
		$("input[name=tope]").val(not)
		$("input[name=aprobacion]").val(notaaprob);
		if(valorbimestre==1){
			$("select[name=casillas]").val(4).attr("disabled","disabled");
		}else{
			$("select[name=casillas]").val($("select[name=casillas]").val()).removeAttr("disabled");
		}
		//$('#formula').click();
		var CodCurso=$("select[name=curso]").val();
		//$.post("materias.php",{'CodDocente':CodDocente,'CodCurso':CodCurso},function(data){$("select[name=materia]").html(data)});
    }*/
	//$('#formula').click(); 
	$("select[name=casillas]").change(function(e) {
		$('#formula').click();
		var Casillas=parseInt($("select[name=casillas]").val());
		$('.filanota').each(function(index, element) {
        	if($(element).attr("rel")>Casillas){
				$(element).addClass('oculto');
			}else{
				$(element).removeClass('oculto');
			}
		});
    });
	$(".guardar").click(function(e) {
		/*var Periodo=$("select[name=Periodo]").val();
		var CodMateria=$("select[name=materia]").val();
		var CodCurso=$("select[name=curso]").val();
		var SexoAlumno=$("select[name=alumno]").val();
		var Casillas=$("select[name=casillas]").val();
		var Formula=$("textarea[name=formula]").val();
		var Tope=$("input[name=tope]").val();
		var Dps=$("select[name=dps]").val();
		if(confirm(GuardarConfiguracionCasilleros+"\n"+NoSePodraModificar)){
			$.post('guardar.php',{'Periodo':Periodo,'CodDocente':CodDocente,'CodMateria':CodMateria,'CodCurso':CodCurso,'SexoAlumno':SexoAlumno,'Casillas':Casillas,'Formula':Formula,'Dps':Dps,'Tope':Tope},respuesta2);
		}
		//
		*/
    });
}
function respuesta2(data){
	$('#contenido2').html(data);
	
}
function mostrar(){
	$.post("mostrar.php",{'CodDocente':CodDocente,'Periodo':$("select[name=Periodo]").val()},respuestamostrar);
}
function respuestamostrar(data){
	$('#contenido1').html(data);
	$(document).on("click",".modificar",function(e){
		e.preventDefault();
		var Cod=$(this).attr('rel');
		$.post('formulario.php',{'Cod':Cod},respuestaInicial);
		cargandoG("#contenido2");
	});
}