<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'server', 'actions', 'addServer')) {

	$infos['adresse'] = $_POST['JsonAddr'];

	if(!empty($_POST['JsonPort']))
	{
		$infos['port'] = $_POST['JsonPort'];
		$infos['utilisateur'] = $_POST['JsonUser'];
		$infos['protocole'] = 0;
	}
	else
	{
		$infos['query'] = $_POST['QueryPort'];
		$infos['rcon'] = $_POST['RconPort'];
		$infos['protocole'] = 1;
	}	
	$infos['mdp'] = $_POST['JsonMdp'];
	$infos['nom'] = $_POST['JsonNom'];

	if($infos['protocole'] == 0)
		$req = $bddConnection->prepare('INSERT INTO cmw_serveur (nom, adresse, protocole, port, utilisateur, mdp) VALUES (:nom, :adresse, :protocole, :port, :utilisateur, :mdp)');
	else
		$req = $bddConnection->prepare('INSERT INTO cmw_serveur (nom, adresse, protocole, port, port2, mdp) VALUES (:nom, :adresse, :protocole, :query, :rcon, :mdp)');

	$req->execute($infos);
}
?>