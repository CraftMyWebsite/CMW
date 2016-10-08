<?php

$lecture = new Lire('modele/config/configServeur.yml');
$lecture = $lecture->GetTableau();

$i = count($lecture['Json']);

$lecture['Json'][$i]['adresse'] = $_POST['JsonAddr'];

if($_POST['localhost'] == 'on')
	$lecture['Json'][$i]['localhost'] = true;
else
	$lecture['Json'][$i]['localhost'] = false;

$lecture['Json'][$i]['port'] = $_POST['JsonPort'];
$lecture['Json'][$i]['utilisateur'] = $_POST['JsonUser'];
$lecture['Json'][$i]['mdp'] = $_POST['JsonMdp'];
$lecture['Json'][$i]['salt'] = $_POST['JsonSalt'];
$lecture['Json'][$i]['nom'] = $_POST['JsonNom'];


$ecriture = new Ecrire('modele/config/configServeur.yml', $lecture);

?>