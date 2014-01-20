function lanzadorC(){
}
function respuestaInicial(data){
	
	$("#contenido1").html(data)
	.on("click","#verdatos",function(){
		$.post("verdatos.php",{"CodDocente":CodDocente},function(data){$("#contenido2").html(data)});
	})
	.on("click","#modificardatos",function(){
		$.post("modificardatos.php",{"CodDocente":CodDocente},function(data){$("#contenido2").html(data);
		$(".fecha").datepicker({dateFormat:"dd-mm-yy"});
		});
	})
	.on("click","#reportedatos",function(){
		$.post("reportedatos.php",{"CodDocente":CodDocente},function(data){$("#contenido2").html(data)});
	})
	.on("click","#nuevodocente",function(){
		$.post("nuevo.php",{"CodDocente":CodDocente},function(data){$("#contenido2").html(data)
		$(".fecha").datepicker({dateFormat:"dd-mm-yy"});
		});
	});
}