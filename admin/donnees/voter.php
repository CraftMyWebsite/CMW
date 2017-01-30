<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['vote']['showPage'] == true) {
	$lectureVotes = new Lire('modele/config/configVotes.yml');
	$lectureVotes = $lectureVotes->GetTableau();

	$lectureServs = new Lire('modele/config/configServeur.yml');
	$lectureServs = $lectureServs->GetTableau();

	$lectureServs = $lectureServs['Json'];
}
?>