<div class="cmw-page-content-header"><strong>Gestion</strong> - Gérez vos Membres</div>
<div class="row">
        <?php if(!Permission::getInstance()->verifPerm('PermsPanel', 'members', 'actions', 'editMember')) { ?>
            <div class="col-md-12 text-center">
                <div class="alert alert-danger">
                    <strong>Vous avez aucune permission pour accéder aux membres.</strong>
                </div>
            </div>
           <?php } else { ?>
    <div class="col-md-12 text-center">
        <div class="alert alert-success">
            <strong>Modifiez ici les informations concernant les membres de votre site.</strong>
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        <div class="panel panel-default cmw-panel">
            <div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Édition des membres</strong><small id="infoState">(Croissant sur ID)</small></h3>
            </div>
            <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-ms-6 col-xs-6">
                            <h5>Vous pouvez cliquer sur les Titres des colonnes pour obtenir une recherche plus approprié à vos attentes.</h5>
                        </div>
                         <div class="col-lg-6 col-ms-6 col-xs-6">
                            <h5 >Nombre de joueurs/pages: <input style="margin-top:3px;" type="number" onchange="setMaxShow('input-changemax')" id="input-changemax" min="1" max="<?php echo count($membres); ?>" step="1" class="input-disabled form-control"  value="<?php echo count($membres)>50 ? '50':count($membres) ; ?>" ></h5>
							<h5  style="margin-top:20px;">Rechercher un joueur: <input style="margin-top:3px;" type="text" onkeyup="updateList();" id="input-search" class="input-disabled form-control"  placeholder="ex: Vladimir" ></h5>
                         </div>
                        <div class="col-lg-12">
                            <h3>Modifier des membres</h3>
                        </div>
                    </div>
                    <table class="table table-striped table-hover" >
                       <thead>
					   <tr>
					        <th style="width:75px;cursor:pointer;" onclick="setAxe('id')">ID</th>
						   <th style="cursor:pointer;" onclick="setAxe('pseudo');">Pseudo</th>
						   <th style="cursor:pointer;" onclick="setAxe('email');">Email</th>
						   <th style="cursor:pointer;" onclick="setAxe('tokens');">Jetons</th>
						   <th style="cursor:pointer;" onclick="setAxe('rang');">Rang</th>
						   <th>Mot de passe</th>  
						   <th style="cursor:pointer;" onclick="setAxe('ValidationMail');">Valid. manuelle</th>
						   <th>Suppression</th> 
					   </tr>
                       </thead>
					   <tbody id="allUser">
					   </tbody>
                    </table>
                    <div class="row">
						<div class="col-md-12 text-center" style="margin-top: 5px;display:inline;">
							<button type="button" style="float:left;" class="btn btn-success"  onclick="lessIndex();" id="left" ><i  class="fa fa-chevron-left" aria-hidden="true"></i></button>
							<input class="btn btn-success" style="text-align:center;" min="0" step="1" max ="9999" onchange="setIndex();" id="block" type="number" value="0"/>
							<button type="button" style="float:right;" class="btn btn-success" onclick="moreIndex();"  id="right" ><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
                        </div>
                         <div class="col-md-12 text-center" style="margin-top: 5px;">
                            <button class="btn btn-success animated bounce infinite" id="confirm-change" onclick="sendChange()" disabled>Modifier le / les comptes</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<script>
var maxShow;
var oldmaxShow;
var index;
var ChangeButton = document.getElementById("confirm-change");
var block;
var right = document.getElementById("right");
var left = document.getElementById("left");
var valindex = document.getElementById("block");
var allChange = {};
var PlayerTotal = <?php echo count($membres); ?>;
var axe = "id";
var grade = new Map();
var axeType = "ASC"; /* ASC = croissant && DESC = !ASC */


$(window).on('load', function () {
    maxShow =oldmaxShow= <?php echo count($membres)>50 ? '50':count($membres) ; ?>;
    index = 0;
    grade.set(0, "Joueur");
    <?php if($_Joueur_['rang'] == 1) { ?>grade.set(1, "Créateur");<?php }
	for($j = 2; $j <= max($lastGrade); $j++) {
		if(file_exists($dirGrades.$j.'.yml') && $idGrade[$j]['Grade']) { ?>
		 grade.set(<?php echo $j; ?>, <?='"'.$idGrade[$j]['Grade'].'"'?>);
		<?php }
	} ?>
    updateIndex();
});


function setIndex(){
    let nb = valindex.value;

    if(nb <= PlayerTotal / maxShow){
        index = nb;
    } else {
        valindex.value = index =  Math.trunc(PlayerTotal / maxShow) ;
    }
	
    updateIndex();
}

function setAxe(a) {
    if(a != axe)
    {
        axe = a;
        axeType = "DESC";
    }
    else {
        axeType = axeType == "DESC" ? "ASC" : "DESC";
    }
    updateList();
}

function updateIndex() {
    left.disabled = index <= 0;
    right.disabled = index + 1 >= PlayerTotal / maxShow;
    updateList();
}

function lessIndex() {
	index--;
    valindex.value = index;
    setIndex();
}

function moreIndex() {
	index++;
    valindex.value = index;
    setIndex();
}

function updateState() {
	document.getElementById("infoState").innerHTML="("+(axeType == "DESC" ? "Décroissant" : "Croissant")+" sur "+axe+")";
}

function updateList()
{
	updateState();
    $.post("admin.php?action=getJsonMember",
    {
        axe: axe,
        axeType: axeType,
        index: index,
		search: document.getElementById("input-search").value,
        max: maxShow
    }, function(data, status){
        if(status != "success")
        {
              notif("error", "Erreur lors du chargement", status, 5000);
        } else {
            try {
                showAll(JSON.parse(data.substring(data.indexOf('[DIV]')+5)));
            } catch(e) {
                notif("error", "Erreur lors du chargement", e, 5000);
            }
        }
    });
}

function notif(type, header, message, time)
{
        toastr[type](message, header)
      toastr.options = {
      				  "closeButton": true,
      				  "debug": true,
      				  "newestOnTop": false,
      				  "progressBar": false,
      				  "positionClass": "toast-top-right",
      				  "preventDuplicates": false,
      				  "onclick": null,
      				  "showDuration": "500",
      				  "hideDuration": "500",
      				  "timeOut": time+"",
      				  "extendedTimeOut": "1000",
      				  "showEasing": "swing",
      				  "hideEasing": "linear",
      				  "showMethod": "fadeIn",
      				  "hideMethod": "fadeOut"
      				}
}

async function showAll(allPlayer) {
    let el = document.getElementById("allUser");
    var all = '';
    for(let i = 0; i < allPlayer.length; i++) {
        all += '<tr class="ligneMembres" id="user'+allPlayer[i].id2+'">';
        all += '<td><input type="number"  class="form-control membres-form" style="padding:1px;text-align:center;"value="'+allPlayer[i].id2+'" disabled></td>';
        if (typeof allChange["id"+allPlayer[i].id2] === 'undefined') {
            all += '<td><input type="text" onkeyup="addChange('+allPlayer[i].id2+')" name="input-pseudo' + allPlayer[i].id2 + '" class="input-disabled form-control membres-form"  value="' + allPlayer[i].pseudo + '" placeholder="Pseudo"></td>';
            all += '<td><input type="text" onkeyup="addChange('+allPlayer[i].id2+')" name="input-email' + allPlayer[i].id2 + '" class="input-disabled form-control membres-form" value="' + allPlayer[i].email + '" placeholder="Email"></td>';
            all += '<td><input type="number" onkeyup="addChange('+allPlayer[i].id2+')" name="input-tokens' + allPlayer[i].id2 + '"class="input-disabled form-control membres-form" value="' + allPlayer[i].tokens + '" placeholder="Jetons"></td>';

            all += '<td><select size="1"  onchange="addChange('+allPlayer[i].id2+')" name="input-rang' + allPlayer[i].id2 + '" class="input-disabled form-control">';
            let it = grade.keys();
            for (let key of it) {
                all += '<option value="' + key + '" ' + (key == allPlayer[i].rang ? 'selected' : '') + '>' + grade.get(key) + '</option>';
            }
            all += '</select></td>';

            all += '<td><input type="password" onkeyup="addChange('+allPlayer[i].id2+')" name="input-password' + allPlayer[i].id2 + '" class="input-disabled form-control membres-form" value="" placeholder="Changer MDP"></td>';

        } else {
            all += '<td><input type="text" onkeyup="addChange('+allPlayer[i].id2+')" name="input-pseudo' + allPlayer[i].id2 + '" class="input-disabled form-control membres-form"  value="' + allChange["pseudo"+allPlayer[i].id2] + '" placeholder="Pseudo"></td>';
            all += '<td><input type="text" onkeyup="addChange('+allPlayer[i].id2+')" name="input-email' + allPlayer[i].id2 + '" class="input-disabled form-control membres-form" value="' + allChange["email"+allPlayer[i].id2] + '" placeholder="Email"></td>';
            all += '<td><input type="number" onchange"addChange('+allPlayer[i].id2+')" onkeyup="addChange('+allPlayer[i].id2+')" min="0" name="input-tokens' + allPlayer[i].id2 + '"class="input-disabled form-control membres-form" value="' + allChange["tokens"+allPlayer[i].id2] + '" placeholder="Jetons"></td>';

            all += '<td><select size="1"  onchange="addChange('+allPlayer[i].id2+')" name="input-rang' + allPlayer[i].id2 + '" class="input-disabledform-control">';
            let it = grade.keys();
            for (let key of it) {
                all += '<option value="' + key + '" ' + (key == allChange["rang"+allPlayer[i].id2] ? 'selected' : '') + '>' + grade.get(key) + '</option>';
            }
            all += '</select></td>';

            all += '<td><input type="password" onkeyup="addChange('+allPlayer[i].id2+')" name="input-password' + allPlayer[i].id2 + '" class="input-disabled form-control membres-form" value="'+allChange["password"+allPlayer[i].id2]+'" placeholder="Changer MDP"></td>';

        }
        if (allPlayer[i].ValidationMail == 0) {
            all += '<td><button class="input-disabled btn btn-danger" onclick="validMail(' + allPlayer[i].id2 + ')" id="validmail' + allPlayer[i].id2 + '" type="button">Valider e-mail</button>';
            all += '<button class="input-disabled btn btn-success" style="display:none;" id="validmail2' + allPlayer[i].id22 + '" type="button" disabled>e-mail validé</button></td>';
        } else {
            all += '<td><button class="input-disabled btn btn-success"  type="button" disabled>e-mail validé</button></td>';
        }
        all += '<td><button onclick="removePlayer('+allPlayer[i].id2+',\''+allPlayer[i].pseudo+'\')" id="suppplayer'+allPlayer[i].id2+'"class="input-disabled btn btn-danger">Supprimer</button></td>';
        all += '</tr>';
    }
    el.innerHTML = all;
	block = document.querySelectorAll(".input-disabled");
}

function addChange(id) {
	    ChangeButton.disabled = false;
	     if (typeof allChange["id"+id] === 'undefined') {
            if (typeof allChange["allid"] === 'undefined') {
                allChange["allid"] = id+"_";
            } else {
                allChange["allid"] += id+"_";
            }
        }
        allChange["id"+id] = id;
        allChange["pseudo"+id] = document.getElementsByName("input-pseudo"+id)[0].value;
        allChange["email"+id] = document.getElementsByName("input-email"+id)[0].value;
        allChange["tokens"+id] = document.getElementsByName("input-tokens"+id)[0].value;
        allChange["rang"+id] = document.getElementsByName("input-rang"+id)[0].value;
        allChange["password"+id] = document.getElementsByName("input-password"+id)[0].value;

}

function sendChange() {
    ChangeButton.disabled = true;
    block.forEach(function(input) {
       input.disabled=true;
    });

    $.post("admin.php?action=modifierMembres", allChange, function(data, status){
        if(status != "success") {
            ChangeButton.disabled = false;
             notif("error", "Erreur", status, 5000);
        }else {
			
            allChange = {};
            ChangeButton.disabled = true;
			notif("success", "Changement éffectué", "", 5000);
        }
        block.forEach(function(input) {
            input.disabled=false;
        });
    });
}

function removePlayer(id, pseudo)
{
    document.getElementById("suppplayer"+id).disabled = true;
    let r = confirm("Vous êtes sur le point de supprimé le compte de "+pseudo+",\n Vous ne pourrez pas revenir en arrière.");
    if(r == true)
    {
        $.get("admin.php", {
            action: "supprMembre",
            id: id
        },async function(data, status){
            if(status != "success") {
                document.getElementById("suppplayer" + id).disabled = false;
                notif("error", "Erreur", status, 5000);
            }else {
                document.getElementById("user"+id).style.display = "none";
                notif("sucess", "Suppression éffectué", status, 5000);
            }
        });
    }
    else {
        document.getElementById("suppplayer" + id).disabled = false;
    }
}

function validMail(id)
{
    document.getElementById("validmail"+id).disabled = true;
    $.get("admin.php", {
        action: "validMail",
        id: id
    },async function(data, status){
        if(status != "success") {
            document.getElementById("validmail"+id).disabled = false;
             notif("error", "Erreur", status, 5000);
        }else {
            document.getElementById("validmail"+id).style.display = "none";
            document.getElementById("validmail2"+id).style.display = "block";
            notif("sucess", "Modification éffectué", status, 5000);
        }
    });
}

function setMaxShow(id) {
    let doc = document.getElementById(id);
    if( parseInt(doc.value) == 2020) { alert("Le Covid-19 ne nous aura pas eu !"); }
    doc.value = parseInt(doc.value) > PlayerTotal ? PlayerTotal : parseInt(doc.value) < 1 ? 1 : doc.value;
    if(oldmaxShow != doc.value){
        oldmaxShow = maxShow = doc.value;
      updateIndex();
    }
}
</script>

<?php } ?>