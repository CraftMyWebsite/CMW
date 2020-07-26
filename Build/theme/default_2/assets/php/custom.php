<script>
    //Forum

    function previewTopic(appel) {
        post = $(appel).val();
        contenue = nl2br(post);
        document.getElementById("previewTopic").innerText = miseEnPage(contenue);
    }

    function nl2br(str, is_xhtml) {
        if (typeof str === 'undefined' || str === null) {
            return '';
        }
        var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
    }

    function miseEnPage($str) {
        $format_search = [
            /\[b\](.*?)\[\/b\]/ig,
            /\[i\](.*?)\[\/i\]/ig,
            /\[u\](.*?)\[\/u\]/ig,
            /\[color=(.*?)\](.*?)\[\/color\]/ig,
            /\[hr\]/ig,
            /\[s(?:trike)?\](.*?)\[\/s(trike)?\]/ig,
            /\[center\](.*?)\[\/center\]/ig,
            /\[font=(.*?)\](.*?)\[\/font\]/ig,
            /\[right\](.*?)\[\/right\]/ig,
            /\[left\](.*?)\[\/left\]/ig,
            /\[justify\](.*?)\[\/justify\]/ig,
            /\[img\](.*?)\[\/img\]/ig,
            /\[img=(.*?)\](.*?)\[\/img\]/ig,
            /[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}/ig,
            /\[url\](.*?)\[\/url\]/ig,
            /\[url=(.*?)\](.*?)\[\/url\]/ig
        ];
        $format_replace = [
            '<strong>$1</strong>',
            '<em>$1</em>',
            '<u>$1</u>',
            '<span style="color: $1">$2</span>',
            '<hr/>',
            '<s>$2</s>',
            '<center>$1</center>',
            '<span style="font-size:$1em;">$2</span>',
            '<p class="text-right" style="margin-bottom: 0px;">$1</p>',
            '<p class="text-left" style="margin-bottom: 0px;">$1</p>',
            '<p class="text-justify" style="margin-bottom: 0px;">$1</p>',
            '<img class="img-fluid" src="$1" />',
            '<img class="img-fluid" src="$1" title="$2" />',
            '<a href="mailto:$0">$0</a>',
            '<a href="$1" target="_blank">$1</a>',
            '<a href="$1" target="_blank">$2</a>'
        ];
        for (var i = 0; i < $format_search.length; i++) {
            $str = $str.replace($format_search[i], $format_replace[i]);
        }
        while ($str.match(/\[spoiler(.*)\](.+)\[\/spoiler\]/i)) {
            var k = Math.floor(Math.random() * 1000);
            $str = $str.replace(/\[spoiler=(.*?)\](.*?)\[\/spoiler\]/i, '<a class="btn btn-primary" data-toggle="collapse" href="#spoiler' + k + '" role="button" aria-expanded="false" aria-controls="spoiler' + k + '">$1</a><div class="collapse" id="spoiler' + k + '"><div class="card card-body"><p style="margin-bottom: 0px;">$2</p></div></div>');
            var k = Math.floor(Math.random() * 1000);
            $str = $str.replace(/\[spoiler\](.*?)\[\/spoiler\]/i, '<a class="btn btn-primary" data-toggle="collapse" href="#spoiler' + k + '" role="button" aria-expanded="false" aria-controls="spoiler' + k + '">Spoiler</a><div class="collapse" id="spoiler' + k + '"><div class="card card-body"><p style="margin-bottom: 0px;">$1</p></div></div>');
        }
        $smileys_symbole = [
            <?php
            $req = $bddConnection->query('SELECT symbole, image FROM cmw_forum_smileys ORDER BY priorite DESC');
            $smileys = $req->fetchAll();
            foreach ($smileys as $key => $value) {
                if (array_key_exists($key + 1, $smileys))
                    echo '"' . $value['symbole'] . '",';
                else
                    echo '"' . $value['symbole'] . '"';
            }
            ?>
        ];
        $smileys_replace = [
            <?php
            foreach ($smileys as $key => $value) {
                if (array_key_exists($key + 1, $smileys))
                    echo '"' . $value['image'] . '",';
                else
                    echo '"' . $value['image'] . '"';
            }
            ?>
        ];
        for (var i = 0; i < $smileys_symbole.length; i++) {
            replace = $smileys_symbole[i].split("/").join("\\/").split("(").join("\\(").split(")").join("\\)").split(":").join("\\:").split("'").join("\\'").split("\"").join("\\\"");
            re = new RegExp(replace, "ig");
            $str = $str.replace(re, '<img src="' + $smileys_replace[i] + '" />');
        }
        return $str;
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
            toastr["success"]("Vous avez copier l\'adresse IP du serveur !", "Succés");
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-bottom-left",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
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

    <?php elseif (isset($_GET['page']) && $_GET['page'] == 'support') : //Gestion tes tickets support
    ?>
        var nbEnvoie = 0

        function envoie_ticket() {
            if (nbEnvoie > 0)
                return false;
            else {
                var data_titre = document.getElementById("titre_ticket").value;
                var data_message = document.getElementById("message_ticket").value;
                var data_vu = document.getElementById("vu_ticket").value;
                $.ajax({
                    url: 'index.php?action=post_ticket',
                    type: 'POST',
                    data: 'titre=' + data_titre + '&message=' + data_message + '&ticketDisplay=' + data_vu,
                    dataType: 'html',
                    success: function() {
                        sleep(1);
                    }
                });
                nbEnvoie++;
                return true;
            }
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
                    if(data['success'] == "query")
                    {
                        chat = '<div class="tab-pane fade in show" aria-expanded="false">\
                                    <div class="info-page bg-danger">\
                                        <div class="text-center">\
                                            La connexion au serveur ne peut pas être établie avec ce protocole.\
                                        </div>\
                                    </div>\
                                </div>';
                    }
                    else if(data['success'] == "erreur")
                    {
                        chat = '<div class="tab-pane fade in show" aria-expanded="false">\
                                    <div class="info-page bg-info">\
                                        <div class="text-center">\
                                            Aucun message n\'a été envoyé sur ce serveur !\
                                        </div>\
                                    </div>\
                                </div>';
                    }
                    else if(data['success'] == "true")
                    {
                        data = data['msg'];
                        for (var i = 0; i < data.length; i++)
                        {
                            if(data[i]['pseudo'] == "" || data[i]['pseudo'] == 'undefined'  || !data[i]['pseudo'])
                                pseudo ="Console";
                            else
                                pseudo =data[i]['pseudo'];
                            chat+= '<div class="media"> \
                                    <p class="username">\
                                        <img class="mr-3" src="';
                            if(pseudo == "Console")
                                chat+= "https://craftmywebsite.fr/favicon.ico";
                            else
                                chat+='https://api.craftmywebsite.fr/skin/face.php?u='+data[i]["pseudo"]+'&s=32';
                            chat+= '" style="width: 32px; height: 32px;" alt="avatar de l\'auteur" />\
                                        <div class="media-body">\
                                            <h5 class="mt-0">';
                            chat+=pseudo;
                            chat+='<small class="font-weight-light float-right text-muted">'+data[i]['date']+'</small>\
                                    </h5>'+data[i]['message']+'</div>\
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
                    $("#msgChat").html(chat);
                }
            });
        }

    <?php elseif (isset($_GET['page']) && $_GET['page'] == 'profil') : //Pour la page de profil 
    ?>
        previewTopic($("#signature"));

    <?php endif; ?>

    //Notifications

    <?php include('controleur/notifications.php'); ?>

    <?php if (!empty($_Serveur_['General']['ipTexte'])) : //Copier l'ip
    ?>

        function copierIP() {
            var copyText = document.getElementById("iptexte");
            copyText.select();
            document.execCommand("copy");

            Snarl.addNotification({
                title: 'Success',
                text: 'Vous avez copier l\'adresse IP du serveur !".',
                icon: '<i class="fa fa-info-circle" aria-hidden="true"></i>'
            });
        }
    <?php endif; ?>

    <?php if (isset($_GET['setTemp']) && $_GET['setTemp'] == 1) : //Envoie d'un mot de passe nouveau 
    ?>
        window.onload = function() {
            Snarl.addNotification({
                title: 'Success',
                text: 'Votre nouveau mot de passe vous a été envoyé par mail !',
                icon: '<i class="fa fa-info-circle" aria-hidden="true"></i>'
            });
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
                        Snarl.addNotification({
                            title: 'Message Système',
                            text: message,
                            icon: '<i class="fa fa-info-circle" aria-hidden="true"></i>'
                        });
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
                        Snarl.addNotification({
                            title: 'Message système',
                            text: message,
                            icon: '<i class="fa fa-info-circle" aria-hidden="true"></i>'
                        });
                    }
                }
            });
        }
    <?php endif; ?>

    <?php if (isset($_GET['envoieMail']) && $_GET['envoieMail'] == true) : //Récupération de compte 
    ?>
        window.onload = function() {
            Snarl.addNotification({
                title: 'Message système',
                text: "Un mail de récupération a bien été envoyé !",
                icon: '<i class="fa fa-info-circle" aria-hidden="true"></i>'
            });
        }
    <?php endif; ?>

    <?php if (isset($_GET['send'])) : //Envoie de message 
    ?>
        $(document).ready(function() {
            Snarl.addNotification({
                title: "Messagerie",
                text: "Votre message a bien été envoyé !",
                icon: '<i class="far fa-paper-plane"></i>'
            });
        });
    <?php endif; ?>

    <?php if (isset($_GET['page']) && $_GET['page'] == "token" && isset($_GET['notif']) && $_GET['notif'] == 0) : //Achat par Paypal 
    ?>
        $(document).ready(function() {
            Snarl.addNotification({
                title: "Paypal",
                text: "Votre paiement a bien été effectué !",
                icon: '<i class="fab fa-paypal"></i>',
                timeout: null
            });
        });

    <?php elseif (isset($_GET['page']) && $_GET['page'] == "token" && isset($_GET['notif']) && $_GET['notif'] == 1) : //Achat par Paypal annulé 
    ?>
        $(document).ready(function() {
            Snarl.addNotification({
                title: "Paypal",
                text: "Vous avez annulé votre paiement !",
                icon: '<i class="fas fa-frown"></i>',
                timeout: null
            });
        });

    <?php elseif ($_GET['page'] == "token" && $_GET['notif'] == 2) :  //Achat par PaySafeCard 
    ?>
        $(document).ready(function() {
            Snarl.addNotification({
                title: "Paysafecard",
                text: "Votre paiement est en attente ! Il sera traité par un admin prochainement.",
                icon: '<i class="fas fa-receipt"></i>',
                timeout: null
            });
        });
    <?php endif; ?>
</script>