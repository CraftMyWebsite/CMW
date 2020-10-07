<?php include('theme/' . $_Serveur_['General']['theme'] . '/config/configTheme.php');
?>

<!-- ATTENTION AUX DEVELOPPEURS DE THEME : 
        -> Le système est concue pour qu'il n'y est qu'un seul FORM, et c'est celui de cette action ! Donc merci de ne pas créer d'autres form et de tout garder dans ce form avec cette action et en POST ! 
        -> Le fichier de traitement est configAdminTraitement.php il ne peux ni être renommer ni déplacé ! 
        -> Tout se fait en AJAX donc vous devez conservé le onClick="sendPost('configThemeAdmin');" sur le bouton d'envoie + ne pas mettre de balise <form> + conserver le <script>...</script> + conserver une div id="configThemeAdmin" qui doit englober tout les input de votre formulaire (sinon ils ne seront pas recupérés). N'hésitez pas à demander de l'aide sur le discord !
-->
<style id="themeEdition">
    .theme .nav-item>.nav-link {
        color: black !important;
    }

    .btn-danger {
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-success {
        color: #fff;
        background-color: #28a745;
        border-color: #28a745;
    }
</style>

<div class="row theme">
    <div class="col-md-9 col-xl-9 col-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Configuration du thème </h4>
            </div>

            <div class="card-body">

                <section>
                    <!-- Gestion des réseaux sociaux -->
                    <div class="row">
                        <div class="col-12" id="configThemeAdmin">

                            <ul class="nav nav-tabs mb-3" id="defaultTheme" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active" id="colorsEdition-tab" data-toggle="tab" href="#colorsEdition" role="tab" aria-controls="colorsEdition" aria-selected="true">Couleurs</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="footerEdition-tab" data-toggle="tab" href="#footerEdition" role="tab" aria-controls="footerEdition" aria-selected="false">Footer</a>
                                </li>

                            </ul>

                            <div class="tab-content" id="defaultThemeContent">



                                <div class="tab-pane fade show active" id="colorsEdition" role="tabpanel" aria-labelledby="colorsEdition-tab">

                                    <div class="col-11 mx-auto my-2">

                                        <h4>Thème de couleur</h4>

                                        <div class="col-10 mx-auto">

                                            <?php $actualTheme = (isset($_Theme_['Main']['theme']['choosed-theme']) && $_Theme_['Main']['theme']['choosed-theme'] === 1) ? "light" : "dark"; ?>

                                            <div class="well 3">
                                                <h4>Thème actuel : </h4>
                                                <h5 class="p-1 bg-secondary w-100 rounded d-block text-center" style="color: white;"><b> Thème <?= ($actualTheme === "light") ? "clair" : "sombre" ?></b></h5>
                                            </div>

                                            <h4> Présentation du thème :</h4>

                                            <div class="col-9 mx-auto mt-5">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <th></th>
                                                        <th>Fond principal</th>
                                                        <th>Fond secondaire</th>
                                                        <th>Couleur du texte</th>
                                                        <th>Couleur foncée du texte</th>
                                                        <th>Couleur importante du texte</th>
                                                        <th>Fond clair</th>
                                                        <th>Fond foncé</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td> <b> Couleur héxadécimal </b> </td>

                                                            <?php if (isset($_Theme_['Main']['theme'][$actualTheme]) && !empty($_Theme_['Main']['theme'][$actualTheme])) foreach ($_Theme_['Main']['theme'][$actualTheme] as $colorValue) : ?>

                                                                <td class="text-center">
                                                                    <code> <?= $colorValue ?> </code>
                                                                </td>

                                                            <?php endforeach; ?>

                                                        </tr>
                                                        <tr>
                                                            <td> <b> Couleur présentée </b> </td>

                                                            <?php if (isset($_Theme_['Main']['theme'][$actualTheme]) && !empty($_Theme_['Main']['theme'][$actualTheme])) foreach ($_Theme_['Main']['theme'][$actualTheme] as $colorValue) : ?>

                                                                <td class="text-center p-0">
                                                                    <div style="background-color: <?= $colorValue; ?>; width: 100%; padding: 0.75rem">
                                                                        &nbsp;
                                                                    </div>
                                                                </td>

                                                            <?php endforeach; ?>

                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <button type='submit' class="btn btn-primary w-100 m-2" name="changeTheme" onClick="genJsonReseau(); sendPost('configThemeAdmin');" value="<?= $actualTheme ?>">Passer en thème <?= ($actualTheme === "light") ? "sombre" : "clair" ?>
                                                </button>

                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane fade mx-auto" id="footerEdition" role="tabpanel" aria-labelledby="footerEdition-tab">

                                    <div class="col-11 mx-auto my-2">

                                        <h4>Vos Résaux Sociaux</h4>

                                        <div class="col-10 mx-auto">
                                            <input type="hidden" id="jsonReseau" name="jsonReseau" />
                                            <div id="all-reseau">

                                                <?php if (isset($_Theme_['Pied']['social']) && !empty($_Theme_['Pied']['social'])) foreach ($_Theme_['Pied']['social'] as $value) : ?>

                                                    <div class="form-row jumbotron py-1" data-reseau>
                                                        <div class="col-md-7 col-lg-3 col-sm-9">
                                                            <label class="control-label">Icone du réseau</label>
                                                            <input type="text" data-type="icon" class="form-control" placeholder='<i class="fab fa-discord"></i>' value="<?= str_replace('"', "'", $value['icon']); ?>">
                                                            <small>Disponible sur : <a href="https://fontawesome.com/icons/">
                                                                    https://fontawesome.com/icons/</a></small>
                                                        </div>

                                                        <div class="col-md-7 col-lg-3 col-sm-9">
                                                            <label class="control-label">Lien vers le réseau</label>
                                                            <input type="text" data-type="link" class="form-control" value="<?= str_replace('"', "'", $value['link']) ?>">
                                                        </div>

                                                        <div class="col-md-7 col-lg-3 col-sm-9">
                                                            <label class="control-label">Message à mettre à côté</label>
                                                            <input type="text" data-type="message" class="form-control" placeholder="Rejoingnez-nous sur Discord !" value="<?= str_replace('"', "'", $value['message']) ?>">
                                                        </div>

                                                        <div class="col-md-2 col-lg-2 col-sm-2 offset-1 my-auto">
                                                            <button class="btn btn-danger form-control" onclick="this.parentElement.parentElement.parentElement.removeChild(this.parentElement.parentElement); genJsonReseau(); sendPost('configThemeAdmin');">Supprimer</button>
                                                        </div>

                                                    </div>

                                                <?php endforeach ?>
                                            </div>

                                            <div class="form-row well py-1">
                                                <h5 class="col-12 my-1">Réseau social personnalisé</h5>
                                                <div class="col-md-7 col-lg-3 col-sm-9">
                                                    <label class="control-label">Icone du réseau</label>
                                                    <input type="text" class="form-control" id="new-s-icone" placeholder='<i class="fab fa-discord"></i>'>
                                                    <small>Disponible sur : <a href="https://fontawesome.com/icons/">
                                                            https://fontawesome.com/icons/</a></small>
                                                </div>

                                                <div class="col-md-7 col-lg-3 col-sm-9">
                                                    <label class="control-label">Lien vers le réseau</label>
                                                    <input type="text" id="new-s-link" class="form-control" />
                                                </div>

                                                <div class="col-md-7 col-lg-3 col-sm-9">
                                                    <label class="control-label">Message à mettre à côté</label>
                                                    <input type="text" class="form-control" id="new-s-message" placeholder="Rejoingnez-nous sur Discord !">
                                                </div>

                                                <div class="col-md-2 col-lg-2 col-sm-2 offset-1 my-auto">
                                                    <button class="btn btn-danger form-control">Supprimer</button>
                                                </div>


                                            </div>

                                            <button class="float-right btn btn-primary my-2" onclick="createNewReseau();">
                                                Ajouter un réseau social
                                            </button>
                                            <div class="clearfix"></div>




                                            <h4>A Propos</h4>
                                            <small class="my-1">Parlez de votre serveur, ou du but de ce site internet
                                                !</small>

                                            <div class="col-10 mx-auto">

                                                <textarea class="form-control" name="about" id="aboutTheme">
                                                    <?= $_Theme_['Pied']['about'] ?>
                                                </textarea>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </section>

            </div>

            <div class="card-footer">
                <div class="form-group text-center">
                    <input type="submit" onClick="genJsonReseau(); sendPost('configThemeAdmin');" class="btn btn-success" value="Sauvegarder">
                </div>

                <script>
                    initPost("configThemeAdmin", "admin.php?action=configTheme");
                </script>
            </div>

        </div>
    </div>
</div>




<script>
    function createNewReseau() {
        var ico = get('new-s-icone');
        var link = get('new-s-link');
        var msg = get('new-s-message');

        console.log("TEST 1 " + ico.value + " " + link.value + " " + msg.value)
        console.log("TEST 2 " + ico + " " + link + " " + msg)
        if (isset(ico.value) && ico.value.replace(" ", "") != "" && isset(link.value) && link.value.replace(" ", "") !=
            "" && isset(msg.value) && msg.value.replace(" ", "") != "") {
            var ht =
                '<div class="form-row jumbotron py-1" data-reseau>' +
                '<h5 class="col-12 my-1">Réseau <small> <div class="badge badge-warning">Non sauvegardé si pas cliqué sur sauvegarder !</div></small></h5>' +
                '<div class="col-md-7 col-lg-3 col-sm-9">' +
                '<label class="control-label">Icone du réseau</label>' +
                '<input type="text" data-type="icon" class="form-control" id="" placeholder=\'<i class="fab fa-discord"></i>\' value="' +
                ico.value.replace(/"/g, '\'') + '">' +
                '<small>Disponible sur : <a href="https://fontawesome.com/icons/"> https://fontawesome.com/icons/</a></small>' +
                '</div>' +

                '<div class="col-md-7 col-lg-3 col-sm-9">' +
                '<label class="control-label">Lien vers le réseau</label>' +
                '<input type="text" id="" class="form-control" data-type="link" value="' + link.value.replace(/"/g, '\'') + '">' +
                '</div>' +

                '<div class="col-md-7 col-lg-3 col-sm-9">' +
                '<label class="control-label">Message à mettre à côté</label>' +
                '<input type="text" class="form-control" id="" data-type="message" placeholder="Rejoingnez-nous sur Discord !" value="' +
                msg.value.replace(/"/g, '\'') + '">' +
                '</div>' +

                '<div class="col-md-2 col-lg-2 col-sm-2 offset-1 my-auto">' +
                '<button class="btn btn-danger form-control" onclick="this.parentElement.parentElement.parentElement.removeChild(this.parentElement.parentElement); genJsonReseau(); sendPost(\'configThemeAdmin\');">Supprimer</button>' +
                '</div>' +

                '</div>'

            get('all-reseau').insertAdjacentHTML("beforeend", ht);
            ico.value = msg.value = link.value = null
            delete ico;
            delete msg;
            delete value;
        } else {
            notif("warning", "Erreur", "Formulaire incomplet");
            console.log("TEST " + ico.value + " " + link.value + " " + msg.value)
        }

    }

    function genJsonReseau() {
        var final = [];
        for (let el of document.querySelectorAll("[data-reseau]")) {
            let temp = {}
            for (let o = 0; o < el.children.length; o++) {
                for (let i = 0; i < el.children[o].children.length; i++) {
                    if (isset(el.children[o].children[i].getAttribute('data-type'))) {
                        temp[el.children[o].children[i].getAttribute('data-type')] = el.children[o].children[i].value;
                    }
                }
            }
            final.push(temp);
        }
        get('jsonReseau').value = JSON.stringify(final);
    }
    genJsonReseau();

    $("#aboutTheme").val((i, v) => v.replace(/\s{2,}/g, ''));
    console.log(">" + $("#aboutTheme").val() + "<")
</script>
