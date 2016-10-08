<?php

$lectureVotes = new Lire('modele/config/configVotes.yml');
$lectureVotes = $lectureVotes->GetTableau();

$lectureServs = new Lire('modele/config/configServeur.yml');
$lectureServs = $lectureServs->GetTableau();

$lectureServs = $lectureServs['Json'];
?>
