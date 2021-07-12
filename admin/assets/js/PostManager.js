var allForm = {};
var allUrl = {};
var allCallBack = {};
var errorForm ={};


var log = true;

function clog(s) {
    if(log) {
        console.log(s);
    }
}

function initPost(idform, url, callBack) {
    let form = document.getElementById(idform);
    allForm[idform] = new Map();
    allUrl[idform] = url;
    allCallBack[idform] = callBack;
    clog('init: '+idform);
    if(isset(form)) {
        loopChild(form, idform);
    } 
}




function loopChild(form, idform) {
    for (let i = 0; i < form.children.length; i++) {
        if(isset(form.children[i].name) && form.children[i].name != "")
        {
            if(form.children[i].type == "radio") {
                if(allForm[idform].has(form.children[i].name))
                {
                    allForm[idform].get(form.children[i].name).push(form.children[i]);
                    clog('add: '+form.children[i].name+' as radio value:'+form.children[i].value );
                } else {
                    allForm[idform].set(form.children[i].name, [ form.children[i] ]);
                    clog('add: '+form.children[i].name+' as first radio value:'+form.children[i].value );
                }
            } else {
                allForm[idform].set(form.children[i].name, form.children[i]);
                clog('add: '+form.children[i].name);
            }

        }
        loopChild(form.children[i], idform);
    }
}

function get(id) { return document.getElementById(id);}

function getEach(element, callBack) {
    for (let el of document.querySelectorAll( element )) {
        callBack(el);
    }
}

function sendDirectPost(url, callback, sendData) {
    var returnData = false;
    $.post(url, {}, function(data, status) {
        clog("post: "+url+" data:"+data)
        if (status == "success") {
            returnData = true;
            if(isset(sendData) && sendData === true)
            {
                if(jsonDataIsOk(data))
                {
                    notif("success", "Action effectuée !","");
                }
                else
                {
                    notif("error", "Erreur !", donneesRetour['message']);
                }
            }
            else
            {
                notif("success", "Action effectuée !","");
            }
        } else {
            notif("error", "Erreur", status);
        }
        if(isset(callback)) {
            if(isset(sendData) && sendData === true) {
                callback(returnData, data);
            } else {
                callback(returnData);
            }
        }
    });
}

function jsonDataIsOk(data) {
    donneesRetour = JSON.parse(data);
    return donneesRetour['retour'] == "OK";
}

function removePost(idform, del) {
    allForm[idform].delete(del);
}

