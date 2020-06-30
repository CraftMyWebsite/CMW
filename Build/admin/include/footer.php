<div class="container-fluid"><div class="row"><div class="cmw-footer">CraftMyWebsite <?php echo $versioncms; ?> ©2014-2020</div></div></div>
<script type="text/javascript">
    $("cmw-header-username").mouseenter(function(){
        $("<audio></audio>").attr({ 
            'src':'./admin/assets/sound/horn.mp3', 
            'volume':0.4,
            'autoplay':'autoplay'
        }).appendTo("cmw-header-username");
    });
</script>
<button class="cmw-egg-1" onClick='javascript:(function(){function c(){var e=document.createElement("link");e.setAttribute("type","text/css");e.setAttribute("rel","stylesheet");e.setAttribute("href",f);e.setAttribute("class",l);document.body.appendChild(e)}function h(){var e=document.getElementsByClassName(l);for(var t=0;t<e.length;t++){document.body.removeChild(e[t])}}function p(){var e=document.createElement("div");e.setAttribute("class",a);document.body.appendChild(e);setTimeout(function(){document.body.removeChild(e)},100)}function d(e){return{height:e.offsetHeight,width:e.offsetWidth}}function v(i){var s=d(i);return s.height>e&&s.height<n&&s.width>t&&s.width<r}function m(e){var t=e;var n=0;while(!!t){n+=t.offsetTop;t=t.offsetParent}return n}function g(){var e=document.documentElement;if(!!window.innerWidth){return window.innerHeight}else if(e&&!isNaN(e.clientHeight)){return e.clientHeight}return 0}function y(){if(window.pageYOffset){return window.pageYOffset}return Math.max(document.documentElement.scrollTop,document.body.scrollTop)}function E(e){var t=m(e);return t>=w&&t<=b+w}function S(){var e=document.createElement("audio");e.setAttribute("class",l);e.src=i;e.loop=false;e.addEventListener("canplay",function(){setTimeout(function(){x(k)},500);setTimeout(function(){N();p();for(var e=0;e<O.length;e++){T(O[e])}},15500)},true);e.addEventListener("ended",function(){N();h()},true);e.innerHTML=" <p>If you are reading this, it is because your browser does not support the audio element. We recommend that you get a new browser.</p> <p>";document.body.appendChild(e);e.play()}function x(e){e.className+=" "+s+" "+o}function T(e){e.className+=" "+s+" "+u[Math.floor(Math.random()*u.length)]}function N(){var e=document.getElementsByClassName(s);var t=new RegExp("\\b"+s+"\\b");for(var n=0;n<e.length;){e[n].className=e[n].className.replace(t,"")}}var e=30;var t=30;var n=350;var r=350;var i="//s3.amazonaws.com/moovweb-marketing/playground/harlem-shake.mp3";var s="mw-harlem_shake_me";var o="im_first";var u=["im_drunk","im_baked","im_trippin","im_blown"];var a="mw-strobe_light";var f="//s3.amazonaws.com/moovweb-marketing/playground/harlem-shake-style.css";var l="mw_added_css";var b=g();var w=y();var C=document.getElementsByTagName("*");var k=null;for(var L=0;L<C.length;L++){var A=C[L];if(v(A)){if(E(A)){k=A;break}}}if(A===null){console.warn("Could not find a node of the right size. Please try a different page.");return}c();S();var O=[];for(var L=0;L<C.length;L++){var A=C[L];if(v(A)){O.push(A)}}})()'>Ne pas cliquer</button>
<script src="./admin/assets/js/jquery.js"></script>
<script src="./admin/assets/js/bootstrap.min.js"></script>
<script src="./admin/assets/js/plugins/morris/raphael.min.js"></script>
<script src="./admin/assets/js/plugins/morris/morris.min.js"></script>
<script src="./admin/assets/js/plugins/morris/morris-data.js"></script>
<script type="text/javascript">
    (function (win, doc) {
        'use strict';
        if (!doc.querySelectorAll || !win.addEventListener) {
        // doesn't cut the mustard.
        return;
    }
    var forms = doc.querySelectorAll('form[method="post"]'),
    formcount = forms.length,
    i,
    submitting = false,
    checkForm = function (ev) {
        if (submitting) {
            ev.preventDefault();
        } else {
            submitting = true;
            this.appendChild(doc.createElement('progress'));
        }
    };
    for (i = 0; i < formcount; i = i + 1) {
        forms[i].addEventListener('submit', checkForm, false);
    }
}(this, this.document));
</script>
<script type="text/javascript">
function cocher(classCheck, appel)
{
    if($(appel).is(':checked'))
    {
        $(':checkbox.'+classCheck).prop('checked', true);
    }
    else
    {
        $(':checkbox.'+classCheck).prop('checked', false);
    }
}

