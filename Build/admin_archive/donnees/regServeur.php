<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'server', 'showPage')) {
	$lecture = new Lire('modele/config/configServeur.yml');
	$lecture = $lecture->GetTableau();
}
?>