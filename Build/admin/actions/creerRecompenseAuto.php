<?php 

if(Permission::getInstance()->verifPerm('PermsPanel', 'vote', 'recompenseAuto', 'actions', 'addRecompense'))
{
	$type = intval(htmlspecialchars($_POST['type']));
	if($type == 1)
		$value = htmlspecialchars($_POST['nbreVote']);
	else
	{
		$date = strtotime(htmlspecialchars($_POST['date']));
		$reinit = intval(htmlspecialchars($_POST['reinit']));
		$rang = intval(htmlspecialchars($_POST['rang']));
		$value = $date.':'.$reinit.':'.$rang;
	}
	if(empty($_POST['message']))
		$message = NULL;
	else
		$message = htmlspecialchars($_POST['message']);
	$action = intval(htmlspecialchars($_POST['action']));
	if($action == 1)
	{
		$cmd = 'cmd:';
		$cmd.= htmlspecialchars($_POST['cmd']);
	}
	elseif($action == 2)
	{
		$cmd = 'give:id:';
		$cmd.= htmlspecialchars($_POST['id']).':quantite:';
		$cmd.= htmlspecialchars($_POST['quantite']);
	}
	else
	{
		$cmd = 'jeton:';
		$cmd.= htmlspecialchars($_POST['quantite']);
	}
	$serveur = intval(htmlspecialchars($_POST['serveur']));
	$req = $bddConnection->prepare('INSERT INTO cmw_votes_recompense_auto_config (type, valueType, message, commande, serveur) VALUES (:type, :value, :message, :commande, :serveur)');
	$req->execute(array(
		'type' => $type,
		'value' => $value,
		'message' => $message,
		'commande' => $cmd,
		'serveur' => $serveur
	));
}