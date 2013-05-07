$(document).on("ready",inicio);
function inicio(){
	var menu=$("ul.nav-stacked li.funo > a");
	menu.toggle(function(e) {
         $(this).parent().find('ul.oculto').slideDown("fast");
    },function(e) {
         $(this).parent().find('ul.oculto').slideUp("fast");
    });
	
	$("ul.nav-stacked li.funo.active > a").click();
	
	$(document).ajaxStop(function() {
	
    }).ajaxSuccess(function(event, XMLHttpRequest, ajaxOptions) {
        $("input[type=date]").datepicker({changeMonth: true,changeYear: true,yearRange:"c-100:c+10"});
		
		
		/*$('form.formulario').on('submit', function(e) {
			alert("asd");
			e.preventDefault(); // prevent native submit
			$(this).ajaxSubmit({
				target: '#resultadoformulario'
			})
		});*/
    });
	$(document).on('submit','form.formulario', function(e) {
		e.preventDefault(); // prevent native submit
    	$(this).ajaxSubmit({
        	target: '#respuestaformulario'
    	})
		$('html, body').animate({scrollTop:$("#respuestaformulario").position().top-200},300);
		 
	});
	
	$(document).on('click','.enlacepost',function(e){
		e.preventDefault();
		var dest=$(this).attr("href")!=""?$(this).attr("href"):$(this).attr("data-destino");
		var mensaje=$(this).attr("data-mensaje");
		var resp=$(this).attr("data-respuesta");
		var campos=$(this).attr("data-campos");
		if(mensaje!=""){
			if(confirm(mensaje)){
				$.post(dest,campos,function(data){$(resp).html(data)})
			}
		}else{
			$.post(dest,campos,function(data){$(resp).html(data)})
		}
	});
	$(document).on('click','#actualizarventana',function(){
		location.reload();	
	});
}
