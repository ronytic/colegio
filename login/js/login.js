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
});