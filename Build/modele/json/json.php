<?php
	require_once('controleur/json/json.class.php');

$reqRecup = $bddConnection->query('SELECT * FROM cmw_serveur');

$lectureJSON = $reqRecup->fetchAll(PDO::FETCH_ASSOC);

	foreach($lectureJSON as $key => $serveur)
	{
		if($serveur['protocole'] == 1)
		{
			$ports = array(
				"query" => $serveur['port'],
				"rcon" => $serveur['port2']
			);
			$jsonCon[$key] = new JsonCon($serveur["adresse"], $ports, null, $serveur['mdp'], $bddConnection, $key);
		}
		else
			$jsonCon[$key] = new JsonCon($serveur['adresse'], $serveur['port'], $serveur['utilisateur'], $serveur['mdp'], $bddConnection, $key);

		$conEtablie[$key] = $jsonCon[$key]->GetConnection();
		if(isset($_Joueur_))
			$jsonCon[$key]->setPlayerName($_Joueur_['pseudo']);
	}
?>