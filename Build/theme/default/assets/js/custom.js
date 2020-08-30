// cookies consent
window.addEventListener("load", function () {
	window.cookieconsent.initialise({
		"palette": {
			"popup": {
				"background": "var(--lightest-color-bg)"
			},
			"button": {
				"background": "var(--secondary-color-bg)",
				"text": "var(--base-color)",
				"border": "var(--active-color)"
			}
		},
		"position": "bottom-left",
		"content": {
			"message": "Ce site utilise des cookies permettant d'améliorer votre expérience utilisateur.",
			"dismiss": "J'ai compris",
			"link": "Voir plus..."
		}
	})
});

function imageModal(el) {
	document.getElementById("modal-image").style.display = "block";
	document.getElementById("modal-image-src").src = el.src
}

function get(id) { return document.getElementById(id);}

function hide(el) {
    get(el).style.display = 'none';
}

function show(el) {
    get(el).style.display = 'block';
}

function openModalEditForum(id,name, cat, img) {
	document.getElementById("editForumTitle").innerHTML = name;
	document.getElementById("editForumId").value=id;
	document.getElementById("editForumName").value=name;
	if(isset(img)) {
		document.getElementById("editForumImg").value = '<i class="'+img+'"></i>';
	}
	document.getElementById("editForumCat"+cat).selected = true;
	$("#editForum").modal();
}

function openModalEditSousForum(id,SFid, index, name, img) {
	document.getElementById("editForumTitle").innerHTML = name;
	document.getElementById("editForumId").value=id;
	document.getElementById("editForumSFId").value=SFid;
	document.getElementById("editForumIndex").value=index;
	document.getElementById("editForumName").value=name;
	if(isset(img)) {
		document.getElementById("editForumImg").value = '<i class="'+img+'"></i>';
	}
	$("#editSForum").modal();
}
for (let el of document.querySelectorAll( "[data-editforum]" )) {
	initForumEdit(el, parseInt(el.getAttribute("data-editforum")),parseInt(el.getAttribute("data-editforum-index")));
}

function initForumEdit(el, id, index) {
	var span;
	var input;
	var ic;
	for(i = 0; i < el.children.length; i++) {
		if(el.children[i].tagName == "INPUT") {
			input = el.children[i];
			input.addEventListener("keyup", function(event) {
				if(isset(input.value) && input.value.replace(" ", "") != "") {
					span.innerText = input.value;
					$.post("index.php?action=editForumCat",{
						id: id,
						index:index,
						nom: input.value
					});
				}
			});
		} else if(el.children[i].tagName == "SPAN") {
			span = el.children[i];
		} else if(el.children[i].tagName == "I") {
			ic = el.children[i];
		}
	}

	el.addEventListener("mouseleave", function(event) {
		span.style.display="inline";
		ic.style.display="none";
		input.style.display="none";
		input.blur();
		document.getSelection().removeAllRanges();
	});
	el.addEventListener("mouseenter", function(event) {
		span.style.display="inline";
		ic.style.display="inline";
		input.style.display="none";
	});
	el.addEventListener("click", function(event) {
		span.style.display="none";
		ic.style.display="inline";
		input.style.display="inline";
		input.focus();
		input.select();
	});
}

//Scroll to Top 
window.onscroll = function () {
	divScroll()
};

function divScroll() {
	if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
		document.getElementById("divScroll").style.display = "block";
	} else {
		document.getElementById("divScroll").style.display = "none";
	}
}

function goToTop() {
	$('html, body').animate({
		scrollTop: 0
	}, 1000);
}


//Inscription page

