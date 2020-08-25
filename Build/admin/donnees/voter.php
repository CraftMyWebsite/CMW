<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['vote']['showPage'] == true) {
	$lectureServs = new Lire('modele/config/configServeur.yml');
	$lectureServs = $lectureServs->GetTableau();

	if(isset($lectureServs['Json'])) {
		$lectureServs = $lectureServs['Json'];
	} else {
		$lectureServs = null;
	}

	$req_donnees = $bddConnection->query('SELECT * FROM cmw_votes_config');
}
?>