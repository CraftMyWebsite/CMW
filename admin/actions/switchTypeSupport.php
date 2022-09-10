<?php
if($_Permission_->verifPerm('PermsPanel', 'support', 'tickets', 'actions', 'editEtatTicket')) {
	$lecture = new Lire('modele/config/config.yml');
	$lecture = $lecture->GetTableau();
	$lecture['support']['visibilite'] = $_POST['visibilite'];
	new Ecrire('modele/config/config.yml', $lecture);
}
?>