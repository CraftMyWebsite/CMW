<?php
if(Permission::getInstance()->verifPerm("connect"))
{

	echo '[DIV]';
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

	$flag = 0;

	foreach ($datas as $data) {
		if($vote->giveRecompense($bddConnection, $data,$jsonCon, true)) {
			$flag++;
		}
	}

	if($flag != 0) {
 		echo $flag;
	}

/*	$req_suppr = $bddConnection->prepare('DELETE FROM cmw_votes_temp WHERE pseudo = :pseudo');
	$req_suppr->execute(array(
		'pseudo' => $_Joueur_['pseudo']
	)); */
}
