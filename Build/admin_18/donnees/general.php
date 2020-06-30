<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['general']['showPage'] == true) {
	$lecture = new Lire('modele/config/config.yml');
	$lecture = $lecture->GetTableau();
}
?>