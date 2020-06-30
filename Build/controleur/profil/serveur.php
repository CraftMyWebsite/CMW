<?php

$enLigne = false;
if($jsonCon != false)
{
	for($i = 0; $i < count($lecture['Json']); $i++)
	{
		$jsonData[$i] = $jsonCon[$i]->GetServeurInfos();
		
		if(isset($jsonData[$i]['joueurs']))
		{
			$jsonData[$i] = $jsonData[$i]['joueurs'];

			foreach($jsonData[$i] as $cle => $element)
			{
				if($element == $_GET['profil'])
					$enLigne = true;
			}
			$serveurProfil['rang'] = $jsonCon[$i]->getPermissionsGroups($_GET['profil']);
		}
	}

	if($enLigne == true)
		$serveurProfil['status'] = "En ligne";
	else 
		$serveurProfil['status'] = "Déconnecté";
		
	for($i = 0; $i < count($lecture['Json']); $i++)
	{
		$serveurProfil['rang'] = $jsonCon[$i]->getPermissionsGroups($_GET['profil']);
		if(isset($jsonData[$i][0]['success']))
		{
			$serveurProfil['rang'] = $serveurProfil['rang'][0]['success'][0];
		}
		else
			$serveurProfil['rang'] = 0;
	}
}
?>
