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
                                    <a class="nav-link" id="policeEdition-tab" data-toggle="tab" href="#policeEdition" role="tab" aria-controls="policeEdition" aria-selected="false">Police</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="footerEdition-tab" data-toggle="tab" href="#footerEdition" role="tab" aria-controls="footerEdition" aria-selected="false">Footer</a>
                                </li>

                            </ul>

                            <div class="tab-content" id="defaultThemeContent">


                                <div class="tab-pane fade show active" id="colorsEdition" role="tabpanel" aria-labelledby="colorsEdition-tab">

                                    <div class="col-11 mx-auto my-2">

                                        <h4>Modifier les couleurs du thème</h4>

                                        <div class="col-10 mx-auto">
                                          
                                            <h4> Présentation du thème :</h4>

                                            <div class="col-9 mx-auto mt-5">
                                                <table class="table table-responsive table-striped table-hover">
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
                                                        <td> <b> Modifier les couleurs </b> </td>
                                                        <td class="text-center">
                                                            <input type="color" id="selColor" name="main-color-bg" value="<?php echo $_Theme_['Main']['theme']['couleurs']['main-color-bg']; ?>">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="color" id="selColor" name="secondary-color-bg" value="<?php echo $_Theme_['Main']['theme']['couleurs']['secondary-color-bg']; ?>">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="color" id="selColor" name="base-color" value="<?php echo $_Theme_['Main']['theme']['couleurs']['base-color']; ?>">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="color" id="selColor" name="main-color" value="<?php echo $_Theme_['Main']['theme']['couleurs']['main-color']; ?>">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="color" id="selColor" name="active-color" value="<?php echo $_Theme_['Main']['theme']['couleurs']['active-color']; ?>">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="color" id="selColor" name="darkest" value="<?php echo $_Theme_['Main']['theme']['couleurs']['darkest']; ?>">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="color" id="selColor" name="lightest" value="<?php echo $_Theme_['Main']['theme']['couleurs']['lightest']; ?>">
                                                        </td>
                                                    </tr>
                                                    <tr id="selColor">
                                                        <td> <b> Couleur présentée </b> </td>
                                                        <td class="text-center p-0">
                                                            <div style="background-color: <?php echo $_Theme_['Main']['theme']['couleurs']['main-color-bg']; ?>; width: 100%; padding: 0.75rem">
                                                                &nbsp;
                                                            </div>
                                                        </td>
                                                        <td class="text-center p-0">
                                                            <div style="background-color: <?php echo $_Theme_['Main']['theme']['couleurs']['secondary-color-bg']; ?>; width: 100%; padding: 0.75rem">
                                                                &nbsp;
                                                            </div>
                                                        </td>
                                                        <td class="text-center p-0">
                                                            <div style="background-color: <?php echo $_Theme_['Main']['theme']['couleurs']['base-color']; ?>; width: 100%; padding: 0.75rem">
                                                                &nbsp;
                                                            </div>
                                                        </td>
                                                        <td class="text-center p-0">
                                                            <div style="background-color: <?php echo $_Theme_['Main']['theme']['couleurs']['main-color']; ?>; width: 100%; padding: 0.75rem">
                                                                &nbsp;
                                                            </div>
                                                        </td>
                                                        <td class="text-center p-0">
                                                            <div style="background-color: <?php echo $_Theme_['Main']['theme']['couleurs']['active-color']; ?>; width: 100%; padding: 0.75rem">
                                                                &nbsp;
                                                            </div>
                                                        </td>
                                                        <td class="text-center p-0">
                                                            <div style="background-color: <?php echo $_Theme_['Main']['theme']['couleurs']['darkest']; ?>; width: 100%; padding: 0.75rem">
                                                                &nbsp;
                                                            </div>
                                                        </td>
                                                        <td class="text-center p-0">
                                                            <div style="background-color: <?php echo $_Theme_['Main']['theme']['couleurs']['lightest']; ?>; width: 100%; padding: 0.75rem">
                                                                &nbsp;
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>

                            </div>

                                    <?php
                                    $fontactubrute = $_Theme_['Main']['theme']['police'];

                                    $fontactu = str_replace(array("'", ";"), '', $fontactubrute);
                                    ?>

                                    <div class="tab-pane fade mx-auto" id="policeEdition" role="tabpanel" aria-labelledby="policeEdition-tab">

                                        <div class="col-11 mx-auto my-2">

                                            <h4>Modification de la police du thème :</h4>

                                            <label class="control-label">Séléction de la police </label>
                                            <select class="form-control text-center" name="police" style="font-family: <?= $fontactubrute?>">
                                                <option value="<?= $fontactubrute ?>" selected ><?= $fontactu ?></option>

                                                <option value="'Electrolize', sans-serif;" style="font-family: 'Electrolize', sans-serif;">Electrolize, sans-serif</option>
                                                <option value="'Brush Script MT', cursive;" style="font-family: 'Brush Script MT', cursive;">Brush Script MT, cursive</option>
                                                <option value="'Courier New', monospace;" style="font-family: 'Courier New', monospace;">Courier New, monospace</option>
                                                <option value="'Georgia', serif;" style="font-family: 'Georgia', serif;">Georgia, serif</option>
                                                <option value="'Trebuchet MS', sans-serif;" style=" font-family: 'Trebuchet MS', sans-serif;">Trebuchet MS, sans-serif</option>
                                                <option value="'Tahoma', sans-serif;" style=" font-family: 'Tahoma', sans-serif;">Tahoma, sans-serif</option>
                                                <option value="'Cursive';" style="font-family: 'Cursive';">Cursive</option>
                                                <option value="'Arial';" style="font-family: 'Arial';">Arial</option>
                                                <option value="'Palatino';" style="font-family: 'Palatino';">Palatino</option>

                                            </select>

                                        </div>

                                    </div>


                                <div class="tab-pane fade mx-auto" id="footerEdition" role="tabpanel" aria-labelledby="footerEdition-tab">

                                    <div class="col-11 mx-auto my-2">

                                        <h4>Vos Résaux Sociaux</h4>

                                        <div class="col-10 mx-auto">
                                            <input type="hidden" id="jsonReseau" name="jsonReseau" />
                                            <div id="all-reseau">

                                                <?php if (isset($_Theme_['Pied']['social']) && !empty($_Theme_['Pied']['social'])) foreach ($_Theme_['Pied']['social'] as $value) : ?>

                                                    <div class="form-row well py-1" data-reseau>
                                                        <div class="col-12">
                                                            <label class="control-label">Icone du réseau</label>
                                                            <input type="text" data-type="icon" class="form-control" placeholder='<i class="fab fa-discord"></i>' value="<?= str_replace('"', "'", $value['icon']); ?>">
                                                            <small>Disponible sur : <a href="https://fontawesome.com/icons/">
                                                                    https://fontawesome.com/icons/</a></small>
                                                        </div>

                                                        <div class="col-12">
                                                            <label class="control-label">Lien vers le réseau</label>
                                                            <input type="text" data-type="link" class="form-control" value="<?= str_replace('"', "'", $value['link']) ?>">
                                                        </div>

                                                        <div class="col-12">
                                                            <label class="control-label">Message à mettre à côté</label>
                                                            <input type="text" data-type="message" class="form-control" placeholder="Rejoingnez-nous sur Discord !" value="<?= str_replace('"', "'", $value['message']) ?>">
                                                        </div>

                                                        <div class="col-4 my-4">
                                                            <button class="btn btn-danger form-control" onclick="this.parentElement.parentElement.parentElement.removeChild(this.parentElement.parentElement); genJsonReseau(); sendPost('configThemeAdmin');">Supprimer</button>
                                                        </div>

                                                    </div>

                                                <?php endforeach ?>
                                            </div>

                                            <div class="form-row well py-1">
                                                <h5 class="col-12 my-1">Réseau social personnalisé</h5>
                                                <div class="col-12">
                                                    <label class="control-label">Icone du réseau</label>
                                                    <input type="text" class="form-control" id="new-s-icone" placeholder='<i class="fab fa-discord"></i>'>
                                                    <small>Disponible sur : <a href="https://fontawesome.com/icons/">
                                                            https://fontawesome.com/icons/</a></small>
                                                </div>

                                                <div class="col-12">
                                                    <label class="control-label">Lien vers le réseau</label>
                                                    <input type="text" id="new-s-link" class="form-control" />
                                                </div>

                                                <div class="col-12">
                                                    <label class="control-label">Message à mettre à côté</label>
                                                    <input type="text" class="form-control" id="new-s-message" placeholder="Rejoingnez-nous sur Discord !">
                                                </div>

                                                <div class="col-4 my-4">
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

                                                <textarea name="about" data-UUID="0954" id="ckeditor">
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
                    initPost("configThemeAdmin", "admin.php?action=configTheme", function(data) { if(data) { setTimeout(function() { },1500); }});
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

        if (isset(ico.value) && ico.value.replace(" ", "") != "" && isset(link.value) && link.value.replace(" ", "") !=
            "" && isset(msg.value) && msg.value.replace(" ", "") != "") {
            var ht =
                '<div class="form-row jumbotron py-1" data-reseau>' +
                '<h5 class="col-12 my-1">Réseau <small> <div class="badge badge-warning">Non sauvegardé si pas cliqué sur sauvegarder !</div></small></h5>' +
                '<div class="col-12">' +
                '<label class="control-label">Icone du réseau</label>' +
                '<input type="text" data-type="icon" class="form-control" id="" placeholder=\'<i class="fab fa-discord"></i>\' value="' +
                ico.value.replace(/"/g, '\'') + '">' +
                '<small>Disponible sur : <a href="https://fontawesome.com/icons/"> https://fontawesome.com/icons/</a></small>' +
                '</div>' +

                '<div class="col-12">' +
                '<label class="control-label">Lien vers le réseau</label>' +
                '<input type="text" id="" class="form-control" data-type="link" value="' + link.value.replace(/"/g, '\'') + '">' +
                '</div>' +

                '<div class="col-12">' +
                '<label class="control-label">Message à mettre à côté</label>' +
                '<input type="text" class="form-control" id="" data-type="message" placeholder="Rejoingnez-nous sur Discord !" value="' +
                msg.value.replace(/"/g, '\'') + '">' +
                '</div>' +

                '<div class="col-4 my-4">' +
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
</script>
