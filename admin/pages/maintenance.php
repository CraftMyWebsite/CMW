<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2 gray">
        Gestion Maintenance du site
    </h2>
</div>
<div class="row">
    <?php if (!$_Permission_->verifPerm('PermsPanel', 'maintenance', 'showPage')) { ?>
        <div class="col-md-12 text-center">
            <div class="alert alert-danger">
                <strong>Vous avez aucune permission pour accéder à la maintenance.</strong>
            </div>
        </div>
    <?php } else { ?>
        <div class="col-md-12 text-center">
            <div class="alert alert-success">
                <strong>Vous avez une panne sur votre site ? Un problème avec le design/script/news/tickets... Alors
                    ceci permet de mettre votre site en mode maintenance, aucun membre n'y aura accès sauf les
                    créateurs.</strong>
            </div>
        </div>
        <?php
        for ($i = 0; $i < count($maintenance); $i++) {
            if ($_Permission_->verifPerm('PermsPanel', 'maintenance', 'actions', 'editDefaultMessage') or $_Permission_->verifPerm('PermsPanel', 'maintenance', 'actions', 'editAdminMessage') or $_Permission_->verifPerm('PermsPanel', 'maintenance', 'actions', 'editMessageInscr')) { ?>
                <div class="col-md-12 col-xl-6 col-12">
                    <div class="card">
                        <div class="card-header ">
                            <h3 class="card-title"><strong>Édition des messages</strong></h3>
                        </div>
                        <div class="card-body">

                            <?php if ($_Permission_->verifPerm('PermsPanel', 'maintenance', 'actions', 'editDefaultMessage')) { ?>


                                <div id="msg1<?php echo $maintenance[$i]['maintenanceId']; ?>"
                                     class="maintenance_msg_desc">
                                    <span><strong>Modification du message principal</strong></span>
                                    <textarea data-UUID="0014" id="ckeditor" name="maintenanceMsg"
                                              style="height: 275px; margin: 0px; width: 20%;"
                                              required><?php echo $maintenance[$i]['maintenanceMsg']; ?></textarea>
                                    <input onclick="sendPost('msg1<?php echo $maintenance[$i]['maintenanceId']; ?>', null);"
                                           type="submit" class="btn btn-success maintenance_msg_btn"
                                           value="Modifier le message !"/>
                                </div>

                                <script>initPost('msg1<?php echo $maintenance[$i]['maintenanceId']; ?>', 'admin.php?&action=editMessage&maintenanceId=<?php echo $maintenance[$i]['maintenanceId']; ?>', null);</script>
                            <?php }
                            if ($_Permission_->verifPerm('PermsPanel', 'maintenance', 'actions', 'editAdminMessage')) { ?>
                                <div id="msg2<?php echo $maintenance[$i]['maintenanceId']; ?>"
                                     class="maintenance_msg_desc">
                                    <span><strong>Message d'administration</strong></span>
                                    <textarea data-UUID="0015" id="ckeditor" name="maintenanceMsgAdmin"
                                              class="form-control" style="height: 275px; margin: 0px; width: 20%;"
                                              required><?php echo $maintenance[$i]['maintenanceMsgAdmin']; ?></textarea>
                                    <input onclick="sendPost('msg2<?php echo $maintenance[$i]['maintenanceId']; ?>', null);"
                                           type="submit" class="btn btn-success  maintenance_msg_btn"
                                           value="Modifier le message !"/>
                                </div>

                                <script>initPost('msg2<?php echo $maintenance[$i]['maintenanceId']; ?>', 'admin.php?&action=editMessageAdmin&maintenanceId=<?php echo $maintenance[$i]['maintenanceId']; ?>', null);</script>
                            <?php }
                            if ($_Permission_->verifPerm('PermsPanel', 'maintenance', 'actions', 'editInscrMessage')) { ?>

                                <div id="msg3<?php echo $maintenance[$i]['maintenanceId']; ?>"
                                     class="maintenance_msg_desc">
                                    <span><strong>Message d'inscription</strong></span>
                                    <textarea data-UUID="0016" id="ckeditor" name="maintenanceMsgInscr"
                                              class="form-control"
                                              style="height: 275px; margin: 0px; width: 20%;required"><?php echo $maintenance[$i]['maintenanceMsgInscr']; ?> </textarea>
                                    <input onclick="sendPost('msg3<?php echo $maintenance[$i]['maintenanceId']; ?>');"
                                           type="submit" class="btn btn-success  maintenance_msg_btn"
                                           value="Modifier le message !"/>
                                </div>

                                <script>initPost('msg3<?php echo $maintenance[$i]['maintenanceId']; ?>', 'admin.php?&action=editMessageInscr&maintenanceId=<?php echo $maintenance[$i]['maintenanceId']; ?>');</script>
                            <?php } ?>

                        </div>
                    </div>
                </div>

            <?php }
            if ($_Permission_->verifPerm('PermsPanel', 'maintenance', 'actions', 'editEtatMaintenance') or $_Permission_->verifPerm('PermsPanel', 'maintenance', 'actions', 'switchRedirectMode') or $_Permission_->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'switchInscriptions')) { ?>
                <div class="col-md-12 col-xl-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><strong>Status & réglages</strong></h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if ($_Permission_->verifPerm('PermsPanel', 'maintenance', 'actions', 'editEtatMaintenance')) { ?>
                                        <?php if ($maintenance[$i]['maintenanceEtat'] == 1) { ?>
                                            <button class="btn btn-block" style="background: #18bc9c;color: white;"
                                                    disabled><strong>INFO :</strong> Maintenance activée
                                            </button>
                                        <?php } else { ?>
                                            <button class="btn btn-block" style="background: #e74c3c;color: white;"
                                                    disabled><strong>INFO :</strong> Maintenance désactivée
                                            </button>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <?php
                                if ($_Permission_->verifPerm('PermsPanel', 'maintenance', 'actions', 'switchRedirectMode')) { ?>
                                    <div class="col-md-12">
                                        <?php if ($maintenance[$i]['maintenancePref'] == 1) { ?>
                                            <button class="btn btn-block" style="background: #3498db;color: white;"
                                                    disabled><strong>Pref actuelle :</strong> Accès panel uniquement
                                            </button>
                                        <?php } else { ?>
                                            <button class="btn btn-block" style="background: #3498db;color: white;"
                                                    disabled><strong>Pref actuelle :</strong> Accès panel + site
                                            </button>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <?php if ($_Permission_->verifPerm('PermsPanel', 'maintenance', 'actions', 'editEtatMaintenance')) { ?>
                                    <div class="col-md-12">
                                        <div class="card" style="text-align: center;">
                                            <div class="card-header">
                                                <h5 class="card-title">Activer/désactiver la maintenance</h5>
                                            </div>
                                            <div class="card-body" id="maintenance">
                                                <center>Vous souhaitez rendre le site accessible uniquement aux
                                                    administrateurs ? Il vous suffit d'appuyer sur le bouton ci-dessous.
                                                    Les visiteurs seront redirigés vers la page de maintenance.
                                                </center>
                                                <label>Définir une date de fin de maintenance: <small>Laissez vide si
                                                        aucune</small></label>
                                                <input type="date" name="date"
                                                       <?php if (!empty($maintenance[$i]['dateFin']) && $maintenance[$i]['dateFin'] > time()) echo 'value="' . date('Y-m-d', $maintenance[$i]['dateFin']) . '"'; ?>class="form-control"
                                                       placeholder="format: jj/mm/aaaa">
                                                <?php if ($maintenance[$i]['maintenanceEtat'] == 1) {
                                                    ?>
                                                    <button onclick="sendPost('maintenance', null, true);" type="submit"
                                                            id="maintenanceBtn"
                                                            class="btn btn-danger btn-block"/>Désactiver la maintenance</button>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <button onclick="sendPost('maintenance', null, true);"
                                                            id="maintenanceBtn" type="submit"
                                                            class="btn btn-success btn-block"/>Activer la maintenance</button>
                                                    <?php
                                                } ?>
                                                <script>initPost('maintenance', 'admin.php?action=switchMaintenance&maintenanceId=<?=$maintenance[$i]['maintenanceId'];?>', function (data, otherData) {
                                                        if (data) {
                                                            update = JSON.parse(otherData);
                                                            btn = document.getElementById('maintenanceBtn');
                                                            if (update['etat'] == 1) {
                                                                btn.classList.remove("btn-success");
                                                                btn.classList.add("btn-danger");
                                                                btn.innerHTML = 'Désactiver la maintenance';
                                                            } else {
                                                                btn.classList.add("btn-success");
                                                                btn.classList.remove("btn-danger");
                                                                btn.innerHTML = 'Activer la maintenance';
                                                            }
                                                            console.log(update['retour']);
                                                        }
                                                    }); </script>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                if ($_Permission_->verifPerm('PermsPanel', 'maintenance', 'actions', 'switchRedirectMode')) { ?>
                                    <div class="col-md-12">
                                        <div class="card" style="text-align: center;">
                                            <div class="card-header">
                                                <h5 class="card-title">Changer le type de redirection</h5>
                                                <p class="text-success">Actuellement : <span
                                                            id="maintenanceActu"><?= ($maintenance[$i]['maintenancePref'] == 1) ? 'Panel Uniquement' : 'Panel + Site'; ?></span>
                                                </p>
                                            </div>
                                            <div class="card-body" id="maintenancePref">
                                                <center>Grâce à cette option, si la maintenance est activée vous pouvez
                                                    choisir si les administrateurs peuvent accéder au panel + le site ou
                                                    uniquement le panel.
                                                </center>
                                                <?php if ($maintenance[$i]['maintenancePref'] == 1) {
                                                    ?>
                                                    <button type="submit" onclick="sendPost('maintenancePref', null);"
                                                            class="btn btn-warning" id="maintenancePrefBtn"
                                                            value="1"/>Changer sur <strong>Panel +
                                                        Site</strong></button>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <button type="submit" id="maintenancePrefBtn"
                                                            onclick="sendPost('maintenancePref', null);"
                                                            class="btn btn-warning" value="0"/>Changer sur <strong>Panel
                                                        uniquement</strong></button>
                                                    <?php
                                                } ?>
                                                <script>initPost('maintenancePref', 'admin.php?&action=switchPreference&maintenanceId=<?php echo $maintenance[$i]['maintenanceId']; ?>', function (data) {
                                                        if (data) {
                                                            btn = document.getElementById('maintenancePrefBtn');
                                                            span = document.getElementById('maintenanceActu');
                                                            if (btn.value == 0) {
                                                                btn.value = 1;
                                                                btn.innerHTML = 'Changer sur <strong>Panel + Site</strong>';
                                                                span.innerHTML = "Panel Uniquement";
                                                            } else {
                                                                btn.value = 0;
                                                                btn.innerHTML = 'Changer sur <strong>Panel uniquement</strong>';
                                                                span.innerHTML = "Panel + Site";
                                                            }
                                                        }
                                                    }); </script>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                if ($_Permission_->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'switchInscriptions')) {
                                    ?>
                                    <div class="col-md-12">
                                        <div class="card" style="text-align: center;">
                                            <div class="card-header">
                                                <h5 class="card-title">Autoriser les inscriptions pendant la
                                                    maintenance</h5>
                                                <p id="inscriptionActuClass"
                                                   class="<?= ($maintenance[$i]['inscription'] == 1) ? 'text-success' : 'text-danger'; ?>">
                                                    Actuellement : <span
                                                            id="inscriptionActu"><?= ($maintenance[$i]['inscription'] == 1) ? 'Autorisée' : 'Refusée'; ?></span>
                                                </p>
                                            </div>
                                            <div class="card-body" id="inscription">
                                                <center>Grâce à cette option, si la maintenance est activée vous pouvez
                                                    choisir si les uilisateurs peuvent tout de même s'inscrire au site
                                                    ou pas. Pratique si vous voulez envoyer une newsletter à l'ouverture
                                                    de votre site !
                                                </center>
                                                <?php if ($maintenance[$i]['inscription'] == 1) {
                                                    ?>
                                                    <button type="submit" onclick="sendPost('inscription');"
                                                            class="btn btn-warning" id="inscriptionBtn"
                                                            value="1"/>Changer sur <strong>Refuser</strong></button>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <button type="submit" id="inscriptionBtn"
                                                            onclick="sendPost('inscription');" class="btn btn-warning"
                                                            value="0"/>Changer sur <strong>Autoriser</strong></button>
                                                    <?php
                                                } ?>
                                                <script>initPost('inscription', 'admin.php?&action=switchPreferenceInscription&maintenanceId=<?php echo $maintenance[$i]['maintenanceId']; ?>', function (data) {
                                                        if (data) {
                                                            btn = get('inscriptionBtn');
                                                            span = get('inscriptionActu');
                                                            cass = get('inscriptionActuClass')
                                                            if (btn.value == 0) {
                                                                btn.value = 1;
                                                                btn.innerHTML = 'Changer sur <strong>Refuser</strong>';
                                                                span.innerHTML = "Autoriser";
                                                                cass.className = "text-success";
                                                            } else {
                                                                btn.value = 0;
                                                                btn.innerHTML = 'Changer sur <strong>Autoriser</strong>';
                                                                span.innerHTML = "Refuser";
                                                                cass.className = "text-danger";
                                                            }
                                                        }
                                                    }); </script>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    <?php } ?>
</div>