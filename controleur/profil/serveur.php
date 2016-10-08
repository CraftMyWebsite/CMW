<?php

$enLigne = false;

for($i = 0; $i < count($lecture['Json']); $i++)
{
	$jsonData[$i] = $jsonCon[$i]->api->call("getPlayerNames");
	
	if(isset($jsonData[$i][0]['success']))
	{
		$jsonData[$i] = $jsonData[$i][0]['success'];

		foreach($jsonData[$i] as $cle => $element)
		{
			if($element == $_GET['profil'])
				$enLigne = true;
		}
		$serveurProfil['rang'] = $jsonCon[$i]->api->call("permissions.getGroups", Array($_GET['profil']));
	}
}

if($enLigne == true)
	$serveurProfil['status'] = "En ligne";
else 
	$serveurProfil['status'] = "Déconnecté";
	
for($i = 0; $i < count($lecture['Json']); $i++)
{
	$serveurProfil['rang'] = $jsonCon[$i]->api->call("permissions.getGroups", Array($_GET['profil']));
	if(isset($jsonData[$i][0]['success']))
	{
		$serveurProfil['rang'] = $serveurProfil['rang'][0]['success'][0];
	}
	else
		$serveurProfil['rang'] = 0;
}
?>