<?php
$lectureServs = new Lire('modele/config/configServeur.yml');
$lectureServs = $lectureServs->GetTableau();

$lectureServs = $lectureServs['Json'];

$reqConfig = $bddConnection->query('SELECT * FROM cmw_votes_recompense_auto_config');
?>