<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['server']['showPage'] == true) {
	$lecture = new Lire('modele/config/configServeur.yml');
	$lecture = $lecture->GetTableau();
}
?>