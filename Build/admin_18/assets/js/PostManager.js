var allForm = {};
var allUrl = {};
var allCallBack = {};
var errorForm ={};

function initPost(idform, url, callBack) {
    let form = document.getElementById(idform);
    allForm[idform] = new Map();
    allUrl[idform] = url;
    allCallBack[idform] = callBack;
    console.log('init: '+idform);
    if(isset(form)) {
        loopChild(form, idform);
    } 
}



function loopChild(form, idform) {
    for (let i = 0; i < form.children.length; i++) {
        if(isset(form.children[i].name))
        {
            if(form.children[i].type == "radio") {
                if(allForm[idform].has(form.children[i].name))
                {
                    allForm[idform].get(form.children[i].name).push(form.children[i]);
                    console.log('add: '+form.children[i].name+' as radio value:'+form.children[i].value );
                } else {
                    allForm[idform].set(form.children[i].name, [ form.children[i] ]);
                    console.log('add: '+form.children[i].name+' as first radio value:'+form.children[i].value );
                }
            } else {
                allForm[idform].set(form.children[i].name, form.children[i]);
                console.log('add: '+form.children[i].name);
            }

        }
        loopChild(form.children[i], idform);
    }
}

function get(id) { return document.getElementById(id);}


function sendDirectPost(url, callback) {
    var returnData = false;
    $.post(url, {}, function(data, status) {
        console.log("post: "+url+" data:"+data)
        if (status == "success") {
            returnData = true;
            notif("success", "Action effectué !","");
        } else {
            notif("error", "Erreur", status);
        }
        if(isset(callback)) {
            callback(returnData);
        }
    });
}

function sendPost(idform, callback) {
    let it = allForm[idform].keys();
    let postData = {};
    for (let key of it) {
        if(!Array.isArray(allForm[idform].get(key))) {
            if(allForm[idform].get(key).required && (allForm[idform].get(key).type=="checkbox" |allForm[idform].get(key).type=="text" |allForm[idform].get(key).type=="password" |allForm[idform].get(key).type=="number" |allForm[idform].get(key).type=="email" )&& (!isset(allForm[idform].get(key).value) | allForm[idform].get(key).value.replace(" ", "") == ""))
            { 
                errorForm[idform] = [];
                let it2 = allForm[idform].keys();
                for (let op of it2) {
                    if(allForm[idform].get(op).required && (allForm[idform].get(op).type=="text" |allForm[idform].get(op).type=="password"|allForm[idform].get(key).type=="number" |allForm[idform].get(op).type=="email" )&& (!isset(allForm[idform].get(op).value) | allForm[idform].get(op).value.replace(" ", "") == ""))
                    { 
                        errorForm[idform].push(allForm[idform].get(op));
                        allForm[idform].get(op).className += " input-red";
                    }
                }
                notif("warning", "Erreur", "Formulaire incomplet");
                return;
            }
            if(allForm[idform].get(key).id == "ckeditor")
            {
                postData[key] = allForm[idform].get(key).innerHTML;
                console.log(key+"-ckeditor-"+allForm[idform].get(key).innerHTML);
            } else {
                if((allForm[idform].get(key).type == "checkbox" && !allForm[idform].get(key).checked))
                {

                } else if(isset(allForm[idform].get(key).value)){
                    console.log(key+"-"+allForm[idform].get(key).value);
                    postData[key] = allForm[idform].get(key).value;
                }
            }
        } else {
            for (let rad of allForm[idform].get(key)) {
                if(rad.checked) {
                    postData[key] = rad.value;
                    console.log(key+"-radio-"+rad.value);
                }
            }
        }
    }
    if(isset(errorForm[idform])) {
        for (let el of errorForm[idform]) {
            el.className = el.className.replace(" input-red", "");
        }
        delete errorForm[idform];
    }
    for (let key of it) {
        allForm[idform].get(key).disabled = true;
    }
    var returnData = false;
    $.post(allUrl[idform], postData, function(data, status) {
        console.log("post: "+allUrl[idform]+" data:"+data)
        if (status == "success") {
            returnData = true;
            notif("success", "Action effectué !","");
        } else {
            notif("error", "Erreur", status);
        }
        if(isset(allCallBack[idform])) {
            allCallBack[idform](returnData);
        }
    });
    it = allForm[idform].keys();
    for (let key of it) {
        allForm[idform].get(key).disabled = false;
    }
    if(isset(callback)) {callback()};
}

function clearAllInput(idform) {
    let it = allForm[idform].keys();
    for (let key of it) {
        if(allForm[idform].get(key).type == "text")
        {
            allForm[idform].get(key).value = "";
        }
    }
}

function getValueByName(idform, name) {
    let it = allForm[idform].keys();
    for (let key of it) {
        if(key == name) {
            return allForm[idform].get(key).value;
        }
    }
}

function updateCont(action, el, callback) {
    $.post(action, {}, function(data, status) {
        if (status == "success") {
            data = data.substring(data.indexOf('[DIV]')+5);
            el.innerHTML = data;
           if(isset(callback)) {callback()};
        } else {
            notif("error", "Erreur", status);
        }
    });
}

function SwitchDisplay(el) {
    if(el.style.display == 'none') {
        el.style.display ='block';
    } else {
        el.style.display ='none';
    }
}
function Switch(el, el1, el2 )
{
    if(el.innerText == el1) {
        el.innerText = el2;
    } else {
        el.innerText = el1;
    }
}

function hide(el) {
    get(el).style.display = 'none';
}

function show(el) {
    get(el).style.display = 'block';
}

function notif(type, header, message)
{
     toastr[type](message, header);
}
function isset(obj) {
    return typeof obj !== 'undefined' && obj !== null;
}

function initPostCallback(callback) {
    var list = document.querySelectorAll('[data-callback]');
    for (var i = 0; i < list.length; ++i) {
        console.log("try callback "+list[i]);
        initPost(list[i].getAttribute("data-callback"), list[i].getAttribute("data-url"), callback);
    }
}