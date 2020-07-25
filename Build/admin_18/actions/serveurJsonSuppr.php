<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'server', 'actions', 'editServer')) {

	$req = $bddConnection->prepare('DELETE FROM cmw_serveur WHERE id = :id');
	$req->execute(array(
		'id' => htmlspecialchars($_GET['nom'])
	));
}
?>