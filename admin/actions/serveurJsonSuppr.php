<?php


$lecture = new Lire('modele/config/configServeur.yml');
$lecture = $lecture->GetTableau();

for($i = 0; $i < count($lecture['Json']); $i++)
{
	if($lecture['Json'][$i]['nom'] == $_GET['nom'])
		unset($lecture['Json'][$i]);
}


$ecriture = new Ecrire('modele/config/configServeur.yml', $lecture);
?>