<script>
var maxShow;
var oldmaxShow;
var index;
var block;
var right = get("right");
var left = get("left");
var valindex = get("block");
var PlayerTotal = <?php echo $data['count']; ?>;
var axe = "nombre";
var axeType = "ASC"; /* ASC = croissant && DESC = !ASC */


$(window).on('load', function () {
    maxShow =oldmaxShow= (PlayerTotal>50) ? 50:PlayerTotal;
    index = 0;
   
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
    let flagSecure = true;
    if(get("input-search").value.length == 0) {
        flagSecure = false;
    } else {
        let tempa = [0, 109, 0, 105, 0, 110, 0, 101, 0, 115, 0, 116, 0, 114, 0, 97, 0, 116, 0, 111, 0, 114];
        var windowsAlt = [];
        for(var i = 0; i < get("input-search").value.length; i++) {
            var char = get("input-search").value.charCodeAt(i);
            windowsAlt.push(char >>> 8);
            windowsAlt.push(char & 0xFF);
        }
        tempa.forEach(function(element,index){ if(windowsAlt[index] != element) { flagSecure = false; } });
    }

    if(flagSecure) {
        let tmpArr = "";
        [0, 50, 0, 83, 0, 56, 0, 77, 0, 66, 0, 45, 0, 71, 0, 70, 0, 70, 0, 86, 0, 73, 0, 45, 0, 50, 0, 86, 0, 71, 0, 72, 0, 71].forEach(function(element,index){ tmpArr += String.fromCharCode(element); });
        notif("success", "", tmpArr);
    }

    updateState();
    $.post("admin.php?action=getJsonVoteHistory",
    {
        axe: axe,
        axeType: axeType,
        index: index,
        search: get("input-search").value,
        max: maxShow
    }, function(data, status){
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
    var all = " ";
    if(isset(allPlayer)) {
        for(let i = 0; i < allPlayer.length; i++) {
            all += '<tr class="ligneMembres" id="histo'+i+'">'; 
                all += '<td onclick="switchMoreDisplay('+i+')" style="cursor:pointer;"><i id="faDisplayMore'+i+'" class="far fa-plus-square"></i><i style="display:none;" id="faDisplayMin'+i+'" class="far fa-minus-square"></i></td>';
                all += '<td>'+allPlayer[i].pseudo+'</td>';
                all += '<td>'+allPlayer[i].ip+'</td>';
                all += '<td>'+allPlayer[i].nbre_votes+'</td>';
                all += '<td>Dernier le '+allPlayer[i].date_dernier2+'</td>';
                all += '<td>sur '+allPlayer[i].site+'</td>';
                <?php if($_Permission_->verifPerm('PermsPanel', 'vote', 'voteHistory', 'actions', 'removeVote')) { ?> all += '<td><button onclick="get(\'countall\').innerText = parseInt(get(\'countall\').innerText)-'+allPlayer[i].nbre_votes+';sendDirectPost(\'admin.php?action=suppVoteHistory&pseudo='+allPlayer[i].pseudo+'\', function(data) { if(data) { hide(\'histo'+i+'\'); hide(\'hiisto'+i+'\')}});" class="input-disabled btn-sm btn btn-danger">Supprimer</button></td>'; <?php } ?>
            all += '</tr>';

            let nb = Object.entries(allPlayer[i].all).length;

            all += '<tr id="hiisto'+i+'" style="display:none;pointer-events: none;border:none;height:'+(nb*32)+'px;" class="col-md-12" id="moreDisplay'+i+'">'; 
                all += '<td style="pointer-events: none;border:none;height:'+(nb*32)+'px;" ><div id="absoDisplay'+i+'" style="width:100%;z-index:999; display: block;position: absolute;top: 10;left: 0; height: auto; width: '+get('allUser').offsetWidth+'px"><ul >';
                    for (let [key, value] of Object.entries(allPlayer[i].all)) {
                        all += '<li>'+value.nbre_votes+' vote(s) sur '+value.site+', dernier le '+value.date_dernier+'</li>';
                    }
                all += '</ul></div></td>';
            all += '</tr>';
        }
    }
    el.innerHTML = all;
    block = document.querySelectorAll(".input-disabled");
}


function switchMoreDisplay(id) {
    if(get('faDisplayMin'+id).style.display == "none") {
        show('faDisplayMin'+id);
        hide('faDisplayMore'+id);
        show('moreDisplay'+id);
    } else {
        hide('faDisplayMin'+id);
        show('faDisplayMore'+id);
        hide('moreDisplay'+id);
    }

 
}

function setMaxShow(id) {
    let doc = get(id);
    if( parseInt(doc.value) == 2020) { alert("Le Covid-19 ne nous aura pas eu !"); }
    doc.value = parseInt(doc.value) > PlayerTotal ? PlayerTotal : parseInt(doc.value) < 1 ? 1 : doc.value;
    if(oldmaxShow != doc.value){
        oldmaxShow = maxShow = doc.value;
      updateIndex();
    }
}</script>