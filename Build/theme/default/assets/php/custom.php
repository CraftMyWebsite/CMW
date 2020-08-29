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
    function notif(type,message)
    {
         toastr[type](message, null);
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
            notif("success", "Vous avez copier l\'adresse IP du serveur !");
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

    <?php include('controleur/notifications.php'); ?>


    <?php if (isset($_GET['setTemp']) && $_GET['setTemp'] == 1) : //Envoie d'un mot de passe nouveau 
    ?>
        window.onload = function() {
            notif("success", "Votre nouveau mot de passe vous a été envoyé par mail!");
        }
    <?php endif; ?>

    <?php if (isset($_Joueur_)) : //Système d'alerte 
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
                        notif("Message Système", message);
                    }
                }
            });
        }
    <?php endif; ?>

    <?php if (Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'seeSignalement')) : //Système de signalement 
    ?>
        setInterval(ajax_signalement, 10000);

        function ajax_signalement() {
            var url = '?action=get_signalement';
            $.post(url, function(signalement) {
                if (signalement > 0) {
                    window.onload = function() {
                        signalement.innerHTML = signalement;
                        var message = "Il y'a " + signalement + " nouveaux signalements !";
                         notif("Message Système",message);
                    }
                }
            });
        }
    <?php endif; ?>

    <?php if (isset($_GET['envoieMail']) && $_GET['envoieMail'] == true) : //Récupération de compte 
    ?>
        window.onload = function() {
            notif("Message Système", "Un mail de récupération a bien été envoyé !");
        }
    <?php endif; ?>

    <?php if (isset($_GET['send'])) : //Envoie de message 
    ?>
        $(document).ready(function() {
            notif("Messagerie", "Votre message a bien été envoyé !");
        });
    <?php endif; ?>

    <?php if (isset($_GET['page']) && $_GET['page'] == "token" && isset($_GET['notif']) && $_GET['notif'] == 0) : //Achat par Paypal 
    ?>
        $(document).ready(function() {
            notif("Paypal", "Votre paiement a bien été effectué !");
        });

    <?php elseif (isset($_GET['page']) && $_GET['page'] == "token" && isset($_GET['notif']) && $_GET['notif'] == 1) : //Achat par Paypal annulé 
    ?>
        $(document).ready(function() {
            notif("Paypal", "Vous avez annulé votre paiement !");
        });

    <?php elseif ($_GET['page'] == "token" && $_GET['notif'] == 2) :  //Achat par PaySafeCard 
    ?>
        $(document).ready(function() {
            notif("Paysafecard", "Votre paiement est en attente ! Il sera traité par un admin prochainement.");
        });
    <?php endif; ?>
</script>