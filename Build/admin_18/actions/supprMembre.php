<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'members', 'actions', 'editMember')) {
	$req = $bddConnection->prepare('DELETE FROM cmw_users WHERE id = :id');
	$req->execute(array(':id' => $_GET['id']));
}
?>