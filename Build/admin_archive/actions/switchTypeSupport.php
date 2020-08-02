<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'support', 'tickets', 'actions', 'editEtatTicket')) {
	$lecture = new Lire('modele/config/config.yml');
	$lecture = $lecture->GetTableau();
	$lecture["support"]["visibilite"] = $_POST["visibilite"];
	new Ecrire('modele/config/config.yml', $lecture);
}
?>