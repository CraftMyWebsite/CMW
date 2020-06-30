<div class="cmw-page-content-header"><strong>Gestion</strong> - Gérez la maintenance</div>
    <?php if(!Permission::getInstance()->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'editDefaultMessage') AND !Permission::getInstance()->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'editAdminMessage') AND !Permission::getInstance()->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'editEtatMaintenance') AND !Permission::getInstance()->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'switchRedirectMode')) { ?>
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="alert alert-danger">
                <strong>Vous avez aucune permission pour accéder à la maintenance.</strong>
            </div>
        </div>
    </div>
    <?php } else { ?>
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="alert alert-success">
                <strong>Vous avez une panne sur votre site ? Un problème avec le design/script/news/tickets... Alors ceci permet de mettre votre site en mode maintenance, aucun membre n'y aura accès sauf les créateurs.</strong>
            </div>
        </div>
    </div>
    <?php } ?>
                <div class=row><?php
        for($i = 0; $i < count($maintenance); $i++) {
            if(Permission::getInstance()->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'editDefaultMessage') OR Permission::getInstance()->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'editAdminMessage')) { ?>
                <div class="col-md-6">
                    <div class="panel panel-default cmw-panel">
                        <div class="panel-heading cmw-panel-header">
                            <h3 class="panel-title"><strong>Édition des messages</strong></h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <table class="table table-striped table-bordered">
                                    <?php if(Permission::getInstance()->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'editDefaultMessage')) { ?>
                                        <tr>
                                            <th>Message :</th>
                                            <th>Action :</th>
                                        </tr>
                                        <tr>
                                            <form method="post" action="?&action=editMessage&maintenanceId=<?php echo $maintenance[$i]['maintenanceId']; ?>">
                                                <td><textarea style="width: 85%" name="maintenanceMsg" class="form-control" required><?php echo $maintenance[$i]['maintenanceMsg']; ?></textarea></td>
                                                <td><input type="submit" class="btn btn-warning" value="Modifier le message !" /></td>
                                            </form>
                                        </tr>
                                    <?php }
                                    if(Permission::getInstance()->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'editAdminMessage')) { ?>
                                        <tr>
                                            <th>Message Administration :</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <form method="post" action="?&action=editMessageAdmin&maintenanceId=<?php echo $maintenance[$i]['maintenanceId']; ?>">
                                                <td><textara style="width: 85%" name="maintenanceMsgAdmin" class="form-control" required><?php echo $maintenance[$i]['maintenanceMsgAdmin']; ?></textara></td>
                                                <td><input type="submit" class="btn btn-warning" value="Modifier le message !" /></td>
                                            </form>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            if(Permission::getInstance()->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'editEtatMaintenance') OR Permission::getInstance()->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'switchRedirectMode')) { ?>
                <div class="col-md-6">
                    <div class="panel panel-default cmw-panel">
                        <div class="panel-heading cmw-panel-header">
                            <h3 class="panel-title"><strong>Status & réglages</strong></h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                <?php if(Permission::getInstance()->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'editEtatMaintenance')) { ?>
                                    <?php if($maintenance[$i]['maintenanceEtat'] == 1) { ?> 
                                        <button class="btn btn-block" style="background: #18bc9c;color: white;" disabled><strong>INFO :</strong> Maintenance activée</button>
                                    <?php } else { ?>
                                        <button class="btn btn-block" style="background: #e74c3c;color: white;" disabled><strong>INFO :</strong> Maintenance  désactivée</button>
                                    <?php } ?>
                                <?php } ?>
                                </div>
                                <?php
                                if(Permission::getInstance()->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'switchRedirectMode')) { ?>
                                    <div class="col-md-12">
                                        <?php if($maintenance[$i]['maintenancePref'] == 1) { ?> 
                                            <button class="btn btn-block" style="background: #3498db;color: white;" disabled><strong>Pref actuelle :</strong> Accès panel uniquement</button>
                                        <?php } else { ?>
                                            <button class="btn btn-block" style="background: #3498db;color: white;" disabled><strong>Pref actuelle :</strong> Accès panel + site </button>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <?php if(Permission::getInstance()->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'editEtatMaintenance')) { ?>
                                    <div class="col-md-12">
                                        <div class="panel panel-success" style="text-align: center;">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Activer/désactiver la maintenance</h3>
                                            </div>
                                            <center>Vous souhaitez rendre le site accessible uniquement aux administrateurs ? Il vous suffit d'appuyer sur le bouton ci-dessous. Les visiteurs seront redirigés vers la page de maintenance.</center>
                                            <div class="panel-body">
                                                <form method="post" action="?&action=switchMaintenance&maintenanceId=<?=$maintenance[$i]['maintenanceId']?>">
													<label>Définir une date de fin de maintenance: <small>Laissez vide si aucune</small></label>
													<input type="text" name="date" value="<?php if(!empty($maintenance[$i]['dateFin']) && $maintenance[$i]['dateFin'] > time()) echo date("d/m/Y H:i", $maintenance[$i]["dateFin"]);?>" class="form-control" placeholder="format: jj/mm/aaaa hh:mm">
                                                    <?php if($maintenance[$i]['maintenanceEtat'] == 1) { 
                                                        echo '<button type="submit" class="btn btn-danger btn-block" />Désactiver la maintenance</button>';
                                                    } else {
                                                        echo '<button type="submit" class="btn btn-success btn-block" />Activer la maintenance</button>';
                                                    } ?> 
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                        <?php }
                                        if(Permission::getInstance()->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'switchRedirectMode')) { ?>
                                    <div class="col-md-12">
                                        <div class="panel panel-success" style="text-align: center;">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Changer le type de redirection</h3>
                                            </div>
                                            <center>Grâce à cette option, si la maintenance est activée vous pouvez choisir si les administrateurs peuvent accéder au panel + le site ou uniquement le panel.</center>
                                            <div class="panel-body">
                                                <form method="post" action="?&action=switchPreference&maintenanceId=<?php echo $maintenance[$i]['maintenanceId']; ?>">
                                                    <?php if($maintenance[$i]['maintenancePref'] == 1) { 
                                                        echo '<button type="submit" name="maintenancePref" class="btn btn-warning" value="0" />Changer sur <strong>Panel + Site</strong></button>';
                                                    } else {
                                                        echo '<button type="submit" name="maintenancePref" class="btn btn-warning" value="1" />Changer sur <strong>Panel uniquement</strong></button>';
                                                    } ?>
                                                </form>
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
</div>
<!-- /.row -->