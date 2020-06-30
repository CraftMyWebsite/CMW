<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['tickets']['actions']['editEtatTicket'] == true) {
	$lecture = new Lire('modele/config/config.yml');
	$lecture = $lecture->GetTableau();
	$lecture["support"]["visibilite"] = $_POST["visibilite"];
	new Ecrire('modele/config/config.yml', $lecture);
}
?>