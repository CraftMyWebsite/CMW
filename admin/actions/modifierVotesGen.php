<?php

//					Version 1.3 - TokensPlus - Elmoren
//					Utilisant la technologie TokensPlus, script recodé par Elmoren
//					***************************************************************
//									By LekyDev'

$votes = new Lire('modele/config/configVotes.yml');
$votes = $votes->GetTableau();

$votes['display'] = $_POST['display'];
$votes['action'] = $_POST['action'];
$votes['cmd'] = '\''.$_POST['cmd'].'\'';
$votes['id'] = $_POST['id'];
$votes['tokens'] = $_POST['tokens'];
$votes['quantite'] = $_POST['quantite'];
$votes['message'] = $_POST['message'];
$votes['methode'] = $_POST['methode'];

$ecriture = new Ecrire('modele/config/configVotes.yml', $votes);


?>
