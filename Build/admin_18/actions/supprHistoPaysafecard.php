<?php 
if(Permission::getInstance()->verifPerm('PermsPanel', 'payment', 'actions', 'verifPaysafecard'))
{
	if(isset($_GET['offre']))
	{
		$req = $bddConnection->prepare('DELETE FROM cmw_paysafecard_historique WHERE id = :id');
		$req->execute(array(
			'id' => htmlspecialchars($_GET['offre'])
		));
	}
}