<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'server', 'actions', 'editServer')) {

	$reqRecup = $bddConnection->query('SELECT * FROM cmw_serveur');

	$lecture = $reqRecup->fetchAll(PDO::FETCH_ASSOC);

	foreach($lecture as $key => $serveur)
	{
		unset($info);
		$info['addr'] = $_POST['JsonAddr' . $key];
		if(isset($_POST['JsonPort'.$key]))
		{
			$info['port'] = $_POST['JsonPort'.$key];
			$info['user'] = $_POST['JsonUser'.$key];
			$protocole = 0; //JSONAPI
		}
		else
		{
			$protocole = 1; //RCON/QUERY
			$info['rcon'] = $_POST['RconPort'.$key]; //port2
			$info['query'] = $_POST['QueryPort'.$key]; //port
		}
		$info['mdp'] = $_POST['JsonMdp'.$key];
		$info['nom'] = $_POST['JsonNom'.$key];
		$info['id'] = $_POST['id'.$key];
		if($protocole == 0)
		{
			$req = $bddConnection->prepare('UPDATE cmw_serveur SET nom = :nom, adresse = :addr, port = :port, utilisateur = :user, mdp = :mdp WHERE id = :id');
			$req->execute($info);
		}
		else
		{
			$req = $bddConnection->prepare('UPDATE cmw_serveur SET nom = :nom, adresse = :addr, port = :query, port2 = :rcon, mdp = :mdp WHERE id = :id');
			$req->execute($info);
		}
	}
}
?>