var ps = "";
function initVoteBouton(el, pseudo, id, timePlayer, timeLien, url, name, actionJson) {
    ps = pseudo;
    allBtn.set(el, [pseudo, id, timePlayer, timeLien, url, name, actionJson]);
    if(timePlayer + timeLien < Math.round(Date.now() / 1000)) {
      el.addEventListener("click", startLoopCheckBtn);
      el.className = "btn btn-secondary";
        el.innerText = name;
        el.disabled = false;
    }else {
        el.className = "btn btn-danger";
        el.disabled = true;
        startLoopTimeBtn(el, timePlayer + timeLien);
    }
}

function startLoopTimeBtn(el, time) {
    let btn = allBtn.get(el);
    if(time <= Math.round(Date.now() / 1000) ) {
        el.addEventListener("click", startLoopCheckBtn);
        el.className = "btn btn-secondary";
        el.innerText = btn[5];
        el.disabled = false;
    } else {
        let distance = (time*1000) - Date.now();
        let days = Math.floor(distance / (1000 * 60 * 60 * 24));
        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);
        el.innerText = (days != 0 ? days+"jour"+putS(days)+" " : "")+(hours != 0 ? hours+"heur"+putS(hours)+" " : "")+(minutes != 0 ? minutes+"minutes"+putS(minutes)+" ": "")+(seconds+"seconde"+putS(seconds)+" ")+"restante"+putS(seconds);
        setTimeout(function () {
            startLoopTimeBtn(el, time);
        }, 1000);
    }
}

function putS(nb) {
    return nb > 1 ? "s" : "";
}

var allBtn = new Map();
var runningBtn = new Array();
var recompenseList = new Array();

function startLoopCheckBtn(event, open = true) {
    let btn = allBtn.get(event.target);
    if(open) {
        window.open(btn[4], btn[5], "menubar=no,location=yes,resizable=yes,scrollbars=yes,status=yes");
    }
    event.target.className = "btn btn-reverse";
    event.target.innerHTML = "<span class=\"spinner-border spinner-border-sm mr-2\" role=\"status\" aria-hidden=\"true\"></span>Vérification en cours";
    let flag = false;
    Object.entries(runningBtn).forEach(element => {
        if(element == event.target) {
            flag = true;
        }
    });

    if(!flag) {
        runningBtn.push(event.target);
        $.post("index.php?action=voter", {
            "id": btn[1],
            "pseudo": btn[0]
        }, function (data, status) {
            console.log(data);
            data = data.substring(data.indexOf('[DIV]') + 5);
            if (data == "success") {
                event.target.removeEventListener("click", startLoopCheckBtn, false);
                runningBtn.splice(runningBtn.indexOf(event.target), 1);
                btn[2] = Math.round(Date.now() / 1000)  ;
                recompenseList.push(btn[6]);
                updateRecompenseList();
                updateBaltop();
                event.target.className = "btn btn-danger";
                event.target.disabled = true;
                startLoopTimeBtn(event.target, btn[2] + btn[3]);
            } else {
                setTimeout(function () {
                    runningBtn.splice(runningBtn.indexOf(event.target), 1);
                    startLoopCheckBtn(event, false);
                }, 500);
            }
        });
    }
}

function clearRecompense() {
    recompenseList = array();
    updateRecompenseList();
}

function updateBaltop(loop = false) {
    $.post("index.php?action=getBaltopVote", {}, function (data, status) {
        data = data.substring(data.indexOf('[DIV]') + 5);

        let f = " <thead>"
                   + "<tr>"
                       +"<th>#</th>"
                        +"<th>Pseudo</th>"
                        +"<th>Votes</th>"
                   + "</tr>"
                +"</thead><tbody>";

        if(data != "") {
            let json = JSON.parse(data);
            json.forEach(function(ar, ar2) { 
                    f+= '<tr>'
                        +'<td>'
                            +(ar2+1)
                        +'</td>'
                        +'<td>'
                            +'<img alt="" src="https://api.craftmywebsite.fr/skin/face.php?u='+ar.pseudo+'&s=25" style="height:25px;width:25px" /> <strong>'
                                +'<a href="?page=profil&profil='+ar.pseudo+'">'
                                        +ar.pseudo
                                +'</a>'
                            +'</strong>'
                        +'</td>'
                        +'<td>'
                            +ar.nombre
                        +'</td>'
                    +'</tr>';
            });
        } else {
            f += '<tr class="p-0 no-hover">'
                +'<td colspan="3" class="p-0 no-hover">'
                    +'<div class="m-0 info-page bg-danger">'
                        +'<div class="text-center">Personne n\'a encore voté !</div>'
                            +'</div>'
                        +'</td>'
                    +'</tr>';    
        }
        f += "</tbody>";
        document.getElementById("baltop").innerHTML = f;
        if(loop) {
            setTimeout(function () {
                updateBaltop(true);
            }, 1000);
        }
    });
}

function addRecompense(action) {
    recompenseList.push(action);
}

function updateRecompenseList() {
    let el = document.getElementById("recompList");
    el.innerText = "";
    let item = new Map();
    let custom = 0;
    let jeton = 0;
    recompenseList.forEach(function(i, val) {
           i.forEach(function(value, val2) {
               if(value.type == "item") {
                   if(item.has(value.value)) {
                       item.set(value.value, parseInt(item.get(value.value)) + parseInt(value.value2));
                   } else {
                       item.set(value.value, parseInt(value.value2));
                   }
               } else if(value.type == "commande") {
                    custom++;
               }else if(value.type == "jeton") {
                   jeton += parseInt(value.value);
               }/*else if(value.type == "message") {
                   custom++;
               }*/
        });
    });

    if(item.size != 0) {
        item.forEach(function(value, val2) { 
            el.innerHTML += "<li>"+value+" item"+putS(value)+" avec l'id "+val2+"</li>";
        });
    }
    if(custom != 0) {
        el.innerHTML += "<li>"+custom+" récompense"+putS(custom)+" surprise !</li>";
    }
    if(jeton != 0) {
        el.innerHTML += "<li>"+jeton+" jeton"+putS(jeton)+" boutique !</li>";
        hasJeton = true;
    } else {
        hasJeton = false
    }

    if(item.size == 0 && jeton == 0 && custom == 0) {
        document.getElementById("disprecompList").style.display="none";
    } else {
         document.getElementById("disprecompList").style.display="block";
        el.innerHTML += "<button type='button' class='btn btn-success' onclick='pickupRecompense();' title='Récupérer mes récompenses'>Récupérer mes récompenses (Connectez-vous sur le serveur)</button>";
    }
}

var hasJeton = false;
var isConnect = false;
function pickupRecompense() {
    if(hasJeton && !isConnect) {
        var r = confirm("Les jetons peuvent être obtenue seulement si vous êtes connecté sur le compte '"+ps+"' sur le site web, sinon ils seront perdu, voulez vous quand même continuer ?");
        if (r == true) 
        {
            $.post("index.php?action=recupVotesTemp", {}, function (data, status) {
                let el = document.getElementById("recompList");
                el.innerText = "Récompenses envoyé !";
                setTimeout(function () {
                    document.getElementById("disprecompList").style.display="none";
                }, 3000);
            });
        }
    } else {
        $.post("index.php?action=recupVotesTemp", {}, function (data, status) {
            let el = document.getElementById("recompList");
            el.innerText = "Récompenses envoyé !";
            setTimeout(function () {
                document.getElementById("disprecompList").style.display="none";
            }, 3000);
        });
    }
}
setTimeout(function () {updateBaltop(true) }, 500);