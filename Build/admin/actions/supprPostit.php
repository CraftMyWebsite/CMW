<?php
if($_Permission_->verifPerm('PermsPanel', 'postit', 'actions', 'addPostIt')) {
	$req = $bddConnection->prepare('DELETE FROM cmw_postit WHERE id = :id');
	$req->execute(array(':id' => $_POST['id']));
}
?>