function securPass() {

	//Gestion des mots de passes, sa sécurité, sa correspondance avec la confirmation et la possibilité de s'inscrire.
	$("#progress").removeClass("d-none");
	result = zxcvbn($("#MdpInscriptionForm").val());
	if (result['score'] == 0) {
		$("#progressbar").addClass("bg-danger");
		$("#progressbar").css('width', '0%');
		$("#progressbar").attr('aria-valuenow', '0');
	} else if (result['score'] == 1) {
		if ($("#progressbar").hasClass("bg-warning"))
			$("#progressbar").removeClass("bg-warning");
		else if ($("#progressbar").hasClass("bg-success"))
			$("#progressbar").removeClass("bg-success");
		$("#progressbar").addClass("bg-danger");
		$("#progressbar").css("width", "25%");
		$("#progressbar").attr("aria-valuenow", "25");
	} else if (result['score'] == 2) {
		if ($("#progressbar").hasClass("bg-success"))
			$("#progressbar").removeClass("bg-success");
		else if ($("#progressbar").hasClass("bg-danger"))
			$("#progressbar").removeClass("bg-danger");
		$("#progressbar").addClass("bg-warning");
		$("#progressbar").css("width", "50%");
		$("#progressbar").attr("aria-valuenow", "50");
	} else if (result['score'] == 3) {
		if ($("#progressbar").hasClass("bg-warning"))
			$("#progressbar").removeClass("bg-warning");
		else if ($("#progressbar").hasClass("bg-danger"))
			$("#progressbar").removeClass("bg-danger");
		$("#progressbar").addClass("bg-success");
		$("#progressbar").css("width", "75%");
		$("#progressbar").attr("aria-valuenow", "75");
	} else if (result['score'] == 4) {
		if ($("#progressbar").hasClass("bg-warning"))
			$("#progressbar").removeClass("bg-warning");
		else if ($("#progressbar").hasClass("bg-danger"))
			$("#progressbar").removeClass("bg-danger");
		$("#progressbar").addClass("bg-success");
		$("#progressbar").css("width", "100%");
		$("#progressbar").attr("aria-valuenow", "100");
	}
	if ($("#MdpInscriptionForm").val() != '' && $("#MdpConfirmInscriptionForm").val() != '') {
		if ($("#MdpInscriptionForm").val() == $("#MdpConfirmInscriptionForm").val()) {
			$("#correspondance").addClass("text-success");
			if ($("#correspondance").hasClass("text-danger"))
				$("#correspondance").removeClass("text-danger");
			$("#correspondance").html("Les mots de passes rentrés correspondent !!!");
			$("#InscriptionBtn").removeAttr("disabled");
		} else {
			$("#correspondance").addClass("text-danger");
			if ($("#correspondance").hasClass("text-success"))
				$("#correspondance").removeClass("text-success");
			$("#correspondance").html("Les mots de passes rentrés ne correspondent pas !!!");
		}
		if ($("#MdpInscriptionForm").val() != $("#MdpConfirmInscriptionForm").val()) {
			$("#InscriptionBtn").attr("disabled", true);
		}
	} else {
		$("#InscriptionBtn").attr("disabled", true);
		$("#correspondance").html("");
	}
}


//Script Profile page

function getUploadFileName(target) {

	document.getElementById("file-name").innerHTML = target.files[0].name;
}


//Form 

var nbclic = 0 // Initialisation à 0 du nombre de clic
function envoie_form() { // Fonction appelée par le bouton
	nbclic++; // nbclic+1
	if (nbclic > 1) { // Plus de 1 clic
		return false;
	} else { // 1 seul clic
		return true;
	}
}



//Messagerie Page

$('#modalRep').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget); // Button that triggered the modal
	var destinataire = button.data('to'); // Extract info from data-* attributes
	var modal = $(this)
	if (destinataire == undefined)
		modal.find('.modal-title').text('Nouveau message');
	else
		modal.find('.modal-title').text('Nouveau message pour ' + destinataire);
	modal.find('.modal-body #destinataire').val(destinataire);
});

$('#modalMessage').on('show.bs.modal', function (event) {
	console.log('test');
	var button = $(event.relatedTarget);
	var idConv = button.data('id');
	var correspondant = button.data('with');
	var modal = $(this);
	modal.find('.modal-title').text("Conversation avec " + correspondant);
	modal.find('#Conversation').html("<center><img src='theme/default/img/gif-charge.gif' alt='chargement...'/></center>");
	modal.find(".destinataire").attr("value", correspondant);
	$.ajax({
		method: "POST",
		url: '?action=getConversationMessage',
		data: {
			id: idConv
		}
	}).done(function (donnees) {
		if (donnees != 'false') {
			modal.find('#Conversation').html(donnees);

			$("#i" + idConv).removeClass("fa-envelope");
			$("#i" + idConv).removeClass("fas");
			$("#i" + idConv).addClass("far");
			$("#i" + idConv).addClass("fa-envelope-open");
		} else {
			modal.find('#Conversation').html("<h2>Erreur: Vous n'avez pas les accès pour cette conversation !</h2>");
		}
	});
});

function getConversations(page) {
	$("#accordion").html("<center><img src='theme/default/img/gif-charge.gif' alt='chargement...'/></center>");
	$.ajax({
		method: "POST",
		url: '?action=getConversations',
		data: {
			page: page
		}
	}).done(function (donnees) {
		$("#accordion").html(donnees);
	});
}

function getMessages(id, page) {
	$('#Conversation').html("<center><img src='theme/default/img/gif-charge.gif' alt='chargement...'/></center>");
	$.ajax({
		method: "POST",
		url: '?action=getConversationMessage',
		data: {
			id: id,
			page: page
		}
	}).done(function (donnees) {
		$("#Conversation").html(donnees);
	});
}


$('document').ready(function () {

	var checked = [];

	$("input:checkbox[name=selection]").each(function () {
		$(this).click(function () {

			checked = $("input:checkbox[name=selection]:checked");

			if (checked.length > 0) {
				$('#popover').css('display', '')
			} else {
				$('#popover').css('display', 'none');
			}
		})
	});

	$('#sel-form').submit(function () {
		var $form = $(this);
		checked.each(function () {
			$('<input>').attr({
				type: 'hidden',
				name: 'id[]',
				value: $(this).val()
			}).appendTo($form);
		});
	});

});