<?php 
if(Permission::getInstance()->verifPerm('PermsPanel', 'payment', 'actions', 'verifPaysafecard'))
{
	if(isset($_GET['offre']))
	{
		$req = $bddConnection->prepare('SELECT pseudo, cmw_paysafecard_offres.jetons AS jetons FROM cmw_paysafecard_historique INNER JOIN cmw_paysafecard_offres ON offre = cmw_paysafecard_offres.id WHERE cmw_paysafecard_historique.id = :id');
		$req->execute(array(
			'id' => htmlspecialchars($_GET['offre'])
		));
		$fetch = $req->fetch(PDO::FETCH_ASSOC);
		if(isset($fetch['pseudo']))
		{
			$addJetons = $bddConnection->prepare('UPDATE cmw_users SET tokens = tokens + :tokens WHERE pseudo = :pseudo');
			$addJetons->execute(array(
				'tokens' => $fetch['jetons'],
				'pseudo' => $fetch['pseudo']
			));
			$traiter = $bddConnection->prepare('UPDATE cmw_paysafecard_historique SET statut = 1 WHERE id = :id');
			$traiter->execute(array(
				'id' => htmlspecialchars($_GET['offre'])
			));
		}
	}
}