function toutCocher(accordion, appel)
{
    if($(appel).is(':checked'))
    {
        $('#'+accordion+' :checkbox').prop('checked', true);
    }
    else
    {
        $('#'+accordion+' :checkbox').prop('checked', false);
    }
}

function updateFormRecompense(appel)
{
    if($(appel).val() == '1')
    {
        $("#updateRecompense").html("<label class='control-label'>Au bout de combien de vote ?</label><input type='number' name='nbreVote' class='form-control' />");
    }
    else
        $("#updateRecompense").html("<label class='control-label'>Quelle date ?</label><input type='date' name='date' class='form-control' /><label class='control-label'>Réinitialiser les votes après ?</label><select name='reinit' class='form-control'><option value='1'>Oui</option><option value='0'>Non</option></select><label class='control-label'>Rang de la personne</label><select name='rang' class='form-control'><option value='1'>Premier</option><option value='2'>Second</option><option value='3'>Troisième</option></select>");
}
function updateFormServeur(appel)
{
    if($(appel).val() == '2')
    {
        $("#updateFormServeurJSONAPI").css('display', 'none');
        $("#updateFormServeurRcon").css('display', 'block');
    }
    else
    {
        $("#updateFormServeurRcon").css('display', 'none');
        $("#updateFormServeurJSONAPI").css('display', 'block');
    }
}
</script>
<script>
function ajaxPostIt()
{
    $("#formPostIt").append('<progress></progress>');
    $("#post_message").attr("disabled", "true");
    message = $("#post_message").val();
    $.ajax({
        method: "POST",
        url: '?action=creerPostit',
        data: { message: message }
    }).done(function(donnees){
        $("#post_contenue").html(donnees);
        $("#post_message").val('');
        $("#formPostIt").html('<span class="pull-left"><input type="text" name="post-it_message" id="post_message" placeholder="Message (max 50 caractères)" class="form-control" maxlength="50"></span><span class="pull-right"><button type="submit" class="btn btn-success pull-right" onClick="ajaxPostIt;">Envoyer !</button></span>');
    });
}

function ajaxSupprPostIt(id)
{
    $("#"+id).html("<strong><span style='color: red;'>En Suppression ...</span></strong>");
    $.ajax({
        method: "GET",
        url: '?action=supprPostit',
        data: { id: id }
    }).done(function(donnees){
        $("#post_contenue").html(donnees);
    });
}

function showOptions(type)
{
    if($('#options'+type).hasClass("d-none"))
    {
        $("#options"+type).removeClass('d-none');
    }
    else
    {
        $("#options"+type).addClass("d-none");
    }
}

function BoutiqueListePage(page)
{
    $.ajax({
        method: "POST",
        url: '?action=getBoutiqueListe',
        data: { page : page }
    }).done(function(donnees){
        $('#boutiqueListe').html(donnees);
    });
}

function showAvanceeBoutique(option)
{
    if($('#recherche'+option).hasClass("d-none"))
        $("#recherche"+option).removeClass('d-none');
    else
        $("#recherche"+option).addClass('d-none');
}

function getBoutiqueListe(option)
{
    value = $("#"+option).val();
    $.ajax({
        method: "POST",
        url: '?action=getBoutiqueListe',
        data: { option: option, value: value }
    }).done(function(donnees){
        $('#boutiqueListe').html(donnees);
    });
}
</script>
</body>
</html>
