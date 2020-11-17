<?php

$enLigne = false;
if($jsonCon != false)
{
	foreach($jsonCon as $i => $serveur)
	{
		$jsonData[$i] = $serveur->GetServeurInfos();
		
		if(isset($jsonData[$i]['joueurs']))
		{
			$jsonData[$i] = $jsonData[$i]['joueurs'];

			foreach($jsonData[$i] as $cle => $element)
			{
				if($element == $_GET['profil'])
					$enLigne = true;
			}
			$serveurProfil['rang'] = $serveur->getPermissionsGroups($_GET['profil']);
		}
	}

	if($enLigne == true)
		$serveurProfil['status'] = "En ligne";
	else 
		$serveurProfil['status'] = "Déconnecté";
		
	foreach($jsonCon as $i => $serveur)
	{
		$serveurProfil['rang'] = $serveur->getPermissionsGroups($_GET['profil']);
		if(isset($jsonData[$i][0]['success']))
		{
			$serveurProfil['rang'] = $serveurProfil['rang'][0]['success'][0];
		}
		else
			$serveurProfil['rang'] = 0;
	}
}
?>
