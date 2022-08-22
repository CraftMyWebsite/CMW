<script>
var maxShow;
var oldmaxShow;
var index;
var ChangeButton = get("confirm-change");
var block;
var right = get("right");
var left = get("left");
var valindex = get("block");
var allChange = {};
var PlayerTotal = <?php echo count($membres); ?>;
var axe = "id";
var grade = new Map();
var axeType = "ASC"; /* ASC = croissant && DESC = !ASC */
var canEdit = <?php echo $_Permission_->verifPerm('PermsPanel', 'members', "actions","editMember") ? 'true' : 'false'; ?>


$(window).on('load', function () {
    maxShow = oldmaxShow = <?php echo count($membres) > 50 ? '50' : count($membres); ?>;
    index = 0;
    grade.set(0, "Joueur");
    <?php if ($_Joueur_['rang'] == 1) {
        echo 'grade.set(1, "Créateur");';
    }
    foreach ($idGrade as $key => $value) {
        // Skip les grades avec comme id numéro 0 (Joueur) et 1 (Créateur) qui viendrait de la base de donnée
        if ($value['id'] != 0 && $value['id'] != 1) {
            echo 'grade.set(' . $value['id'] . ', "' . $value['nom'] . '");';
        }
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
	get("infoState").innerHTML="("+(axeType == "DESC" ? "Décroissant" : "Croissant")+" sur "+axe+")";
}

function updateList()
{
	updateState();
    $.post("admin.php?action=getJsonMember",
    {
        axe: axe,
        axeType: axeType,
        index: index,
		search: get("input-search").value,
        max: maxShow
    }, function(data, status){
        console.log(data);
        if(status != "success")
        {
              notif("error", "Erreur lors du chargement", status);
        } else {
            try {
                if(data.includes('[DIV]')) {
                    let cont = data.substring(data.indexOf('[DIV]')+5);
                    if(isset(cont) && cont != "") {
                         showAll(JSON.parse(cont));
                    }
                }
            } catch(e) {
                notif("error", "Erreur lors du chargement", e);
            }
        }
    });
}

async function showAll(allPlayer) {
    let el = get("allUser");
    var all = '';
    if(isset(allPlayer)) {
        for(let i = 0; i < allPlayer.length; i++) {
            all += '<tr class="ligneMembres" id="user'+allPlayer[i].id2+'">';
            all += '<td><input type="number"  class="form-control membres-form" style="padding:1px;text-align:center;"value="'+allPlayer[i].id2+'" disabled></td>';
            if (typeof allChange["id"+allPlayer[i].id2] === 'undefined') {
                all += '<td><input type="text" onkeyup="addChange('+allPlayer[i].id2+')" name="input-pseudo' + allPlayer[i].id2 + '" class="input-disabled form-control membres-form"  value="' + allPlayer[i].pseudo + '" placeholder="Pseudo"></td>';
                all += '<td><input type="text" onkeyup="addChange('+allPlayer[i].id2+')" name="input-email' + allPlayer[i].id2 + '" class="input-disabled form-control membres-form" value="' + allPlayer[i].email + '" placeholder="Email"></td>';
                all += '<td><input type="number" onkeyup="addChange('+allPlayer[i].id2+')" name="input-tokens' + allPlayer[i].id2 + '"class="input-disabled form-control membres-form" value="' + allPlayer[i].tokens + '" placeholder="<?=$_Serveur_['General']['moneyName'];?>"></td>';

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
                all += '<td><input type="number" onchange"if(parseInt(this.value) < 1 ) { this.value = 0;}addChange('+allPlayer[i].id2+')" onkeyup="if(parseInt(this.value) < 1 ) { this.value = 0;}addChange('+allPlayer[i].id2+')" min="0" name="input-tokens' + allPlayer[i].id2 + '"class="input-disabled form-control membres-form" value="' + allChange["tokens"+allPlayer[i].id2] + '" placeholder="<?=$_Serveur_['General']['moneyName'];?>"></td>';

                all += '<td><select size="1"  onchange="addChange('+allPlayer[i].id2+')" name="input-rang' + allPlayer[i].id2 + '" class="input-disabledform-control">';
                let it = grade.keys();
                for (let key of it) {
                    all += '<option value="' + key + '" ' + (key == allChange["rang"+allPlayer[i].id2] ? 'selected' : '') + '>' + grade.get(key) + '</option>';
                }
                all += '</select></td>';

                all += '<td><input type="password" onkeyup="addChange('+allPlayer[i].id2+')" name="input-password' + allPlayer[i].id2 + '" class="input-disabled form-control membres-form" value="'+allChange["password"+allPlayer[i].id2]+'" placeholder="Changer MDP"></td>';

            }
            if(canEdit) {
                if (allPlayer[i].ValidationMail == 0) {
                    all += '<td><button class="input-disabled btn btn-danger w-100" style="display: block !important" onclick="validMail(' + allPlayer[i].id2 + ')" id="validmail' + allPlayer[i].id2 + '" type="button" title="Cliquer pour valider l\'email de cette personne manuellement"><i class="fas fa-exclamation-triangle"></i></button>';
                    all += '<button class="input-disabled btn btn-block btn-success" style="display:block;" id="validmail2' + allPlayer[i].id22 + '" type="button" disabled>Validé</button></td>';
                } else {
                    all += '<td><button class="input-disabled btn btn-block btn-success"  type="button" style="display: inline !important" disabled>Validé</button></td>';
                }
                all += '<td><button onclick="removePlayer('+allPlayer[i].id2+',\''+allPlayer[i].pseudo+'\')" id="suppplayer'+allPlayer[i].id2+'"class="input-disabled btn-sm btn btn-danger">Supprimer</button></td>';
            }
            all += '</tr>';
        }
    }
    el.innerHTML = all;
	block = document.querySelectorAll(".input-disabled");
}

function addChange(id) {
    if(canEdit) {
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
}

function sendChange() {
    ChangeButton.disabled = true;
    block.forEach(function(input) {
       input.disabled=true;
    });

    $.post("admin.php?action=modifierMembres", allChange, function(data, status){
        if(status != "success") {
            ChangeButton.disabled = false;
             notif("error", "Erreur", status);
        }else {
			
            allChange = {};
            ChangeButton.disabled = true;
			notif("success", "Changement éffectué", "");
        }
        block.forEach(function(input) {
            input.disabled=false;
        });
    });
}

function removePlayer(id, pseudo)
{
    get("suppplayer"+id).disabled = true;
    let r = confirm("Vous êtes sur le point de supprimé le compte de "+pseudo+",\n Vous ne pourrez pas revenir en arrière.");
    if(r == true)
    {
        $.get("admin.php", {
            action: "supprMembre",
            id: id
        },async function(data, status){
            if(status != "success") {
                get("suppplayer" + id).disabled = false;
                notif("error", "Erreur", status);
            }else {
                get("user"+id).style.display = "none";
                notif("sucess", "Suppression éffectué", status);
            }
        });
    }
    else {
        get("suppplayer" + id).disabled = false;
    }
}

function validMail(id)
{
    get("validmail"+id).disabled = true;
    $.get("admin.php", {
        action: "validMail",
        id: id
    },async function(data, status){
        if(status != "success") {
            get("validmail"+id).disabled = false;
             notif("error", "Erreur", status, 5000);
        }else {
            get("validmail"+id).style.display = "none";
            get("validmail2"+id).style.display = "block";
            notif("sucess", "Modification éffectué", status);
        }
    });
}

function setMaxShow(id) {
    let doc = get(id);
    if( parseInt(doc.value) == 2020) { alert("Le Covid-19 ne nous aura pas eu !"); }
    doc.value = parseInt(doc.value) > PlayerTotal ? PlayerTotal : parseInt(doc.value) < 1 ? 1 : doc.value;
    if(oldmaxShow != doc.value){
        oldmaxShow = maxShow = doc.value;
      updateIndex();
    }
}
</script>
