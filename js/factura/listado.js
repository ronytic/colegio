$(document).on("ready",function(){
	$(".fecha").datepicker({dateFormat:'dd-mm-yy',maxDate:'0 d'});	
	$(document).on("change",".estado",function(e){
		e.preventDefault();
		if(confirm(SeguroCambiarEstado)){
			var Cod=$(this).attr("rel");
			var Valor=$(this).val();
			$.post("cambiarestado.php",{"Cod":Cod,"Valor":Valor},function(){
				
			});
		}else{
			$(".formulario").submit();
		}
	})
});