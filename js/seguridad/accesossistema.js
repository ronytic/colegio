$(document).on("ready",function(){
	$("input[name=Fecha]").datepicker({maxDate:"0 D",changeMonth: true,changeYear: true,dateFormat: 'dd-mm-yy'});
	$("#ver").click(function(e) {
        $.post("ver.php",{'Nivel':$("select[name=Nivel]").val(),"Fecha":$('input[name=Fecha]').val()},function(data){
			$('#resultado').html(data);	
		});
    });
});