<script>
    
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
            $("#tableMembre").html("<img src='theme/<?= $_Serveur_['General']['theme']; ?>/img/gif-search.gif'>Recherche en cours ...");
            $.ajax({
                url: 'index.php?action=rechercheMembre',
                type: 'POST',
                data: 'ajax=true&recherche=' + $('#recherche').val(),
                success: function(code, statut) {
                    $("#tableMembre").html(code);
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
                                            <img class="mr-3" src="';
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

    <?php if(isset($_GET["ActivateSuccess"]) && urldecode($_GET['ActivateSuccess'])){ ?>
        notif('success','Votre compte vient d\'être activé avec succès.');
    <?php } elseif(isset($_GET["WaitActivate"]) && urldecode($_GET['WaitActivate'])) { ?>
            notif('warning', 'Un mail vient de vous être envoyé pour l\'activation de votre compte. Vérifiez dans les Courriers indésirables.');
    <?php } elseif(isset($_GET["ActivateImpossible"]) && urldecode($_GET['ActivateImpossible'])) { ?>
            notif('erreur', 'Votre compte ne peut être activé.');
    <?php } elseif(isset($_GET["MessageEnvoyer"]) && urldecode($_GET['MessageEnvoyer'])) { ?>
            notif('success','Votre commentaire vient d\'être envoyé.');
    <?php } elseif(isset($_GET["MessageTropLong"]) && urldecode($_GET['MessageTropLong'])) { ?>
            notif('erreur', 'Votre commentaire est trop long.');
    <?php } elseif(isset($_GET["MessageTropCourt"]) && urldecode($_GET['MessageTropCourt'])) { ?>
            notif('erreur','Votre commentaire est trop court.');
    <?php } elseif(isset($_GET["NotOnline"]) && urldecode($_GET['NotOnline'])) { ?>
            notif('erreur','Vous n\'êtes pas connecté.');
    <?php } elseif(isset($_GET["NewsNotExist"]) && urldecode($_GET['NewsNotExist'])) { ?>
            notif('erreur', 'Cette nouveauté n\'existe pas.');
    <?php } elseif(isset($_GET["TicketNotExist"]) && urldecode($_GET['TicketNotExist'])) { ?>
            notif('erreur','Ce ticket n\'existe pas.');
    <?php } elseif(isset($_GET["CommentaireNotExist"]) && urldecode($_GET['CommentaireNotExist'])) { ?>
            notif('erreur','Ce commentaire n\'existe pas.');
    <?php } elseif(isset($_GET["LikeExist"]) && urldecode($_GET['LikeExist'])) { ?>
            notif('erreur','Votre mention j\'aime est déjà existante.');
    <?php } elseif(isset($_GET["LikeAdd"]) && urldecode($_GET['LikeAdd'])) { ?>
            notif('success', 'Votre mention j\'aime vient d\'être envoyée.');
    <?php } elseif(isset($_GET["SuppressionCommentaire"]) && urldecode($_GET['SuppressionCommentaire'])) { ?>
            notif('success','Votre commentaire vient d\'être supprimé.');
    <?php } elseif(isset($_GET["SuppressionImpossible"]) && urldecode($_GET['SuppressionImpossible'])) { ?>
            notif('erreur','Le commentaire ne peut être supprimé.');
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

    <?php if (isset($_GET['envoieMail']) && $_GET['envoieMail'] == true) { //Récupération de compte 
    ?>
        window.onload = function() {
            notif2("Message Système", "Un mail de récupération a bien été envoyé !", "success");
        }
    <?php } ?>

    <?php if (isset($_GET['send'])) { //Envoie de message 
    ?>
        $(document).ready(function() {
            notif2("Messagerie", "Votre message a bien été envoyé !", "success");
        });
    <?php } ?>

    <?php if (isset($_GET['page']) && $_GET['page'] == "token" && isset($_GET['notif']) && $_GET['notif'] == 0) { //Achat par Paypal 
    ?>
        $(document).ready(function() {
            notif2("Paypal", "Votre paiement a bien été effectué !", "success");
        });

    <?php } if (isset($_GET['page']) && $_GET['page'] == "token" && isset($_GET['notif']) && $_GET['notif'] == 1) { //Achat par Paypal annulé 
    ?>
        $(document).ready(function() {
            notif2("Paypal", "Vous avez annulé votre paiement !", "success");
        });

    <?php } if ($_GET['page'] == "token" && $_GET['notif'] == 2) {  //Achat par PaySafeCard 
    ?>
        $(document).ready(function() {
            notif2("Paysafecard", "Votre paiement est en attente ! Il sera traité par un admin prochainement.", "success");
        });
    <?php } if ($_GET['page'] == "panier" && $_GET['success'] == true) {  //Achat par PaySafeCard 
    ?>
        $(document).ready(function() {
            notif2("Boutique", "Vos achats ont été validé.", "success");
        });
    <?php } ?>
</script>
