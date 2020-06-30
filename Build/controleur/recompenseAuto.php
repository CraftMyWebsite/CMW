<?php
require('modele/recompenseAuto.class.php');
include('controleur/topVoteurs.php');

$RecompenseAuto = new RecompenseAuto($bddConnection, $_Joueur_);
$donneesRA = $RecompenseAuto->getRecompensesAuto();
$verif = $RecompenseAuto->verifDate();
if(!empty($verif))
{
	foreach($verif as $value)
	{
		$action = explode(':', $value['commande'], 2);
		if($action[0] == "give")
		{
			$action = explode(':', $action[1]);
			$id = $action[1];
			$quantite = $action[3];
		}
		elseif($action[0] == "jeton")
		{
			$quantite = $action[1];
		}
		$message = str_replace('{JOUEUR}', $topVoteurs[$value['rang']-1]['pseudo'], str_replace('{QUANTITE}', $quantite, str_replace('{ID}', $id, str_replace('&amp;', '§', $value['message']))));
		if(!empty($value['message']))
		{
			$jsonCon[$value['serveur']]->SendBroadcast($message);
		}
		//Req d'ajout dans le "récupérer plus tard"
		$req = $bddConnection->prepare('INSERT INTO cmw_votes_temp (pseudo, methode, action, serveur) VALUES (:pseudo, :methode, :action, :serveur)');
		$req->execute(array(
			'pseudo' => $topVoteurs[$value['rang']-1]['pseudo'],
			'methode' => 2,
			'action' => $value['commande'],
			'serveur' => $value['serveur']
		));
		if($value['reinit'] == 1)
		{
			$reqReinit = $bddConnection->query('TRUNCATE cmw_votes');
		}
		$reqSuppr = $bddConnection->prepare('DELETE FROM cmw_votes_recompense_auto_config WHERE id = :id');
		$reqSuppr->execute(array(
			'id' => $value['id']
		));
	}
}