<?php
if($_Permission_->verifPerm('PermsPanel', 'server', 'actions', 'addServer') OR $_Permission_->verifPerm('PermsPanel', 'server', 'actions', 'editServer')) {
	$lecture = new Lire('modele/config/configServeur.yml');
	$lecture = $lecture->GetTableau();
}
?>