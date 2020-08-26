<?php
if(!(!$_Permission_->verifPerm('PermsPanel', 'server', 'actions', 'addServer') AND !$_Permission_->verifPerm('PermsPanel', 'server', 'actions', 'editServer'))) {
	$lecture = new Lire('modele/config/configServeur.yml');
	$lecture = $lecture->GetTableau();
}
?>