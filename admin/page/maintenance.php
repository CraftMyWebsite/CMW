<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"> Maintenance
            <small>Gestionnaire de Maintenance</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a data-toggle="collapse" data-parent="#adminPanel" href="#informations">Informations</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Maintenance
            </li>
        </ol>
        <hr>
        <?php if($_Joueur_['rang'] != 1 AND ($_PGrades_['PermsPanel']['support']['maintenance']['actions']['editDefaultMessage'] == false AND $_PGrades_['PermsPanel']['support']['maintenance']['actions']['editAdminMessage'] == false AND $_PGrades_['PermsPanel']['support']['maintenance']['actions']['editEtatMaintenance'] == false AND $_PGrades_['PermsPanel']['support']['maintenance']['actions']['switchRedirectMode'] == false)) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="alert alert-danger">
                    <strong>Vous avez aucune permission pour accéder à la maintenance.</strong>
                </div>
            </div>
        <?php } else { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="alert alert-success">
                    <strong>Vous avez une panne sur votre site ? Un problème avec le design/script/news/tickets... Alors ceci permet de mettre votre site en mode maintenance, aucun membre n'y aura accès sauf les créateurs.</strong>
                </div>
            </div>
        <?php }
        for($i = 0; $i < count($maintenance); $i++) {
            if($_Joueur_['rang'] == 1 OR ($_PGrades_['PermsPanel']['support']['maintenance']['actions']['editDefaultMessage'] == true OR $_PGrades_['PermsPanel']['support']['maintenance']['actions']['editAdminMessage'] == true)) { ?>
                <div class="col-lg-6 col-lg-offset-3 text-center">
                    <h3>Edition des messages</h3>
                </div>
                <div class="col-lg-6 col-lg-offset-3 text-center">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="col-lg-8 col-lg-offset-2">
                                <div class="row">
                                    <table class="table table-striped table-bordered">
                                        <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['maintenance']['actions']['editDefaultMessage'] == true) { ?>
                                            <tr>
                                                <th>Message :</th>
                                                <th>Action :</th>
                                            </tr>
                                            <tr>
                                                <form method="post" action="?&action=editMessage&maintenanceId=<?php echo $maintenance[$i]['maintenanceId']; ?>">
                                                    <td><input style="width: 85%" type="text" name="maintenanceMsg" value="<?php echo $maintenance[$i]['maintenanceMsg']; ?>" class="form-control" placeholder="Ex : Maintenance en cours.." required></td>
                                                    <td><input type="submit" class="btn btn-warning" value="Modifier le message !" /></td>
                                                </form>
                                            </tr>
                                        <?php }
                                        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['maintenance']['actions']['editAdminMessage'] == true) { ?>
                                            <tr>
                                                <th>Message Administration :</th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <form method="post" action="?&action=editMessageAdmin&maintenanceId=<?php echo $maintenance[$i]['maintenanceId']; ?>">
                                                    <td><input style="width: 85%" type="text" name="maintenanceMsgAdmin" value="<?php echo $maintenance[$i]['maintenanceMsgAdmin']; ?>" class="form-control" placeholder="Ex : Vous êtes administrateur? Alors connectez-vous :" required></td>
                                                    <td><input type="submit" class="btn btn-warning" value="Modifier le message !" /></td>
                                                </form>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            if($_Joueur_['rang'] == 1 OR ($_PGrades_['PermsPanel']['support']['maintenance']['actions']['editEtatMaintenance'] == true OR $_PGrades_['PermsPanel']['support']['maintenance']['actions']['switchRedirectMode'] == true)) { ?>
                <div class="col-lg-6 col-lg-offset-3 text-center">
                    <h3>Status & Réglages</h3>
                </div>
                <div class="col-lg-6 col-lg-offset-3 text-center">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="col-lg-6 col-lg-offset-3">
                                <div class="row">
                                    <?php if($_Joueur_['rang'] == 1 OR ($_PGrades_['PermsPanel']['support']['maintenance']['actions']['editEtatMaintenance'] == true OR $_PGrades_['PermsPanel']['support']['maintenance']['actions']['switchRedirectMode'] == true)) { ?>
                                        <div class="row">
                                            <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['maintenance']['actions']['editEtatMaintenance'] == true) { ?>
                                                <div class="row">
                                                    <?php if($maintenance[$i]['maintenanceEtat'] == 1) { ?> 
                                                        <button class="btn btn-block" style="background: #18bc9c;color: white;" disabled><strong>INFO :</strong> Maintenance activé</button>
                                                    <?php } else { ?>
                                                        <button class="btn btn-block" style="background: #e74c3c;color: white;" disabled><strong>INFO :</strong> Maintenance  désactivé</button>
                                                    <?php } ?>
                                                </div>
                                            <?php }
                                            if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['maintenance']['actions']['switchRedirectMode'] == true) { ?>
                                                <div class="row">
                                                    <?php if($maintenance[$i]['maintenancePref'] == 1) { ?> 
                                                        <button class="btn btn-block" style="background: #3498db;color: white;" disabled><strong>Pref actuelle :</strong> Accès panel uniquement</button>
                                                    <?php } else { ?>
                                                        <button class="btn btn-block" style="background: #3498db;color: white;" disabled><strong>Pref actuelle :</strong> Accès panel + site </button>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="row">
                                            <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['maintenance']['actions']['editEtatMaintenance'] == true) { ?>
                                                <div class="row">
                                                    <div class="panel panel-success" style="text-align: center;">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Activer/désactiver la maintenance</h3>
                                                        </div>
                                                        <center>Vous souhaitez rendre le site accésible uniquement aux administrateurs ? Il vous suffie d'appuyer sur le bouton ci-dessous. Les visiteurs seront redirigé vers la page de maintenance.</center>
                                                        <div class="panel-body">
                                                            <form method="post" action="?&action=switchMaintenance&maintenanceId=<?php echo $maintenance[$i]['maintenanceId']; ?>">
                                                                <?php if($maintenance[$i]['maintenanceEtat'] == 1) { 
                                                                    echo '<button type="submit" name="maintenanceEtat" class="btn btn-danger btn-block" value="0" />Désactiver la maintenance</button>';
                                                                } else {
                                                                    echo '<button type="submit" name="maintenanceEtat" class="btn btn-success btn-block" value="1" />Activer la maintenance</button>';
                                                                } ?> 
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                            if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['maintenance']['actions']['switchRedirectMode'] == true) { ?>
                                                <div class="row">
                                                    <div class="panel panel-success" style="text-align: center;">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Changer le type de redirection</h3>
                                                        </div>
                                                        <center>Grâce a cette option , si la maintenance est activé vous pouvez choisir si les administrateurs peuvent accéder au panel + le site ou uniquement le panel.</center>
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
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>
<!-- /.row -->