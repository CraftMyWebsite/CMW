<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'postit', 'actions', 'addPostIt')) {
	$req = $bddConnection->prepare('DELETE FROM cmw_postit WHERE 1');
	$req->execute();
}
?>