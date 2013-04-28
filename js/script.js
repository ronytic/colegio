$(document).on("ready",inicio);
function inicio(){
	$(".nav.nav-tabs.nav-stacked li").toggle(function(e) {
		e.preventDefault();
        $(this).find("ul.oculto").slideDown("fast");
    },function(e) {
		e.preventDefault();
        $(this).find("ul.oculto").slideUp("fast");
    });
}