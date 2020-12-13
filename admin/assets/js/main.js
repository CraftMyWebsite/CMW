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


function switchTypePassword(el) {
	for(i = 0; i < el.parentElement.parentElement.children.length; i++) {
		if(isset(el.parentElement.parentElement.children[i].type) && el.parentElement.parentElement.children[i].type == "password" ) {
			el.parentElement.parentElement.children[i].type = "text";
			el.innerHTML = '<i class="far fa-eye-slash"></i>';
		} else if(isset(el.parentElement.parentElement.children[i].type) && el.parentElement.parentElement.children[i].type == "text" ) { 
			el.parentElement.parentElement.children[i].type = "password";
			el.innerHTML = '<i class="far fa-eye"></i>';
		}
	}
}

// Loader
$(document).ready(function() {
	setTimeout(function(){
		document.getElementsByTagName('body')[0].className = 'loaded';
	}, 100);
	$('.popover').each(function () {
                    var $this = $(this);
                    $this.popover({
                        trigger: 'hover',
                        content: 'Content Here',
                        container: $this
                    })
                });
	
});


function boutiqueUpdate() {
	destroyCK();
	updateCont("admin.php?action=getOffreBoutique", get("allcategorie"), function(data) { if(data) { 
		initPostCallback();
		var list = document.querySelectorAll('[data-boutique-callback]');
		get("allcategorieupdate").innerText = "";
		get("allcategoriecoupon").innerText = "";
	    for (var i = 0; i < list.length; ++i) {
	        console.log("try callback "+list[i]);
	        get("allcategorieupdate").innerHTML+='<option value="'+list[i].getAttribute("data-boutique-callback")+'">'+list[i].getAttribute("data-boutique-callback-name")+'</option>';
	        get("allcategoriecoupon").innerHTML+='<option value="'+list[i].getAttribute("data-boutique-callback")+'">'+list[i].getAttribute("data-boutique-callback-name")+'</option';
	    }

	    list = document.querySelectorAll('[data-callback-tagsinput]');
	    for (var i = 0; i < list.length; ++i) {

	    	$(list[i]).tagsinput();
	    }

	    list = document.querySelectorAll('[data-boutique-tagsinput]');
	    for (var i = 0; i < list.length; ++i) {

	    	$('#'+list[i].getAttribute("data-boutique-tagsinput")).tagsinput('add', { 'value': parseInt(list[i].getAttribute("data-boutique-tagsinput-value")) ,'text': list[i].getAttribute("data-boutique-tagsinput-text") });
	    }



	    initCK();
	}});
}

function boutiqueActionUpdate(id) {
	updateCont("admin.php?action=getOffreActionBoutique&id="+id, get("allaction-"+id), function(data) { if(data) { 
		initPostCallback();
	}});
}

function boutiqueCheck() {
	var list = document.querySelectorAll('[data-boutique-switchsupp]');
	for (var i = 0; i < list.length; ++i) {
		if(list[i].children[0].children[0].checked) {
			hide(list[i].parentElement.id, true);
		}
	}
}

