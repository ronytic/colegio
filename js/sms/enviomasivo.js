function lanzadorC(CodCurso){
	$.post("veralumnos.php",{'CodCurso':CodCurso},function(data){
		$("#respuesta").html(data)
		
	});	
}
function respuesta1(data){
	$("#configuracion").html(data);
	
	
	
}
$(document).on("ready",function(){
	$(document).on("click",'#enviar',function(){
		if(confirm(SeguroDeseaEnviarSMSCurso)){
			enviar(1,1);	
		}
	});
	$(document).on("click",'.enviarindependiente',function(){
		var Posicion=$(this).data('posicion');
		if(confirm(SeguroDeseaEnviarSMS)){
			enviar(Posicion,0);	
		}
	});
	
});
function enviar(Posicion,Siguiente){
	EstadoMensaje=$(".EstadoMensaje[data-posicion='"+Posicion+"']");
	EstadoMensaje.html("Enviando...").removeClass("btn-success").removeClass("btn-danger").addClass("btn-warning");
	Mensaje=$('#Mensaje').val();
	NumeroCelular=$(".numeros[data-posicion='"+Posicion+"']");
	var NumeroSMS=NumeroCelular.val();
	var Posicion=NumeroCelular.data('posicion');
	var Total=NumeroCelular.data('total');
	$.post("enviar.php",{'NumeroSMS':NumeroSMS,'Posicion':Posicion,'Total':Total,'Mensaje':Mensaje},function(data){
		if(data.Estado=="Correcto"){
			EstadoMensaje=$(".EstadoMensaje[data-posicion='"+data.Posicion+"']");
			EstadoMensaje.html(data.Mensaje).removeClass("btn-danger").removeClass("btn-warning").addClass("btn-success");
			if(parseInt(data.Posicion)<=parseInt(data.Total)){
				if(Siguiente==1){
					enviar(Posicion+1,1);
				}
			}else{
					
			}
		}else{
			EstadoMensaje=$(".EstadoMensaje[data-posicion='"+data.Posicion+"']");
			EstadoMensaje.html(data.Mensaje).removeClass("btn-danger").removeClass("btn-warning").removeClass("btn-success").addClass("btn-danger");
			if(Siguiente==1){
				enviar(Posicion+1,1);
			}
		}
	},"json");

}