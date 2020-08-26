<?php
if($_Permission_->verifPerm('PermsPanel', 'general', 'actions', 'editGeneral')) {
	$lecture = new Lire('modele/config/config.yml');
	$lecture = $lecture->GetTableau();
}
?>