function sendPost(idform, callback, sendData) {
    let it = allForm[idform].keys();
    let postData = {};
    for (let key of it) {
        if(!Array.isArray(allForm[idform].get(key))) {
            if(allForm[idform].get(key).hasAttribute('required') && (allForm[idform].get(key).type=="checkbox" |allForm[idform].get(key).type=="text" |allForm[idform].get(key).type=="password" |allForm[idform].get(key).type=="number" |allForm[idform].get(key).type=="email" )&& (!isset(allForm[idform].get(key).value) | allForm[idform].get(key).value.replace(" ", "") == ""))
            { 
                errorForm[idform] = [];
                let it2 = allForm[idform].keys();
                for (let op of it2) {
                    if(allForm[idform].get(op).hasAttribute('required') && (allForm[idform].get(op).type=="text" | allForm[idform].get(op).type=="password"|allForm[idform].get(op).type=="number" |allForm[idform].get(op).type=="email" )&& (!isset(allForm[idform].get(op).value) | allForm[idform].get(op).value.replace(" ", "") == ""))
                    { 
                        errorForm[idform].push(allForm[idform].get(op));
                        allForm[idform].get(op).classList.add("input-red");
                    }
                    else if(allForm[idform].get(op).className.includes("input-red") && isset(allForm[idform].get(op).value) && allForm[idform].get(op).value.replace(" ", "") != "")
                    {
                        allForm[idform].get(op).classList.remove("input-red");
                    }
                }
                notif("warning", "Erreur", "Formulaire incomplet");
                return;
            }
           /* if(isset(allForm[idform].get(key).getAttribute("data-role")) && allForm[idform].get(key).getAttribute("data-role")=="tagsinput") 
            {
                postData[key] = $(allForm[idform].get(key)).tagsinput('items');
                clog(key+"-taginput-"+postData[key]);
            } 
            else */ if(allForm[idform].get(key).id == "ckeditor" && allForm[idform].get(key).tagName.toLowerCase() == "textarea") 
            {
                postData[key] = CK.get(allForm[idform].get(key)).getData();
                clog(key+"-ckeditor-"+postData[key]);
            } 
            else if(allForm[idform].get(key).tagName.toLowerCase() == "textarea") 
            {
                postData[key] = allForm[idform].get(key).value;
                clog(key+"-textarea-"+postData[key]);
            } else {
                if((allForm[idform].get(key).type == "checkbox" && !allForm[idform].get(key).checked))
                {

                } else if(isset(allForm[idform].get(key).value)){
                    clog(key+"-"+allForm[idform].get(key).value);
                    postData[key] = allForm[idform].get(key).value;
                }
            }
        } else {
            for (let rad of allForm[idform].get(key)) {
                if(rad.checked) {
                    postData[key] = rad.value;
                    clog(key+"-radio-"+rad.value);
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
        clog("post: "+allUrl[idform]+" data:"+data)
        if (status == "success") {
            returnData = true;
            if(isset(sendData) && sendData === true)
            {
                if(jsonDataIsOk(data))
				{
                    notif("success", "Action effectuée !","");
				}
                else
                {
                    notif("error", "Erreur !", donneesRetour['message']);
                }
            }
            else
			{
                notif("success", "Action effectuée !","");
			}
        } else {
            notif("error", "Erreur", status);
        }
        if(isset(allCallBack[idform])) {
            if(isset(sendData) && sendData === true)
			{
                allCallBack[idform](returnData, data);
			}
            else
			{
                allCallBack[idform](returnData);
			}
        }
    });
    it = allForm[idform].keys();
    for (let key of it) {
        allForm[idform].get(key).disabled = false;
    }
    if(isset(callback)) {
        callback();
    };
}

function clearAllInput(idform) {
    let it = allForm[idform].keys();
    for (let key of it) {
        if(allForm[idform].get(key).type == "text")
        {
            allForm[idform].get(key).value = "";
        } else if(allForm[idform].get(key).id == "ckeditor") {
            CK.get(allForm[idform].get(key)).setData("");
           // removeCK(allForm[idform].get(key));
        }
    }
}

function getValueByName(idform, name) {
    let it = allForm[idform].keys();
    for (let key of it) {
        if(key == name) {
            if(!Array.isArray(allForm[idform].get(key))) {
                return allForm[idform].get(key).value;
            } else {
                for (let rad of allForm[idform].get(key)) {
                    if(rad.checked) {
                        return rad.value;
                    }
                }
            }
        }
    }
}

function getElementByName(idform, name) {
    let it = allForm[idform].keys();
    for (let key of it) {
        if(key == name) {
            return allForm[idform].get(key);
        }
    }
}
function updateCont(action, el, callback) {
    let pre = '<div class="loader-wave-background"></div><div class="loader-wave"></div>';
    el.innerHTML = pre + el.innerHTML;
    $.post(action, {}, function(data, status) {
        if (status == "success") {
            data = data.substring(data.indexOf('[DIV]')+5);
            el.innerHTML = "";
            el.insertAdjacentHTML("afterbegin", data);
           if(isset(callback)) {callback(true)};
        } else {
            el.innerHTML = "";
            el.insertAdjacentHTML("afterbegin", el.innerHTML.substring(73));
            notif("error", "Erreur", status);
             if(isset(callback)) {callback(false)};
        }
    });
}

function SwitchDisplay(el) {
    if(el.style.display == 'none') {
        show(el.id);
    } else {
         hide(el.id);
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

function hide(el, remove = false, callback = null) {
    $("#"+el).hide(300);
    if(remove) {
        setTimeout(function () {
            get(el).parentElement.removeChild(get(el));
			if(isset(callback)) { callback(); }
        }, 301);
    }
}

function show(el) {
    $("#"+el).show(300);
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
        clog("try callback "+list[i]);
        if(isset(list[i].getAttribute("data-js"))) {
            callback = window[list[i].getAttribute("data-js")];
        }
        initPost(list[i].getAttribute("data-callback"), list[i].getAttribute("data-url"), callback);
    }

    list = document.querySelectorAll('[data-callback-loop]');
    for (var i = 0; i < list.length; ++i) {
        clog("try callback loop "+list[i]);
        loopChild(get(list[i].getAttribute("data-callback-loop")),list[i].getAttribute("data-idform"));
    }
}

function registerEvent(el, type, fct) {
    type.forEach(function(event) { el.addEventListener(event, fct); });
}

function configVoteGetMaxVal() {
    for(i = 1; i <= 999; i++) {
        if(!isset(topRec.get(i))) {
            return i;
        }
    }
    return 999;
}
