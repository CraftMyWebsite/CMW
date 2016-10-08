<?php
	require_once('controleur/json/json.class.php');

$lecture = new Lire('modele/config/configServeur.yml');
$lecture = $lecture->GetTableau();
for($i = 0; $i < count($lecture['Json']); $i++)
{
	if($lecture['Json'][$i]['localhost'] == true)
		$addr = 'localhost';
	else
		$addr = $lecture['Json'][$i]['adresse'];
	
	$jsonCon[$i] = new JsonCon($addr, $lecture['Json'][$i]['port'], $lecture['Json'][$i]['utilisateur'], $lecture['Json'][$i]['mdp'], $lecture['Json'][$i]['salt']);

	$conEtablie[$i] = $jsonCon[$i]->GetConnection();
	if(!isset($conEtablie[$i][0]['result']) OR $conEtablie[$i][0]['result'] == 'error')
	{
		$conEtablie[$i] = false;
		$serveurStats[$i]['enLignes'] = 0;
		$serveurStats[$i]['maxJoueurs'] = 0;
	}
	else
	{
		$conEtablie[$i] = true;
		$serveurStats[$i] = $jsonCon[$i]->GetServeurInfos();
		$console[$i] = $jsonCon[$i]->GetConsole();
		$plugins[$i] = $jsonCon[$i]->getPlugins();
	}
		
	if(isset($_Joueur_))
	{
		$jsonCon[$i]->SetPlayerName($_Joueur_['pseudo']);
	}	
}
	
$tousDown = true;
for($i = 0; $i < count($lecture['Json']); $i++)
{
	$nomServeur[$i] = '';
	for($j = 0; $j < strlen($lecture['Json'][$i]['nom']); $j++)
	{
		$nomServeur[$i] = $nomServeur[$i] .'['. substr($lecture['Json'][$i]['nom'], $j, 1);
	}
	$nomServeur[$i] = str_replace(' ', ']', $nomServeur[$i]);

	if(strlen($lecture['Json'][$i]['nom']) < 14)	
		$nomServeur[$i] = '('. $nomServeur[$i] .')';

	if($conEtablie[$i] == true)
		$tousDown = false;
}


if(count($lecture['Json']) > 1)
	$titreEtat = 'DES SERVEURS';
else
	$titreEtat = 'DU SERVEUR';


require_once('controleur/perms/Permissions.class.php');
require_once('modele/perms/PermissionsManager.class.php');

if(isset($jsonCon[0]) AND $conEtablie[0])
{
    $groups = new Permissions();
    $groups->hydrate($jsonCon[0], $_Serveur_['General']['permsPlugin'], $_Serveur_['General']['permsWorld']);

    $rand = rand(1, 15);
    
    if($rand == 1)
    {
        $groups->readPermsServer();
        $groups->permsToArray();
        $groups->updateLocal();
    }
    else
    {
        $groups->readPermsLocal();
    }
    $groups = $groups->getPerms();
}
?>
