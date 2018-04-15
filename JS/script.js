	

if ( window.history.replaceState ) {
	window.history.replaceState( null, null, window.location.href );
}

//---tooltip script---//
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip(); 
});

//----popover script-----//
$(document).ready(function(){
	$("[data-toggle=popover]").popover({html:true});
});
