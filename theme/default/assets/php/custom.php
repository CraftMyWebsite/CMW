<script type="application/javascript">
    
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
    function notif(type,message, header)
    {
         toastr[type](message, header);
    }

    function notif2(header, message, type) {
        toastr[type](message, header);
    }

    $('#NomForum').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var ancienNom = button.data('nom');
        var icone = button.data('icone');
        var id = button.data('id');
        var entite = button.data('entite');
        var modal = $(this)
        modal.find('.modal-body #nom').val(ancienNom);
        modal.find('.modal-body #icone').val(icone);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #entite').val(entite);
    });

    //Other

    <?php
    if (!empty($_Serveur_['General']['ipTexte'])) : ?>

        function copierIP() {
            var copyText = document.getElementById("iptexte");
            copyText.select();
            document.execCommand("copy");
            notif("success", "Vous avez copié l\'adresse IP du serveur !");
        }

    <?php endif; ?>

    //Scripts de page

    <?php if (isset($_GET['page']) && $_GET['page'] == 'membres') : //Recherche de membres dans la page membre 
    ?>

        function rechercheAjaxMembre() {
            $("#tableMembre").html("<td><i class='fas fa-spinner loading mx-2'></i> Recherche en cours...</td>");
            $.ajax({
                url: 'index.php?action=rechercheMembre',
                type: 'POST',
                data: 'ajax=true&recherche=' + $('#recherche').val(),
                success: function(code, statut) {
                    if(code.length > 0) {
                        $("#tableMembre").html(code)
                    }else {
                        $("#tableMembre").html(`<td class="info-page bg-danger" colspan="5">
                                                    <div class="text-center">
                                                        Aucun joueur trouvé.
                                                    </div>
                                                </td>`)
                    }
                }
            });
        }

    <?php elseif (isset($_GET['page']) && $_GET['page'] == 'chat') : //Gestion du tchat minecraft
    ?>
        setInterval(AJAXActuChat, 10000);

        function AJAXActuChat() {
            <?php for ($i = 0; $i < count($jsonCon); $i++) : ?>
                if ($('#server-<?= $i; ?>').hasClass("active")) {
                    var active = <?= $i; ?>;
                }
            <?php endfor; ?>

            $.ajax({
                url: 'index.php?action=chatActu',
                type: 'POST',
                data: 'ajax=true&active=' + active,
                success: function(code, statut) {
                    let data = JSON.parse(code);
                    let chat = "";
                    for(let j = 0; j < data.length; j++)
                    {
                        if(data[j]['success'] == "query")
                        {
                            chat = '<div class="tab-pane fade in show" aria-expanded="false">\
                                        <div class="info-page bg-danger">\
                                            <div class="text-center">\
                                                La connexion au serveur ne peut pas être établie avec ce protocole.\
                                            </div>\
                                        </div>\
                                    </div>';
                        }
                        else if(data[j]['success'] == "erreur")
                        {
                            chat = '<div class="tab-pane fade in show" aria-expanded="false">\
                                        <div class="info-page bg-info">\
                                            <div class="text-center">\
                                                Aucun message n\'a été envoyé sur ce serveur !\
                                            </div>\
                                        </div>\
                                    </div>';
                        }
                        else if(data[j]['success'] == "true")
                        {
                            dataM = data[j]['msg'];
                            for (var i = 0; i < dataM.length; i++)
                            {
                                if(dataM[i]['pseudo'] == "" || dataM[i]['pseudo'] == 'undefined'  || !dataM[i]['pseudo'])
                                    pseudo ="Console";
                                else
                                    pseudo =dataM[i]['pseudo'];
                                chat+= '<div class="media"> \
                                        <p class="username">\
                                            <img alt="'+pseudo+'" class="mr-3" src="';
                                if(pseudo == "Console")
                                    chat+= "https://craftmywebsite.fr/favicon.ico";
                                else
                                    chat+='https://api.craftmywebsite.fr/skin/face.php?u='+dataM[i]["pseudo"]+'&s=32';
                                chat+= '" style="width: 32px; height: 32px;" alt="avatar de l\'auteur" />\
                                            <div class="media-body">\
                                                <h5 class="mt-0">';
                                chat+=pseudo;
                                chat+='<small class="font-weight-light float-right text-muted">'+dataM[i]['date']+'</small>\
                                        </h5>'+dataM[i]['message']+'</div>\
                                </p>\
                            </div>';
                            }
                        }
                        else
                        {
                            chat = '<div class="tab-pane fade in show" aria-expanded="false">\
                                        <div class="info-page bg-danger">\
                                            <div class="text-center">\
                                                La connexion au serveur n\'a pas pu être établie.\
                                            </div>\
                                        </div>\
                                    </div>';
                        }
                        $("#msgChat"+i).html(chat);
                        chat = "";
                    }
                }
            });
        }

    <?php elseif (isset($_GET['page']) && $_GET['page'] == 'profil') : //Pour la page de profil 
    ?>
        previewTopic($("#signature"));

    <?php endif; ?>

    //Notifications

    <?php if(isset($_GET["ActivateSuccess"])){ ?>
        notif('success','Votre compte vient d\'être activé avec succès.');
    <?php } elseif(isset($_GET["WaitActivate"])) { ?>
            notif('warning', 'Un mail vient de vous être envoyé pour l\'activation de votre compte. Vérifiez dans les Courriers indésirables.');
    <?php } elseif(isset($_GET["ActivateImpossible"])) { ?>
            notif('error', 'Votre compte ne peut être activé.');
    <?php } elseif(isset($_GET["MessageEnvoyer"])) { ?>
            notif('success','Votre commentaire vient d\'être envoyé.');
    <?php } elseif(isset($_GET["MessageTropLong"])) { ?>
            notif('error', 'Votre commentaire est trop long.');
    <?php } elseif(isset($_GET["MessageTropCourt"])) { ?>
            notif('error','Votre commentaire est trop court.');
    <?php } elseif(isset($_GET["NotOnline"])) { ?>
            notif('error','Vous n\'êtes pas connecté.');
    <?php } elseif(isset($_GET["NewsNotExist"])) { ?>
            notif('error', 'Cette nouveauté n\'existe pas.');
    <?php } elseif(isset($_GET["TicketNotExist"])) { ?>
            notif('error','Ce ticket n\'existe pas.');
    <?php }elseif(isset($_GET["EditCommentaire"]) ) { ?>
            notif('success','Le commentaire a été édité !');
    <?php } elseif(isset($_GET["CommentaireNotExist"])) { ?>
            notif('error','Ce commentaire n\'existe pas.');
    <?php } elseif(isset($_GET["LikeExist"])) { ?>
            notif('error','Votre mention j\'aime est déjà existante.');
    <?php } elseif(isset($_GET["LikeAdd"])) { ?>
            notif('success', 'Votre mention j\'aime vient d\'être envoyée.');
    <?php } elseif(isset($_GET["SuppressionCommentaire"])) { ?>
            notif('success','Votre commentaire vient d\'être supprimé.');
    <?php } elseif(isset($_GET["SuppressionImpossible"])) { ?>
            notif('error','Le commentaire ne peut être supprimé.');
    <?php }elseif(isset($_GET["MessageEditer"])) { ?>
            notif('success','Le commentaire a été édité.');
    <?php }elseif(isset($_GET["EditImpossible"])) { ?>
            notif('error','Le commentaire ne peut pas être édité.');
    <?php }elseif(isset($_GET["NotReportYourSelf"])) { ?>
            notif('error','You are stupid.');
    <?php }elseif(isset($_GET["ReportVictimeExist"])) { ?>
            notif('error','Vous ne pouvez pas report plusieurs fois.');
    <?php }elseif(isset($_GET["ReportEnvoyer"])) { ?>
            notif('success','Report envoyer !');
    <?php }elseif(isset($_GET["PlayerNotExist"])) { ?>
            notif('error','L\'utilisateur n\'éxiste pas.');
    <?php }  elseif(isset($_GET["postSignalement"])) { ?>
            notif('success','Le signalement a bien été envoyé.');
    <?php }  elseif(isset($_GET["Connection"])) { ?>
            notif('success','Connection réussie !');
     <?php }  elseif(isset($_GET["Register"])) { ?>
            notif('success','Bienvenue sur <?=$_Serveur['General']['name']?> !');
        <?php } ?>


    <?php if (isset($_GET['setTemp']) && $_GET['setTemp'] == 1) { //Envoie d'un mot de passe nouveau 
    ?>
        window.onload = function() {
            notif("success", "Votre nouveau mot de passe vous a été envoyé par mail!");
        }
    <?php } ?>

    <?php if (isset($_Joueur_)) { //Système d'alerte 
    ?>
        setInterval(ajax_alerts, 10000);

        function ajax_alerts() {
            var url = '?action=get_alerts';
            $.post(url, function(data) {
                alerts.innerHTML = data;
                ajax_new_alerts();
            });
        }

        function ajax_new_alerts() {
            var url = '?action=new_alert';
            $.post(url, function(donnees) {
                if (donnees > 0) {
                    window.onload = function() {
                        var message = "Vous avez " + donnees + " nouvelles alertes.";
                        notif2("Message Système", message, "info");
                    }
                }
            });
        }
    <?php } ?>

    <?php if (Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'seeSignalement')) { //Système de signalement 
    ?>
        setInterval(ajax_signalement, 10000);

        function ajax_signalement() {
            var url = '?action=get_signalement';
            $.post(url, function(signalement) {
                if (signalement > 0) {
                    window.onload = function() {
                        signalement.innerHTML = signalement;
                        var message = "Il y'a " + signalement + " nouveaux signalements !";
                         notif2("Message Système",message,"info");
                    }
                }
            });
        }
    <?php } ?>

    <?php if (isset($_GET['envoieMail'])) { //Récupération de compte 
    ?>
       $(document).ready(function() {
            notif2("Message Système", "Un mail de récupération a bien été envoyé !", "success");
        });

    <?php } if (isset($_GET['page']) && $_GET['page'] == "token" && isset($_GET['successDedipass'])) { 
    ?>
        $(document).ready(function() {
            notif2("Dedipass", "Votre paiement a bien été effectué !", "success");
        });

    <?php } if (isset($_GET['page']) && $_GET['page'] == "token" && isset($_GET['errorDedipass'])) { 
    ?>
        $(document).ready(function() {
            notif2("Dedipass", "Votre paiement n'a pas pu être éffectué.", "error");
        });

    <?php } if (isset($_GET['page']) && $_GET['page'] == "panier" && $_GET['success']) { 
    ?>
        $(document).ready(function() {
            notif2("Boutique", "Vos achats ont été validé.", "success");
        });
    <?php } if (isset($_GET['page']) && $_GET['page'] == "boutique" && $_GET['ajout']) { 
    ?>
        $(document).ready(function() {
            notif2("Boutique", "Article ajouter dans le panier.", "success");
        });
    <?php } if (isset($_GET['page']) && $_GET['page'] == "chat" && $_GET['success']) { 
    ?>
        $(document).ready(function() {
            notif2("Chat", "Message envoyé.", "success");
        });
    <?php } if (isset($_GET['page']) && $_GET['page'] == "chat" && $_GET['erreur']) {  
    ?>
        $(document).ready(function() {
            notif2("Chat", "Le message n'a pas pu être envoyé.", "error");
        });
    <?php } if (isset($_GET['page']) && $_GET['page'] == "forum" && $_GET['postSignalement']) {  
    ?>
        $(document).ready(function() {
            notif2("Forum", "Signalement envoyé !", "success");
        });
    <?php } ?>
</script>
