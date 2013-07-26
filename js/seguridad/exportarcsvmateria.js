function respuesta1(data){
	$("#configuracion").html(data);	
	$(document).on("click","#generar",function(){
		var cabeceralista=$("#cabeceralista").val();
		var separador=$("#separador").val();
		var separadorfila=$("#separadorfila").val();
		var numeracion=$("#numeracion").val();
		var materias=$("#materias").val();
		var trimestre=$("#trimestre").val();
		 $.get("generar.php",{'Cabecera':cabeceralista,'CodCurso':CodCurso,'Separador':separador,"SeparadorFila":separadorfila,"Numeracion":numeracion,"Materias":materias,"Trimestre":trimestre},function(data){
			 var contenido="<a href='generar.php?"+'Cabecera='+cabeceralista+'&CodCurso='+CodCurso+'&Separador='+separador+"&SeparadorFila="+separadorfila+"&Numeracion="+numeracion+"&Materias="+materias+"&Trimestre="+trimestre+"' class='btn btn-success'>"+DescargarArchivo+"</a><hr>"+data;
			$("#respuesta").html(contenido)	 
		});
	})
	
}
function lanzadorC(){
	$.post("materias.php",{"CodCurso":CodCurso},function(data){
		$("#materias").html(data);	
	});
//	$("#generar").click(generar);
}
