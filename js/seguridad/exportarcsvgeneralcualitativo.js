function respuesta1(data){
	$("#configuracion").html(data);	
	$(document).on("click","#generar",function(){
		var cabeceralista=$("#cabeceralista").val();
		var separador=$("#separador").val();
		var separadorfila=$("#separadorfila").val();
		var numeracion=$("#numeracion").val();
		var separadormateria=$("#separadormateria").val();
		var separadorestadisticas=$("#separadorestadisticas").val();
		var estadisticas=$("#estadisticas").val();
		var reforzamiento=$("#reforzamiento").val();
		var separadorreforzamiento=$("#separadorreforzamiento").val();
		var trimestre=$("#trimestre").val();
		var formato=$("#formato").val();
		//alert(trimestre);
		 $.get("generar.php",{'Cabecera':cabeceralista,'CodCurso':CodCurso,'Separador':separador,"SeparadorFila":separadorfila,"Numeracion":numeracion,"Trimestre":trimestre,'SeparadorMateria':separadormateria,'Estadisticas':estadisticas,'SeparadorEstadisticas':separadorestadisticas,'Reforzamiento':reforzamiento,'SeparadorReforzamiento':separadorreforzamiento,"Formato":formato},function(data){
			 //var contenido="<a class ='btn btn-success' href='generar.php?"+'Cabecera='+cabeceralista+'&CodCurso='+CodCurso+'&Separador='+separador+"&SeparadorFila="+separadorfila+"&Numeracion="+numeracion+"&Trimestre="+trimestre+'&SeparadorMateria='+encodeURIComponent(separadormateria)+'&Estadisticas='+estadisticas+'&SeparadorEstadisticas='+encodeURIComponent(separadorestadisticas)+"&Formato="+formato+"' class='botonSec'>Descargar Archivo</a><hr>"+data;
			switch(formato){
				case "Tabla":{
				var contenido=data;}break;
			 	case "Csv":{
					var contenido="<a class ='btn btn-success' href='generar.php?"+'Cabecera='+cabeceralista+'&CodCurso='+CodCurso+'&Separador='+separador+"&SeparadorFila="+separadorfila+"&Numeracion="+numeracion+"&Trimestre="+trimestre+'&SeparadorMateria='+encodeURIComponent(separadormateria)+'&Estadisticas='+estadisticas+'&SeparadorEstadisticas='+encodeURIComponent(separadorestadisticas)+'&Reforzamiento='+reforzamiento+'&SeparadorReforzamiento='+encodeURIComponent(separadorreforzamiento)+"&Formato="+formato+"' class='botonSec'>Descargar Archivo</a><hr>"+data;
				}break;
			}
			$("#respuesta").html(contenido)	 
			//$(".foco").focus();
		});
	})
	$(document).on("focus",'input',function(e){
		$(this).select();
	}).on("mousedown",'input',function(e){
		$(this).select();
	}).on("mouseup",'input',function(e){
		e.preventDefault();	
	});
}
function lanzadorC(){
	//$.post("materias.php",{"CodCurso":CodCurso},function(data){
		//$("#materias").html(data);	
//	});
//	$("#generar").click(generar);
}
