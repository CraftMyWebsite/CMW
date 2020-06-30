<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'vote', 'showPage')) {
	$lectureServs = new Lire('modele/config/configServeur.yml');
	$lectureServs = $lectureServs->GetTableau();

	$lectureServs = $lectureServs['Json'];

	$req_donnees = $bddConnection->query('SELECT * FROM cmw_votes_config');
}
?>