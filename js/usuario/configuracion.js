$(document).on("ready",function(){
	$("#Usuario").alpha({'allow':''});
	//$("input").mousedown(function(e){$(this).select();}).mouseup(function(e){e.preventDefault();});
	
	$("#datos").submit(function(e) {
       
		var Pass=$("#Pass").val();
		var PassRepetir=$("#PassRepetir").val();
		if(Pass!=PassRepetir){
			alert(ContrasenaNoIgual);
			 e.preventDefault();	
		}else{
			//$(this).submit();	
		}
    });
});