<?php
if(Permission::getInstance()->verifPerm("connect"))
{

	require_once('modele/joueur/maj.class.php');
	$joueurMaj = new Maj($_Joueur_['pseudo'], $bddConnection);
	$playerData = $joueurMaj->getReponseConnection();
	$playerData = $playerData->fetch(PDO::FETCH_ASSOC);	

	require_once('modele/vote.class.php');
	$vote = new vote($bddConnection, $_Joueur_['pseudo'], null);

	$req_recup = $bddConnection->prepare('SELECT * FROM cmw_votes_temp WHERE pseudo = :pseudo');
	$req_recup->execute(array(
		'pseudo' => $_Joueur_['pseudo']
	));
	$datas = $req_recup->fetchAll(PDO::FETCH_ASSOC);

	foreach ($datas as $data) {
		echo $data['action'].'----';
		$vote->giveRecompense($bddConnection, $data['action'],$jsonCon);
	}

	$req_suppr = $bddConnection->prepare('DELETE FROM cmw_votes_temp WHERE pseudo = :pseudo');
	$req_suppr->execute(array(
		'pseudo' => $_Joueur_['pseudo']
	));
}
