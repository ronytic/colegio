$(document).on("ready",function(){
	$("#registrarfalta").click(function(e) {
        if(confirm(Mensaje)){
			
		}else{
			e.preventDefault();
			e.stopPropagation();	
		}
    });
});