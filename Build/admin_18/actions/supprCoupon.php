<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'shop', 'action', 'modifCoupon'))
{
	if(isset($_GET['id']))
	{
		$id = htmlspecialchars($_GET['id']);
		$req = $bddConnection->prepare('DELETE FROM cmw_boutique_reduction WHERE id = :id');
		$req->execute(array('id' => $id));
	}
}