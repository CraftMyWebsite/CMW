<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h2 class="h2 gray">
        Gestion Maintenance du site
	</h2>
</div>
<div class="row">
<?php if(!$_Permission_->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'editDefaultMessage') AND !$_Permission_->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'editAdminMessage') AND !$_Permission_->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'editEtatMaintenance') AND !$_Permission_->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'switchRedirectMode')) { ?>
     	<div class="col-md-12 text-center">
            <div class="alert alert-danger">
                <strong>Vous avez aucune permission pour accéder à la maintenance.</strong>
            </div>
        </div>
    <?php } else { ?>
    	<div class="col-md-12 text-center">
            <div class="alert alert-success">
                <strong>Vous avez une panne sur votre site ? Un problème avec le design/script/news/tickets... Alors ceci permet de mettre votre site en mode maintenance, aucun membre n'y aura accès sauf les créateurs.</strong>
            </div>
        </div>
        <?php
        for($i = 0; $i < count($maintenance); $i++) {
            if($_Permission_->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'editDefaultMessage') OR $_Permission_->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'editAdminMessage')) { ?>
            	<div class="col-md-12 col-xl-6 col-12">
				    <div class="card">
				      <div class="card-header ">
				        <h3 class="card-title"><strong>Édition des messages</strong></h3>
				      </div>
				      <div class="card-body" >
				       <table class="table table-striped table-bordered">
                                    <?php if($_Permission_->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'editDefaultMessage')) { ?>
                                        <tr>
                                            <th>Message :</th>
                                            <th>Action :</th>
                                        </tr>
                                        <tr id="msg1<?php echo $maintenance[$i]['maintenanceId']; ?>">
                                            <td><input type="text" name="maintenanceMsg" class="form-control" required value="<?php echo $maintenance[$i]['maintenanceMsg']; ?>"/></td>
                                            <td><input onclick="sendPost('msg1<?php echo $maintenance[$i]['maintenanceId']; ?>', null);"  type="submit" class="btn btn-success" value="Modifier le message !" /></td>
                                        </tr>
                                        <script>initPost('msg1<?php echo $maintenance[$i]['maintenanceId']; ?>','admin.php?&action=editMessage&maintenanceId=<?php echo $maintenance[$i]['maintenanceId']; ?>',null );</script>
                                    <?php }
                                    if($_Permission_->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'editAdminMessage')) { ?>
                                        <tr>
                                            <th>Message Administration :</th>
                                            <th></th>
                                        </tr>
                                        <tr id="msg2<?php echo $maintenance[$i]['maintenanceId']; ?>">
                                            <td><input type="text" name="maintenanceMsgAdmin" class="form-control" required value="<?php echo $maintenance[$i]['maintenanceMsg']; ?>"/></td>
                                            <td><input onclick="sendPost('msg2<?php echo $maintenance[$i]['maintenanceId']; ?>', null);" type="submit" class="btn btn-success" value="Modifier le message !" /></td>
                                        </tr>
                                        <script>initPost('msg2<?php echo $maintenance[$i]['maintenanceId']; ?>','admin.php?&action=editMessageAdmin&maintenanceId=<?php echo $maintenance[$i]['maintenanceId']; ?>',null );</script>
                                    <?php } ?>
                                </table>
				      </div>
				  	</div>
				</div>

          	<?php } if($_Permission_->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'editEtatMaintenance') OR $_Permission_->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'switchRedirectMode')) { ?>
                <div class="col-md-12 col-xl-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><strong>Status & réglages</strong></h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                <?php if($_Permission_->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'editEtatMaintenance')) { ?>
                                    <?php if($maintenance[$i]['maintenanceEtat'] == 1) { ?> 
                                        <button class="btn btn-block" style="background: #18bc9c;color: white;" disabled><strong>INFO :</strong> Maintenance activée</button>
                                    <?php } else { ?>
                                        <button class="btn btn-block" style="background: #e74c3c;color: white;" disabled><strong>INFO :</strong> Maintenance  désactivée</button>
                                    <?php } ?>
                                <?php } ?>
                                </div>
                                <?php
                                if($_Permission_->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'switchRedirectMode')) { ?>
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
                                <?php if($_Permission_->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'editEtatMaintenance')) { ?>
                                    <div class="col-md-12">
                                        <div class="card" style="text-align: center;">
                                            <div class="card-header">
                                                <h5 class="card-title">Activer/désactiver la maintenance</h3>
                                            </div>
                                            <div class="card-body">
                                                <center>Vous souhaitez rendre le site accessible uniquement aux administrateurs ? Il vous suffit d'appuyer sur le bouton ci-dessous. Les visiteurs seront redirigés vers la page de maintenance.</center>
               
                                                <form method="post" action="?&action=switchMaintenance&maintenanceId=<?=$maintenance[$i]['maintenanceId']?>">
													<label>Définir une date de fin de maintenance: <small>Laissez vide si aucune</small></label>
													<input type="date" name="date" value="<?php if(!empty($maintenance[$i]['dateFin']) && $maintenance[$i]['dateFin'] > time()) echo date("d/m/Y H:i", $maintenance[$i]["dateFin"]);?>" class="form-control" placeholder="format: jj/mm/aaaa hh:mm">
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
                                        if($_Permission_->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'switchRedirectMode')) { ?>
                                    <div class="col-md-12">
                                        <div class="card"  style="text-align: center;">
                                            <div class="card-header">
                                                <h5 class="card-title">Changer le type de redirection</h3>
                                            </div>
                                            <div class="card-body">
                                                <center>Grâce à cette option, si la maintenance est activée vous pouvez choisir si les administrateurs peuvent accéder au panel + le site ou uniquement le panel.</center>
                  
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
    <?php } ?>
</div>