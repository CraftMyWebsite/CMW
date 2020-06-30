<?php
require_once('modele/joueur/maj.class.php');
if(Permission::getInstance()->verifPerm("connect"))
{
	$req_recup = $bddConnection->prepare('SELECT * FROM cmw_votes_temp WHERE pseudo = :pseudo');
	$req_recup->execute(array(
		'pseudo' => $_Joueur_['pseudo']
	));
	$datas = $req_recup->fetchAll(PDO::FETCH_ASSOC);
	$req_suppr = $bddConnection->prepare('DELETE FROM cmw_votes_temp WHERE pseudo = :pseudo');
	$req_suppr->execute(array(
		'pseudo' => $_Joueur_['pseudo']
	));
	foreach ($datas as $data) {
		$joueurMaj = new Maj($_Joueur_['pseudo'], $bddConnection);
		$playerData = $joueurMaj->getReponseConnection();
		$playerData = $playerData->fetch(PDO::FETCH_ASSOC);	
		$action = explode(':', $data['action'], 2);
		if($action[0] == "give")
		{
			$action = explode(':', $action[1]);
			$id = $action[1];
			$quantite = $action[3];
			if($lectureVotes['methode'] == 2)
			{
				$jsonCon[$lectureVotes['serveur']]->GivePlayerItem($id . ' ' .$quantite);
			}
			else
			{
				for($j =0; $j < count($jsonCon); $j++)
				{
					$jsonCon[$j]->GivePlayerItem($id . ' ' .$quantite);
				}
			}
		}
		elseif($action[0] == "jeton")
		{
			if($lectureVotes['methode'] == 2)
			{
				ajouterTokens($action[1]);
			}
			else
			{
				ajouterTokens($action[1]);
			}
		}
		else
		{
			$cmd = str_replace('{JOUEUR}', $_Joueur_['pseudo'], $action[1]);
			if($lectureVotes['methode'] == 2)
			{
				$jsonCon[$lectureVotes['serveur']]->runConsoleCommand($cmd);
			}
			else
			{
				for($j = 0; $j < count($jsonCon); $j++)
				{
					$jsonCon[$j]->runConsoleCommand($cmd);
				}
			}
		}
	}
	header('Location: ?page=voter&success=recupTemp');
}

function ajouterTokens($number){
	global $playerData, $joueurMaj, $_Joueur_;
	$playerData['tokens'] = $playerData['tokens'] + $number;
	$joueurMaj->setReponseConnection($playerData);
	$joueurMaj->setNouvellesDonneesTokens($playerData);
	$_Joueur_['tokens'] = $_Joueur_['tokens'] + $number;
	$_SESSION['Player']['tokens'] = $_Joueur_['tokens']; 
}