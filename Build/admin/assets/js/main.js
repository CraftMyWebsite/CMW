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
		initPostCallback( function(data) {  boutiqueUpdate(); });
	}});
}

function voteUpdate() {
	updateCont("admin.php?action=getLienVote", get("all-votee"), function(data) { if(data) { 
		initPost("all-vote", "admin.php?action=modifierVote", function (data) { if(data) {  voteUpdate();}})
	}});
}

function newsUpdate() {
	destroyCK();
	updateCont("admin.php?action=getNewsList", get("edit-news"), function(data) { if(data) { 
		initPostCallback(null);
		initCK();
	}});
}

function serverUpdate() {
	updateCont("admin.php?action=getServerList", get("modifServer"), function(data) { if(data) { 
		initPost('modifServer', 'admin.php?&action=serveurConfig', function(data) { if(data) {  }});
	}});
}

function paypalUpdate() {
	updateCont("admin.php?action=getOffrePaypal", get("offrePaypal"), function(data) { if(data) { 
		initPostCallback( null);
	}});
}

function pagesUpdate() {
	destroyCK();
	updateCont("admin.php?action=getPagesList", get("allPage"), function(data) { if(data) { 
		initPostCallback( null);
		initCK();
	}});
}

function menuLienUpdate() {
	updateCont("admin.php?action=getMenuLien", get("allLien"), function(data) { if(data) { 
		initPostCallback( null);
	}});
}

function menuListeUpdate() {
	updateCont("admin.php?action=getMenuListe", get("allListe"), function(data) { if(data) { 
		initPostCallback( null);
	}});
}


function switchGrade(el, id, key) {
	if(parseInt(el.value) == 0) {
		el.value=1;
		el.innerHTML = "<i class='far fa-minus-square'></i> "+key;
		getEach("#"+id, function(element) { 
			$(element).show(500);
		})
	} else if(parseInt(el.value) == 1){
		el.value=0;
		el.innerHTML = "<i class='far fa-plus-square'></i> "+key;
		getEach("#"+id, function(element) { 
			$(element).hide(500);
		})
	}
}

function CheckUnder(el, value) {
	for (let i = 0; i < el.children.length; i++) {
		if(isset(el.children[i].type) && el.children[i].type == "checkbox" ) {
			el.children[i].checked= value;
		} else {
			CheckUnder(el.children[i], value);
		}
	}
}
	//PermsPanel-home-actions-editSlider-2
function updateGradeUl(el) {
	let ar = el.id.split("-");
	if(ar.lenght != 2) {
		let other = ar[ar.length-1];
		for (let i = ar.length-2; 0 < i; i--) {
			let strid = "";
			for(let o = 0; o < i; o++) {
				strid += "-"+ar[o];
			}
			console.log("cont"+strid+"-"+other);
			get(strid.substring(1)+"-"+other).checked = isAllGradeChecked(get("cont"+strid+"-"+other));
		}
	}
}

function isAllGradeChecked(el) {
	for (let i = 0; i < el.children.length; i++) {
		if(isset(el.children[i].id) && el.children[i].id == "grade-div") {
			for (let o = 0; o < el.children[i].children.length; o++) {
				if(isset(el.children[i].children[o].type) && el.children[i].children[o].type == "checkbox" && !el.children[i].children[o].checked)
				{
					return false;
				}
			}
		}
	}
	return true;
}

//previsu grade
function updatePrevisu(grade) {
	let previsu = get('previsu'+grade);
	if(!get('prefix'+grade+'-none').checked)
		previsu.style.backgroundColor = get('prefix'+grade).value;
	else
		previsu.style.backgroundColor = "";
	previsu.style.color = get('couleur'+grade).value;
	previsu.className = '';
	previsu.classList.add("prefix");
	let effets = get('effets'+grade).getElementsByTagName("input");
	for(let radio of effets)
		if(radio.checked && radio.value != "")
			previsu.classList.add(radio.value);
}