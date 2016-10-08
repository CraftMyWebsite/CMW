<?php

$votes = new Lire('modele/config/configVotes.yml');
$votes = $votes->GetTableau();

$votes['id'] = $_POST['id'];
$votes['quantite'] = $_POST['quantite'];
$votes['message'] = $_POST['message'];
$votes['methode'] = $_POST['methode'];

$ecriture = new Ecrire('modele/config/configVotes.yml', $votes);


?>
