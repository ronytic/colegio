$(document).ready(function(){
	$("#usuario").focus();
	$("#login").submit(function(event){
		if($("#usuario").val()=="")
		{
			$("#usuario").focus();
		}else if($("#pass").val()==""){
			$("#pass").focus();
		}else{
			//$.pos($(this).attr("action"),{"usuario":$("#usuario").val(),"pass":$("pass").val()});
		}
		//event.preventDefault();	
	});
	$(".ayuda").click(function(e){e.preventDefault();}).popover({title:AyudaTitulo+$('#noticerrar').html(),html : true,placement:'bottom',content:$('#AyudaCuerpo').html()})
	$(document).on("click",'#cerrarnoti',function(e){
		e.preventDefault();
		$(".ayuda").popover('hide');
	});
});