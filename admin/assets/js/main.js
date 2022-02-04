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

function findIndexElement(el, array) {
	for(let i = 0; i < array.length; i++) {
		if(el == array[i]) {
			return i;
		}
	}
}

function menuMooveUp(el) {
	if(el.parentElement.children.length > 1) {
		if(el.parentElement.children[0] != el) {
			let index = findIndexElement(el, el.parentElement.children);
			let el2 =  el.parentElement.children[index - 1];
			let id2 = el2.id+"";
			let ht2 = el2.innerHTML+"";
			
			let btn = ['','','',''];
			
			btn[0] = get(el.id+"-up").style.display;
			btn[1] = get(el.id+"-down").style.display;
			btn[2] = get(el2.id+"-up").style.display;
			btn[3] = get(el2.id+"-down").style.display;
			
			el2.id = el.id;
			el2.innerHTML = "";
			el2.insertAdjacentHTML("afterbegin", el.innerHTML);
			
			el.innerHTML = "";
			el.insertAdjacentHTML("afterbegin", ht2);
			el.id = id2;
			
			get(el.id+"-up").style.display = btn[0];
			get(el.id+"-down").style.display = btn[1];
			get(el2.id+"-up").style.display = btn[2];
			get(el2.id+"-down").style.display = btn[3];
		}
	}
}

function checkMenuForMoove() {
	for (let el of document.querySelectorAll("[btn-menu-up]" )) {
		let main = el.parentElement.parentElement.parentElement;
		console.log(main.id);
		let count = main.parentElement.children.length;
		if(count < 2) {
			hide(el.id);
			return;
		}
		let index;
		for(let i = 0; i < count; i++) {
			if(main.parentElement.children[i] == main) {
				index = i;
				break;
			}
		}
		console.log(index);
		if(index == 0) {
			hide(el.id); 
		} else {
			show(el.id);
		}
	}
	for (let el of document.querySelectorAll("[btn-menu-down]" )) {
		let main = el.parentElement.parentElement.parentElement;
		let count = main.parentElement.children.length;
		if(count < 2) {
			hide(el.id);
			return;
		}
		let index;
		for(let i = 0; i < count; i++) {
			if(main.parentElement.children[i] == main) {
				index = i;
				break;
			}
		}
		if(index == count - 1) {
			hide(el.id); 
		} else {
			show(el.id);
		}
	}
}

function menuMooveDown(el) {
	if(el.parentElement.children.length > 1) {
		if(el.parentElement.children[el.parentElement.children.length-1] != el) {
			let index = findIndexElement(el, el.parentElement.children);
			let el2 =  el.parentElement.children[index + 1];
			let id2 = el2.id+"";
			let ht2 = el2.innerHTML+"";
			
			let btn = ['','','',''];
			
			btn[0] = get(el.id+"-up").style.display;
			btn[1] = get(el.id+"-down").style.display;
			btn[2] = get(el2.id+"-up").style.display;
			btn[3] = get(el2.id+"-down").style.display;
			
			el2.id = el.id;
			el2.innerHTML = "";
			el2.insertAdjacentHTML("afterbegin", el.innerHTML);
			
			el.innerHTML = "";
			el.insertAdjacentHTML("afterbegin", ht2);
			el.id = id2;
			
			get(el.id+"-up").style.display = btn[0];
			get(el.id+"-down").style.display = btn[1];
			get(el2.id+"-up").style.display = btn[2];
			get(el2.id+"-down").style.display = btn[3];
		}
	}
}

function menuRemovelist(id) {
	let el = get(id);
	let main = getElementByName('newLien','dest');
	for(let el2 of main.children) {
		if(el2 == el) {
			main.removeChild(el2);
			return;
		}
	}
}


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

