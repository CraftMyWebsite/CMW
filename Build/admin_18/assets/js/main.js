// Toastr Notifications
toastr.options = {
    "closeButton"   : true,
    "debug"         : true,
	"newestOnTop"      : false,
	"progressBar"      : false,
	"positionClass"    : "toast-top-right",
	"preventDuplicates": false,
	"onclick"          : null,
	"showDuration"     : "500",
	"hideDuration"     : "500",
	"timeOut"          : "5000",
	"extendedTimeOut"  : "1000",
	"showEasing"       : "swing",
	"hideEasing"       : "linear",
	"showMethod"       : "fadeIn",
	"hideMethod"       : "fadeOut"
}

// Loader
$(document).ready(function() {
	setTimeout(function(){
		document.getElementsByTagName('body')[0].className = 'loaded';
	}, 100);
	
});

function boutiqueUpdate() {
	updateCont("admin.php?action=getOffreBoutique", get("allcategorie"), function(data) { if(data) { 
		initPostCallback( function() {  boutiqueUpdate(); });
	}});
}
