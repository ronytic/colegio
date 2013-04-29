$(document).ready(function(e) {
	$("#DesdeFecha,#HastaFecha").datepicker({maxDate:"0 D",changeMonth: true,changeYear: true,dateFormat: 'dd-mm-yy'});
	$("select[name=Tipo]").change(function(e) {
		//alert($(this).val())
     	if($(this).val()=='Fecha'){
			$(".fecha").show(1000);
			$(".factura").hide();
		}else{
			$(".fecha").hide();
			$(".factura").show(1000);
		}
    });
    $("input#guardar").click(function(e) {
		var Tipo=$("select[name=Tipo]").val()
		if(Tipo=='Fecha'){
			var Desde=$("#DesdeFecha").val();
			var Hasta=$("#HastaFecha").val();
			$.post("resumen.php",{'Tipo':Tipo,'Desde':Desde,'Hasta':Hasta},resultado);
		}else{
			var Desde=$("#DesdeFactura").val();
			var Hasta=$("#HastaFactura").val();
			$.post("resumen.php",{'Tipo':Tipo,'Desde':Desde,'Hasta':Hasta},resultado);
		}
    });
	function resultado(data){
		$("#resultado").html(data);
		//$("body").niceScroll();
	}
});