function miniaUpdate() {
	destroyCK();
	updateCont("admin.php?action=getMiniaList", get("allMinia"), function(data) { if(data) {
		show('card-minia');
		initPost("allMinia", "admin.php?action=editMiniature",null);
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

function widgetsUpdate() {
	destroyCK();
	updateCont('admin.php?action=getWidgetsList', get('allWidgets'), function(data) { if(data) { 
		initPost("allWidgets", "admin.php?action=editWidgets"); 
		initCK();
	}});
}


var showPopUpPage = null;

function setShowPopUpPage(name) {
	showPopUpPage = name;
}

function pagesUpdate() {
	destroyCK();
	updateCont("admin.php?action=getPagesList", get("allPage"), function(data) { if(data) {
		initPostCallback( null);
		initCK();
		if(isset(showPopUpPage)) {

			window.open("index.php?page="+showPopUpPage,showPopUpPage,"menubar=no, status=no, scrollbars=no, menubar=no, width=1280, height=720");
			showPopUpPage = null;
		}
	}});
}


function menuUpdate() {
	updateCont("admin.php?action=getMenuListe", get("allMenu"), function(data) { if(data) {
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
    	ht += '<label class="control-label">Quantité de '+_Jetons_+' à donner (forcera le joueur à être connecté sur le serveur pour voter)</label>'
            		 +'<input type="number" data-type="value" min="1" value="1" max="99999999" class="form-control"/>';
    } else  if(type == "jetonAlea") {
    	ht += '<label class="control-label">Quantité de '+_Jetons_+' à donner (forcera le joueur à être connecté sur le serveur pour voter)</label>'
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

		ht += '<label class="control-label">Donner la récompense instantanément (ne sera pas stocké si possible)</label>'
            		 +'<div class="custom-control custom-switch" style="padding-top: 5px"><input type="checkbox" id="inst'+idvote+'" data-type="inst" class="custom-control-input" /><label class="custom-control-label" for="inst'+idvote+'">Oui</label> </div>';


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
    	ht += '<label class="control-label">Quantité de '+_Jetons_+' à donner (forcera le joueur à être connecté sur le serveur pour voter)</label>'
            		 +'<input type="number" data-type="value" min="1" value="1" max="99999999" class="form-control"/>';
    }  else  if(type == "jetonAlea") {
    	ht += '<label class="control-label">Quantité de '+_Jetons_+' à donner (forcera le joueur à être connecté sur le serveur pour voter)</label>'
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

	ht += '<label class="control-label">Donner la récompense instantanément (ne sera pas stocké si possible)</label>'
            		 +'<div class="custom-control custom-switch" style="padding-top: 5px"><input type="checkbox" id="inst'+idvote+'" data-type="inst" class="custom-control-input" /><label class="custom-control-label" for="inst'+idvote+'">Oui</label> </div>';

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
					}else {
						
						let el4 = el3.children[a];
						for (let u = 0; u < el4.children.length; u++)
						{
							if(el4.children[u].type == "checkbox" && isset(el4.children[u].getAttribute('data-type')))
							{
								final += ',"'+el4.children[u].getAttribute('data-type')+'":"'+(el4.children[u].checked ? 1 : 0 )+'"';
							}
						}
						
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

function testUrlVoteForTest(url, id, btn) {
	btn.disabled = true;
	if(url.includes("serveurs-mc.net")) {
		fetchVote("https://serveurs-mc.net/api/hasVote/"+id+"/0.0.0.0/10", function(data, status) {
			// true -> json, false -> null
			if(isJson(data)) {
				notif("success", "serveurs-mc.net", "Id "+id+" trouvé !");
			} else {
				notif("error", "serveurs-mc.net", "Id "+id+" introuvable.");
			}
			btn.disabled = false;
		});
	} else if (url.includes("serveur-minecraft-vote.fr")) { // Serveur minecraft vote
		fetchVote("https://serveur-minecraft-vote.fr/api/v1/servers/" + id, function (data, status) {
			// true -> json {"status":"1"}, false -> {"status":"0"}
			if (isJson(data)) {
				notif("success", "serveur-minecraft-vote.fr", "Id " + id + " trouvé !");
			} else {
				notif("error", "serveur-minecraft-vote.fr", "Valeur invalide: " + data);
			}
			btn.disabled = false;
		});
	} else if(url.includes("serveur-prive.net")) {
		fetchVote("https://serveur-prive.net/api/stats/json/"+id+"/position", function(data, status) {
			// true -> json {"status":"1"}, false -> {"status":"0"}
			if(isJson(data)) {
				if(parseInt(JSON.parse(data).status) == 1) {
					notif("success", "serveur-prive.net", "Id "+id+" trouvé !");
				} else {
					notif("error", "serveur-prive.net", "Id "+id+" introuvable.");
				}
			} else {
				notif("error", "serveur-prive.net", "Valeur invalide: "+data);
			}
			btn.disabled = false;
		});
	}else if(url.includes("serveurs-minecraft.org") & !url.includes("liste-serveurs-minecraft.org")) { // Access-Control-Allow-Origin
		fetchVote("https://www.serveurs-minecraft.org/api/is_online.php?id="+id+"&format=json", function(data, status) {
			// true -> 1, false -> -1
			if(parseInt(data) == 1) {
				notif("success", "serveurs-minecraft.org", "Id "+id+" trouvé !");
			} else {
				notif("error", "serveurs-minecraft.org", "Id "+id+" introuvable.");
			}
			btn.disabled = false;
		});
	}else if(url.includes("serveurs-minecraft.com")) { // Access-Control-Allow-Origin
		fetchVote("https://serveurs-minecraft.com/api?Classement="+id+"&Slots", function(data, status) {
			// true -> 100, false -> <h2>Serveur introuvable.</h2>
			if(!data.includes("<h2>Serveur introuvable.</h2>")) {
				notif("success", "serveurs-minecraft.com", "Id "+id+" trouvé !");
			} else {
				notif("error", "serveurs-minecraft.com", "Id "+id+" introuvable.");
			}
			btn.disabled = false;
		});
	}else if(url.includes("serveursminecraft.fr")) { // Access-Control-Allow-Origin
		fetchVote("https://serveursminecraft.fr/api/ping.php?ServeurID="+id+"&Info=Version", function(data, status) {
			// true -> 1.16.5, false -> Le serveur demandé n'éxiste pas.
			if(!(data.includes("false")) ) {
				notif("success", "serveursminecraft.fr", "Id "+id+" trouvé !");
			} else {
				notif("error", "serveursminecraft.fr", "Id "+id+" introuvable.");
			}
			btn.disabled = false;
		});
	}else if(url.includes("liste-minecraft-serveurs.com")) { // Access-Control-Allow-Origin
		fetchVote("https://www.liste-minecraft-serveurs.com/Api/Worker/id_server/"+id+"/ip/0.0.0.0", function(data, status) {
			// true -> {"result":200,"msg":"n a pas encore vote"}, false -> {"result":400,"msg":"id du serveur incorrect"}
			if(isJson(data)) {
				if(!(parseInt(JSON.parse(data).result) == 400)) {
					notif("success", "liste-minecraft-serveurs.com", "Id "+id+" trouvé !");
				}
				else {
					notif("error", "liste-minecraft-serveurs.com", "Id "+id+" introuvable.");
				}
			} else {
				//notif("error", "liste-minecraft-serveurs.com", "Valeur invalide: "+data);
				notif("error", "liste-minecraft-serveurs.com", "Id "+id+" introuvable.");
			}
			btn.disabled = false;
		});
	}else if(url.includes("liste-serveurs.fr")) { // Access-Control-Allow-Origin
		fetchVote("https://www.liste-serveurs.fr/api/topVotes/"+id+"/1", function(data, status) {
			// true -> { "classement": [ { "pseudo": "greshyme", "votes": "2" } ] }, false -> {"classement": [] }
			if(isJson(data)) {
				let l = JSON.parse(data);
				if(isset(l.classement) & l.classement.length > 0) {
					notif("success", "liste-serveurs.fr", "Id "+id+" trouvé !");
				} else {
					notif("error", "liste-serveurs.fr", "Id "+id+" introuvable.");
				}
			} else {
				notif("error", "liste-serveurs.fr", "Valeur invalide: "+data);
			}
			btn.disabled = false;
		});
	}else if(url.includes("liste-serveur.fr")) {
		notif("warning", "liste-serveur.fr", "Aucun moyen de vérification n'a été trouvé pour se site");
		btn.disabled = false;
	}else if(url.includes("top-serveurs.net")) {
		fetchVote("https://api.top-serveurs.net/v1/servers/"+id+"/players-ranking", function(data, status) {
			// true -> ?, false -> {"code":404,"success":false,"error":"ServerNotFound","message":"Aucun serveur n'est associ\u00e9 \u00e0 cette Token."}
			if(isJson(data))
			{
				let l = JSON.parse(data);
				if(!(isset(l.code) && parseInt(l.code) == 404)) {
					notif("success", "top-serveurs.net", "Id "+id+" trouvé !");
				} else {
					notif("error", "top-serveurs.net", "Id "+id+" introuvable.");
				}
			} else {
				notif("error", "top-serveurs.net", "Valeur invalide: "+data);
			}
			btn.disabled = false;
		});
	}else if(url.includes("serveursminecraft.org")) { // Access-Control-Allow-Origin
		fetchVote("https://www.serveursminecraft.org/serveur/"+id+"/", function(data, status) {
			console.log(data.substring(284, 736));
			if(data.substring(284, 736).includes("| Liste de Serveur Minecraft</title>")) {
				notif("success", "serveursminecraft.org", "Id "+id+" trouvé !");
			} else {
				notif("error", "serveursminecraft.org", "Id "+id+" introuvable.");
			}
			btn.disabled = false;
			// true -> ?, false -> <title>Serveur Minecraft | Liste de Serveur Minecraft </title>
		});
	}else if(url.includes("minecraft-top.com")) {
		notif("warning", "minecraft-top.com", "Aucun moyen de vérification n'a été trouvé pour se site");
		btn.disabled = false;
	}else if(url.includes("liste-serveurs-minecraft.org")) { // Access-Control-Allow-Origin
		fetchVote("https://api.liste-serveurs-minecraft.org/widget/index.php?id="+id, function(data, status) {
			// true -> json, false -> null
			if(!isset(data) | data.replaceAll(" ", "") == "") {
				notif("error", "liste-serveurs-minecraft.org", "Id "+id+" introuvable.");
			} else {
				notif("success", "liste-serveurs-minecraft.org", "Id "+id+" trouvé !");
			}
			btn.disabled = false;
		});
	}else if(url.includes("liste-serv-minecraft.fr")) { // Access-Control-Allow-Origin
		fetchVote("https://liste-serv-minecraft.fr/serveur?id="+id, function(data, status) {
			// true -> ?, false -> <title>Liste-serv-minecraft.fr | Liste de serveur minecraft</title>
			if(data.substring(2333, 2745).includes("| Liste-serv-minecraft.fr</title>")) {
				notif("success", "liste-serv-minecraft.fr", "Id "+id+" trouvé !");
			} else {
				notif("error", "liste-serv-minecraft.fr", "Id "+id+" introuvable.");
			}
			btn.disabled = false;
		});
	}else if(url.includes("minecraft-mp.com")) {
		fetchVote("https://minecraft-mp.com/api/?object=servers&element=detail&key="+id, function(data, status) {
			// true -> ?, false -> Error: server key not found
			if(!data == "Error: server key not found") {
				notif("success", "minecraft-mp.com", "Id "+id+" trouvé !");
			} else {
				notif("error", "minecraft-mp.com", "Id "+id+" introuvable.");
			}
			btn.disabled = false;
		});
	}else if(url.includes("serveur-minecraft.com")) {
		fetchVote("https://serveur-minecraft.com/"+id, function(data, status) {
			// true -> 100, false -> <title>An Error Occurred: Not Found</title>
			if(!data.includes("<title>An Error Occurred: Not Found</title>")) {
				notif("success", "serveur-minecraft.com", "Id "+id+" trouvé !");
			} else {
				notif("error", "serveur-minecraft.com", "Id "+id+" introuvable.");
			}
			btn.disabled = false;
		});
	} else {
		notif("warning", url, "Aucune API enregistré pour se site.");
		btn.disabled = false;
	}
}


function isJson(item) {
	item = typeof item !== "string"
		? JSON.stringify(item)
		: item;
	try {
		item = JSON.parse(item);
	} catch (e) {
		return false;
	}
	return (typeof item === "object" && item !== null);
}

function fetchVote(url, callback) {
	try {
		$.get("admin.php?action=getUrlContent&url="+url, function(data, status){
			if(status == "success") {
				callback(data.substring(data.indexOf('[DIV]') + 5), status);
			} else {
				notif("error", "Site web inaccessible", status);
			}
		});
	} catch (error) {
		console.log(error);
		callback(null, 404);
	}
}
