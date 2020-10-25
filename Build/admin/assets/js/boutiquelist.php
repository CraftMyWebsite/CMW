<script>
var maxShow;
var oldmaxShow;
var index;
var block;
var right = document.getElementById("right");
var left = document.getElementById("left");
var valindex = document.getElementById("block");
var PlayerTotal = <?php echo $data['count']; ?>;
var axe = "id";
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
    document.getElementById("infoState").innerHTML="("+(axeType == "DESC" ? "Décroissant" : "Croissant")+" sur "+axe+")";
}

function updateList()
{
    updateState();
    $.post("admin.php?action=getJsonAchat",
    {
        axe: axe,
        axeType: axeType,
        index: index,
        search: document.getElementById("input-search").value,
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
    let el = document.getElementById("allAchat");
    var all = '';
    if(isset(allPlayer)) {
        for(let i = 0; i < allPlayer.length; i++) {
            all += '<tr class="ligneMembres">';
            all += '<td>'+allPlayer[i].id2+'</td>';
             all += '<td>'+allPlayer[i].pseudo+'</td>';
              all += '<td>'+allPlayer[i].titre+'</td>';
               all += '<td>'+allPlayer[i].prix+'</td>';
                all += '<td>'+allPlayer[i].quantite+'</td>';
                 all += '<td>'+allPlayer[i].prixTotal+'</td>';
                  all += '<td>'+allPlayer[i].date_achat+'</td>';
            all += '</tr>';
        }
    }
    el.innerHTML = all;
    block = document.querySelectorAll(".input-disabled");
}

function setMaxShow(id) {
    let doc = document.getElementById(id);
    if( parseInt(doc.value) == 2020) { alert("Le Covid-19 ne nous aura pas eu !"); }
    doc.value = parseInt(doc.value) > PlayerTotal ? PlayerTotal : parseInt(doc.value) < 1 ? 1 : doc.value;
    if(oldmaxShow != doc.value){
        oldmaxShow = maxShow = doc.value;
      updateIndex();
    }
}</script>