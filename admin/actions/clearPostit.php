<?php
if($_Permission_->verifPerm('PermsPanel', 'postit', 'actions', 'addPostIt')) {
	$req = $bddConnection->prepare('DELETE FROM cmw_postit WHERE 1');
	$req->execute();
}
?>