function voteUpdate() {
	updateCont("admin.php?action=getLienVote&id="+idvote, get("all-vote"), function(data) { if(data) { 
		idvote+=1000;
		initPost("all-vote", "admin.php?action=modifierVote");
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
		initPost('modifServer', 'admin.php?&action=serveurConfig');
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

function checkGrade() {
	let text = getElementByName("addGrade","gradeName").value;
	if(text.length < 3) {
		notif("error", "Erreur", "Nom du grade trop court !");
	} else if(text.length > 32) {
		notif("error", "Erreur", "Nom du grade trop long !");
	} else if(gradeExist(text)) {
		notif("error", "Erreur", "Grade déjà éxistant !");
	} else {
		return true;
	}
	return false;
}
function gradesUpdate() {
	updateCont("admin.php?action=getGradesList", get("allGrade"), function(data) { if(data) { 
		initPost("allGrade", "admin.php?&action=editGrade");
	}});
}

function gradeExist(str) {
	for (let el of document.querySelectorAll("[data-grade]" )) {
		if(el.innerText.toLowerCase() == str.toLowerCase()) {
			return true;
		}
	}
	return false;
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

function addVoteConfigRec(type, id1, id2) {
	show(id1);
	let el = get(id2);
	idvote++;
	var ht = '<div class="col-md-6 col-12" id="rec-vote-'+idvote+'" data-type="'+type+'" style="margin-top:15px;"><div style="border: 1px solid #B0B0B0;border-radius: 24px;padding:20px;margin:7px;"> '
			+'<div style="width: 100%;display: inline-block">'
                +'<div class="float-left">'
                    +'<h5>'+(type.charAt(0).toUpperCase() + type.slice(1))+'</h5>'
                +'</div>'
                +'<div class="float-right">'
                    +'<button onclick="get(\''+id2+'\').removeChild(get(\'rec-vote-'+idvote+'\'));if(get(\''+id2+'\').children.length == 0) { hide(\''+id1+'\');}" class="btn btn-sm btn-outline-secondary">Supprimer</button>'
                +'</div>'
            +'</div>';

    if(type == "commande") {
    	ht += '<label class="control-label">Commande à éxecuter (SANS /)</label>'
            		 +'<input type="text" data-type="value"class="form-control"/>';
    } else  if(type == "message") {
    	ht += '<label class="control-label">Message à afficher lors du vote</label>'
            		 +'<input type="text" data-type="value" class="form-control"/>';
    } else  if(type == "jeton") {
    	ht += '<label class="control-label">Quantité de '+_Jetons_+' à donner (forcera le joueur à être connecter sur le serveur pour voter)</label>'
            		 +'<input type="number" data-type="value" min="1" value="1" max="99999999" class="form-control"/>';
    } else  if(type == "jetonAlea") {
    	ht += '<label class="control-label">Quantité de '+_Jetons_+' à donner (forcera le joueur à être connecter sur le serveur pour voter)</label>'
    	ht += '<label class="control-label" style="margin-top:10px;">Quantité minimum:</label>'
            		 +'<input type="number" data-type="value" min="0" value="1" max="99999999" class="form-control"/>'
        ht += '<label class="control-label" style="margin-top:10px;">Quantité maximum:</label>'
            		 +'<input type="number" data-type="value2" min="0" value="100" max="99999999" class="form-control"/>';
    } else  if(type == "item") {
    	ht += '<label class="control-label">Id de l\'item à donner</label>'
            		 +'<input type="text" data-type="value" class="form-control"/>'

            		 +'<label class="control-label">Nombre d\'item à donner</label>'
            		 +'<input type="number" data-type="value2" min="1" value="1" max="64"  class="form-control"/>';
    } 
    if(type != "jeton" && type != "jetonAlea") {
		ht += '<label class="control-label">Obtention de la récompense</label>'
                        +'<select data-type="methode" class="form-control" style="margin-bottom:20px">'
                            +'<option value="1"> Le serveur où il est en ligne </option>'
                            +'<option value="3"> Tous les serveurs </option>'
                        +'</select> <hr/>';
    }
    ht += '<label class="control-label">Pourcentage de chance d\'obtenir cette récompense</label>'
            		 +'<input type="number" min="1" max="100" value="100" data-type="pourcentage" class="form-control"/>';
   	ht +='</div></div>';
    el.insertAdjacentHTML("beforeend", ht);

}

function addVoteRec(type, id1, id2) {
	show(id1);
	let el = get(id2);
	idvote++;
	var ht = '<div class="col-md-6 col-12" id="rec-vote-'+idvote+'" data-type="'+type+'" style="margin-top:15px;"><div style="border: 1px solid #B0B0B0;border-radius: 24px;padding:20px;margin:7px;"> '
			+'<div style="width: 100%;display: inline-block">'
                +'<div class="float-left">'
                    +'<h5>'+(type.charAt(0).toUpperCase() + type.slice(1))+'</h5>'
                +'</div>'
                +'<div class="float-right">'
                    +'<button onclick="get(\''+id2+'\').removeChild(get(\'rec-vote-'+idvote+'\'));if(get(\''+id2+'\').children.length == 0) { hide(\''+id1+'\');}" class="btn btn-sm btn-outline-secondary">Supprimer</button>'
                +'</div>'
            +'</div>';

    if(type == "commande") {
    	ht += '<label class="control-label">Commande à éxecuter (SANS /)</label>'
            		 +'<input type="text" data-type="value" class="form-control"/>';
    } else  if(type == "message") {
    	ht += '<label class="control-label">Message à afficher lors du vote</label>'
            		 +'<input type="text" data-type="value" class="form-control"/>';
    } else  if(type == "jeton") {
    	ht += '<label class="control-label">Quantité de '+_Jetons_+' à donner (forcera le joueur à être connecter sur le serveur pour voter)</label>'
            		 +'<input type="number" data-type="value" min="1" value="1" max="99999999" class="form-control"/>';
    }  else  if(type == "jetonAlea") {
    	ht += '<label class="control-label">Quantité de '+_Jetons_+' à donner (forcera le joueur à être connecter sur le serveur pour voter)</label>'
    	ht += '<label class="control-label" style="margin-top:10px;">Quantité minimum:</label>'
            		 +'<input type="number" data-type="value" min="0" value="1" max="99999999" class="form-control"/>'
        ht += '<label class="control-label" style="margin-top:10px;">Quantité maximum:</label>'
            		 +'<input type="number" data-type="value2" min="0" value="100" max="99999999" class="form-control"/>';
    } else  if(type == "item") {
    	ht += '<label class="control-label">Id de l\'item à donner</label>'
            		 +'<input type="text" data-type="value" class="form-control"/>'

            		 +'<label class="control-label">Nombre d\'item à donner</label>'
            		 +'<input type="number" data-type="value2" min="1" value="1" max="64"  class="form-control"/>';
    } 
    if(type != "jeton" && type != "jetonAlea") {
		ht += '<label class="control-label">Obtention de la récompense</label>'
                        +'<select data-type="methode" class="form-control" style="margin-bottom:20px">'
                            +'<option value="1"> Le serveur où il est en ligne </option>'
                            +'<option value="2"> Le serveur de la catégorie </option>'
                            +'<option value="3"> Tous les serveurs </option>'
                        +'</select> <hr/>';
    }
    ht += '<label class="control-label">Pourcentage de chance d\'obtenir cette récompense</label>'
            		 +'<input type="number" min="1" max="101" value="100" data-type="pourcentage" class="form-control"/>';
   	ht +='</div></div>';
    el.insertAdjacentHTML("beforeend", ht);

}

function genVoteJson(id1, id2) {
	let el = get(id1);
	var final = "[";
	for (let i = 0; i < el.children.length; i++) 
	{
		if(isset(el.children[i].getAttribute('data-type'))) 
		{
			let el2 = el.children[i];
			final += '{ "type":"'+el2.getAttribute('data-type')+'"';

			for (let o = 0; o < el2.children.length; o++) 
			{
				let el3 = el2.children[o];
				for (let a = 0; a < el3.children.length; a++) 
				{
					if(isset(el3.children[a].getAttribute('data-type')))
					{
						final += ',"'+el3.children[a].getAttribute('data-type')+'":"'+el3.children[a].value+'"';
					}
				}
			}
			final += '},';
		}
	}
	if(final != "[") {
		final = final.slice(0,-1);
	}
	final += "]";
		get(id2).value = final;
}

function genVoteJson2() {
	let el = get('all-vote');
	for (let i = 0; i < el.children.length; i++) {
		if(isset(el.children[i].getAttribute('data-other'))) {
			genVoteJson(el.children[i].getAttribute('data-other'), el.children[i].id);
		}
	}
}
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