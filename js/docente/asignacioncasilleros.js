function lanzadorC(CodDocente){
	cargandoG("#contenido1");
	cargandoG("#contenido2");
	$.post('formulario.php',{'CodDocente':CodDocente},respuestaInicial);
}
var valorbimestre;
function respuestaInicial(data){
	$('#contenido1').html(data);
	mostrar();
	$('#formula').click(function(e) {
        var Casillas=$("select[name=casillas]").val();
		Texto='n1 n2 +';
		for(i=3;i<=Casillas;i++){
			Texto+=' n'+i+' +';
		}
		if(!valorbimestre){Texto+=' '+Casillas+' /';}
		$("textarea[name=formula]").val(Texto);
    });
	cambiarCantidad();
	$("input[name=CodDocenteMateriaCurso]").change(cambiarCantidad);
	function cambiarCantidad(e) {
		valorbimestre=parseInt($(this).attr("data-bimestre"));
		if(valorbimestre==1){
			$("#FilaTipoNota").show();
			//$("#TipoNota").val("");
			$("select[name=casillas]").val(4).attr("disabled","disabled");
		}else{
			$("#FilaTipoNota").hide();
			$("#TipoNota").val("");
			$("select[name=casillas]").val($("select[name=casillas]").val()).removeAttr("disabled");
		}
		$('#formula').click();
    }
	$('#formula').click(); 
	$("select[name=casillas]").change(function(e) {
       $('#formula').click(); 
    });
	$(".guardar").click(function(e) {
		var TipoNota=$("#TipoNota").val();
		var Periodo=$("select[name=Periodo]").val();
		var Casillas=$("select[name=casillas]").val();
		var Formula=$("textarea[name=formula]").val();
		var CodDocenteMateriaCurso=$("input[name=CodDocenteMateriaCurso]:checked").val();
		if(confirm(GuardarConfiguracionCasilleros+"\n"+NoSePodraModificar)){
			$.post('guardar.php',{'TipoNota':TipoNota,'Periodo':Periodo,'CodDocenteMateriaCurso':CodDocenteMateriaCurso,'Casillas':Casillas,'Formula':Formula},respuesta2);
		}
    });
}
function respuesta2(data){
	$('#respuesta').html(data);
	$(document).on("click","#actualizarlistado",mostrar);
}
function mostrar(){
	$.post("mostrar.php",{'CodDocente':CodDocente,'Periodo':$("select[name=Periodo]").val()},respuestamostrar)
}
function respuestamostrar(data){
	$('#contenido2').html(data);	
}