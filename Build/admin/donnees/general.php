<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'general', 'showPage')) {
	$lecture = new Lire('modele/config/config.yml');
	$lecture = $lecture->GetTableau();
}
?>