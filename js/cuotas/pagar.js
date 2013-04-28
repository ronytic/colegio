var file="cuotas.php";
var fileP="../../";
function respuesta(data){
	$("#respuesta").html(data);
	$(".cuotas").change(function(e) {
        var id=$(this).attr('rel');
		var Fac=$('#f'+id).val();
		var Obs=$('#o'+id).val();
		var Fecha=$('#fe'+id).val();
		if($(this).attr('checked')){
			$('label[for="c'+id+'"]').html('Cancelado');
			$.post('guardarCuota.php',{'CodCuota':id,'Valor':1,'Factura':Fac,'Observaciones':Obs,'Fecha':Fecha,'Check':1},pagado,"json");
		}else{
			$('label[for="c'+id+'"]').html('Pendiente');
			$.post('guardarCuota.php',{'CodCuota':id,'Valor':0,'Factura':Fac,'Observaciones':Obs,'Fecha':Fecha,'Check':1},pagado,"json");
		}
    });
	
	$(".ku").keyup(function(e) {
        var id=$(this).attr('rel');
		var Obs=$('#o'+id).val();
		var Fac=$('#f'+id).val();
		var Fecha=$('#fe'+id).val();
		if($("#c"+id).attr('checked')){
			$.post('guardarCuota.php',{'CodCuota':id,'Valor':1,'Factura':Fac,'Observaciones':Obs,'Fecha':Fecha},pagado,"json");
		}else{
			$.post('guardarCuota.php',{'CodCuota':id,'Valor':0,'Factura':Fac,'Observaciones':Obs,'Fecha':Fecha},pagado,"json");
		}
    });
	$(".fechass").change (function(e) {
        var id=$(this).attr('rel');
		var Obs=$('#o'+id).val();
		var Fac=$('#f'+id).val();
		var Fecha=$('#fe'+id).val();
		if($("#c"+id).attr('checked')){
			$.post('guardarCuota.php',{'CodCuota':id,'Valor':1,'Factura':Fac,'Observaciones':Obs,'Fecha':Fecha},pagado,"json");
		}else{
			$.post('guardarCuota.php',{'CodCuota':id,'Valor':0,'Factura':Fac,'Observaciones':Obs,'Fecha':Fecha},pagado,"json");
		}
    });
	$(".fechass").datepicker({maxDate:"0 D",dateFormat: 'dd-mm-yy',changeMonth: true,changeYear: true});
	
}
function pagado(data){
	if(data.Valor==1){
		$("#tr"+data.CodCuota).addClass('success');
	}else{
		$("#tr"+data.CodCuota).removeClass('success');
	}
}