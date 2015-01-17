// JavaScript Document
$(document).ready(function(e) {
	/*MontoKinder
	MontoGeneral*/
   $('#FechaNac').datepicker({ maxDate:"0 D",changeMonth: true,changeYear: true,yearRange:"c-100:c+10",dateFormat: 'dd-mm-yy'});
   $('#FechaRetiro').datepicker({changeMonth: true,changeYear: true,dateFormat: 'dd-mm-yy'})
  // if($("#Ci").val()!=""){$('#CedulaId').attr('checked','checked');}
   /*$('#Ci').keyup(function(e) {
    	if($(this).val()!=""){
			$('#CedulaId').attr('checked','checked');	
		}else{
			$('#CedulaId').attr('checked','');	
		}
	});
	$('#CiMadre').keyup(function(e) {
    	if($(this).val()!=""){
			$('#CedulaIdM').attr('checked','checked');	
		}else{
			$('#CedulaIdM').attr('checked','');	
		}
	});
	$('#CiPadre').keyup(function(e) {
    	if($(this).val()!=""){
			$('#CedulaIdP').attr('checked','checked');	
		}else{
			$('#CedulaIdP').attr('checked','');	
		}
	});*/
	//alert(MontoKinder);
	verifica()
	$("#Curso").change(function(e) {
		

        verifica();
    });
	function verifica(){
		MontoGeneral=$("#Curso>option:selected").attr('rel-cuota');
		$("#MontoPagar").val(MontoGeneral);
		valor=$("#PorcentajeBeca").val();
		MontoBeca=(valor*MontoGeneral)/100;

		//if($("#MontoBeca").val()=="0.00"){
			$("#MontoBeca").val(MontoBeca.toFixed(2));
		//}
		$('#MontoPagar').val(MontoGeneral-($("#MontoBeca").val()));

	}
	//$('#MontoPagar').val(MontoGeneral-($("#MontoBeca").val()));
	$("#MontoBeca").keyup(function(e) {
		var valor=$(this).val();
		if(valor==""){valor=0;}
		valor=parseFloat(valor);
		var PorcentajeBeca=0;
		valor=valor.toFixed(2);
		if($("#Curso").val()==1){
			PorcentajeBeca=(valor/MontoKinder)*100;
			$('#MontoPagar').val(MontoKinder-(valor));
		}else{
			PorcentajeBeca=(valor/MontoGeneral)*100;
			$('#MontoPagar').val(MontoGeneral-(valor));
		}

		$("#PorcentajeBeca").val(PorcentajeBeca.toFixed(2));
    });
	
	MontoBeca=$("#MontoBeca").val();
	$("#PorcentajeBeca").val((MontoBeca*100/MontoGeneral).toFixed(2));	
	
	$("#PorcentajeBeca").keyup(function(e) {
		var valor=$(this).val();
		//alert(MontoGeneral);
		var MontoBeca=0;
		MontoBeca=(valor*MontoGeneral)/100;
		$('#MontoPagar').val(MontoGeneral-(MontoBeca.toFixed(2)));
		$("#MontoBeca").val(MontoBeca.toFixed(2));
		
    });
	$("form").on("submit",function(){
		$("input[type=submit]").attr("disabled","disabled");	
	})
	function habilita(){
		$("input[type=submit]").attr("disabled","");	
	}
});