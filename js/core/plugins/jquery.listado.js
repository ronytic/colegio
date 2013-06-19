function buscadorLista(input, listas,  mover,clase) { 
	if(isNaN(mover)){
		mover=1;	
	}
	if(typeof(clase)=="undefined"){
		clase="";
	}
	
	jQuery.expr[':'].Contains = function(a,i,m){
		return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
  	};
	var name=$(listas).attr("name");
  	$(listas).css("display","none");
	$(listas).next(".r-contenedor").remove();
	var cont='<div class=" r-contenedor"><ul class="r-listado">';
	listas.find("option").each(function(){
		var v=$(this).val()
		var va=$(this).html();
		var r=$(this).attr("rel");
		if($(listas).val()==v){sel="r-seleccionado";}else{sel="";}
		cont+='<li class="'+clase+'"><a rel="'+v+'" class="'+sel+' '+clase+'" data-rel="a'+r+'"';
		if(clase=="cuadro"){cont+='title="'+va+'"'}
		cont+='>';
		if(clase=="cuadro"){cont+=''+sacarIniciales(va)+''}else{cont+=(va);}
		cont+="</a></li>";
	});
	cont+='</ul></div>';
	var list=$(cont);
	$(listas).after(list);
    $(input)
      .change( function () {
        var filter = $(this).val();
        if(filter) {
		  $matches = $(list).find('a:Contains(' + filter + ')').parent();
		  $('li', list).not($matches).slideUp("fast");
		  //$('li:first', list).not($matches).slideUp("fast");
		  $matches.slideDown();
        } else {
          $(list).find("li").slideDown(0);
        }
        return false;
      })
    .keyup( function () {
        $(this).change();
    });
	$('a',list).on("click",function(e){
		e.preventDefault();
		var v=$(this).attr("rel");
		$('a.r-seleccionado',list).removeClass("r-seleccionado");
		$(this).addClass("r-seleccionado");
		listas.val(v).change();
		//$('html, body').animate({scrollTop:$(input).position().top}, 'slow');
		if(mover==1){
			//$('html, body').animate({scrollTop:0},300);
		}
		//$(input).focus(); 
		
	})
}