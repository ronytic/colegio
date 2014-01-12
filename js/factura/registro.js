file="#";
function lanzador(CodAlumno){
	
}
$(document).ready(function(e) {
	var TipoBusqueda="";
	var Registro=0;
	$(".fecha").datepicker({altField: "#FechaActividad",dateFormat: 'dd-mm-yy'})
	$(document).on("click",".buscar",function(e) {
		TipoBusqueda=$(this).attr("rel");
		if(TipoBusqueda=="Registro"){
			Registro=$(this).attr("rel-id");
		}
        $('.modal').modal('show');
		
    }).on("change","select.MostrarCuota",function(){
		Reg=$(this).attr("rel");
		NumCuota=$("select.MostrarCuota[rel="+Reg+"]").val();
		CodigoAlumno=$("input.CodigoAlumno[rel="+Reg+"]").val();
		$.post("sacarmonto.php",{'CodAlumno':CodAlumno,"NumeroCuota":NumCuota},function(data){
			$("input[name='a["+Reg+"][MontoCuota]']").val(data.MontoPagar).change();
			$("input[name='a["+Reg+"][ImporteCobrado]']").val(data.MontoPagar).change();
			$("input[name='a["+Reg+"][Total]']").val(data.MontoPagar).change();
			$("input[name='a["+Reg+"][CodCuota]']").val(data.CodCuota);
		},"json");
	});
	$('.modal').on('hidden', function () {
  		$("html,body").css("overflow","auto")
	}).on('shown', function () {
  		//$("html,body").css("overflow","hidden")
	})
	$(document).on("change",".ImporteCobrado,.Interes,.Descuento",function(e){
		Reg=$(this).attr("rel");
		Importe=parseFloat($(".ImporteCobrado[rel="+Reg+"]").val());
		Interes=parseFloat($(".Interes[rel="+Reg+"]").val());
		Descuento=parseFloat($(".Descuento[rel="+Reg+"]").val());	
		var TotalT=Importe+Interes-Descuento;
		$(".Total[rel="+Reg+"]").val(TotalT).change();
	});
	
	$(document).on("change",".NFactura",function(e){
		$.post("verificarnumerofactura.php",{'NFactura':$("input[name=NFactura]").val()},function(data){
			if(data.Estado=="Si"){
				$("#Guardar").removeAttr("disabled");
			}else{
				alert(NFacturaDuplicado);	
				$("input[name=NFactura]").focus();
				$("#Guardar").attr("disabled","disabled");
			}
		},"json");
			
	});
	//$("input[name=NFactura]").change();
	$(document).on("change",".der",function(e){
		var v=parseFloat($(this).val());
		if(isNaN(v)){
			v=0;
		}
		$(this).val(v.toFixed(2));
		sumaInteres=0;
		$(".Interes").each(function(index, element) {
            sumaInteres+=parseFloat($(element).val());
        });
		$(".TotalInteres").val(sumaInteres.toFixed(2))
		
		sumaDescuento=0;
		$(".Descuento").each(function(index, element) {
            sumaDescuento+=parseFloat($(element).val());
        });
		$(".TotalDescuento").val(sumaDescuento.toFixed(2))
		sumaTotal=0;
		$(".Total").each(function(index, element) {
            sumaTotal+=parseFloat($(element).val());
        });
		$(".TotalBs").val(sumaTotal.toFixed(2));
	});
	$(document).on("change",".Cancelado",function(e){
		TotalT=parseFloat($(".TotalBs").val());
		Cancelado=parseFloat($(".Cancelado").val());
		MontoDevuelto=Cancelado-TotalT;
		if(MontoDevuelto>=0 && Cancelado>0 && TotalT >0){
			$("#Guardar").removeAttr("disabled");
		}else{
			$("#Guardar").attr("disabled","disabled");	
		}
		$(".MontoDevuelto").val(MontoDevuelto.toFixed(2));
	});
	$("#cerrar").click(function(e) {
		e.preventDefault();
        $('.modal').modal('hide');
    });
	
	
	$("#seleccionar").click(function(e) {
		e.preventDefault();
		switch(TipoBusqueda){
			case "BusquedaNit":{
				
				$.post("sacarnit.php",{'CodAlumno':CodAlumno},function(data){
					$("input[name=CodAlumno]").val(CodAlumno);
					$("input[name=FacturaAlumno]").val(data.Alumno);
					$("input[name=Nit]").val(data.Nit);
					$("input[name=NombreFactura]").val(data.FacturaA);

					$('.modal').modal('hide');
					//alert(CodAlumno);
					Registro=1
					TipoBusqueda="Registro";
					$("#seleccionar").click();
				},"json");
			}break;
			case "Registro":{
				$.post("sacarregistro.php",{'CodAlumno':CodAlumno},function(data){
					$("input[name='a["+Registro+"][Nombre]']").val(data.Alumno);
					$("input[name='a["+Registro+"][CodAlumno]']").val(CodAlumno);
					
					$("select[name='a["+Registro+"][Cuota]']").html('');
					if(data.Cuota=="SinDeuda"){
						$("select[name='a["+Registro+"][Cuota]']").append('<option value="null">'+data.Cuota+'</option>')
					}else{
						for(i=data.Cuota;i<=10;i++){
							$("select[name='a["+Registro+"][Cuota]']").append('<option value="'+i+'">'+i+'</option>')
						}
						$("select[name='a["+Registro+"][Cuota]']").append('<option value="Todo">Contado 1 - 10</option>')
					}
					$("select[name='a["+Registro+"][Cuota]']").change();
					$('.modal').modal('hide');
				},"json");
			}break;
		}
    });
	var l=0;
	$(document).on("click",".aumentar",aumentarregistro).on("click",".eliminar",eliminarregistro);
	aumentarregistro(event);
	function eliminarregistro(e){
		e.preventDefault();
		if(confirm(MensajeEliminarRegistro)){
			$(this).parent().parent().remove();
		}
	}
	function aumentarregistro(e){
		e.preventDefault();
		l++;
		$.post("registro.php",{"l":l},function(data){
		$("#senal").before(data);
		$(".der").numeric({allow:'.'});
		});
	}
	$(document).on("submit","#formulario",function(e){
		if(confirm(EstaSeguroRegistrarFactura)){
		}else{
			e.preventDefault();
		}
	});
	if(CodAlumno!=""){//alert(CodAlumno);
		TipoBusqueda="BusquedaNit";
		$("#seleccionar").click();
	}
});