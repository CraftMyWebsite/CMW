<?php

$lectureVotes = new Lire('modele/config/configVotes.yml');
$lectureVotes = $lectureVotes->GetTableau();

$lectureServs = new Lire('modele/config/configServeur.yml');
$lectureServs = $lectureServs->GetTableau();

$lectureServs = $lectureServs['Json'];

$i = count($lectureVotes['liens']);

$lectureVotes['liens'][$i]['serveur'] = $_POST['serveur'];
$lectureVotes['liens'][$i]['lien'] = $_POST['lien'];
$lectureVotes['liens'][$i]['titre'] = $_POST['titre'];
$lectureVotes['liens'][$i]['temps'] = $_POST['temps'];


$ecriture = new Ecrire('modele/config/configVotes.yml', $lectureVotes);
?>
